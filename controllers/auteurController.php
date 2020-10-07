<?php
$action=$_GET['action'];
switch ($action) {
    case 'list':
     //On cherche s'il y a quelque chose dans libelle, on fait la requete $textRequete, s'il y a rien on passe. 
    $nom="";
    $prenom="";
    $Nationalite="Tous"; //à changer!!
    if (isset($_POST['nom'])) {
        $nom=$_POST['nom'];  //On cherche le nom
    }
    if (isset($_POST['prenom'])) {
        $prenom=$_POST['prenom']; //On cherche le prenom
    }
    if (isset($_POST['nationalite'])) {
        $Nationalite=$_POST['nationalite']; //On cherche la nationalité
    }
  
        $LesAuteurs=Auteur::findAll($nom,$prenom,$Nationalite);
        $LesNationalites=Nationalite::findall();
       include('vues/listeAuteur.php');
      
        break;
    
    case 'add': // Ajouter
        $mode="Ajouter";
        $LesNationalites=Nationalite::findall();
        $LesAuteurs=Auteur::findAll();
        include('vues/formAuteur.php');
        break;

    case 'update': // Modifier
        $mode="Modifier";
        $LesNationalites=Nationalite::findall();
        $auteur=Auteur::findByid($_GET['num']);
       include('vues/formAuteur.php');
        break;

    case 'delete': // supprimer
        
        $auteur=Auteur::findByid($_GET['num']);
        $nb=Auteur::delete($auteur);
        
        if ($nb==1) {
            $_SESSION['message']=["success" =>"La nationlationalité  a bien été supprimer"];

            }
            else{
            $_SESSION['message']=["danger" =>"La nationlationalité  n'a pas été supprimer"];

            }
            header('location: index.php?uc=auteurs&action=list');
            exit();
        break;
                    case 'valideform':
                        $auteur= new Auteur();
                       if (empty($_POST['num'])) { //cas d'une création
                        $Nationalite=new Nationalite;// Cherche le libelle de nationalité
                        $Nationalite=Nationalite::findByid($_POST['Nationalite']); // Cherche le libelle de nationalité
                        $auteur->setNumNationalite($Nationalite);// Cherche le libelle de nationalité
                        $auteur->setNom($_POST['nom']);//cherche le nom de l'auteur
                        $auteur->setPrenom($_POST['prenom']);//cherche le nom de l'auteurs
                            $nb=Auteur::add($auteur);
                            $message= "Ajouter";
                       }
                       else{ // cas d'une Modification
                        $Nationalite=new Nationalite;// Cherche le libelle de nationalité
                        $Nationalite=Nationalite::findByid($_POST['Nationalite']); // Cherche le libelle de nationalité
                        $auteur->setNumNationalite($Nationalite);// Cherche le libelle de nationalité
                            $auteur->setNum($_POST['num']);
                            $auteur->setNom($_POST['nom']);
                            $auteur->setPrenom($_POST['prenom']);
                            $nb=Auteur::update($auteur);
                            $message= "Modifier";
                       }
                       if ($nb==1) {
                        
                          $_SESSION['message']=["success" =>"La nationalité a bien été $message"];

                       }
                       else{
                        $_SESSION['message']=["danger" =>"La nationalité n'a pas été $message"];

                       }
                   
                       header('location: index.php?uc=auteurs&action=list');
                        break;
}
?>