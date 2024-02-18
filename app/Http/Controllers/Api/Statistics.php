<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Pension;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Horse;

class Statistics extends Controller
{
  public function pensionRepartion(Request $request) {
    $tab_pensions = [];
    $tab_count    = [];

    // Obtenir toues les pensions
    $pensions = Pension::all();

    // Pour chaque pension, obtenir le nombre de chevaux dont les clients ne sont pas supprimés
    foreach ($pensions as $pension) {
      // Ajouter le nombre de chevaux au tableau
      $tab_pensions[] = $pension->name;
      $tab_count[] = $pension->horses->count();
    }

    // Retourner le tableau
    return response()->json([
      'data' => ['labels' => $tab_pensions, 'values' => $tab_count],
    ]);

  }

  public function monthlyIncomes() {
    $tab_incomes = [];
    $tab_months  = [];

    // Obtenir les 12 derniers
    $months = collect(range(0, 11))->map(function ($i) {
      return now()->subMonths($i)->format('F');
    })->reverse();

    // Pour chaque mois, obtenir le montant total des factures
    foreach ($months as $month) {

      // Pour chaque facture obtenir le montant total via chaque item
      $tab_incomes[] = Invoice::whereMonth('created_at', Carbon::parse($month)->month)->get()->map(function ($invoice) {
        return $invoice->items->sum(function ($item) {
          return $item->price * $item->quantity;
        });
      })->sum();

      // Ajouter le mois au tableau en français
      // convert month name to french
      setlocale(LC_TIME, 'fr_FR.UTF-8');
      $month = strftime('%B', strtotime($month));
      $tab_months[] = ucfirst($month);
    }

    // Retourner le tableau
    return response()->json([
      'data' => ['labels' => $tab_months, 'values' => $tab_incomes],
    ]);
  }

  public function getPensionByHorse() {
    // Obtenir pour chaque client, chque cheval et sa pension sous forme client => cheval => pension
    $clients = Client::with('horses.pension')->get();

    $tab_pensions = [];

    foreach ($clients as $client) {
      $tab_pensions[] = $client;
    }

    return response($tab_pensions);

  }

}
