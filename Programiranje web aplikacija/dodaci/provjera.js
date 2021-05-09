
function provjera(event){
	var tekst = document.getElementById("tekst").value;
	var naslov = document.getElementById("naslov").value;
	var sazetak = document.getElementById("sazetak").value;
	var kategorija = document.getElementById("kategorija").value;

	if(kategorija === "" || kategorija === null){
		document.getElementById("kategorija_upoz").innerHTML="Molimo Vas da odaberite kategoriju.";
		event.preventDefault();
	}
	
	else document.getElementById("kategorija_upoz").innerHTML="";

	if(sazetak.length < 10){
		document.getElementById("sazetak_upoz").innerHTML="Sa�etak treba imati vi�e od 10 slova.";
		event.preventDefault();
	}

	else if(sazetak.length > 100){
		document.getElementById("sazetak_upoz").innerHTML="Sa�etak treba imati manje od 100 slova.";
		event.preventDefault();
	}
	
	else if (sazetak.length <= 100 && sazetak.length >= 10) document.getElementById("sazetak_upoz").innerHTML="";

	if(naslov.length < 5){
		document.getElementById("naslov_upoz").innerHTML="Naslov treba imati vi�e od 5 slova.";
		event.preventDefault();
	}

	else if(naslov.length > 30){
		document.getElementById("naslov_upoz").innerHTML="Naslov treba imati manje od 30 slova.";
		event.preventDefault();
	}
	
	else if (naslov.length <= 30 && naslov.length >= 5) document.getElementById("naslov_upoz").innerHTML="";

	if(tekst.length < 10){
		document.getElementById("tekst_upoz").innerHTML="Tekst treba imati vi�e od 10 slova.";
		event.preventDefault();
	}

	else if(tekst.length > 1000){
		document.getElementById("tekst_upoz").innerHTML="Tekst treba imati manje od 1000 slova.";
		event.preventDefault();
	}
	
	else if(tekst.length <= 1000 && tekst.length >= 10) document.getElementById("tekst_upoz").innerHTML="";
}


function lozinka(event){
	var password = document.getElementById("password").value;
	var password_con = document.getElementById("password_con").value;

	if(password !== password_con){
		document.getElementById("lozinka_upoz").innerHTML="Lozinke se ne podudaraju.<br/>";
		event.preventDefault();
	}
}

function naslovnica_upoz(event) {
	if (document.getElementById("naslovnica").checked == false){
		window.alert("Postavit �e te vijest da se ne prika�e na naslovnoj stranici!");
	}
}

