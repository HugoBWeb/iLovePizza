document.querySelector('form').addEventListener('submit', e => {
    if (nom.value.lenght < 2) {
        e.preventDefault();
        alert('Nom de la pizza invalide !') ;
        return false
    }
    if (!prix_vente.value) {
        e.preventDefault();
        alert('Prix de vente invalide !') ;
        return false
    }
})

