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