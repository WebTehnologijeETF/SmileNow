<?php

$veza = new PDO('mysql:host=localhost;dbname=bazasmile;charset=utf8', 'root', '');
$veza->exec("set names utf8");
$upit = $veza->prepare("SELECT * FROM novosti order by vrijeme desc");
$upit->execute();

print "{ \"novosti\":" . json_encode($upit->fetchAll()) . "}";

?>
