<?php
$action=$_GET['action'];
switch ($action) {
    case 'list':
    //On cherche s'il y a quelque chose dans libelle, on fait la requete $textRequete, s'il y a rien on passe. 
        $libelle="";
        $Continent="Tous";
        if (isset($_POST['libelle'])) {
            $libelle=$_POST['libelle'];

        }
        //On cherche s'il y a quelque chose dans libelle, on fait la requete $textRequete, s'il y a rien on passe. 
        if (isset($_POST['continent'])) {
            $Continent=$_POST['continent'];
        }
        $LesNationalites=Nationalite::findAll($libelle,$Continent);//On l'ajoute dans le FindALL 
        $LesContinents=Continent::findAll();
       include('vues/listeNationalite.php');
      
        break;
    
    case 'add':
        $mode="Ajouter";
        $LesContinents=Continent::findAll();
        include('vues/formNationalite.php');
        break;

    case 'update':
        $mode="Modifier";
        $LesContinents=Continent::findAll();
        $nationalite=Nationalite::findByid($_GET['num']);
       include('vues/formNationalite.php');
        break;

    case 'delete':
        
        $nationalite=Nationalite::findByid($_GET['num']);
        $nb=Nationalite::delete($nationalite);
        
        if ($nb==1) {
            $_SESSION['message']=["success" =>"La nationlationalité  a bien été supprimer"];

            }
            else{
            $_SESSION['message']=["danger" =>"La nationlationalité  n'a pas été supprimer"];

            }
            header('location: index.php?uc=nationalites&action=list');
            exit();
        break;
                    case 'valideform':
                        $nationalite= new Nationalite();
                       if (empty($_POST['num'])) { //cas d'une création
                        $nationalite->setLibelle($_POST['libelle']);
                        $Continent=new Continent;
                       $Continent=Continent::findByid($_POST['Continent']);
                        $nationalite->setNumContinent($Continent);
                            $nb=Nationalite::add($nationalite);
                            $message= "Ajouter";
                       }
                       else{ // cas d'une Modification
                            $nationalite->setNum($_POST['num']);
                            $nationalite->setLibelle($_POST['libelle']);
                            $Continent=new Continent;
                            $Continent=Continent::findByid($_POST['Continent']);
                             $nationalite->setNumContinent($Continent);
                            $nb=Nationalite::update($nationalite);
                            $message= "Modifier";
                       }
                       if ($nb==1) {
                        
                          $_SESSION['message']=["success" =>"La nationalité a bien été $message"];

                       }
                       else{
                        $_SESSION['message']=["danger" =>"La nationalité n'a pas été $message"];

                       }
                   
                       header('location: index.php?uc=nationalites&action=list');
                        break;
}
?>