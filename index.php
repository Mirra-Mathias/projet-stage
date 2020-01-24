
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/sort.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <link href="css/modallong.css" rel="stylesheet" type="text/css">



</head>
<body>

<?php
session_start();
require_once("include/inc.php");
$pdo = PdoGsb::getPdoGsb();


if(isset($_GET['loading']) && $_GET['loading'] == "on") {
    echo "
        <div style=\"position:relative; top: 350px;\" class='text-center'>
        <div class=\"spinner-grow text-info\" style=\"width: 3rem; height: 3rem;\" role=\"status\">
        <span class=\"sr-only\">Loading...</span>
        </div></div>
        <script>
        includeGET('loading=off')
        </script>
        ";

}else{
    !isset($_GET['menu']) ? $_GET['menu']="tout" : null;
    !isset($_GET['page']) ?  $_GET['page']=1 : null;
    !isset($_GET['nb']) ? $_GET['nb']=20 : null ;
    if(!isset($_GET['keyword'])){
        echo "<script>includeGET('keyword=')</script>";
}

//recherche(mot,*pr case,*nb case,choix menu,date début ,date fin,tri date default 0,tri titre default 0)

if(!isset($_GET['loading'])||$_GET['loading']=="off"){
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
            1,
            null);

        isset( $_GET['keyword']) ? $_SESSION['keyword'] = $_GET['keyword'] : null;
        isset( $_GET['date_debut']) ? $_SESSION['date_debut'] = $_GET['date_debut'] : null;
        isset( $_GET['date_fin']) ? $_SESSION['date_fin'] = $_GET['date_fin'] : null;


    }
}

?>
    <i class="fas fa-search" aria-hidden="true"></i>
    <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
           aria-label="Search" id="keyword" <?php echo isset($_GET['keyword']) && strlen($_GET['keyword']) > 0 ? 'value="'. str_replace('"', '', $_GET['keyword']).'"' : null;?>>
<br>
<script>
    var input = document.getElementById("keyword");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {

           includeGET("keyword="+input.value+"&loading=on");
        }
    });
</script>

<div >

<script type="text/javascript">
    <?php if(count($_SESSION['table']) == 0) { ?>
    gen_menu(0,0,0,0);
    <?php } else { ?>
 gen_menu(<?php echo count($_SESSION['table']).",".$pdo->count_menu($_SESSION['table'],1).",".$pdo->count_menu($_SESSION['table'],2).",".$pdo->count_menu($_SESSION['table'],3)?>);
 <?php } ?>

</script>

</div>
<br><br>
<div class="btn-group align-items-center">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php
    if($_GET['nb']==20|$_GET['nb']==40|$_GET['nb']==60|$_GET['nb']==90){
        echo $_GET['nb'];
    }else{
        echo "20";
    }
        ?>


    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" onclick="includeGET('nb=20')">20</a>
        <a class="dropdown-item" onclick="includeGET('nb=40')">40</a>
        <a class="dropdown-item" onclick="includeGET('nb=60')">60</a>
    </div>
</div>
<br><br>
<div class="float-left">
<div class="input-group mb-3">
    <input id="date_debut" type="number" class="form-control-sm" placeholder="date début" aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?php echo isset($_GET['date_debut']) && strlen($_GET['date_debut']) > 0 ? $_GET['date_debut'] : null ;?>">
</div>
<div class="input-group mb-3">
    <input type="number" class="form-control-sm" placeholder="date fin" aria-label="Recipient's username" aria-describedby="basic-addon2" id="date_fin" value="<?php echo isset($_GET['date_fin']) && strlen($_GET['date_fin']) > 0 ? $_GET['date_fin'] : null ;?>">
    <div class="input-group-append"></div>
</div>
    <input class="btn btn-outline-secondary" type="submit" value="Rechercher" id="recherche" onclick="recherche_date()">
</div>

    <script>

    </script>

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
                include('vue_affiche.php');
                //include ('vue_Modallong.php');
            }}?>

        </div>
    </div>
</div>


<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <a class="page-link" aria-label="Previous" onclick="includeGET('page=<?php echo  $_GET['page']-20; ?>')">
            <span aria-hidden="true">&laquo;&laquo;</span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="page-link" aria-label="Previous" onclick="includeGET('page=<?php echo  $_GET['page']-10; ?>')">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
        </a>

        <?php


        if($total/$_GET['nb']<8) {
            for ($i = 1; $i <= float_page($total/$_GET['nb']); $i++) {
                if ($i == $_GET['page']) {
                    ?>
                    <li class="page-item active"><a class="page-link active"
                                                    onclick="includeGET('page=<?php echo $_GET['page']; ?>')"><?php echo $_GET['page']; ?>
                        <span class="sr-only">(current)</span></a></li><?php
                } else {
                    ?>
                    <li class="page-item"><a class="page-link"
                                             onclick="includeGET('page=<?php echo $i; ?>')"><?php echo $i; ?></a>
                    </li><?php
                }
            }
        }

        else if($total/$_GET['nb']-3<$_GET['page']) {
            for ($i =  float_page($total/$_GET['nb']-7); $i<= float_page($total/$_GET['nb']); $i++){
                if($i == $_GET['page']){
                    ?><li class="page-item active" ><a class="page-link active" onclick="includeGET('page=<?php echo  $_GET['page']; ?>')"><?php echo $_GET['page']; ?> <span class="sr-only">(current)</span></a></li><?php
                }else{
                    ?><li class="page-item" ><a class="page-link" onclick="includeGET('page=<?php echo  $i; ?>')"><?php echo $i; ?></a></li><?php
                }
            }


            }elseif($_GET['page']<4){
            for ($i = 1; $i<8; $i++){
                if($i == $_GET['page']){
                    ?><li class="page-item active" ><a class="page-link active" onclick="includeGET('page=<?php echo  $_GET['page']; ?>')"><?php echo $_GET['page']; ?> <span class="sr-only">(current)</span></a></li><?php
                }else{
                ?><li class="page-item" ><a class="page-link" onclick="includeGET('page=<?php echo  $i; ?>')"><?php echo $i; ?></a></li><?php
                    }
            }
        }
        elseif($_GET['page']> 3){
            for ($i = $_GET['page']-3; $i<$_GET['page']; $i++){
                ?><li class="page-item" ><a class="page-link" onclick="includeGET('page=<?php echo  $i; ?>')"><?php echo $i; ?></a></li><?php
            }

            ?><li class="page-item active" ><a class="page-link active" onclick="includeGET('page=<?php echo  $_GET['page']; ?>')"><?php echo $_GET['page']; ?> <span class="sr-only">(current)</span></a></li><?php

            for ($i = $_GET['page']+1; $i<$_GET['page']+4; $i++){
                ?><li class="page-item" ><a class="page-link" onclick="includeGET('page=<?php echo  $i; ?>')"><?php echo $i; ?></a></li><?php
            }

       }


        ?>

        <li class="page-item">
            <a class="page-link" aria-label="Next" onclick="includeGET('page=<?php echo  $_GET['page']+10; ?>')">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" aria-label="Next" onclick="includeGET('page=<?php echo  $_GET['page']+20; ?>')">

                <span aria-hidden="true">&raquo;&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>

<?php }?>



</body>


</html>