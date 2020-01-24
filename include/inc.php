<?php

class PdoGsb
{
    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=mairiesaomod1';
    private static $user = 'root';
    private static $mdp = 'root';
    public static $monPdo;
    private static $monPdoGsb = null;

    private function __construct()
    {
        PdoGsb::$monPdo = new PDO(PdoGsb::$serveur . ';' . PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp);
        PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
    }

    public function _destruct()
    {
        PdoGsb::$monPdo = null;
    }

    public static function getPdoGsb()
    {
        if (PdoGsb::$monPdoGsb == null) {
            PdoGsb::$monPdoGsb = new PdoGsb();
        }
        return PdoGsb::$monPdoGsb;
    }
// codejournal = 1 L'ABEILLE DE SAINT JUNIEN
//codejournal = 2 DELIVRANCE
//codejournal = 3 LA NOUVELLE ABEILLE


//recherche(mot,pr case,nb case,choix menu, date début , date fin, tri date , tri titire)
    function recherche($keyword,$menu,$date_debut,$date_fin,$tridate,$triaz){
        $keyword = str_replace("'", "\'", $keyword);


        $where = false;
        $union = false;
        $tab = explode(" ", $keyword);
        $req = "SELECT DISTINCT id,titre,dtjournal,codejournal FROM jnl WHERE";

        if(isset($menu)&$menu!=0) {
            $where = true;
            $req = $req . " codejournal = " . $menu;
        }

        if(isset($date_debut)){
            $where = true;
            if(stristr($req, '=')){
                $req = $req . " AND";
            }
            $req = $req ." DATE_FORMAT(dtjournal, '%Y') >= " . $date_debut;
        }

        if(isset($date_fin)){
            $where = true;
            if(stristr($req, '=')){
                $req = $req." AND";
            }
            $req = $req . " DATE_FORMAT(dtjournal, '%Y') <= " . $date_fin;
        }

        if(count($tab)>1){
            $where = true;
            if(stristr($req, '=')){
                $req = $req . " AND";
            }
            $reqtempo = $req;
            $req = $req . " LOCATE('" . $keyword . "',pleintext)";

            $req = $req . " UNION " . $reqtempo;

            $premier = true;
            foreach ($tab as $t){
                if($premier){
                    $req = $req . " LOCATE('" . $t . "',pleintext)";
                    $premier = false;
                }
                else{
                    $req = $req . " AND LOCATE('" . $t . "',pleintext)";
                }
            }

            foreach ($tab as $t){
                $req = $req . " UNION " . $reqtempo . " LOCATE('" . $t . "',pleintext)";
            }

        }else if (isset($keyword)){
            $where = true;
            if(stristr($req, '=')){
                $req = $req . " AND";
            }
            $req = $req . " LOCATE('" . $keyword . "',pleintext)";
        }

        if(!$where) {
            $req = str_replace("WHERE", "", $req);
        }

        if(isset($triaz)){

            if($triaz == 0){
                $req = $req . " ORDER BY titre ASC";
            }else{
                $req = $req . " ORDER BY titre DESC";
            }

        }elseif(isset($tridate)){
            if($tridate == 0){
                $req = $req . " ORDER BY dtjournal ASC";
            }else{
                $req = $req . " ORDER BY dtjournal DESC";
            }
        }


        $rs = PdoGsb::$monPdo->query($req);
        $ligne = $rs->fetchAll();

        return $ligne;

    }


    function getTab($id,$debut,$nb_case,$total){
        if($debut+$nb_case-1<=$total){
            for ($i=$debut;$i < $debut+$nb_case;$i++){

                if(isset($info)){
                    $info = $info.",".$id[$i]['id'];
                }else{
                    $info = $id[$i]['id'];
                }

            }
        }else{
            $fin = count($id)-$debut;
            $fin = $fin + $debut - 1;
            for($i=$debut;$i<=$fin;$i++){
                if(isset($info)){
                    $info = $info.",".$id[$i]['id'];
                }else{
                    $info = $id[$i]['id'];
                }
            }
        }


        $req = "SELECT * FROM jnl where id IN(".$info.")";
        $rs = PdoGsb::$monPdo->query($req);
        $getTab = $rs->fetchAll();
        return $getTab;

    }


    function count_menu($tableau,$option){
        foreach ($tableau as $i){
            if(isset($info)){
                $info = $info.",".$i['id'];
            }else{
                $info = $i['id'];
            }

        }

        $req = "SELECT count(codejournal) as code FROM jnl WHERE id IN(".$info.") AND codejournal=".$option;
        $rs = PdoGsb::$monPdo->query($req);
        $getTab = $rs->fetch();
        if(count( $getTab)<1){
            return 0;
        }
        return $getTab['code'];

    }

    function modallong($id){
        $req = "SELECT titre,pleintext FROM jnl WHERE id =".$id;
        $rs = PdoGsb::$monPdo->query($req);
        $getTab = $rs->fetch();
        return $getTab;

    }



}//pdo

function page($nb_page,$nb_case,$total_case){
        $case = 0;

        if($nb_page!=0&&$nb_page!=1) {
            $case = $nb_page - 1;
            $case = $nb_case * $case;
            $case = $case + 1;
        }

        if($case <= $total_case){
            return $case;
        }

    return null;

}

function float_page($nb){
    if(is_float($nb)){
        return intval($nb)+1;
    }
    return $nb;
}

function menu($tab,$nb){
    $tab2 = array();


    foreach ($tab as $i){
        if($i['codejournal'] == $nb){
            array_push($tab2,$i);
        }
    }

    return $tab2;

}



// "<mark id='1'>" . $item . "</mark>"
function get_Pos_chaine($key,$chaine,$a,$b,$c){
    $table_key = explode(" ", $key);
    $chaine = " ".$chaine;
    $i = 1;
    $n_chaine = $chaine ;
    do {
        $pp = strpos(strtolower ($chaine),strtolower($key));
        $tk = strlen($key);
        $mot = $key;
        foreach ($table_key as $item){
            if($pp == strpos(strtolower ($chaine),strtolower($item)) AND $tk < strlen($item) AND $pp !== false){
                $tk = strlen($item);
                $mot = $item;
            }else if($pp > strpos(strtolower ($chaine),strtolower($item)) XOR $pp == false){
                $pp = strpos(strtolower ($chaine),strtolower($item));
                $tk = strlen($item);
                $mot = $item;
            }

        }
        $ch = "";
        if($pp!==false){
            for($i2=strlen($a.$i.$b.$mot.$c);$i2>0;$i2--){
                $ch = $ch."*";
            }

            $n_chaine = substr_replace($n_chaine,$a.$i.$b.$mot.$c,$pp, strlen($mot));
            $chaine = substr_replace($chaine, $ch, $pp, strlen($mot));
            $i++;
        }
    }while($pp!==false);

    return $n_chaine;

}
