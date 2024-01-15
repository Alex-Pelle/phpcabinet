<?php 

enum Fonction {
    case M;
    case U;

    public static function valueOf(string $nom) :Fonction {
        if($nom == Fonction::M->name) {
            return Fonction::M;
        }else {
            return Fonction::U;
        }
    }
}

?>