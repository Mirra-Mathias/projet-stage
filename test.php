<?php

echo get_Pos_chaine("b a c","abc a","<mark id='","'>","</mark>");

function get_Pos_chaine($key,$chaine,$a,$b,$c){
    $table_key = explode(" ", $key); // recupère chaine tableau
    $i = 1;
    $n_chaine = $chaine ; // nouvelle chaine
    do {
        $pp = strpos(strtolower ($chaine),strtolower($key)); // premiere position $key dans $chaine
        $tk = strlen($key); // taille $key
        $mot = $key; // mot récupérer
        foreach ($table_key as $item){ //parcour tous les items
            if($pp == strpos(strtolower ($chaine),strtolower($item)) AND $tk < strlen($item)){// si premiere position de key est la meme que premiere position $item et taille de key < taille item et taille key n'est pas nul
                $tk = strlen($item); // remplacement taille
                $mot = $item; //récupère nouveau key
            }
            if($pp > strpos(strtolower ($chaine),strtolower($item)) OR $pp = null){// sinon si position key est plus grande ou position $key n'éxiste pas
                $pp = strpos(strtolower ($chaine),strtolower($item)); // récupère position
                $tk = strlen($item); // remplacement position
                $mot = $item; // récupère nouveau key
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
        return $n_chaine;
    }
    return $n_chaine;


}

