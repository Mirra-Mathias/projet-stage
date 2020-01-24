<?php
require_once("../include/inc.php");
$pdo = PdoGsb::getPdoGsb();

if(isset($_GET['id'])){
    $modallong = get_Pos_chaine( $_GET['keyword'],$pdo->modallong($_GET['id'])['pleintext'],"<mark id='","'>","</mark>");

    $nb_key = mb_substr_count(strtolower ($modallong),strtolower("<mark"));

    $modallong = "<link href=\"../css/modallong.css\" rel=\"stylesheet\" type=\"text/css\">".$pdo->modallong($_GET['id'])['titre']."*/$~§<a id='0'></a>".$modallong."*/$~§".$nb_key;


   echo $modallong;
}

