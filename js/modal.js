// Get the modal
const modalList = [...document.getElementsByClassName("modal")];

// Get the button that opens the modal
const btnList = [...document.getElementsByClassName("del")];

// Get the <span> element that closes the modal
const spanList = [...document.getElementsByClassName("close")];

modalList.forEach( (m,i) => {
  // When the user clicks on the button, open the modal
  btnList[i].addEventListener('click',() => m.style.display = "block") ;
  // When the user clicks on <span> (x), close the modal
  spanList[i].addEventListener('click',() => m.style.display = "none") ;
  // When the user clicks anywhere outside of the modal, close it
  window.addEventListener('click',e => {
    if(e.target == m) {
      m.style.display = "none";
    }
  })
})