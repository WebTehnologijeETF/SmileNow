ucitajNovosti();
var intervalID = setInterval(ucitajNovosti, 1000);
var intervalID2 = setInterval(ucitajPNKomentarima, 2000);
//clearInterval(intervalID);
function ucitajKomentareZaNovost(idNovosti, pom)
{
    if (typeof(pom) === 'undefined')
	{
		if(document.getElementById("kom"+(idNovosti.toString())).innerHTML != "")
		{
			document.getElementById("kom"+(idNovosti.toString())).innerHTML = "";
			document.getElementById("forma"+(idNovosti.toString())).innerHTML = "";
			return;
		}
	}
	
			var ajax = new XMLHttpRequest();
		ajax.onreadystatechange = function() {// Anonimna funkcija
			if (ajax.readyState == 4 && ajax.status == 200)
			{
				var obj = JSON.parse(ajax.responseText);
				var i = 0;
				var komentari_string = "";
				for(i = 0; i < obj.komentari.length; i++)
				{		
					komentari_string += "<hr><p>"+ obj.komentari[i].autor + "&nbsp&nbsp&nbsp"+ obj.komentari[i].vrijeme +"</p>" 
					                 + "<p>" + obj.komentari[i].tekst + "</p>";
					
					if(obj.komentari[i].emailautora != "")
						komentari_string += '<a href="mailto:'+ obj.komentari[i].emailautora + '">'+obj.komentari[i].emailautora+'</a>';
				}
				
				if(document.getElementById("forma"+(idNovosti.toString())).innerHTML == "")
				{
					var forma_string = '<hr><form id="forma" method="post">Name: <input id="autor" name="autor" type="text" /><br />'+
					'Email: <input id="emailautora" name="emailautora" type="text" /><br />Komentar:<br />'+
					'<textarea id="kom" name="komentar" values="" rows="3" cols="100"></textarea><br />'+
					'</form><button onclick="jsPosalji('+(idNovosti.toString())+')">Postavi</button>';
				
					document.getElementById("forma"+(idNovosti.toString())).innerHTML = forma_string;
				}
				
				komentari_string += '<hr><a id="linkSakrijK" href="#" onclick="ucitajKomentareZaNovost('+ (idNovosti.toString()) +');">Sakrij komentare</a><br>';
				document.getElementById("kom"+(idNovosti.toString())).innerHTML = komentari_string;
			}
			if (ajax.readyState == 4 && ajax.status == 404)
				document.getElementById("kom"+(idNovosti.toString())).innerHTML = "Greska: nepoznat URL";
		}
		ajax.open("GET", "php/servisKomentari.php?novost=" + (idNovosti.toString()), true);
		ajax.send();
	
}
function jsPosalji(idNovosti)
{
	var ajax = new XMLHttpRequest();
    var autor = document.getElementById("autor").value;
    var emailautora = document.getElementById("emailautora").value;
    var komentar = document.getElementById("kom").value;
	
	document.getElementById("autor").value = "";
    document.getElementById("emailautora").value = "";
    document.getElementById("kom").value = "";
	
	if(komentar == "")
		return;

    ajax.onreadystatechange = function () {// Anonimna funkcija
        if (ajax.readyState == 4 && ajax.status == 200) {
			//return;
        }
        if (ajax.readyState == 4 && ajax.status == 404)
            document.getElementById("kom"+(idNovosti.toString())).innerHTML += "Greska neka :D";
    }
	var podaciSaForme = "?idNovosti="+idNovosti+"&autor="+autor+"&komentar="+komentar+"&emailautora="+emailautora;
	ajax.open("GET", "php/servisPostKomentar.php"+podaciSaForme, true);
    ajax.send();
}
function ucitajPNKomentarima()
{
	var elements = document.getElementsByClassName("kom");
			for(var i=0; i<elements.length; i++)
			{
				if(elements[i].innerHTML != "")
				{
					var div_id_komentar = elements[i].id;
					ucitajKomentareZaNovost(div_id_komentar.substring(3), 1);
				}
			}
}
function ucitajNovosti()
{
		
		var elements = document.getElementsByClassName("kom");
		for(var i=0; i<elements.length; i++)
			if(elements[i].innerHTML != "")
				return;
		
		
			var ajax = new XMLHttpRequest();
		ajax.onreadystatechange = function() {// Anonimna funkcija
			if (ajax.readyState == 4 && ajax.status == 200)
			{
				var obj = JSON.parse(ajax.responseText);
				var i = 0;
				var vijesti_string = "";
				for(i = 0; i < obj.novosti.length; i++)
				{
					vijesti_string += "<h3>" + obj.novosti[i].naslov + "</h3>"
									+ "<p>"+ obj.novosti[i].autor + "&nbsp&nbsp&nbsp" + obj.novosti[i].vrijeme + "</p>"
									+ "<p>"+ obj.novosti[i].tekst +"</p>"
									+ '<span><a id="uii" href="#">Detaljnije</a>&nbsp&nbsp&nbsp'
									+ '<a id="zuzuzzu" href="#" onclick="ucitajKomentareZaNovost('+ obj.novosti[i].id +');">'+ obj.novosti[i].brojkomentara +' komentara</a></span>'
									+ "<br></br>"
									+ '<div class="forma" id="forma' + obj.novosti[i].id +'"></div>'
									+ '<div class="kom" id="kom' + obj.novosti[i].id +'"></div>';
				}
				
				document.getElementById("novosti").innerHTML = vijesti_string;	
			}
			if (ajax.readyState == 4 && ajax.status == 404)
				document.getElementById("novosti").innerHTML = "Greska: nepoznat URL";
		}
		ajax.open("GET", "php/servisNovosti.php", true);
		ajax.send();
	
}