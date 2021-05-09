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
<center>
<?php
$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$level = 0;

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

else {
	$password_sig = md5($password);

	$upit = "INSERT INTO users (username, password, name, level) VALUES (?, ?, ?, ?)";

if(isset($username) && isset($password)){
	$baza = mysqli_connect('localhost', 'root', '', 'portal') or die('Pogreka u vezi sa bazom!');

	$baza_sig = mysqli_stmt_init($baza);


	if (mysqli_stmt_prepare($baza_sig, $upit)) {

		mysqli_stmt_bind_param($baza_sig,'sssi', $username, $password, $name, $level);
		mysqli_stmt_execute($baza_sig);
		
		echo "<h2>Uspjeno ste se upisali!</h2>";
}

mysqli_close($baza);
}
}
?>
</center>
</main>
</body>
</html>