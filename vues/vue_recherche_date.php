<div class="float-left">
    <div class="input-group mb-3">
        <input id="date_debut" name="date_debut" type="number" onkeydown="if (event.keyCode == 13) document.getElementById('recherche').click()" class="form-control-sm" placeholder="date début" aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?php echo isset($_GET['date_debut']) && strlen($_GET['date_debut']) > 0 ? $_GET['date_debut'] : null ;?>">
    </div>
    <div class="input-group mb-3">
        <input type="number" onkeydown="if (event.keyCode == 13) document.getElementById('recherche').click()" class="form-control-sm" placeholder="date fin" aria-label="Recipient's username" aria-describedby="basic-addon2" id="date_fin" value="<?php echo isset($_GET['date_fin']) && strlen($_GET['date_fin']) > 0 ? $_GET['date_fin'] : null ;?>">
        <div class="input-group-append"></div>
    </div>
    <input class="btn btn-outline-secondary" type="submit" value="Rechercher" id="recherche" onclick="recherche_date()">
</div>

