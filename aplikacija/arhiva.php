<!DOCTYPE html>
<html>

<head>
	<meta charset="ISO-8859-2"/>
	<title>Rezultati</title> 
	<link rel="stylesheet" type="text/css" href="dodaci/style.css">
</head>

<body>
	<img src="http://www.netakademija.hr/wp-content/uploads/2015/05/tvz-plavi.png" alt="Tehničko Veleučilite u Zagrebu"/><br/>

<?php
	$baza = mysqli_connect('localhost', 'root', '', 'projekt') or die('Nema povezanosti sa bazom!');
	$i = 0;

	$upit_multi = "SELECT COUNT(id) FROM pitanja WHERE tip NOT LIKE 'tekst'";

	$rezultat_multi = mysqli_query($baza, $upit_multi);

	$broj_multi = mysqli_fetch_array($rezultat_multi);

	$var = $broj_multi['COUNT(id)'];

for($i = 1; $i <= $var; $i++) {
	$upit1_multi = "SELECT * FROM pitanja WHERE id = '$i'";
	$upit2_multi = "SELECT * FROM odgovor_multi WHERE sifText = '$i'";

	$rezultat1 = mysqli_query($baza, $upit1_multi);
	$rezultat2 = mysqli_query($baza, $upit2_multi);

	while($redak1 = mysqli_fetch_array($rezultat1)){

	echo '<h2>'.$redak1['pitanje'].'</h2>';
	echo '<ul>';

		while($redak2 = mysqli_fetch_array($rezultat2)){

	for($k = 0; $k <= 8; $k++) $max += $redak2['odg'.$k.''];

	$opti = ($max / 4) * 3;
	$opti = number_format($opti, 0, '.', '');

	$low = $max / 3;
	$low = number_format($low, 0, '.', '');

	$high = $low * 2;
	$high = number_format($high, 0, '.', '');

	for($j = 1; $j <= 8; $j++) {
		if($redak2['odg'.$j.''] != 0){

		$rez = $redak2['odg'.$j.''];
			
		 echo '<li>Odgovor '.$j.': <b>'.$redak1['odg'.$j.''].'</b> 
			<meter value="'.$rez.'" min="0" max="'.$max.'"
			high="'.$high.'" low="'.$low.'" optimum="'.$opti.'">Va prebirnik ne podrava ovaj objekt.</meter>
			 ('.$rez.' glasova)</li>';
				}
			}
		}

	echo '</ul><hr/>';

	$max = 0;
	}
}


	$upit_tekst = "SELECT COUNT(id) FROM pitanja WHERE tip LIKE 'tekst'";

	$rezultat_tekst = mysqli_query($baza, $upit_tekst);
	
	$broj_tekst = mysqli_fetch_array($rezultat_tekst);

	$kol = $broj_tekst['COUNT(id)'];

for($i = 1; $i <= $kol; $i++) {

	$upit1_tekst = "SELECT * FROM pitanja WHERE tip LIKE 'tekst'";
	$upit2_tekst = "SELECT * FROM odgovor_text WHERE sifPitanje = '$i'";
	$upit_kol = "SELECT COUNT(sifText) FROM odgovor_text WHERE sifPitanje = '$i'";

	$rezultat3 = mysqli_query($baza, $upit1_tekst);
	$rezultat4 = mysqli_query($baza, $upit2_tekst);
	$rezultat_kol = mysqli_query($baza, $upit_kol);

	$redak_tekst = mysqli_fetch_array($rezultat_kol);

	$broj = $redak_tekst['COUNT(sifText)'];


	while($redak3 = mysqli_fetch_array($rezultat3)){
	echo '<h2>'.$redak3['pitanje'].'</h2>';

echo '<ul>';
		while($redak4 = mysqli_fetch_array($rezultat4)){

	for($j = 1; $j < $broj; $j++) echo '<li>'.$redak4['tekst'].'</li>';

			}
		}
	echo '</ul><hr/>';
}

	mysqli_close($baza);
?>

<button><a href="index.html">Na početnu stranicu.</a></button>

		<footer>Fantastična Četvorka copyright 1995.-2017.</footer>
</html>