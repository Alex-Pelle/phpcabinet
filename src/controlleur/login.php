<?php
class ControlleurLogin {
  static function afficher() {
   require(__DIR__.'/../vue/connexion.php');
  }
  static function login($input) {
    if ($input['login'] != 'etu' || $input['pwd'] != '$iutinfo') {
      $_SESSION['notification_message'] = 'Mauvais identifiant ou mot de passe';
      header('Location: /');
    } 
    else {
      $_SESSION['logged'] = true;
      header('Location: /');
    }
  }
}