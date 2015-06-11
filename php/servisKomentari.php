<?php

$idN = $_GET['novost'];

$veza = new PDO('mysql:host=localhost;dbname=bazasmile;charset=utf8', 'root', '');
$veza->exec("set names utf8");
$upit = $veza->prepare("SELECT * FROM komentari WHERE idnovosti=? order by vrijeme desc");
$upit->bindValue(1, $idN, PDO::PARAM_INT);
$upit->execute();

print "{ \"komentari\":" . json_encode($upit->fetchAll()) . "}";

?>