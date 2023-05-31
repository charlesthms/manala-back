<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facture mensuelle</title>
</head>
<body style="background-color: #F1EDE7; font-family: Arial, sans-serif; font-weight: 100; line-height: 1.5; margin: 0; padding: 0;">
<table align="center" style="max-width: 600px; margin: 2rem auto; background-color: #130d08e6; color: #F1EDE7; padding: 3rem; border-radius: 1rem;">
  <tr>
    <td align="center">
      <img src="https://ecurieduvalhalla.fr/img/site/logo.png" style="max-width: 5rem; height: auto;">
      <h1 style="color: #feb19d; font-weight: bold;">Facture mensuelle</h1>
      <hr style="margin: 2rem;">
    </td>
  </tr>
  <tr>
    <td>
      <h4 style="margin: 2rem 0;">Bonjour {{ explode(' ', $invoice['client']['name'])[1] }},</h4>
      <p style="text-align: justify; font-weight: lighter; margin-bottom: 2rem;">
        Voici un récapitulatif de votre facture mensuelle <span style="color: #feb19d; font-weight: bold;">N° {{ $invoice['number'] }}</span>.
        Vous trouverez la facture détaillée au format PDF en pièce jointe.<br>
      </p>
    </td>
  </tr>
  <tr>
    <td>
      <table align="center" style="width: 100%; margin-top: 2rem; border-collapse: collapse;">
        <tr>
          <th style="width: 50%; background: #130d08e6; color: white; font-weight: lighter; text-transform: uppercase; font-size: .8rem;">Désignation</th>
          <th style="width: 50%; background: #130d08e6; color: white; font-weight: lighter; text-transform: uppercase; font-size: .8rem;">Prix HT</th>
        </tr>
        @foreach($invoice['items'] as $item)
          <tr align="center">
            <td style="font-size: 13px; padding: 1rem; font-weight: bold;">{{ $item['name'] }}</td>
            <td style="font-size: 13px; padding: 1rem;">{{ $item['total'] }} €</td>
          </tr>
        @endforeach
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <p style="text-align: justify; font-weight: lighter; margin-top: 2rem;">
        Veuillez noter que si le paiement n'est pas reçu avant la date limite, des frais de retard peuvent être appliqués.<br>
      </p>
    </td>
  </tr>
  <tr>
    <td align="center">
      <img src="https://ecurieduvalhalla.fr/img/site/bande.png" style="width: 100%; border-radius: 1rem; margin: 2rem 0;">
    </td>
  </tr>
  <tr>
    <td>
      <table style="width: 100%;">
        <tr>
          <td>
            <div>
              Pour toute question ou demande : <span style="font-weight: bold;">alexia@ecurieduvalhalla.fr</span>
            </div>
          </td>
          <td align="center">
            <div>
              <a href="https://www.facebook.com/profile.php?id=100076178269751"><img src="https://ecurieduvalhalla.fr/img/site/fb-icon.png"></a>
              <a href="https://www.instagram.com/ecurie_du_valhalla/?hl=fr"><img src="https://ecurieduvalhalla.fr/img/site/insta-icon.png"></a>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
