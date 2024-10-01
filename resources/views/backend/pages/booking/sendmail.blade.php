<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>


    <h3>{{ $mailData['title'] }}</h3>
  
    <p>Salut,{{ $mailData['nom'] }} vient de reserver @if( $mailData['chambre']) {{ $mailData['chambre'] }} @endif @if( $mailData['salle']) {{ $mailData['salle'] }} @endif @if( $mailData['paillote']) {{ $mailData['paillote'] }} @endif le {{ $mailData['date'] }} à {{ $mailData['time'] }},ils sont au nombre de {{ $mailData['ofpeople'] }}.</p>

     <p>
         DESIGNED BY <a href="">AIT</a>
     </p>
     <p>
         Discutez avec lui : <a href="https://api.whatsapp.com/send?phone={{ $mailData['phone_no'] }}" target="_blank" class="nav-link"><span class="icon-whatsapp"></span>{{ $mailData['phone_no'] }}</a>
     </p>
    <p>Merci !</p>
</body>
</html>