var ime, prezime, telefon, email, ocjena, porukaF, stariKorisnik, buttonPos;

document.getElementById("buttonPos").addEventListener( "click", validirajFormu, false);

function ocitajFormu()
{
	ime = document.getElementById("firstname").value;
	prezime = document.getElementById("lastname").value;
	porukaF = document.getElementById("poruka").value;
	telefon = document.getElementById("telefon").value;
	email = document.getElementById("email").value;
	ocjena = document.getElementById("ocjena").value;
	stariKorisnik = document.getElementById("daNeID").value;
}
function validirajFormu(){
	ocitajFormu();
	
	var u1 = provjeriName(); 
	var u2 = provjeriLast(); 
	var u3 = provjeriPoruku(); 
	var u4 = provjeriTelefon(); 
	var u5 = provjeriEmail(); 
	var u6 = provjeriOcjenu();
	// ne znam zasto nisam mogao staviti funkcije umjesto varijabli direktno u if-u
	if(u1 && u2 && u3 && u4 && u5 && u6)
		alert('Uspješno ste poslali poruku!');
}
//ovo je jako povrsna validacija (u odnosu kako bi trebalo), nadam se da je ovo dovoljno...
function ispravanMail(mail)
{
	if (mail.indexOf('@') == -1)
		return false;
	
	var dijeloviMaila = mail.split('@');
	
	if (dijeloviMaila.length > 2)
		return false;
	
	var domena = dijeloviMaila[1];
	
	if(domena.indexOf('.') == -1)
		return false;

    var dijeloviDomene = domena.split('.');
	var posljednjaDomena = dijeloviDomene[dijeloviDomene.length-1];

    if (posljednjaDomena.length < 2 || posljednjaDomena.length > 4)
		return false;
	
	return true;	
}
function provjeriTelefon(){
	var cssf="none", prikazi="none", poruka="", ok=true;
	var regexTelefon = /\+387\d{2}-\d{3}-\d{3}$/;
	if(telefon==""){
		cssf="none";
	}
	else if(!regexTelefon.test(telefon))
	{
		cssf="left"; prikazi="block"; ok=false;
		poruka = "Telefon moze biti samo u formatu: +387XX-XXX-XXX";
	}
	azurirajError("erTelefon1", "erTelefon2", "mErrorT", cssf, prikazi, poruka);
	return ok;
}
function provjeriPoruku(){
	var cssf="none", prikazi="none", poruka="", ok=true;
	if(porukaF==""){
		cssf="left"; prikazi="block"; ok=false;
		poruka = "Vaša poruka je obavezna!";
	}
	else if(porukaF.length>1000)
	{
		cssf="left"; prikazi="block"; ok=false;
		poruka = "Vasa poruka ne smije biti duza od 1000 karaktera.";
	}
	else if(porukaF.length<20)
	{
		cssf="left"; prikazi="block"; ok=false;
		poruka = "Vasa poruka treba imati minimalno 20 karaktera.";
	}
	azurirajError("erPoruka1", "erPoruka2", "mErrorP", cssf, prikazi, poruka);
	return ok;
}
function provjeriEmail(){
	var cssf="none", prikazi="none", poruka="", ok=true;
	if(email==""){
		cssf="left"; prikazi="block"; ok=false;
		poruka = "Vaš email je obavezan!";
	}
	else if(!ispravanMail(email))
	{
		cssf="left"; prikazi="block"; ok=false;
		poruka = "Email nije validan!";
	}
	azurirajError("erEmail1", "erEmail2", "mErrorE", cssf, prikazi, poruka);
	return ok;
}
function provjeriLast(){
	var cssf="none", prikazi="none", poruka="", ok=true;
	if(prezime.length>25)
	{
		cssf="left"; prikazi="block"; ok=false;
		poruka = "Prezime ne može biti duže od 25 karaktera.";
	}
	azurirajError("erLast1", "erLast2", "mErrorL", cssf, prikazi, poruka);
	return ok;
}
function provjeriName(){
	var cssf="none", prikazi="none", poruka="", ok=true;
	if(ime.length>25)
	{
		cssf="left"; prikazi="block"; ok=false;
		poruka = "Ime ne može biti duže od 25 karaktera.";
	}
	azurirajError("erName1", "erName2", "mErrorN", cssf, prikazi, poruka);
	return ok;
}
function provjeriOcjenu(){
	var cssf="none", prikazi="none", poruka="", ok=true;
	if(stariKorisnik=="")
	{
		cssf="left"; prikazi="block"; ok=false;
		poruka = "Prvo polje (DA/NE) je obavezno";
	}
	else if(stariKorisnik=="da" && ocjena=="")
	{
		cssf="left"; prikazi="block"; ok=false;
		poruka = "Ako ste bili nas korisnik, potrebna je ocjena!";
	}
	else if(stariKorisnik=="ne")
	{
		document.getElementById("ocjena").readOnly = true;
		document.getElementById("ocjena").value = "";
	}
	azurirajError("erOcjena1", "erOcjena2", "mErrorO", cssf, prikazi, poruka);
	return ok;
}
function azurirajError(id1, id2, id3, cssf, prikazi, poruka)
{
	document.getElementById(id1).style.cssFloat = cssf;
	document.getElementById(id2).style.display = prikazi;
	document.getElementById(id3).innerHTML = poruka;
}