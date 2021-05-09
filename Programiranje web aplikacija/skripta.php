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
			<li><a href="index.php">Naslovnica</a></li>
			<li><a href="onama.html">O nama</a></li>
			<li><a href="unos.html">Napiite vijesti</a></li>
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
<h2>Podaci:</h2>
<?php
	$Eposta = $_POST['Eposta'];
	$Naslov = $_POST['Naslov'];
	$Tekst = $_POST['Tekst'];
	$Sazetak = $_POST['Sazetak'];
	$Kategorija = $_POST['Kategorija'];
	$Slika = basename($_FILES['Slika']['name']);
	$domena = 'slike/'.$Slika;
	
	if (empty($_POST['Naslovnica'])){
		$Naslovnica = 0;
		$Potvrda = 'ne';
	}

	else {
		$Naslovnica = 1;
		$Potvrda = 'da';
	}

	$baza = mysqli_connect('localhost', 'root', '', 'portal') or die('<p class="upozorenje">Nema veze sa bazom!</p>');

	$upit = "INSERT INTO tablica (Eposta, Naslov, Tekst, Sazetak, Naslovnica, Kategorija, Slika)
	VALUES ('$Eposta', '$Naslov', '$Tekst', '$Sazetak', '$Naslovnica', '$Kategorija', '$Slika')";
	
	if(move_uploaded_file($_FILES['Slika']['tmp_name'], $domena)) $potvrda = $slika;
	
	else $potvrda = '<p class="upozorenje">Nema slike!</p>';

	echo 'Uneeni podaci su:<br/>'.
		'E-pota: '. $Eposta .'<br/>'.
		'Naslov: '. $Naslov . '<br/>'.
		'Saetak: '. $Sazetak . '<br/>'.
		'Odlomak: '. $Tekst . '<br/>'.
		'Da li je na naslovnici: '. $Potvrda . '<br/>'.
		'Kategorija: '. $Kategorija . '<br/>'.
		'Slika: '. $Slika . '<br/><br/>';
	
	

	$rezultat = mysqli_query($baza, $upit) or die('<p class="upozorenje">Pogreka u vezi sa bazom!</p>');
	mysqli_close($baza);
?>
</main>
</body>
</html>