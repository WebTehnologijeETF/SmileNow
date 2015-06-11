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

?>