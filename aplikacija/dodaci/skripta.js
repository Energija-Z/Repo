function lozinka_prov(event){
	var lozinka = document.getElementById("lozinka").value;
	var lozinka_isp = document.getElementById("lozinka_isp").value;

	if(lozinka !== lozinka_isp){
		document.getElementById("lozinka_upoz").innerHTML = "Lozinke se ne podudaraju.";
		event.preventDefault();
	}
}