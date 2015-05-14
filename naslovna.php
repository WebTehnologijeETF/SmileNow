<!DOCTYPE html>
<html>
<head>
<title>Naslovna</title>
</head>
	<body>
	<?php 
	
	
	
	$folder = "novosti";
	$datoteke = scandir($folder);
	$sortirano_po_datumu = array();//indeksi datoteka
	$sortirani_datumi = array();
	$autori_novosti = array();
	$naslovi_novosti = array();
	$linkovi_slika = array();
	$detaljnije_novost = array();
	$novosti = array();
	$pomNiz = array();
	
	for ($i=2; $i<count($datoteke); $i++) {
	
	array_push($sortirano_po_datumu, ($i-2));
	$datoteka = file("novosti/".$datoteke[$i]);//ovo je niz linija
	array_push($sortirani_datumi, $datoteka[0]);
	array_push($autori_novosti, $datoteka[1]);
	array_push($naslovi_novosti, $datoteka[2]);
	array_push($linkovi_slika, $datoteka[3]);
	
	$k = 4;
	while(count($datoteka) > $k && strcmp($datoteka[$k],"--\r\n") != 0)
	{
		array_push($pomNiz, $datoteka[$k]);
		$k++;
	}
	array_push($novosti, implode("\n",$pomNiz));
	unset($pomNiz);
	$pomNiz = array();
	
	///detalji novosti
	$k++;
	while(count($datoteka) > $k && strcmp($datoteka[$k],"--\r\n") != 0)
	{
		array_push($pomNiz, $datoteka[$k]);
		$k++;
	}
	if(count($pomNiz) > 0)
	{
		array_push($detaljnije_novost, implode("\n",$pomNiz));
	}
	else
	{
		array_push($detaljnije_novost, "");
	}
		
	unset($pomNiz);
	$pomNiz = array();
	
	}
	
	for ( $i = 0; $i < count($sortirani_datumi); $i++ )
	{
	   for ($j = $i+1; $j < count($sortirani_datumi); $j++ )
	   {
		   if (new DateTime($sortirani_datumi[$j]) > new DateTime($sortirani_datumi[$i])) 
		   {
				$pom = $sortirani_datumi[$j];
				$sortirani_datumi[$j] = $sortirani_datumi[$i];
				$sortirani_datumi[$i] = $pom;
				//indeksi
				$pom = $sortirano_po_datumu[$j];
				$sortirano_po_datumu[$j] = $sortirano_po_datumu[$i];
				$sortirano_po_datumu[$i] = $pom;
			}
	   }
	}
	
	for ($i=0; $i<count($novosti); $i++) {
		
	echo '<br/><br/><br/><br/>';
	print_r($novosti[$sortirano_po_datumu[$i]]);
	print_r("detaljnije<br/><br/>");
	print_r($detaljnije_novost[$sortirano_po_datumu[$i]]);
	
	}
	
	
	?> 
	
	
	
	
	
	
	
	
			<div id="naslovna">
			<h2 class="welcome"> Dobrodošli na web stranicu stomatološke ordinacije SmileNoW! </h2><hr>
			</div>
			
			<div id="objave">
			<div class="objava">
				<h2>Ordinacija neće raditi 31.3.2015</h2>
				<img src="slika.png" alt="Slika smile">
				<p class="objavio">Ime Prezime</p>
				<p class="date">29.3.2015</p><br><br>
				<p class="text_objave">Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst 
				objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave 
				Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst 
				objave Tekst objave Tekst objave 
				</p>
				<a href="">Detaljnije...</a><br><hr>
			</div>
			<div class="objava">
				<h2>Ordinacija neće raditi 31.3.2015</h2>
				<img src="slika.png" alt="Slika smile">
				<p class="objavio">Ime Prezime</p>
				<p class="date">29.3.2015</p><br><br>
				<p class="text_objave">Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst 
				objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave 
				Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst 
				objave Tekst objave Tekst objave 
				</p>
				<a href="">Detaljnije...</a><br><hr>
			</div><div class="objava">
				<h2>Ordinacija neće raditi 31.3.2015</h2>
				<img src="slika.png" alt="Slika smile">
				<p class="objavio">Ime Prezime</p>
				<p class="date">29.3.2015</p><br><br>
				<p class="text_objave">Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst 
				objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave 
				Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst 
				objave Tekst objave Tekst objave 
				</p>
				<a href="">Detaljnije...</a><br><hr>
			</div><div class="objava">
				<h2>Ordinacija neće raditi 31.3.2015</h2>
				<img src="slika.png" alt="Slika smile">
				<p class="objavio">Ime Prezime</p>
				<p class="date">29.3.2015</p><br><br>
				<p class="text_objave">Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst 
				objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave 
				Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst objave Tekst 
				objave Tekst objave Tekst objave 
				</p>
				<a href="">Detaljnije...</a><br><hr>
			</div>
			</div>
	</body>
</html>