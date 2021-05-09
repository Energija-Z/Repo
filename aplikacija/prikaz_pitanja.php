<!DOCTYPE html>
<html>

<head>
	<meta charset="ISO-8859-2"/>
	<title>Glasovanje</title> 
	<link rel="stylesheet" type="text/css" href="dodaci/style.css">
</head>


<body>
<?php
$korisnik = $_POST['korisnik'];
$lozinka = $_POST['lozinka'];
$lozinka = md5($lozinka);

$odg = "_".$korisnik;
$lozinka_sig = "_".$lozinka;


if(
strpos($odg, "<") !== false || strpos($odg, ">") !== false || strpos($odg, "=") !== false || 
strpos($odg, "&") !== false || strpos($odg, "%") !== false || strpos($odg, ":") !== false || 
strpos($odg, "'") !== false || strpos($odg, ";") !== false || strpos($odg, "/") !== false ||

strpos($lozinka_sig, "<") !== false || strpos($lozinka_sig, ">") !== false || strpos($lozinka_sig, "=") !== false || 
strpos($lozinka_sig, "&") !== false || strpos($lozinka_sig, "%") !== false || strpos($lozinka_sig, ":") !== false || 
strpos($lozinka_sig, "'") !== false || strpos($lozinka_sig, ";") !== false || strpos($lozinka_sig, "/") !== false
) echo "Korisničko ime ili lozinka sadreavaju Vam krive znakove.";


else{
	$baza = mysqli_connect('localhost', 'root', '', 'projekt') or die('Nema povezanosti sa bazom!');
	$upit = "SELECT * FROM pitanja WHERE prikaz = 1";

	$rezultat = mysqli_query($baza, $upit);
	$i = 0;

echo '<form method="post">';

while($redak = mysqli_fetch_array($rezultat)){

	$pitanje = $redak['pitanje'];
	$id = $redak['id'];

	echo '<h2>'.$pitanje.'</h2>
		<ul>';
	$i;
	$provjera;


if($date > $redak['vrijeme']) {
	echo "Prolo je vrijeme za odgovaranje!<br/>";
	$provjera = false;
}

else $provjera = true;

if($provjera == true && $redak['tip'] != "tekst"){
	for($i = 1; $i < 9; $i++) {
		$odgovor = $redak['odg'.$i.''];
		$tip = $redak['tip'];
		$ime = 'odg'.$i;
		echo '<li><label><input name="odg'.$i.'" type="'.$tip.'"/>'.$odgovor.'</label></li>';
	}
}


if($provjera == true && $redak['tip'] == "tekst") echo '<label>Upiite odgovor: <input name="odg" type="text"/></label>';

	echo '</ul>
	<input type="hidden" name="id" value="'.$id.'"/>';

	if($redak['tip'] == "tekst") echo '<input type="hidden" name="text"/>';
	if($redak['tip'] == "checkbox" ||
	$redak['tip'] == "radio") echo '<input type="hidden" name="multi"/>';
}

if ($provjera == true) echo '<input type="submit" value="Poalji podatke"/>';

echo '</form>';

	mysqli_close($baza);
}
?>

<?php
if(isset($_POST['id'])){
if(isset($_POST['text'])){

$sifra = $_POST['id'];
$odg = $_POST['odg'];

if(
strpos($odg, "<") !== false || strpos($odg, ">") !== false || strpos($odg, "=") !== false || 
strpos($odg, "&") !== false || strpos($odg, "%") !== false || strpos($odg, ":") !== false || 
strpos($odg, "'") !== false || strpos($odg, ";") !== false || strpos($odg, "/") !== false
) echo "<p>Unijeli ste krivi znak!</p>";


else{

$upit = "INSERT INTO odgovor_text (sifPitanje, tekst) VALUES (?, ?)";

$baza = mysqli_connect('localhost', 'root', '', 'projekt') or die ("Pogreka u vezi sa bazom!");

$baza_sig = mysqli_stmt_init($baza);



if (mysqli_stmt_prepare($baza_sig, $upit)){

	mysqli_stmt_bind_param($baza_sig, 'is', $sifra, $odg);

	mysqli_stmt_execute($baza_sig);

	mysqli_stmt_store_result($baza_sig);

	}

mysqli_close($baza);
}
}

if(isset($_POST['multi'])){
$sifra = $_POST['id'];

if(isset($_POST['odg1'])) $odg1 = 1; else $odg1 = 0;
if(isset($_POST['odg2'])) $odg2 = 1; else $odg2 = 0;
if(isset($_POST['odg3'])) $odg3 = 1; else $odg3 = 0;
if(isset($_POST['odg4'])) $odg4 = 1; else $odg4 = 0;
if(isset($_POST['odg5'])) $odg5 = 1; else $odg5 = 0;
if(isset($_POST['odg6'])) $odg6 = 1; else $odg6 = 0;
if(isset($_POST['odg7'])) $odg7 = 1; else $odg7 = 0;
if(isset($_POST['odg8'])) $odg8 = 1; else $odg8 = 0;

$upit = "UPDATE odgovor_multi SET
odg1 = odg1 + '$odg1',
odg2 = odg2 + '$odg2',
odg3 = odg3 + '$odg3',
odg4 = odg4 + '$odg4',
odg5 = odg5 + '$odg5',
odg6 = odg6 + '$odg6',
odg7 = odg7 + '$odg7',
odg8 = odg8 + '$odg8'
WHERE sifPitanje = '$sifra'";

echo $sifra;

$baza = mysqli_connect('localhost', 'root', '', 'projekt') or die ("<p>Pogreka u vezi sa bazom!</p>");

$rezultat = mysqli_query($baza, $upit) or die('<p>Pogreka pri vezi sa bazom!</p>');

mysqli_close($baza);
}

else echo "<br/><p>Niste nikakav odgovor odabrali! Osvjeite stranicu za ponovni unos.</p>";
}

?>
		<footer>Fantastična Četvorka copyright 1995.-2017.</footer>
	</body>
</html>