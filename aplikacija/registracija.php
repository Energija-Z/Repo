<!DOCTYPE html>
<html>

<head>
	<meta charset="ISO-8859-2"/>
	<title>Prijava</title> 
	<link rel="stylesheet" type="text/css" href="dodaci/style.css">
</head>
	<body>
	<center>
<?php
$korisnik = $_POST['korisnik'];
$lozinka = $_POST['lozinka'];
$eposta = $_POST['eposta'];
$razina = 0;

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

else {
	$lozinka = md5($lozinka);

	$upit = "INSERT INTO korisnici (eposta, korisnik, lozinka, razina) VALUES (?, ?, ?, ?)";

if(isset($korisnik) && isset($lozinka)){
	$baza = mysqli_connect('localhost', 'root', '', 'projekt') or die('Pogreka u vezi sa bazom!');

	$baza_sig = mysqli_stmt_init($baza);


	if (mysqli_stmt_prepare($baza_sig, $upit)) {

		mysqli_stmt_bind_param($baza_sig,'sssi', $eposta, $korisnik, $lozinka, $razina);
		mysqli_stmt_execute($baza_sig);
		
		echo '<h2>Uspjeno ste se upisali!</h2><p>Moete se vratiti na <a href="index.html">početak</a>.</p>';
		}
	}


mysqli_close($baza);
}
?>
		<footer>Fantastična Četvorka copyright 1995.-2017.</footer>
	</body>
</html>