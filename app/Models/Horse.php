<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $fillable = [
    'name',
    'client_id',
    'pension_id',
  ];

  public function client()
  {
    return $this->belongsTo(Client::class);
  }

  public function pension()
  {
    return $this->belongsTo(Pension::class);
  }

}
