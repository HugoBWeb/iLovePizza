<form action="traitement.php?type=pizza&action=up&oldName=<?php echo $pizza ?>" method="post">

    <div>
        <label for="nom">Pizza</label>
        <input type="text" name="nom" id="nom" value="<?php echo $pizza ?>">
    </div>

    <div>
        <label for="prix_vente">Prix de vente</label>
        <input type="number" name="prix_vente" id="prix_vente" min="0" max="99.99" step="0.01" value='<?php echo $prix ?>' >
    </div>

    <div>
        <input type="number" name="note" id="note" min="0" max="5" step="1"  value='<?php echo $note ?>' >
        <label for="note">/5</label>
    </div>

    <div class="listeingredients">

        <div class="possede">
            
            <h2>Ingredients</h2>

            <?php foreach ($ingredients as $k => $i) {?>

            <div class="ingredient">
                <p><?php echo $i['nom'] ?></p>
                <input class="clickable" type="number" min="0" max="100" step="1" value="<?php echo $i['quantite'] ?>" name="ingredients[<?php echo $k ?>][quantite]">
                <input type="text" name="ingredients[<?php echo $k ?>][nom]" class="hidden" value='<?php echo $i['nom'] ?>'>
            </div>

            <?php } ?>
            
        </div>

        <div class="nonpossede">
            <h2>Ajouter un ingredient</h2>
            <?php foreach ($autres_ingredients as $i) {?>

            <div class="ingredient">
                <?php echo $i['nom'] ?>
            </div>

            <?php } ?>
        </div>

    </div>

    <div>
        <input type="submit" value="Mettre à jour">
    </div>
    
</form>

<script src="js/ingredients.js"></script>