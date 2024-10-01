<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>


    <h3>{{ $mailData['title'] }}</h3>
  
    <p>Salut,EDEN GARDEN RESORT vient de confirmer votre reservation @if( $mailData['chambre']) {{ $mailData['chambre'] }} @endif @if( $mailData['salle']) {{ $mailData['salle'] }} @endif @if( $mailData['paillote']) {{ $mailData['paillote'] }} @endif,Alors,Soyez bienvenu le {{ $mailData['date'] }} à {{ $mailData['time'] }}.</p>
    <p>
        Eden Garden Resort est doté de différentes salles pour réunions et conférences ainsi que plusieurs salles pour réceptions, cocktails et grands évènements, avec tous les équipements technologiques nécessaires.
    </p>
    <p>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2ls7SGRft-1groG5wsBzdGZdgVf9EiYvxhA&usqp=CAU">
    </p>
    <p>
        Discutez avec nous sur Whatsapp : <a href="https://api.whatsapp.com/send?phone=79500500" target="_blank" class="nav-link"><span class="icon-whatsapp"></span>79500500</a>
    </p>
     <p>
         DESIGNED BY <a href="">AIT</a>
     </p>
    <p>Merci !</p>
</body>
</html>