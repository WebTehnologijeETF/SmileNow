var idS = [];//globalni niz koji cuva id-ove div-ova listeStabla
var idSadrzaj = [];//globalni niz koji cuva id-ove div-ova sadrzaja stabla
var prosliSadrzaj = "";
window.onload = function () {
	ocitajStablo();
	ocitajSadrzajStabla();
	postaviNaL();
}
function ocitajSadrzajStabla(){
	var sadrzaj = document.getElementById("sadrzajU").innerHTML;
	var pomNiz = sadrzaj.split('"');
	var i = 1;
	while(i < pomNiz.length){
		idSadrzaj.push(pomNiz[i]);
		i+=4;
	}
}
function ocitajStablo(){//ovo omogucava da se Stablo moze mjenjati bez promjene javaScript koda
	var stablo = document.getElementById("asideStablo").innerHTML;
	var pomNiz = stablo.split('"');
	var i = 1;
	while(i < pomNiz.length){
		idS.push(pomNiz[i]);
		i+=4;
	}
}
function postaviNaL()//postavljenje svih div-ova liste na eventListener
{
	var i = 0;
	for(i=0; i<idS.length; i++)
	{
		postaviNaL2(idS[i]);
	}
}
function postaviNaL2(idKontrole)
{
	document.getElementById(idKontrole).addEventListener( "click", function(){ mojaFunkcija2(idKontrole); }, false);
}

function mojaFunkcija2(idKontrole)
{
	var s = document.getElementById(idKontrole).innerHTML;
	if(s[0]=="+"){
		s = s.replaceAt(0, "-");
		document.getElementById(idKontrole).innerHTML = s;
		//otvori();
		var indexIdKontrole = idS.indexOf(idKontrole);
		var pomNiz = idS[indexIdKontrole].split("_");
		var nivoH = parseInt(pomNiz[1]);
		indexIdKontrole++;

		while(indexIdKontrole < idS.length){
			pomNiz = idS[indexIdKontrole].split("_");
			var hPom = parseInt(pomNiz[1]);
			if(hPom <= nivoH)
			{
				break;
			}
			if((hPom-1) == nivoH)
			{
				document.getElementById(idS[indexIdKontrole]).style.display = "block";
			}
			
			indexIdKontrole++;
		}
	}
	else if(s[0]=="-"){
		s = s.replaceAt(0, "+");
		document.getElementById(idKontrole).innerHTML = s;
		//zatvori();
		var indexIdKontrole = idS.indexOf(idKontrole);
		var pomNiz = idS[indexIdKontrole].split("_");
		var nivoH = parseInt(pomNiz[1]);
		indexIdKontrole++;

		while(indexIdKontrole < idS.length){
			pomNiz = idS[indexIdKontrole].split("_");
			var hPom = parseInt(pomNiz[1]);
			if(hPom <= nivoH)
			{
				break;
			}
			if(hPom > nivoH)
			{
				document.getElementById(idS[indexIdKontrole]).style.display = "none";
				s = document.getElementById(idS[indexIdKontrole]).innerHTML;
				if(s[0]=="-")
				{
					s = s.replaceAt(0, "+");
					document.getElementById(idS[indexIdKontrole]).innerHTML = s;
				}
			}
			
			indexIdKontrole++;
		}
	}
	else if(s[1]=="."){
		
		if(prosliSadrzaj != "")//ako ima sadrzaj od prije brisi ga
		{
			document.getElementById(prosliSadrzaj).style.display = "none";
			prosliSadrzaj="";
		}
		
		if(idSadrzaj.indexOf(idKontrole + "s") > -1)//ako imamo sadrzaj za kliknuti div, onda ga prikazujemo
		{
			prosliSadrzaj = idKontrole + "s";
			document.getElementById(prosliSadrzaj).style.display = "block";
		}
		else
		{
			prosliSadrzaj = idSadrzaj[idSadrzaj.length-1];//posljednji tag
			document.getElementById(prosliSadrzaj).style.display = "block";
		}
		
	}
}
String.prototype.replaceAt=function(index, character) {
    return this.substr(0, index) + character + this.substr(index+character.length);
}
