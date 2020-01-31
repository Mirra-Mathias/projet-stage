
<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <form class="form-inline">
                <button id="button1" class="btn btn-light btn-lg" type="button" onclick="menu(0)" >Tout <span class="badge badge-secondary"><?php echo isset($_SESSION['table']) ? count($_SESSION['table']) : "0"; ?></span></button>
                <button id="button2" class="btn btn-light btn-lg" type="button" onclick="menu(1)">L'abeille de saint-Junien <span class="badge badge-secondary"><?php echo isset($_SESSION['table']) ? $pdo->count_menu($_SESSION['table'],1) : "0"; ?></span></button>
                <button id="button3" class="btn btn-light btn-lg" type="button" onclick="menu(2)" >La Délivrance <span class="badge badge-secondary"><?php echo isset($_SESSION['table']) ? $pdo->count_menu($_SESSION['table'],2) : "0"; ?></span></button>
                <button id="button4" class="btn btn-light btn-lg" type="button" onclick="menu(3)" >La Nouvelle Abeille <span class="badge badge-secondary"><?php echo isset($_SESSION['table']) ? $pdo->count_menu($_SESSION['table'],3) : "0"; ?></span></button>
            </form>
            <script>
                switch($_GET('menu')){

                    case 'abeille':
                        document.getElementById("button2").className = "btn btn-dark btn-lg";
                        break;
                    case 'delivrance':
                        document.getElementById("button3").className = "btn btn-dark btn-lg";
                        break;
                    case 'nouvelle_abeille':
                        document.getElementById("button4").className = "btn btn-dark btn-lg";

                        break;
                    default:
                        document.getElementById("button1").className = "btn btn-dark btn-lg";
                }


            </script>
        </ul>
        <div class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" id="keyword" type="search" placeholder="Recherche"
                <?php echo isset($_GET['keyword']) && strlen($_GET['keyword']) > 0 ? 'value="'. str_replace('"', '', $_GET['keyword']).'"' : null;?>
                   aria-label="Recherche" onkeydown="if (event.keyCode == 13) document.getElementById('recherche_bar').click()">

            <button id="recherche_bar" class="btn btn-outline-info  my-2 my-sm-0" type="submit" onclick="includeGET('keyword='+document.getElementById('keyword').value+'&loading=on')">Recherche</button>
        </div>
    </div>
</nav>
