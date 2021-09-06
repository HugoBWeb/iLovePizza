const possede = document.querySelector('.possede')
const liste_possede = possede.querySelectorAll('.ingredient') ;

const non_possede = document.querySelector('.nonpossede') ;
const liste_non_possede = non_possede.querySelectorAll('.ingredient') ;

const get_key = e => {
    let debut = e.lastElementChild.name.substr(e.lastElementChild.name.indexOf('[')+1) ;
    let sub_str = debut.substr(0,debut.indexOf(']')) ;
    return Number(sub_str) ;
} ;

const key_dispo = [] ;

let key_max = liste_possede[liste_possede.length-1] ? get_key(liste_possede[liste_possede.length-1]) : 0 ;


[...liste_non_possede,...liste_possede].forEach( 
    e => e.addEventListener('click', c => {
        if ( c.target != e.querySelector('.clickable') ) {
            if ( e.parentElement == possede ) {

                possede.removeChild(e) ;
                non_possede.appendChild(e) ;
                key_dispo.push( get_key(e) ) ;
                e.innerHTML = e.querySelector('p').innerText ;

            } else {

                let key = key_dispo ? ++key_max : key_dispo.pop() ;

                non_possede.removeChild(e) ;
                possede.appendChild(e) ;
                let p = document.createElement('p') ;
                p.innerHTML = e.innerText ;
                let input_nom = document.createElement('input') ;
                input_nom.type = "text" ;
                input_nom.name = `ingredients[${key}][nom]` ;
                input_nom.className = "hidden" ;
                input_nom.value = e.innerText ;
                let input_qte = document.createElement('input') ;
                input_qte.className = "clickable" ;
                input_qte.type = "number" ;
                input_qte.name = `ingredients[${key}][quantite]` ;
                input_qte.min = "0" ;
                input_qte.max = '999' ;
                input_qte.step = "1" ;
                input_qte.value = "0" ;
                e.innerHTML = "" ;
                e.appendChild(p) ;
                e.appendChild(input_qte) ;
                e.appendChild(input_nom) ;
                
            }
        }    
    })
)