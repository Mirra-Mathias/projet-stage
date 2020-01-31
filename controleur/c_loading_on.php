<?php

//isset chaque
!isset($_GET['menu']) ? $_GET['menu']="tout" : null;
!isset($_GET['page']) ?  $_GET['page']=1 : null;
!isset($_GET['nb']) ? $_GET['nb']=20 : null ;
if(!isset($_GET['keyword'])){
    echo "<script>includeGET('keyword=')</script>";
}

//recherche(mot,*pr case,*nb case,choix menu,date début ,date fin,tri date default 0,tri titre default 0)

$dd = false;
$df = false;

if(isset($_GET['date_debut'])){
    if(!isset($_SESSION['date_debut'])){
        $_SESSION['date_debut'] = "";
    }
    if($_SESSION['date_debut']!=$_GET['date_debut']){
        $dd =true;
    }
}

if(isset($_GET['date_fin'])){
    if(!isset($_SESSION['date_fin'])){
        $_SESSION['date_fin'] = "";
    }
    if($_SESSION['date_fin']!=$_GET['date_fin']){
        $df =true;
    }
}


if(!isset($_SESSION['keyword'])|| $_SESSION['keyword']!=$_GET['keyword']|| $dd|| $df) {
    $_SESSION['table'] = $pdo->recherche(
        isset($_GET['keyword']) && strlen($_GET['keyword']) > 0 ? $_GET['keyword'] : null,
        null,
        isset($_GET['date_debut']) && strlen($_GET['date_debut']) > 0 ? $_GET['date_debut'] : null,
        isset($_GET['date_fin']) && strlen($_GET['date_fin']) > 0 ? $_GET['date_fin'] : null,
        null,
        null);

    isset( $_GET['keyword']) ? $_SESSION['keyword'] = $_GET['keyword'] : null;
    isset( $_GET['date_debut']) ? $_SESSION['date_debut'] = $_GET['date_debut'] : null;
    isset( $_GET['date_fin']) ? $_SESSION['date_fin'] = $_GET['date_fin'] : null;
}

?><br><?php
include('vues/vue_recherche_bar.php'); ?>
<br>
<?php
 include('vues/vue_taille_page.php')?>
<br><br>
<?php include ('vues/vue_recherche_date.php')?>



<div class="album py-5" id="content">
    <div class="container">

        <div class="row">


            <?php
            if(isset($_GET['menu'])){
                switch($_GET['menu']){
                    case "tout":
                        $tempo = $_SESSION['table'];
                        break;
                    case "abeille":
                        $tempo = menu($_SESSION['table'],1);
                        break;
                    case "delivrance":
                        $tempo = menu($_SESSION['table'],2);
                        break;
                    case "nouvelle_abeille":
                        $tempo = menu($_SESSION['table'],3);
                        break;
                }
            }
            else{
                $tempo = $_SESSION['table'];
            }


            $case = 0;
            if(!isset($_GET['nb'])){
                $_GET['nb'] = 20;
            }else if ($_GET['nb']>80||$_GET['nb']<20){
                $_GET['nb']=20;
            }

            $total = count($tempo);
            if(isset($_GET['page'])){
                if($_GET['page']>0&$_GET['page']<= float_page($total/$_GET['nb'])){
                    $case = page($_GET['page'],$_GET['nb'],$total);
                }else{
                    $_GET['page']=1;


                }
            }

            if(count($tempo)==0){
                echo "<div class=\"alert alert-danger\" role=\"alert\">Aucune page trouver</div>";
            }else{
                $tab = $pdo->getTab($tempo,$case,$_GET['nb'],$total);
                for ($i = 0; $i < count($tab) ;$i++){
                    include('vues/vue_affiche.php');
                }}?>

        </div>
    </div>
</div>
