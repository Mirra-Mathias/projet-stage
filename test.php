<?php
//strpos(strtolower (chaine),strtolower(mot)) position mot dans chaine
//strlen(chaine) taille chaine
//explode(" ", chaine) retrouve toutes les keys
//substr_replace(chaine, mot, position, taille)
//        for($i2=strlen($a.$i.$b.$mot.$c);$i2>0;$i2--){
//            $ch = $ch."-";
//        }

$tc = strlen("abc");


if(strpos("abc","a")!==false){
    echo "test";
}else{
    echo "test2";
}

function get_Pos_chaine($key,$chaine,$a,$b,$c){
    $table_key = explode(" ", $key);
    $i = 0;
    $n_chaine = $chaine ;
    do {
        $pp = strpos(strtolower ($chaine),strtolower($key));
        $tk = strlen($key);
        $mot = $key;

        foreach ($table_key as $item){
            if($pp > strpos(strtolower ($chaine),strtolower($item))){
                $pp = strpos(strtolower ($chaine),strtolower($item));
                $tk = strlen($item);
                $mot = $item;
            }else if ($pp == strpos(strtolower ($chaine),strtolower($item)) && $tk < strlen($item)){
                $tk = strlen($item);
                $mot = $item;
            }

        }
        $ch = "";
            if($pp!==false){
                for($i2=strlen($a.$i.$b.$mot.$c);$i2>0;$i2--){
                    $ch = $ch."-";
                }


            $chaine = substr_replace($chaine, $ch, $pp, strlen($mot));
            $n_Chaine = substr_replace($n_chaine,$a.$i.$b.$mot.$c,$pp, strlen($mot));
            $i++;
        }
    }while($pp!==false);

    return $n_chaine;

    }

