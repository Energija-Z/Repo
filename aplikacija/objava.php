<!DOCTYPE html>
<html>

<head>
	<meta charset="ISO-8859-2"/>
	<title>Postavljanje odgovora</title> 
	<link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>

<?php
$korisnik = $_POST['korisnik'];
$lozinka = $_POST['lozinka'];

if(
strpos($korisnik, "<") !== false || strpos($korisnik, ">") !== false || strpos($korisnik, "=") !== false || 
strpos($korisnik, "&") !== false || strpos($korisnik, "%") !== false || strpos($korisnik, ":") !== false || 
strpos($korisnik, "'") !== false || strpos($korisnik, ";") !== false || strpos($korisnik, "/") !== false ||

strpos($lozinka, "<") !== false || strpos($lozinka, ">") !== false || strpos($lozinka, "=") !== false || 
strpos($lozinka, "&") !== false || strpos($lozinka, "%") !== false || strpos($lozinka, ":") !== false || 
strpos($lozinka, "'") !== false || strpos($lozinka, ";") !== false || strpos($lozinka, "/") !== false
) echo "Korisničko ime ili lozinka sadreavaju Vam krive znakove.";


else{
$lozinka = md5($lozinka);

$upit = "SELECT korisnik, lozinka, razina FROM korisnici WHERE korisnik = ? AND lozinka = ?";

$baza = mysqli_connect('localhost', 'root', '', 'projekt') or die ("Pogreka u vezi sa bazom!");

$baza = mysqli_stmt_init($baza);



if (mysqli_stmt_prepare($baza, $upit)){

	mysqli_stmt_bind_param($baza, 'ss', $korisnik, $lozinka);

	mysqli_stmt_execute($baza);

	mysqli_stmt_store_result($baza);

	mysqli_stmt_bind_result($baza, $usr, $psw, $lvl);
	

	while(mysqli_stmt_fetch($baza)){


	if($lvl === 1){
		echo '<form enctype="multipart/form-data" method="post">
			<ol>';
	
		$baza2 = mysqli_connect('localhost', 'root', '', 'projekt') or die('Nema povezanosti sa bazom!');
		$upit2 = "SELECT pitanje FROM pitanja";

		$result = mysqli_query($baza2, $upit2);
	
		while($redak = mysqli_fetch_array($result)) {
			$pitanje = $redak['pitanje'];
			echo '<li><label><input type="radio" name="pitanje" value="'.$pitanje.'"/> '.$pitanje.'</label></li>';
		}

		echo '</ol>
		<input type="datetime-local" name="vrijeme">
		<input type="submit" value="Objavite!"/>
		</form>';
	}
	

else echo "Move along, nothing to see here...";
}

mysqli_close($baza);
}

}
?>

<?php
if(isset($_POST['vrijeme'])) {
	$vrijeme = $_POST['vrijeme'].':00';
	$vrijeme = str_replace("T", " ", $vrijeme);
	$objava = $_POST['pitanje'];

	$baza = mysqli_connect('localhost', 'root', '', 'projekt') or die ("Ne moe se spojiti sa bazom!");

	$upit = "UPDATE pitanja SET prikaz = 1, vrijeme = '$vrijeme' WHERE pitanje = '$objava'";

	$rezultat = mysqli_query($baza, $upit) or die('Pogreka u vezi sa bazom!');

	if(isset($rezultat)) echo 'Podaci su spremljeni.';

	mysqli_close($baza);

}
?>
</form>
	<footer>Fantastična Četvorka copyright 1995.-2017.</footer>
	</body>
</html>