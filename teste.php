<?php
require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();

echo get_Pos_chaine("a","abc a","<mark id='","'>","</mark>");

//var_dump($pdo->recherche("Jean-Christophe CHABOT le",1,null,null,null,null));

//var_dump( $pdo->recherche($_GET['keyword'], null, $_GET['date_debut'], $_GET['date_fin'], 1, null));