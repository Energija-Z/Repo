<!DOCTYPE html>
<html>

<head>
	<meta charset="ISO-8859-2"/>
	<title>Postavljanje odgovora</title> 
	<link rel="stylesheet" type="text/css" href="dodaci/style.css">
</head>

<body>
	<img src="http://www.netakademija.hr/wp-content/uploads/2015/05/tvz-plavi.png" alt="Tehničko Veleučilite u Zagrebu"/><br/>

<?php
$korisnik = $_POST['korisnik'];
$lozinka = $_POST['lozinka'];
$lozinka = md5($lozinka);

$korisnik_sig = "_".$korisnik;
$lozinka_sig = "_".$lozinka;


if(
strpos($korisnik_sig, "<") !== false || strpos($korisnik_sig, ">") !== false || strpos($korisnik_sig, "=") !== false || 
strpos($korisnik_sig, "&") !== false || strpos($korisnik_sig, "%") !== false || strpos($korisnik_sig, ":") !== false || 
strpos($korisnik_sig, "'") !== false || strpos($korisnik_sig, ";") !== false || strpos($korisnik_sig, "/") !== false ||

strpos($lozinka_sig, "<") !== false || strpos($lozinka_sig, ">") !== false || strpos($lozinka_sig, "=") !== false || 
strpos($lozinka_sig, "&") !== false || strpos($lozinka_sig, "%") !== false || strpos($lozinka_sig, ":") !== false || 
strpos($lozinka_sig, "'") !== false || strpos($lozinka_sig, ";") !== false || strpos($lozinka_sig, "/") !== false
) echo "Korisničko ime ili lozinka sadreavaju Vam krive znakove.";


else{
$upit = "SELECT korisnik, lozinka, razina FROM korisnici WHERE korisnik = ? AND lozinka = ?";

$baza = mysqli_connect('localhost', 'root', '', 'projekt') or die ("Pogreka u vezi sa bazom!");

$baza_sig = mysqli_stmt_init($baza);



if (mysqli_stmt_prepare($baza_sig, $upit)){

	mysqli_stmt_bind_param($baza_sig, 'ss', $korisnik, $lozinka);
	


	mysqli_stmt_execute($baza_sig);

	mysqli_stmt_store_result($baza_sig);

	//mysqli_stmt_fetch($baza_sig);

	mysqli_stmt_bind_result($baza_sig, $usr, $psw, $lvl);
	

	while(mysqli_stmt_fetch($baza_sig)){
		

	if($lvl === 1){
		echo '<form enctype="multipart/form-data" method="post">
			<label>Upiite broj mogućih odgovora: <input type="text" name="broj"/></label>
			<br/><p>Ako elite checkbox ili radio, unesite od 1 do 8.<br/>Za tekst, unesite broj 9.</p>
		<input type="submit" value="Poalji">
		</form>';
	}

else echo "Move along, nothing to see here...";
}

mysqli_close($baza);
}

}
?>

<?php
if(isset($_POST['broj'])) {
	$broj = $_POST['broj'];
	$i;

echo '<form enctype="multipart/form-data" method="post"><ul>
		<li><label>Napiite pitanje: <input type="text" name="pitanje"/></label></li>
		<li>Tip odgovora:</li>
		<ul>';

if($broj >= 1 && $broj <= 8){
		echo '<li><label><input type="radio" name="odabir" value="checkbox"/> Checkbox</label></li>
			<li><label><input type="radio" name="odabir" value="radio"/> Radio</label></li>
		</ul>';
for($i = 1; $i <= $broj; $i++) echo "<li>Odgovor $i: <input type='text' name='odgovor$i'/></li>";
}

if ($broj == 9) echo '<li><label><input type="radio" name="odabir" checked/> Tekst</label></li>';

if ($broj <= 0 || $broj > 9) echo "Greka, nije dobar broj unesen!";
		echo '</ul>';

echo '</ul><br/>
<input type="submit" value="Poaljite"/>
</form>';
}
?>

<?php
if(isset($_POST['pitanje'])) {
	$pitanje = $_POST['pitanje'];
	$tip = $_POST['odabir'];

	if(isset($_POST['odgovor2'])) $odg1 = $_POST['odgovor1'];
	else $odg1 = "tekst";

	if(isset($_POST['odgovor2'])) $odg2 = $_POST['odgovor2'];
	else $odg2 = null;

	if(isset($_POST['odgovor3'])) $odg3 = $_POST['odgovor3'];
	else $odg3 = null;

	if(isset($_POST['odgovor4'])) $odg4 = $_POST['odgovor4'];
	else $odg4 = null;

	if(isset($_POST['odgovor5'])) $odg5 = $_POST['odgovor5'];
	else $odg5 = null;

	if(isset($_POST['odgovor6'])) $odg6 = $_POST['odgovor6'];
	else $odg6 = null;

	if(isset($_POST['odgovor7'])) $odg7 = $_POST['odgovor7'];
	else $odg7 = null;

	if(isset($_POST['odgovor8'])) $odg8 = $_POST['odgovor8'];
	else $odg8 = null;

	$baza = mysqli_connect('localhost', 'root', '', 'projekt') or die ("Ne moe se spojiti sa bazom!");

	$upit = "INSERT INTO pitanja (tip, pitanje, odg1, odg2, odg3, odg4, odg5, odg6, odg7, odg8)
	VALUES ('$tip', '$pitanje', '$odg1', '$odg2', '$odg3', '$odg4', '$odg5', '$odg6', '$odg7', '$odg8')";

	$rezultat = mysqli_query($baza, $upit) or die('Pogreka u vezi sa bazom!');

	if(isset($rezultat)) echo 'Podaci su spremljeni.';

	mysqli_close($baza);
}
?>
			<footer>Fantastična Četvorka copyright 1995.-2017.</footer>
</html>