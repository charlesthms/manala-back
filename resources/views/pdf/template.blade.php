<!DOCTYPE html>
<html lang="fr">
<head>
  <title>{{ $invoice['number'] }}</title>
</head>
<style type="text/css">
  body{
    font-family: 'Inter', sans-serif;
    color: #262626;
  }
  .m-0{
    margin: 0px;
  }
  .p-0{
    padding: 0px;
  }
  .pt-5{
    padding-top:5px;
  }
  .mt-5 {
    margin-top: 5px;
  }
  .mt-10{
    margin-top:10px;
  }
  .text-center{
    text-align:center !important;
  }
  .w-100{
    width: 100%;
  }
  .w-50{
    width:50%;
  }
  .w-85{
    width:85%;
  }
  .w-15{
    width:15%;
  }
  .logo img{
    width:65%
  }
  .gray-color{
    color:#5D5D5D;
  }
  .text-light{
    color:#A0A0A0;
    font-size: .8rem;
    font-weight: lighter;
  }
  .text-bold{
    font-weight: bold;
  }
  .border{
    border:1px solid black;
  }
  table tr,th,td{
    border: none;
    border-collapse:collapse;
    padding:7px 8px;
  }
  table tr th{
    background: #171717;
    color: white;
    font-weight: lighter;
    text-transform: uppercase;
    font-size: .8rem;
  }
  table tr td{
    font-size:13px;
    padding: 1rem;
  }
  table{
    border-collapse:collapse;
  }
  table th:first-child{
    border-radius:2rem 0 0 2rem;
  }

  table th:last-child{
    border-radius:0 2rem 2rem 0;
  }
  .box-text p{
    line-height:10px;
  }
  .float-left{
    float:left;
  }
  .total-part{
    font-size:16px;
    line-height:12px;
  }
  .total-right p{
    padding-right:20px;
  }
  .bt-1{
    border-top:1px solid #FFEFE6;
  }
  .subtotal td {
    padding-top: 0;
  }

  .bande {
    width: 100%;
    border-radius: 2rem
  }

  .bottom {
    position: absolute;
    bottom: 0;
    left: 0;
  }

  .law {
    display: block;
    margin: 10px 1rem;
    padding-left: 8px;
    font-weight: lighter;
    font-size: .8rem;
    font-weight: bold;
  }

  .duplicata {
    position: absolute;
    z-index: -1;
    font-size: 7rem;
    color: rgba(183, 183, 183, 0.52);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(45deg);
  }

</style>
<body>

  @if($invoice['duplicata'])
    <h1 class="duplicata">DUPLICATA</h1>
  @endif

  <div class="add-detail mt-10">
    <div class="w-50 float-left logo mt-10">
      <img src="{{ public_path('images/logo.png') }}" alt="Logo">
    </div>
    <div class="w-50 float-left mt-10">
      <h1>FACTURE</h1>
      <p class="mt-5 pt-5 text-bold w-100">Numéro de facture: <br> <span class="text-light">{{ $invoice['number'] }}</span></p>
      <p class="mt-5 pt-5 text-bold w-100">Date: <br> <span class="text-light">{{ $invoice['date'] }}</span></p>
      <p class="mt-5 pt-5 text-bold w-100">Equidé: <br> <span class="text-light">{{ $invoice['horse'] }}</span></p>
    </div>
    <div style="clear: both;"></div>
  </div>
  <div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
      <tr>
        <td class="w-50">
          <div class="box-text">
            <p>Ecurie du Valhalla</p>
            <p>La Florianne</p>
            <p>77120 CHAILLY-EN-BRIE</p>
            <p>RIB FR7618706000009754955834104</p>
            <p>BIC AGRIFRPP887</p>
            <p>N° TVA intra FR92902616390</p>
          </div>
        </td>
        <td style="padding-left: 0">
          <div class="box-text">
            <p class="text-bold">A: {{ $invoice['client']['name'] }}</p>
            <p>{{ explode('-', $invoice['client']['address'])[0] }}</p>
            <p>{{ explode('-', $invoice['client']['address'])[1] }}</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
          </div>
        </td>
      </tr>
    </table>
  </div>

  <div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
      <tr>
        <th class="w-100">Désignation</th>
        <th class="w-50">Prix HT</th>
        <th class="w-50">Quantité</th>
        <th class="w-50">Total HT</th>
      </tr>

      @foreach($invoice['items'] as $item)
        <tr align="center">
          <td class="text-bold" style="text-align: left;">{{ $item['name'] }}</td>
          <td>{{ $item['price'] }}€</td>
          <td>{{ $item['quantity'] }}</td>
          <td>{{ $item['total'] }}€</td>
        </tr>
      @endforeach

      <tr align="center">
        <td></td>
        <td></td>
        <td class="bt-1">Sous-total</td>
        <td class="bt-1">{{ $invoice['total'] }}€</td>
      </tr>
      <tr align="center" class="subtotal">
        <td></td>
        <td></td>
        <td>TVA 0%</td>
        <td>0.00€</td>
      </tr>
      <tr align="center" class="text-bold">
        <td></td>
        <td></td>
        <td class="bt-1">TOTAL TTC</td>
        <td class="bt-1">{{ $invoice['total'] }}€</td>
      </tr>
    </table>
  </div>

  <div class="table-section">
    <table class="table">
      <tr>
        <td><p style="font-weight: lighter"><b>Note:</b><br>Merci de bien vouloir noter le numéro de facture correspondant au dos des chèques de règlement. Libellez les chèques à l’ordre - Ecurie du Valhalla
            <br><b>Règlement avant le 5 du mois.</b></p></td>
      </tr>
    </table>
  </div>

  <div class="bottom">
    <span class="law">Article 293-B du CGI TVA non applicable</span>
    <img src="{{ public_path('images/bande.png') }}" class="bande">
  </div>
</body>
</html>
