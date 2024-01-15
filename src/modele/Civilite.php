<?php


enum Civilite {
    case H;
    case F;


    public static function valueOf(string $nom) :Civilite {
        if($nom == Civilite::H->name) {
            return Civilite::H;
        }else {
            return Civilite::F;
        }
    }
}

?>