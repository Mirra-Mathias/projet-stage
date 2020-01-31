
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <! -- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <! -- fonctions -->
    <script src="js/min_fonctions.js"></script>
    <! -- plugin jquery-confirm -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>



</head>
<body>

<?php
session_start();
require_once("include/pdo.php");//méthode pdo (fonction)
require_once ("include/fonctions.php");
$pdo = PdoGsb::getPdoGsb();

 if(isset($_GET['loading']) && $_GET['loading'] == "on") include("vues/vue_loading.php");//page de chargement

else if(!isset($_GET['loading'])||$_GET['loading']=="off"){
    include ("controleur/c_loading_on.php");//interface globale
    include ("vues/vue_pied_menu_pages.php");//menu pour changer de page
}?>
</body>
</html>