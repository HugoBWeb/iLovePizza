<?php
    $optStyle = ['update'] ;
    include_once "header.php" 
?>

<?php 
    $pizza = $_GET['nom'] ;
    $prix = $_GET['prix_vente'] ;
    $note = $_GET['note_consommateur'] ;
?>

<main>
    <form action="traitement.php?action=up&oldName=<?php echo $pizza ?>" method="post">
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
        <div>
            <input type="submit" value="Mettre à jour">
        </div>
    </form>

</main>

<script src="js/validForm.js"></script>

<?php include_once 'footer.php' ?>