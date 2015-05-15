<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Naslovna</title>
</head>
	<body>
	
	<div id="naslovna">
		<h2 class="welcome"> Dobrodošli na web stranicu stomatološke ordinacije SmileNoW! </h2><hr>
	</div>
	
	
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
	echo '<div id="objave">';
	for ($i=0; $i<count($novosti); $i++) {
		//operator . spaja stringove
		//pokusaj sa strigom
		$ispis = '<div class="objava"><h2>' . $naslovi_novosti[$sortirano_po_datumu[$i]] . '</h2>';
		$ispis .= '<img src="' . $linkovi_slika[$sortirano_po_datumu[$i]] . '" alt="Nema slike">';
		$ispis .= '<p class="objavio">' . $autori_novosti[$sortirano_po_datumu[$i]] . '</p>';
		$ispis .= '<p class="date">' . $sortirani_datumi[$i] . '</p><br><br>';
		$ispis .= '<p class="text_objave">' . $novosti[$sortirano_po_datumu[$i]] . '</p>';
		$ispis .= '<a href="">Detaljnije...</a><br><hr></div>';
		$ispis .= "<br/>";
		$str = utf8_decode($ispis);
		echo $str;
	}
	
	echo '</div>';
	
	?> 
	
	</body>
</html>