<!DOCTYPE html>
<html lang="hr">
<head>
	<link rel="stylesheet" href="dodaci/style.css"/>
  	<link rel="icon" href="dodaci/Logo.ico" type="image/ico" sizes="10x8"/>
	
	<title>Mrena stranica Slovo</title>

	<meta charset="ISO-8859-2"/>
  	<meta name="description" content="Mrena stranica vijesti Slovo"/>
 	<meta name="keywords" content="Vijesti, Portal, Novosti, Novine, Reportaa, Novinarstvo"/>
  	<meta name="author" content="Jaka Ciglar"/>
 	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
<figure>
	<img src="dodaci/Zaglavlje_slika.jpg" alt="Slika zaglavlja"/>
	<figcaption>Dobrodoli na mreni portal <b>Slovo</b>!</figcaption>
</figure>

<header>
	<aside>
		<img src="dodaci/Logo.png" width="125" height="100" alt="Vodeća slika"/><br/>
		<h1>Slovo</h1>
		<h2>Vijesti #1</h2>
	</aside>

	<nav>
		<div>Poveznice</div>
		<ul>
			<li><a href="http://www.tvz.hr/">Server</a></li>
			<li><a href="onama.html">O nama</a></li>
			<li><a href="unos.html">Napiite vijesti</a></li>
			<li><a href="registracija.html">Registracija</a></li>
		</ul>
	</nav>

</header>

<section>
	<ul>
		<li>
			<h3>Politika</h3>
			<ul>
				<li><a href="#">Prosvjed!</a></li>
			</ul>
		</li>

		<li>
			<h3>Sport</h3>
			<ul>
				<li><a href="#">Tenis</a></li>
			</ul>
		</li>

		<li>
			<h3>Kultura</h3>
			<ul>
				<li><a href="#">Otvorenje</a></li>
			</ul>
		</li>

		<li>
			<h3>Znanost</h3>
			<ul>
				<li><a href="#">Fuzija i fisija</a></li>
			</ul>
		</li>

		<li>
			<h3>Financije</h3>
			<ul>
				<li><a href="#">Pad eura!</a></li>
			</ul>
		</li>

		<li>
			<h3>Ostalo</h3>
			<ul>
				<li><a href="#">Mesne krafne</a></li>
			</ul>
		</li>
	</ul>
</section>

<main>
	<h2>Dananje vijesti</h2>
	<article>
<?php
	$baza = mysqli_connect('localhost', 'root', '', 'portal') or die('<p class="upozorenje">Nema veze sa bazom!</p>');
	$upit = "SELECT * FROM tablica";
	$brojac = 0;

	$result = mysqli_query($baza, $upit);
	
	while($redak = mysqli_fetch_array($result)) {
	$brojac++;

	if($redak['Naslovnica'] != 0) {
		$slika = $redak['Slika'];

		echo '<a href="#"><h4>'. $redak['Naslov'] .'</h4>';
		if($slika != null or $slika != "") echo '<img src="slike/'. $slika .'" alt="'. $slika .'"/>';
		echo '<p>'. $redak['Sazetak'] .'</p></a>';
	}

	if($brojac == 3) echo '<br style="clear:both;"/>';

	elseif($brojac == 6) {
			break;
			mysqli_close($baza);
		}
	}
?>
	</article>
</main>
<footer>
	<ul>
		<li><a href="https://www.facebook.com/"><img src="dodaci/Facebook_ikona.ico" alt="Facebook"/></a></li>
		<li><a href="https://twitter.com/"><img src="dodaci/Twitter_ikona.ico" alt="Twitter"/></a></li>
		<li><a href="https://www.youtube.com/"><img src="dodaci/Youtube_ikona.ico" alt="Youtube"/></a></li>
		<li><a href="https://plus.google.com/"><img src="dodaci/Google_plus_ikona.ico" alt="Google +"/></a></li>
	</ul>

	<span title="Podaci o dizajneru">
		Autor: Jaka Ciglar<br/>
		E-pota: <a href="mailto:jciglar@tvz.hr" target="_blank">jciglar@tvz.hr</a><br/>
		Stranica SLOVOŠ izrađena 2017. godine. Sva su prava zadrana.
	</span>

</footer>
</body>
</html>