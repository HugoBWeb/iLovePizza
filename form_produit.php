<form action="traitement.php?type=produit&action=up&oldName=<?php echo $produit ?>" method="post">

    <div>
        <label for="nom">Produit</label>
        <input type="text" name="nom" id="nom" value='<?php echo $produit ?>'>
    </div>

    <div>
        <label for="prix_kg">Prix au kg</label>
        <input type="number" name="prix_kg" id="prix_kg" min="0" max="99.99" step="0.01" value=<?php echo $prix ?>>
    </div>

    <div class="allergene">
        <p>Allergène :</p>
        <div>
            <label for="ouiallergene">Oui</label>
            <input <?php if ($allergene) {echo "checked";} ?> type="radio" name="allergene" id="ouiallergene" value="1">
            <label for="nonallergene">Non</label>
            <input <?php if (!$allergene) {echo "checked";} ?> type="radio" name="allergene" id="nonallergene" value="0">
        </div>
    </div>

    <div>
        <input type="submit" value="Mettre à jour">
    </div>

</form>