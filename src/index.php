<?php

require_once(__DIR__.'/controlleur/usagers.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {
	if ($_GET['action'] === 'usagers') {
        	liste();
	} else {
    	echo "Erreur 404 : la page que vous recherchez n'existe pas.";
	}
} else {
}