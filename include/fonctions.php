<?php
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
    $chaine = $chaine;
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

    if($i==251){
        return "+".($i-1)."*/$~§".$n_chaine;
    }
    return ($i-1)."*/$~§<a id='0'></a>".$n_chaine;


}



