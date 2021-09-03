<?php
    $optStyle = ['update'] ;
    include_once "header.php" 
?>

<main>
    <form action="traitement.php?action=ins" method="post">
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
        <div>
            <input type="submit" value="Ajouter">
        </div>
    </form>

</main>

<script src="js/validForm.js"></script>

<?php include_once 'footer.php' ?>