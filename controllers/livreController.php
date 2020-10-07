<?php
$action=$_GET['action'];
switch ($action) {
            
    // requête qui permet d'ajouter les colonnes dans le body'
    case 'list':
        $titre=""; 
        $auteur="Tous";
        $genre="all";

        //On cherche s'il y a quelque chose dans le titre, s'il y a rien on passe. 
        if (isset($_POST['titre'])) {
            $titre=$_POST['titre'];
        }

        //On cherche s'il y a quelque chose dans l'auteur , s'il y a rien on passe. 
        if (isset($_POST['auteur'])) {
            $auteur=$_POST['auteur'];
        }

        //On cherche s'il y a quelque chose dans le genre, s'il y a rien on passe. 
        if (isset($_POST['genre'])) {
            $genre=$_POST['genre'];
        }

        $LesLivres=Livre::findAll( $titre,$auteur,$genre);
        $LesGenres=Genre::findAll(); //on met le variable  $LesGenres dans la classe Genre, pour aller chercher dans la classe Genre
        $LesAuteurs=Auteur::findAll(); //on met le variable  $LesGenres dans la classe Auteur, pour aller chercher dans la classe Auteur
       include('vues/listeLivre.php');
      
        break;
    
    // requête qui permet d'ajouter
    case 'add':
        $mode="Ajouter";
        $LesGenres=Genre::findall();//on met le variable  $LesGenres dans la classe Genre, pour aller chercher dans la classe Genre
        $LesAuteurs=Auteur::findAll();//on met le variable  $LesGenres dans la classe Auteur, pour aller chercher dans la classe Auteur
        include('vues/formLivre.php');
        break;
    
        // requête qui permet de modifier
    case 'update':
        $mode="Modifier";
         $LesGenres=Genre::findall();//on met le variable  $LesGenres dans la classe Genre, pour aller chercher dans la classe Genre
        $LesAuteurs=Auteur::findAll();//on met le variable  $LesGenres dans la classe Auteur, pour aller chercher dans la classe Auteur
        $livre=Livre::findByid($_GET['num']);
       include('vues/formLivre.php');
        break;

        // requête qui permet de supprimer
    case 'delete':
        
        $livre=Livre::findByid($_GET['num']);
        $nb=Livre::delete($livre);
        
        if ($nb==1) {
            $_SESSION['message']=["success" =>"Le livre  a bien été supprimer"];

            }
        else{
            $_SESSION['message']=["danger" =>"Le livre  n'a pas été supprimer"];

            }
            header('location: index.php?uc=livres&action=list');
            exit();
        break;
                    case 'valideform':
                        $livre= new Livre();
                       if (empty($_POST['num'])) { //cas d'une création
                        $Auteur=new Auteur;// Cherche le libelle de auteur
                        $Auteur=Auteur::findByid($_POST['auteur']); // Cherche le libelle de Auteur
                        $livre->setnumAuteur($Auteur);// Cherche le libelle de auteur
                        $Genre=new Genre;// Cherche le libelle de genre
                        $Genre=Genre::findByid($_POST['genre']);// Cherche le libelle de genre
                        $livre->setnumGenre($Genre);// Cherche le libelle de genre

                        $livre->setIsbn($_POST['isbn']);//cherche le ISBN de livres
                        $livre->setTitre($_POST['titre']);//cherche le titre de livres
                        $livre->setPrix($_POST['prix']);//cherche le prix de livres
                        $livre->setEditeur($_POST['editeur']);//cherche le editeur de livres
                        $livre->setAnnee($_POST['annee']);//cherche l'année de livres
                        $livre->setLangue($_POST['langue']);//cherche la langue de livres
                            $nb=Livre::add($livre);
                            $message= "Ajouter";
                       }
                       else{ // cas d'une Modification
                        $Auteur=new Auteur;// Cherche le libelle de auteur
                        $Auteur=Auteur::findByid($_POST['auteur']); // Cherche le libelle de Auteur
                        $livre->setnumAuteur($Auteur);// Cherche le libelle de auteur
                        $Genre=new Genre;// Cherche le libelle de genre
                        $Genre=Genre::findByid($_POST['genre']);// Cherche le libelle de genre
                        $livre->setnumGenre($Genre);// Cherche le libelle de genre

                            $livre->setNum($_POST['num']);// cherche le numero de livre
                            $livre->setIsbn($_POST['isbn']);//cherche le ISBN de livres
                            $livre->setTitre($_POST['titre']);//cherche le titre de livres
                            $livre->setPrix($_POST['prix']);//cherche le prix de livres
                            $livre->setEditeur($_POST['editeur']);//cherche le editeur de livres
                            $livre->setAnnee($_POST['annee']);//cherche l'année de livres
                            $livre->setLangue($_POST['langue']);//cherche la langue de livres
                            $nb=Livre::update($livre);
                            $message= "Modifier";
                       }
                       if ($nb==1) {
                        
                          $_SESSION['message']=["success" =>"Le livre a bien été $message"];

                       }
                       else{
                        $_SESSION['message']=["danger" =>"Le livre n'a pas été $message"];

                       }
                   
                       header('location: index.php?uc=livres&action=list');
                break;
                case 'nbgenre':
                       

                break;
}
?>