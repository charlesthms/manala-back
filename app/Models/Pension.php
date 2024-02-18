<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pension extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'price',
    'color',
    'description',
    'attributes',
  ];

  public function clients()
  {
    return $this->hasMany(Client::class);
  }

  public function horses()
  {
    return $this->hasMany(Horse::class);
  }

}
