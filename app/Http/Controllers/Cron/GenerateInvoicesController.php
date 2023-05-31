<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\Client;

class GenerateInvoicesController extends Controller
{

  public function index()
  {

    // Obtenir tous les clients
    $clients = Client::all();

    // Pour chaque client, obtenir les chevaux
    foreach ($clients as $client) {
      /** @var Client $client */
      foreach ($client->horses as $horse) {
        $client->generateInvoice($horse);
      }
    }
  }

}
