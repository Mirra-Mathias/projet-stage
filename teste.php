<?php
require_once("include/inc.php");
$pdo = PdoGsb::getPdoGsb();

echo get_Pos_chaine("a","abc a","<mark id='","'>","</mark>");
