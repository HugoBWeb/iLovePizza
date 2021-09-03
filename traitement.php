<?php

$servername = 'localhost';
$username = 'root';
$password = '';

if($_GET['action'] == 'up' ) {

    try{
        $bdd = new PDO("mysql:host=$servername;dbname=pizzeria", $username, $password) ;
        //On définit le mode d'erreur de PDO sur Exception
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

        $update = $bdd->prepare("UPDATE pizzas INNER JOIN ingredients ON pizzas.nom = ingredients.nom_pizza SET pizzas.nom = :setNom , pizzas.prix_vente = :setPrix , ingredients.nom_pizza = :setNom , pizzas.note_consommateur = :setNote WHERE pizzas.nom = :getOld") ;

        $update->bindValue(':setNom',$_POST['nom'],PDO::PARAM_STR) ;
        $update->bindValue(':setPrix',$_POST['prix_vente'],PDO::PARAM_STR) ;
        $update->bindValue(':getOld',$_GET['oldName'],PDO::PARAM_STR) ;
        $update->bindValue(':setNote',$_POST['note'],PDO::PARAM_STR) ;

        $update->execute();

        $bdd = NULL ;

        header('Location: index.php') ;
    }
    
    /*On capture les exceptions si une exception est lancée et on affiche
     *les informations relatives à celle-ci*/
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage() ;
      die() ;
    }

} elseif($_GET['action'] == 'ins' ) {

    try{
        $bdd = new PDO("mysql:host=$servername;dbname=pizzeria", $username, $password) ;
        //On définit le mode d'erreur de PDO sur Exception
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

        $insert = $bdd->prepare("INSERT INTO pizzas (nom,prix_vente,note_consommateur) VALUES ( :setNom , :setPrix , :setNote)") ;

        $insert->bindValue(':setNom',$_POST['nom'],PDO::PARAM_STR) ;
        $insert->bindValue(':setPrix',$_POST['prix_vente'],PDO::PARAM_STR) ;
        $insert->bindValue(':setNote',$_POST['note'],PDO::PARAM_STR) ;

        $insert->execute();

        $bdd = NULL ;

        header('Location: index.php') ;
    }
    
    /*On capture les exceptions si une exception est lancée et on affiche
     *les informations relatives à celle-ci*/
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage() ;
      die() ;
    }

} else {

    try{
        $bdd = new PDO("mysql:host=$servername;dbname=pizzeria", $username, $password) ;
        //On définit le mode d'erreur de PDO sur Exception
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

        $delete_ingredients = $bdd->prepare("DELETE FROM ingredients WHERE nom_pizza = :pizza") ;
        $delete_pizzas = $bdd->prepare("DELETE FROM pizzas WHERE nom = :pizza");

        $delete_ingredients->bindValue(':pizza',$_GET['pizza'],PDO::PARAM_STR) ;
        $delete_pizzas->bindValue(':pizza',$_GET['pizza'],PDO::PARAM_STR) ;

        $delete_ingredients->execute();
        $delete_pizzas->execute();

        $bdd = NULL ;

        header('Location: index.php') ;
    }
    
    /*On capture les exceptions si une exception est lancée et on affiche
     *les informations relatives à celle-ci*/
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage() ;
      die() ;
    }

}