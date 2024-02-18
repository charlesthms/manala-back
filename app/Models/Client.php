<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
  use HasFactory, HasUuids, SoftDeletes;

  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'phone_number',
    'address',
    'horse',
  ];

  public function pension()
  {
    return $this->belongsTo(Pension::class);
  }

  public function horses()
  {
    return $this->hasMany(Horse::class);
  }

  public function options()
  {
    return $this->hasMany(ClientOption::class);
  }

  public function invoices()
  {
    return $this->hasMany(Invoice::class);
  }

  public function generateInvoice(Horse $horse, $currentMonth = false) {
    // Générer un numéro de facture
    if ($currentMonth) {
      $invoiceNumber = 'FC' . date('ym', strtotime('+0 month')) . str_pad(Invoice::whereMonth('date', now()->month)->whereYear('date', now()->year)->count() + 1, 2, '0', STR_PAD_LEFT);
    } else {
      $invoiceNumber = 'FC' . date('ym', strtotime('+1 month')) . str_pad(Invoice::whereMonth('date', now()->addMonth()->month)->whereYear('date', now()->addMonth()->year)->count() + 1, 2, '0', STR_PAD_LEFT);
    }

    // Créer la facture
    $invoice = $this->invoices()->create([
      'invoice_number' => $invoiceNumber,
      'pension_id'     => $horse->pension_id,
      'horse_id'       => $horse->id,
      'status'         => 0,
      'date'           => $currentMonth ? now()->startOfMonth()->format('Y-m-d') : now()->addMonth()->startOfMonth()->format('Y-m-d'),
    ]);

    // Ajouter les options
    foreach ($this->options as $option) {
      $invoice->items()->create([
        'name'      => $option->name,
        'quantity'  => 1,
        'price'     => $option->price,
        'is_option' => true,
      ]);
    }

    // Ajouter la pension
    $invoice->items()->create([
      'name'      => 'Pension formule ' . $horse->pension->name,
      'quantity'  => 1,
      'price'     => $horse->pension->price,
      'is_option' => false,
    ]);

    return $invoice;
  }

}
