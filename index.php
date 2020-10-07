
<?php ob_start();
session_start();?>
<?php include 'vues/header.php';
include "modeles/Nationalite.php";
include "modeles/Livre.php";
include "modeles/Auteur.php";
include "modeles/Continent.php";
include "modeles/Genre.php";
include "modeles/monPdo.php";
include "vues/messagesFlash.php";



$uc=empty($_GET['uc']) ? "accueil" : $_GET['uc']; 

switch ($uc) {
    case 'accueil':
        include('vues/accueil.php');
        break;
    
    case 'continents':
        include('controllers/continentController.php'); //ajoute , modifier , supprimer les continents
        break;
    case 'nationalites':
            include('controllers/nationaliteController.php'); //ajoute , modifier , supprimer les nationalités
    break;
    case 'auteurs': 
        include('controllers/auteurController.php');  //ajoute , modifier , supprimer les auteurs
    break;
    case 'genres': 
        include('controllers/genreController.php');  //ajoute , modifier , supprimer les genres
    break;
    case 'livres': 
        include('controllers/livreController.php');  //ajoute , modifier , supprimer les genres
    break;

}

?>
<?php include 'vues/footer.php';?>