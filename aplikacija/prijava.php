<!DOCTYPE html>
<html>

<head>
	<meta charset="ISO-8859-2"/>
	<link rel="stylesheet" type="text/css" href="dodaci/style.css"/>

	<title>Prijava</title>
</head>
	<body>
		 <img src="http://www.netakademija.hr/wp-content/uploads/2015/05/tvz-plavi.png" alt="Tehni�ko Veleu�ili�te u Zagrebu"/><br/>

<?php
if(isset($_POST['link'])) {
$link = $_POST['link'].".php";

				echo '<form action="'.$link.'" enctype="multipart/form-data" method="post">
						<label>Korisni�ko ime: <input type="text" name="korisnik" required/></label>
						<br>
						<label>Va�a lozinka: <input type="password" name="lozinka" id="lozinka" required/></label>
						<br>
					<input type="submit" value="Upi�i se!"/>
				</form>';
}

else echo '<p>Morate se vratiti na <a href="index.html">po�etnu stranicu</a>!</p>';
?>

		<footer><br/>Fantasti�na �etvorka copyright 1995.-2017.</footer>
	</body>
</html>