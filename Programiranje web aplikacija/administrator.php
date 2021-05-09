<!DOCTYPE html>
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
			<li><a href="registracija.html">Registracija</a></li>
			<li><a href="index.php">Naslovnica</a></li>
			<li><a href="onama.html">O nama</a></li>
			<li><a href="unos.html">Napiite vijesti</a></li>
		</ul>
	</nav>

</header>

<main>
<?php
$username = $_POST['username'];
$password = $_POST['password'];
$password = md5($password);

$username_sig = "_".$username;
$password_sig = "_".$password;




if(
strpos($username_sig, "<") !== false || strpos($username_sig, ">") !== false || strpos($username_sig, "=") !== false || 
strpos($username_sig, "&") !== false || strpos($username_sig, "%") !== false || strpos($username_sig, ":") !== false || 
strpos($username_sig, "'") !== false || strpos($username_sig, ";") !== false || strpos($username_sig, "/") !== false ||

strpos($password_sig, "<") !== false || strpos($password_sig, ">") !== false || strpos($password_sig, "=") !== false || 
strpos($password_sig, "&") !== false || strpos($password_sig, "%") !== false || strpos($password_sig, ":") !== false || 
strpos($password_sig, "'") !== false || strpos($password_sig, ";") !== false || strpos($password_sig, "/") !== false
) echo "Korisničko ime ili lozinka sadreavaju Vam krive znakove.";


else{
$upit = "SELECT username, password, level FROM users WHERE username = ? AND password = ?";

$baza = mysqli_connect('localhost', 'root', '', 'portal') or die ("Pogreka u vezi sa bazom!");

$baza_sig = mysqli_stmt_init($baza);



if (mysqli_stmt_prepare($baza_sig, $upit)){

	mysqli_stmt_bind_param($baza_sig, 'ss', $username, $password);

	mysqli_stmt_execute($baza_sig);

	mysqli_stmt_store_result($baza_sig);

	mysqli_stmt_bind_result($baza_sig, $usr, $psw, $lvl);
	
	

	while(mysqli_stmt_fetch($baza_sig)){

	if($lvl === 1){
		echo '<form enctype="multipart/form-data" method="post">
			<h3>Upravljanje:</h3>
			<label>E-pota: <input type="email" name="Eposta"/></label>
			<label>Skrivanje vijesti: <input type="radio" name="akcija" value="skrivanje"/></label>
			<label>Brisanje vijesti: <input type="radio" name="akcija" value="brisanje"/></label>
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
if(isset($_POST['Eposta']) && isset($_POST['akcija'])) {
	$Eposta = $_POST['Eposta'];
	$akcija = $_POST['akcija'];
	$baza = mysqli_connect('localhost', 'root', '', 'portal') or die('<p class="upozorenje">Nema povezanosti na bazu!</p>');

	if($akcija == "brisanje") $upit = "DELETE FROM tablica WHERE Eposta = '$Eposta'";

	elseif ($akcija == "skrivanje") $upit = "UPDATE tablica SET Naslovnica = 0 WHERE Eposta = '$Eposta'";

	else echo 'Nita se nije dogodilo na bazi!';
	

	$rezultat = mysqli_query($baza, $upit) or die('<p class="upozorenje">Pogreka u vezi sa bazom!</p>');
	mysqli_close($baza);
}

?>
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