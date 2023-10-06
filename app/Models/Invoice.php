<?php

namespace App\Models;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ZipArchive;

class Invoice extends Model
{
  use HasFactory;

  protected $fillable = [
    'invoice_number',
    'client_id',
    'pension_id',
    'horse_id',
    'duplicate',
    'status',
    'date',
  ];

  public function client()
  {
    return $this->belongsTo(Client::class);
  }

  public function horse()
  {
    return $this->belongsTo(Horse::class);
  }

  public function pension()
  {
    return $this->belongsTo(Pension::class);
  }

  public function items()
  {
    return $this->hasMany(InvoiceItem::class);
  }

  public function deleteInvoice()
  {
    // Delete related items
    $this->items()->delete();

    // Delete the invoice
    $this->delete();

    // Optionally, you may want to delete the associated PDFs or perform other cleanup

    return true; // Or you can return a response indicating the success or failure of the deletion
  }

  public function getTotalAttribute()
  {
    return $this->items->sum(function (InvoiceItem $item) {
      return $item->getTotalAttribute();
    });
  }

  public function generatePDF($getData = false): array | \Barryvdh\DomPDF\PDF
  {
    // Trouver le client
    $client = $this->client()->withTrashed()->first();

    // Trouver les items de la facture
    $items = $this->items;

    // Mettre l'item dont l'attribut is_option est à true en premier
    $items = $items->sortBy('is_option');

    $tab_items = [];
    foreach ($items as $item) {
      $tab_items[] = [
        'name' => $item->name,
        'quantity' => $item->quantity,
        'price' => number_format($item->price, 2, ',', ' '),
        'total' => number_format($item->getTotalAttribute(), 2, ',', ' '),
      ];
    };

    $invoice = [
      'id' => $this->id,
      'duplicata' => $this->status > 1,
      'number' => $this->invoice_number,
      'date' => date('d-m-Y', strtotime($this->date)),
      'horse' => Horse::findOrFail($this->horse_id)->name,
      'client' => [
        'name' => $client->first_name . ' ' . $client->last_name,
        'address' => $client->address,
        'city' => '',
      ],
      'items' => $tab_items,
      'total' => number_format($this->getTotalAttribute(), 2, ',', ' '),
    ];

    if ($getData) {
      return [
        'pdf' => PDF::loadView('pdf.template', compact('invoice')),
        'invoice' => $invoice,
      ];
    } else {
      return PDF::loadView('pdf.template', compact('invoice'));
    }

  }

  public static function exportMonthFolder($date)
  {
    // Create a temporary folder to store the PDFs
    $tempFolder = storage_path('app/temp');
    if (!file_exists($tempFolder)) {
      mkdir($tempFolder, 0755, true);
    }

    // Get the invoices within the date range
    $invoices = Invoice::where('date', Carbon::createFromFormat("d/m/Y", $date)->format("Y/m/d"))->get();

    // Generate PDFs and save them in the temporary folder
    foreach ($invoices as $invoice) {
      $pdf = $invoice->generatePDF(true)['pdf'];
      $pdfPath = $tempFolder . '/' . $invoice->invoice_number . '-' . $invoice->horse->name . '.pdf';
      $pdf->save($pdfPath);
    }

    // Create a zip archive
    $zipPath = storage_path('app/' . Carbon::createFromFormat('d/m/Y', $date)->format('m-Y') . '.zip');
    $zip = new ZipArchive;
    $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    // Add the PDFs to the zip archive
    $pdfFiles = glob($tempFolder . '/*.pdf');
    foreach ($pdfFiles as $pdfFile) {
      $zip->addFile($pdfFile, basename($pdfFile));
    }

    // Close the zip archive
    $zip->close();

    // Remove the temporary folder and PDFs
    foreach ($pdfFiles as $pdfFile) {
      unlink($pdfFile);
    }
    rmdir($tempFolder);

    // Return the path to the zip folder
    return $zipPath;
  }

}
