<?php

$servername = 'localhost';
$username = 'root';
$password = '';

if ($_GET['type'] == "pizza") {
  if ($_GET['action'] == 'up' ) {

      try{
          $bdd = new PDO("mysql:host=$servername;dbname=pizzeria", $username, $password) ;
          //On définit le mode d'erreur de PDO sur Exception
          $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
          $bdd->query("SET NAMES utf8");

          $update_pizza = $bdd->prepare(
              "UPDATE pizzas SET pizzas.nom = :setNom , pizzas.prix_vente = :setPrix , pizzas.note_consommateur = :setNote WHERE pizzas.nom = :getOld"
            ) ;

          $update_pizza->bindValue(':setNom',$_POST['nom'],PDO::PARAM_STR) ;
          $update_pizza->bindValue(':setPrix',$_POST['prix_vente'],PDO::PARAM_STR) ;
          $update_pizza->bindValue(':getOld',$_GET['oldName'],PDO::PARAM_STR) ;
          $update_pizza->bindValue(':setNote',$_POST['note'],PDO::PARAM_INT) ;

          $update_pizza->execute();
          
          $get_ingredients = $bdd->prepare(
            "SELECT nom FROM ingredients WHERE nom_pizza = :setNom"
          ) ;

          $get_ingredients->bindValue(':setNom',$_POST['nom'],PDO::PARAM_STR) ;

          $get_ingredients->execute() ;

          $old_ingredients = $get_ingredients->fetchall(PDO::FETCH_COLUMN) ;

          $nom_nv_ingredients = array_map( function($e){ return $e['nom'] ;} , $_POST['ingredients'] ) ;

          foreach($_POST['ingredients'] as $data){

            if ( in_array( $data['nom'] , $old_ingredients ) ) {
              //update
              echo "update<br>" ;
              print_r($data) ;
              echo "<br>".$_POST['nom']."<br>" ;
              echo $data['quantite']."<br>" ;
              echo "<br>" ;
              echo "UPDATE ingredients SET quantite = ".$data['quantite']." WHERE nom_pizza = ".$_POST['nom']." AND nom = ".$data['nom']."<br>" ;
              $update_ingredient = $bdd->prepare(
                "UPDATE ingredients SET quantite = :qte WHERE nom_pizza = :pizza AND nom = :ingredient"
              ) ;
              $update_ingredient->bindValue(':ingredient',$data['nom'],PDO::PARAM_STR) ;
              $update_ingredient->bindValue(':pizza',$_POST['nom'],PDO::PARAM_STR);
              $update_ingredient->bindValue(':qte',$data['quantite'],PDO::PARAM_INT);
              $update_ingredient->execute() ;
            } else {
              //add
              echo "add<br>" ;
              print_r($data) ;
              echo "<br>" ;
              $ajoute_ingredient = $bdd->prepare(
                "INSERT INTO ingredients (nom,nom_pizza,quantite) VALUES (:ingredient,:pizza,:qte)"
              ) ;
              $ajoute_ingredient->bindValue(':ingredient',$data['nom'],PDO::PARAM_STR) ;
              $ajoute_ingredient->bindValue(':pizza',$_POST['nom'],PDO::PARAM_STR);
              $ajoute_ingredient->bindValue(':qte',$data['quantite'],PDO::PARAM_STR);
              $ajoute_ingredient->execute() ;
            }

          }

          foreach($old_ingredients as $i) {

            if ( !in_array( $i , $nom_nv_ingredients ) ) {
              //suppr
              echo "suppr<br>" ;
              print_r($i) ;
              echo "<br>".$_POST['nom'] ;
              echo "<br>" ;
              $supprime = $bdd->prepare(
                "DELETE FROM ingredients WHERE nom_pizza = :setNom AND nom = :setIngredient"
              ) ;
              
              $supprime->bindValue(':setIngredient',$i,PDO::PARAM_STR) ;
              $supprime->bindValue(':setNom',$_POST['nom'],PDO::PARAM_STR) ;
  
              $supprime->execute() ;
            } 

          }
/*
          foreach ( array_diff( array_map($getNom,$_POST['ingredients']) ,$old_ingredients) as $k => $i ) {

            $ajoute = $bdd->prepare(
              "INSERT INTO ingredients (nom_pizza,nom,quantite) VALUES (:setNom,:setIngredient,:setQuantite)"
            ) ;
            
            $ajoute->bindValue('setIngredient',$i,PDO::PARAM_STR) ;
            $ajoute->bindValue('setNom',$_POST['nom'],PDO::PARAM_STR) ;
            $ajoute->bindValue('setNom',$_POST['ingredients'],PDO::PARAM_STR) ;

            $ajoute->execute() ;

          } ;

          foreach ( array_diff($old_ingredients , array_map($getNom,$_POST['ingredients']) ) as $i ) {

            $supprime = $bdd->prepare(
              "DELETE FROM ingredients WHERE nom_pizza = :setNom AND nom = :setIngredient"
            ) ;
            
            $supprime->bindValue('setIngredient',$i,PDO::PARAM_STR) ;
            $supprime->bindValue('setNom',$_POST['nom'],PDO::PARAM_STR) ;

            $supprime->execute() ;

          } ;
*/

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
          $bdd->query("SET NAMES utf8");

          $insert = $bdd->prepare("INSERT INTO pizzas (nom,prix_vente,note_consommateur) VALUES ( :setNom , :setPrix , :setNote)") ;

          $insert->bindValue(':setNom',$_POST['nom'],PDO::PARAM_STR) ;
          $insert->bindValue(':setPrix',$_POST['prix_vente'],PDO::PARAM_STR) ;
          $insert->bindValue(':setNote',$_POST['note'],PDO::PARAM_INT) ;

          $insert->execute();

          foreach($_POST['ingredients'] as $data) {
            $ajoute_ingredient = $bdd->prepare(
              "INSERT INTO ingredients (nom,nom_pizza,quantite) VALUES (:ingredient,:pizza,:qte)"
            ) ;
            $ajoute_ingredient->bindValue(':ingredient',$data['nom'],PDO::PARAM_STR) ;
            $ajoute_ingredient->bindValue(':pizza',$_POST['nom'],PDO::PARAM_STR);
            $ajoute_ingredient->bindValue(':qte',$data['quantite'],PDO::PARAM_STR);
            $ajoute_ingredient->execute() ;
          } ;
          /*
          foreach($_POST['ingredients'] as $i){
            $insert_ingredient = $bdd->prepare(
              "INSERT INTO ingredients (nom,nom_pizza) VALUES (:setIngredient,:setPizza)"
            );
            $insert_ingredient->bindValue(':setIngredient',$i,PDO::PARAM_STR);
            $insert_ingredient->bindValue(':setPizza',$_POST['nom'],PDO::PARAM_STR);
            $insert_ingredient->execute();
          }
          */

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
          $bdd->query("SET NAMES utf8");

          $delete_ingredients = $bdd->prepare("DELETE FROM ingredients WHERE nom_pizza = :pizza") ;
          $delete_pizzas = $bdd->prepare("DELETE FROM pizzas WHERE nom = :pizza");

          $pizza = str_replace('_',' ',$_GET['pizza']) ;

          $delete_ingredients->bindValue(':pizza',$pizza,PDO::PARAM_STR) ;
          $delete_pizzas->bindValue(':pizza',$pizza,PDO::PARAM_STR) ;

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
} elseif ($_GET['type'] == "produit") {

  if ( $_GET['action'] == 'up' ) {

    try{
      $bdd = new PDO("mysql:host=$servername;dbname=pizzeria", $username, $password) ;
      //On définit le mode d'erreur de PDO sur Exception
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
      $bdd->query("SET NAMES utf8");

      $update_produit = $bdd->prepare(
        "UPDATE produits SET produits.nom = :setNom , produits.prix_kg = :setPrix , produits.allergene = :setAllergene WHERE produits.nom = :getOld"
      ) ;

      $update_produit->bindValue(':setNom',$_POST['nom'],PDO::PARAM_STR) ;
      $update_produit->bindValue(':setPrix',$_POST['prix_kg'],PDO::PARAM_STR) ;
      $update_produit->bindValue(':getOld',$_GET['oldName'],PDO::PARAM_STR) ;
      $update_produit->bindValue(':setAllergene',$_POST['allergene'],PDO::PARAM_BOOL) ;

      $update_produit->execute();

      $bdd = NULL ;
      header('Location: index.php') ;
  }
  
  /*On capture les exceptions si une exception est lancée et on affiche
  *les informations relatives à celle-ci*/
  catch(PDOException $e){
    echo "Erreur : " . $e->getMessage() ;
    die() ;
  }

  } elseif ( $_GET['action'] == 'ins' ) {

    try{
      $bdd = new PDO("mysql:host=$servername;dbname=pizzeria", $username, $password) ;
      //On définit le mode d'erreur de PDO sur Exception
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
      $bdd->query("SET NAMES utf8");

      $insert = $bdd->prepare("INSERT INTO produits (nom,prix_kg,allergene) VALUES ( :setNom , :setPrix , :setAllergene)") ;

      $insert->bindValue(':setNom',$_POST['nom'],PDO::PARAM_STR) ;
      $insert->bindValue(':setPrix',$_POST['prix_kg'],PDO::PARAM_STR) ;
      $insert->bindValue(':setAllergene',$_POST['allergene'],PDO::PARAM_BOOL) ;

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
      $bdd->query("SET NAMES utf8");

      $delete_ingredients = $bdd->prepare("DELETE FROM ingredients WHERE nom = :produit") ;
      $delete_produits = $bdd->prepare("DELETE FROM produits WHERE nom = :produit");

      $delete_ingredients->bindValue(':produit',$_GET['produit'],PDO::PARAM_STR) ;
      $delete_produits->bindValue(':produit',$_GET['produit'],PDO::PARAM_STR) ;

      $delete_ingredients->execute();
      $delete_produits->execute();

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
}