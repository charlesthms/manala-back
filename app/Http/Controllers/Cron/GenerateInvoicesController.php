<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invoice;

class GenerateInvoicesController extends Controller
{

  public function index()
  {
    // Obtenir tous les clients
    $clients = Client::all();

    // Verifier si le client a déjà une facture pour le mois courant
    $count = 0;
    foreach ($clients as $client) {
      /** @var Client $client */
      $invoice = $client->invoices()
        ->where('date', '>=', now()->addMonth()->startOfMonth())
        ->where('date', '<=', now()->addMonth()->endOfMonth())
        ->first();

      if (!isset($invoice)) {

        foreach ($client->horses as $horse) {
          $client->generateInvoice($horse);
          $count++;
        }
      }
    }

    return response()->json([
      'message' => $count . ' factures ont été générées.',
    ]);

  }

}
