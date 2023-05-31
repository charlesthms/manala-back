<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientOption extends Model
{
  use HasFactory;

  protected $table = 'client_option';

  protected $fillable = [
    'client_id',
    'name',
    'price',
  ];
}
