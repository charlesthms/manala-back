<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{

  public function send(Request $request, $id)
  {
    /** @var Invoice $invoice */
    $invoice = Invoice::find($id);
    $array = $invoice->generatePDF(true);

    $pdf     = $array["pdf"];
    $invoice = $array["invoice"];

    return view('mails.template', compact('invoice'));

    $data["email"] = "carlitoo.thomas@gmail.com";
    $data["title"] = "Test envoi facture";

    Mail::send('mails.template', ['invoice' => $invoice], function($message) use ($data, $pdf) {
      $message->to($data["email"])->subject($data["title"])->cc(['thierry.thomas31@wanadoo.fr', 'alexia.thomas77@gmail.com']);
      $message->attachData($pdf->output(), "facture.pdf");
    });

    echo "Mail send successfully !!";
  }

  public function view($invoice)
  {
    $invoiceId = decrypt($invoice);

    $invoice = Invoice::find($invoiceId);
    $invoice= $invoice->generatePDF(true)['invoice'];

    return view('mails.template', compact('invoice'));
  }
}
