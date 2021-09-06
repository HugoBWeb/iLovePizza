<?php
    $optStyle = ['update'] ;
    require_once "header.php" 
?>

<?php 
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    
    try{
        $bdd = new PDO("mysql:host=$servername;dbname=pizzeria", $username, $password) ;
        //On définit le mode d'erreur de PDO sur Exception
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
        $bdd->query("SET NAMES utf8");

        if($_GET['type'] == 'pizza') {

            $info_pizza = $bdd->prepare("
                SELECT prix_vente,note_consommateur FROM pizzas WHERE nom LIKE :nom
            ") ;
            $info_ingredients = $bdd->prepare("
                SELECT * FROM ingredients WHERE nom_pizza LIKE :nom
            ") ;
            $info_autres_ingredients = $bdd->prepare("
                SELECT nom FROM produits WHERE nom NOT IN (SELECT nom FROM ingredients WHERE nom_pizza LIKE :nom) GROUP BY nom
            ") ;
            
            $pizza = str_replace('_',' ',$_GET['nom']) ;

            $info_pizza->bindValue(':nom',$pizza,PDO::PARAM_STR) ;
            $info_ingredients->bindValue(':nom',$pizza,PDO::PARAM_STR) ;
            $info_autres_ingredients->bindValue(':nom',$pizza,PDO::PARAM_STR) ;

            $info_pizza->execute();
            $info_ingredients->execute();
            $info_autres_ingredients->execute();

            $result = $info_pizza->fetchall(PDO::FETCH_ASSOC) ;
            $ingredients = $info_ingredients->fetchall(PDO::FETCH_ASSOC);
            $autres_ingredients = $info_autres_ingredients->fetchall(PDO::FETCH_ASSOC);
            $prix = $result[0]['prix_vente'] ;
            $note = $result[0]['note_consommateur'] ;

        } elseif ($_GET['type'] == 'produit') {

            $produit = str_replace('_',' ',$_GET['nom']) ;

            $info_produits = $bdd->prepare(
                "SELECT prix_kg , allergene FROM produits WHERE nom = :setNom"
            ) ;

            $info_produits->bindValue(':setNom',$produit,PDO::PARAM_STR) ;

            $info_produits->execute() ;

            $result = $info_produits->fetchall(PDO::FETCH_ASSOC) ;

            $prix = $result[0]['prix_kg'] ;
            $allergene = $result[0]['allergene'] ;

        }

        $bdd = NULL ;
    }
        
    /*On capture les exceptions si une exception est lancée et on affiche
     *les informations relatives à celle-ci*/
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage() ;
      die() ;
    }
?>

<main>

    <?php

    if ( $_GET['type'] == 'pizza' ) {
        require_once "form_pizza.php" ;
    } elseif ( $_GET['type'] == 'produit' ) {
        require_once "form_produit.php" ;
    }

    ?>

</main>


<script src="js/validForm.js"></script>

<?php require_once 'footer.php' ?>