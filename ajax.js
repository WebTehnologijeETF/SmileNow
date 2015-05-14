function ucitajStranicu(link){
			//alert("dsdsd");
			var ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function() {// Anonimna funkcija
					if (ajax.readyState == 4 && ajax.status == 200)
					{
						document.getElementById("stranica").innerHTML = ajax.responseText;

							//koda potreban da bi se skripte izvrsavale...
	    					var scripts = document.getElementById("stranica").getElementsByTagName("script");
						    for (var i = 0; i < scripts.length; i++) {
						        if (scripts[i].src != "") {
						            var tag = document.createElement("script");
						            tag.src = scripts[i].src;
						            document.getElementsByTagName("head")[0].appendChild(tag);
						        }
						        else {
						            eval(scripts[i].innerHTML);
						        }
						    }

					}
					if (ajax.readyState == 4 && ajax.status == 404)
							document.getElementById("stranica").innerHTML = "Greska: nepoznat URL";
			}
			ajax.open("GET", link, true);
			ajax.send();
			
			}
			
			document.getElementById("onama").addEventListener( "click", function(ev) { 
			ucitajStranicu("onama.html"); 
			}, false);

			document.getElementById("usluge").addEventListener( "click", function(ev) { 
			ucitajStranicu("usluge.html"); 
			}, false);

			document.getElementById("naslovna").addEventListener( "click", function(ev) { 
			ucitajStranicu("naslovna.php"); 
			}, false);

			document.getElementById("kontakt").addEventListener( "click", function(ev) { 
			ucitajStranicu("kontakt.html"); 
			}, false);

			window.onload = function () {
			ucitajStranicu("naslovna.php");
			}