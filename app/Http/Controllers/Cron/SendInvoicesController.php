<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;

class SendInvoicesController extends Controller
{

  public function sendInvoices()
  {

    $email_sent = 0;
    $queue = Invoice::where('status', 1)->get();

    foreach ($queue as $invoice) {

      /** @var Invoice $invoice */
      $array = $invoice->generatePDF(true);

      $pdf          = $array["pdf"];
      $invoice_data = $array["invoice"];

      $data = [
        "email" => $invoice->client()->get()[0]->email,
        "title" => "Facture mensuelle pour " . $invoice->horse()->get()[0]->name,
      ];

      $filename = $invoice->invoice_number . '_' . $invoice->horse()->get()[0]->name . ".pdf";

      Mail::send('mails.template', ['invoice' => $invoice_data], function($message) use ($data, $pdf, $filename) {
        //$message->to($data["email"])->subject($data["title"])->cc('alexia@ecurieduvalhalla.fr');
        $message->to('carlitoo.thomas@gmail.com')->subject($data["title"]);
        $message->attachData($pdf->output(), $filename);
      });

      dd('email envoyé');

      $invoice->status = 2;
      $invoice->save();

      $email_sent++;

    }

    dd($email_sent . ' emails envoyés');

  }

}
