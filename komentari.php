<!DOCTYPE html>
<html>
	<head>
		<title>Komentari</title>
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

		
		<?php
	if(isset($_REQUEST['komentar']) )
	{
		$komentar = $_REQUEST['komentar'];
		$emailautora = "";
		$imeautora = "anoniman";
		if(isset($_REQUEST['autor']))
			$imeautora = $_REQUEST['autor'];
		
		if(isset($_REQUEST['emailautora']))
			$emailautora = $_REQUEST['emailautora'];
		
		if($imeautora == "")
			$imeautora = "anoniman";
		
		
		$veza = new PDO("mysql:dbname=bazasmile;host=localhost;charset=utf8", "root", "");
		$veza->exec("set names utf8");
		
		$komentariPlus = $veza->prepare("update novosti set brojkomentara = brojkomentara + 1 where id=?");
		$komentariPlus->bindParam(1, $_REQUEST['idNovosti']);
		$komentariPlus->execute();
		
		$upis = $veza->prepare("INSERT INTO komentari (idnovosti, autor, emailautora, tekst) VALUES (?, ?, ?, ?)");
		$upis->bindParam(1, $_REQUEST['idNovosti']);
		$upis->bindParam(2, $imeautora);
		$upis->bindParam(3, $emailautora);
		$upis->bindParam(4, $komentar);
		$upis->execute();
		
	}
	if(isset($_REQUEST['idNovosti']))
	{
		$idNovosti = $_REQUEST['idNovosti'];
		
		$veza = new PDO("mysql:dbname=bazasmile;host=localhost;charset=utf8", "root", "");
		 $veza->exec("set names utf8");
		 
		$novost = $veza->prepare("select naslov, tekst, UNIX_TIMESTAMP(vrijeme) vrijemeVijesti, autor from novosti where id=?");
		$novost->bindParam(1, $_REQUEST['idNovosti']);
		$novost->execute();
		
		$novosti = $novost->fetchAll();
		foreach($novosti as $n)
		{
          print "<h2>". $n['naslov'] ."</h2>";
		  print "<p>". $n['autor'] . "  ". date("d.m.Y. (h:i)", $n['vrijemeVijesti']) ."</p>";
		  print "<p>". $n['tekst'] ."</p>";
		}
		 
		 print "<h3>Komentari</h3>";
		 
		 
		 $komentari = $veza->prepare("select tekst, autor, UNIX_TIMESTAMP(vrijeme) vrijemeKomentara, emailautora from komentari where idnovosti=?");
		$komentari->bindParam(1, $idNovosti);
		$komentari->execute();
		 
		 if (!$komentari) {
			  $greska = $veza->errorInfo();
			  print "SQL greška: " . $greska[2];
			  exit();
		 }
		 
		 $nizKomentara = $komentari->fetchAll();
		 foreach ($nizKomentara as $komentar) {
			 
			  print "<hr>";
			  print "<p>". $komentar['autor'] . "  ". date("d.m.Y. (h:i)", $komentar['vrijemeKomentara']) ."</p>";
			  print "<p>". $komentar['tekst'] ."</p>";
			  
			  if($komentar['emailautora'] != "")
			      print '<a href="mailto:'.$komentar['emailautora'].'">'.$komentar['emailautora'].'</a>';
			  
		 }  
	}
    ?>
	  <hr>
	  <form id='forma' method="post">
		  Name: <input name="autor" type="text" /><br />
		  Email: <input name="emailautora" type="text" /><br />
		  Komentar:<br />
		  <textarea id="kom" name="komentar" values="" rows="7" cols="100"></textarea><br />
	  </form>
	  <button onclick="jsPosalji()">Postavi</button>
	  
	  <script type="text/javascript">
	    function jsPosalji()
		{
			var komentar = document.getElementById("kom").value;
			if(komentar != "")
			{
				document.forms["forma"].submit();
				document.getElementById("kom").value = "";
			}
		}
	  </script>

		
			
			<div id="footer">
				<p>Copyright © 2015 SmileNow Sarajevo<br>
				Sva prava zadržana</p>
			</div>	
	</body>
	
</html>
