<!DOCTYPE html>
<html>
	<head>
		<title>SmileNOW</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
			<a name="1"></a>
			<div id="header">
				<h1>SmileNoW!</h1>
				<h3 id="podnaslov">Prepustite brigu o Vašem osmijehu nama.</h3>
			</div>
			
			<div id="nav">
				<ul id="menu">
					<li><a id="naslovna" href="pocetna.php"  title="Naslovna strana">Pocetna</a></li>
					<li><a id="usluge"   href="usluge.html"  title="Usluge koje pružamo">Usluge</a></li>
					<li><a id="onama"    href="onama.html"  title="Informacije o nama">O nama</a></li>
					<li><a id="kontakt"  href="kontakt.html"  title="Kako do nas">Kontakt</a></li>
				</ul> 
			</div>
						
			<hr>
			
			<div id="naslovna">
		<h2 class="welcome"> Dobrodošli na web stranicu stomatološke ordinacije SmileNoW! </h2><hr>
	</div>
	
	
	<?php 
	$veza = new PDO("mysql:dbname=bazasmile;host=localhost;charset=utf8", "root", "");
     $veza->exec("set names utf8");
     $novosti = $veza->query("select id, naslov, tekst, UNIX_TIMESTAMP(vrijeme) vrijemeVijesti, autor, brojkomentara from novosti order by vrijeme desc");
	 if (!$novosti) {
          $greska = $veza->errorInfo();
          print "SQL greška: " . $greska[2];
          exit();
     }

     foreach ($novosti as $novost) {
		 
          print "<h3>". $novost['naslov'] ."</h3>";
		  print "<p>". $novost['autor'] . "  ". date("d.m.Y. (h:i)", $novost['vrijemeVijesti']) ."</p>";
		  print "<p>". $novost['tekst'] ."</p>";
		  print '<a class="button" href="komentari.php?idNovosti='.$novost['id'].'">'.$novost['brojkomentara'].' komentara</a>';
		  print "<hr>";
     }
	print "<br>";
	
	
	?> 
			
			<div id="footer">
				<p>Copyright © 2015 SmileNow Sarajevo<br>
				Sva prava zadržana</p>
			</div>
	<!-- <script src="ajax.js"></script>	-->	
	</body>
	
</html>
