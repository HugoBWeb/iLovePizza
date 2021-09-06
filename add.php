<?php
    $optStyle = ['update'] ;
    include_once "header.php" 
?>

<main>
    <?php if ( $_GET['type'] == 'pizza' ) { 
        
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        
        try{
            $bdd = new PDO("mysql:host=$servername;dbname=pizzeria", $username, $password) ;
            //On définit le mode d'erreur de PDO sur Exception
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
            $bdd->query("SET NAMES utf8");

            $affiche_ingredients = $bdd->prepare("SELECT * FROM produits") ;
            $affiche_ingredients->execute() ;

            $liste_ingredients = $affiche_ingredients->fetchall(PDO::FETCH_ASSOC) ;
    
            $bdd = NULL ;
        }
            
        /*On capture les exceptions si une exception est lancée et on affiche
         *les informations relatives à celle-ci*/
        catch(PDOException $e){
          echo "Erreur : " . $e->getMessage() ;
          die() ;
        }

    ?>
    <form action="traitement.php?type=pizza&action=ins" method="post">
        <div>
            <label for="nom">Pizza</label>
            <input required type="text" name="nom" id="nom">
        </div>
        <div>
            <label for="prix_vente">Prix de vente</label>
            <input required type="number" name="prix_vente" id="prix_vente" min="0" max="99.99" step="0.01">
        </div>
        <div>
            <input type="number" name="note" id="note" min="0" max="5" step="1">
            <label required for="note">/5</label>
        </div>
        <div class="listeingredients">

            <div class="possede">
                
                <h2>Ingredients</h2>
                
            </div>

            <div class="nonpossede">
                <h2>Ajouter un ingredient</h2>
                <?php foreach ($liste_ingredients as $i) {?>

                <div class="ingredient">
                    <?php echo $i['nom'] ?>
                </div>

                <?php } ?>
            </div>

        </div>
        <div>
            <input type="submit" value="Ajouter">
        </div>
    </form>

    <script src="js/ingredients.js"></script>

    <?php } elseif ( $_GET['type'] == 'produit' ) { ?>
        
        <form action="traitement.php?type=produit&action=ins" method="post">

            <div>
                <label for="nom">Produit</label>
                <input type="text" name="nom" id="nom">
            </div>

            <div>
                <label for="prix_kg">Prix au kg</label>
                <input type="number" name="prix_kg" id="prix_kg" min="0" max="99.99" step="0.01" value="0">
            </div>

            <div class="allergene">
                <p>Allergène :</p>
                <div>
                    <label for="ouiallergene">Oui</label>
                    <input type="radio" name="allergene" id="ouiallergene" value="1">
                    <label for="nonallergene">Non</label>
                    <input checked type="radio" name="allergene" id="nonallergene" value="0">
                </div>
            </div>

            <div>
                <input type="submit" value="Ajouter">
            </div>

        </form>
        
    <?php } ?>

</main>

<script src="js/validForm.js"></script>

<?php include_once 'footer.php' ?>