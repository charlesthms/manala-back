<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $fillable = [
    'invoice_id',
    'name',
    'quantity',
    'price',
    'is_option',
  ];

  public function invoice()
  {
    return $this->belongsTo(Invoice::class);
  }

  public function getTotalAttribute()
  {
    return floatval($this->quantity * $this->price);
  }
}
