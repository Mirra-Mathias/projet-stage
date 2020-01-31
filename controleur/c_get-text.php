<?php
require_once("../include/pdo.php");
require_once ("../include/fonctions.php");
$pdo = PdoGsb::getPdoGsb();

if(isset($_GET['id'])){
    $modallong = get_Pos_chaine( $_GET['keyword'],$pdo->modallong($_GET['id'])['pleintext'],"<mark id='","'>","</mark>");//ajout des occurences dans le texte

    $modallong = "<link href=\"../css/modallong.css\" rel=\"stylesheet\" type=\"text/css\">".$pdo->modallong($_GET['id'])['titre']."*/$~§".$modallong."*/$~§".$pdo->modallong($_GET['id'])['fichier'];//ajoute en concaténation


   echo $modallong;
}

