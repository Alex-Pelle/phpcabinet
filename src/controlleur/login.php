<?php
class ControlleurLogin {
  static function afficher() {
   require(__DIR__.'/../vue/connexion.php');
  }
  static function login($input) {
    if ($input['login'] != 'user_iut' || $input['pwd'] != '$iutinfo') {
      $_SESSION['notification_message'] = 'Mauvais identifiant ou mot de passe';
      $_SESSION['notification_color'] = 'red';
      header('Location: /');
    } 
    else {
      $_SESSION['logged'] = true;
      $_SESSION['notification_message'] = 'Authentification réussie';
      $_SESSION['notification_color'] = 'green';
      header('Location: /');
    }
  }
  static function logout() {
   $_SESSION['logged'] = false;
   $_SESSION['notification_message'] = 'Déconnexion réussie';
   $_SESSION['notification_color'] = 'green';
   header('Location: /');
  }
}