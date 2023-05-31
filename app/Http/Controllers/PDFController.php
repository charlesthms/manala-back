<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Support\Facades\Response;

class PDFController extends Controller
{

  public function generatePDF($id)
  {

    // Trouver la facture
    /** @var Invoice $invoice */
    $invoice = Invoice::where('id', $id)->firstOrFail();

    $pdf = $invoice->generatePDF();

    return Response::make($pdf->output(['compress' => 0]), 200, [
      'Content-Type' => 'application/pdf',
      'Content-Disposition' => 'inline; filename="' . $invoice['number'] . '.pdf"'
    ]);

  }

}
