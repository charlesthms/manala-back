<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facture mensuelle</title>
  <style>
    * {
      margin: 0;
      padding: 0;
    }

    body {
      background-color: #F1EDE7;
      font-family: 'Inner', sans-serif;
      font-weight: 100;
      line-height: 1.5;
    }

    .accent {
      color: #feb19d;
      font-weight: bold;
    }

    .content {
      max-width: 600px;
      margin: 2rem auto;
      background-color: #130d08e6;
      color: #F1EDE7;
      padding: 3rem;
      border-radius: 1rem;
    }

    .header {
      text-align: center;
    }

    hr {
      margin: 2rem;
    }

    .logo {
      max-width: 5rem;
      height: auto;
    }

    h4 {
      margin: 2rem 0;
    }

    p {
      text-align: justify;
      font-weight: lighter;
    }

    .recap {
      color: #F1EDE7;
      margin-top: 2rem;
      padding: 2rem;
      background-color: #645447;
      border-radius: 1rem;
    }

    .nobr {
      white-space: nowrap;
    }

    .m-0 {
      margin: 0px;
    }

    .p-0 {
      padding: 0px;
    }

    .pt-5 {
      padding-top: 5px;
    }

    .mt-5 {
      margin-top: 5px;
    }

    .mt-10 {
      margin-top: 10px;
    }

    .text-center {
      text-align: center !important;
    }

    .w-100 {
      width: 100%;
    }

    .w-50 {
      width: 50%;
    }

    .w-85 {
      width: 85%;
    }

    .w-15 {
      width: 15%;
    }

    .gray-color {
      color: #5D5D5D;
    }

    .text-light {
      color: #A0A0A0;
      font-size: .8rem;
      font-weight: lighter;
    }

    .text-bold {
      font-weight: bold;
    }

    .border {
      border: 1px solid black;
    }

    table tr,
    th,
    td {
      border: none;
      border-collapse: collapse;
      padding: 7px 8px;
    }

    table tr th {
      background: #130d08e6;
      color: white;
      font-weight: lighter;
      text-transform: uppercase;
      font-size: .8rem;
    }

    table tr td {
      font-size: 13px;
      padding: 1rem;
    }

    table {
      border-collapse: collapse;
    }

    table th.first {
      border-radius: 0.5rem 0 0 0.5rem;
    }

    table th.last {
      border-radius: 0 0.5rem 0.5rem 0;
    }

    .box-text p {
      line-height: 10px;
    }

    .float-left {
      float: left;
    }

    .total-part {
      font-size: 16px;
      line-height: 12px;
    }

    .total-right p {
      padding-right: 20px;
    }

    .bt-1 {
      border-top: 1px solid #FFEFE6;
    }

    .subtotal td {
      padding-top: 0;
    }

    .bande {
      width: 100%;
      border-radius: 1rem;
      margin: 2rem 0;
    }

    footer {
      display: flex;
      justify-content: space-between;
    }

    .socials {
      justify-self: end;
    }

    @media only screen and (max-width: 600px) {
      .content {
        padding: 1rem;
        margin: 5px;
      }
    }
  </style>
</head>
<body>
<div class="content">
  <div class="header">
    <div>
      <img src="https://ecurieduvalhalla.fr/img/site/logo.png" class="logo">
      <h1>Facture mensuelle</h1>
    </div>
    <hr>
  </div>

  <h4>Bonjour {{ explode(' ', $invoice['client']['name'])[1] }},</h4>

  <p style="margin-bottom: 2rem;">
    Voici un récapitulatif de votre facture mensuelle <span class="accent">N° {{ $invoice['number'] }}</span>.
    Vous trouverez la facture détaillée au format PDF en pièce jointe.<br>
  </p>

  <div class="recap table-section bill-tbl mt-10">
    <table class="table w-100 mt-10">
      <tr>
        <th class="w-100 nobr first">Désignation</th>
        <th class="w-50 nobr last">Prix HT</th>
      </tr>

      @foreach($invoice['items'] as $item)
        <tr align="left">
          <td class="text-bold">{{ $item['name'] }}</td>
          <td class="nobr">{{ $item['total'] }} €</td>
        </tr>
      @endforeach

      <tr align="right">
        <td class="bt-1">Sous-total</td>
        <td class="bt-1 nobr">{{ $invoice['total'] }} €</td>
      </tr>
      <tr align="right" class="subtotal">
        <td>TVA 0%</td>
        <td align="center">0.00€</td>
      </tr>
      <tr align="right" class="text-bold">
        <td class="bt-1">TOTAL TTC</td>
        <td class="bt-1 nobr">{{ $invoice['total'] }} €</td>
      </tr>
    </table>
  </div>

  <p style="margin-top: 2rem">
    Veuillez noter que si le paiement n'est pas reçu avant la date limite, des frais de retard peuvent être appliqués.<br>
  </p>

  <img src="https://ecurieduvalhalla.fr/img/site/bande.png" class="bande">

  <footer>
    <table style="width: 100%">
      <tbody>
      <tr>
        <td>
          <div>
            Pour toute question ou demande : <span class="text-bold" style="color: white !important;">alexia@ecurieduvalhalla.fr</span>
          </div>
        </td>

        <td class="text-center">
          <div class="socials">
            <a href="https://www.facebook.com/profile.php?id=100076178269751"><img src="https://ecurieduvalhalla.fr/img/site/fb-icon.png"></a>
            <a href="https://www.instagram.com/ecurie_du_valhalla/?hl=fr"><img src="https://ecurieduvalhalla.fr/img/site/insta-icon.png"></a>
          </div>
        </td>
      </tr>
      <tr>
        <td class="text-center" colspan="2"><small>Si vous rencontrez des problèmes d'affichage, <a href="{{ route('emails.view', encrypt($invoice['id'])) }}" style="color: white !important;">cliquez pour afficher l'email dans votre navigateur</a></small></td>
      </tr>
      </tbody>
    </table>


  </footer>

</div>
</body>
</html>
