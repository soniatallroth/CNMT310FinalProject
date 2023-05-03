// Get the modal
var addModal = document.getElementById("addModal");
var modalContent = document.querySelector(".modal-content");

// Get the button that opens the modal
var addBtn = document.getElementById("addBtn");

// Get the <span> element that closes the modal
var addModalClose = document.getElementById("addModal").getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
addBtn.onclick = function() {
  setTimeout(function() {
    modal.style.opacity = "1";
  }, 50);
  addModal.style.display = "block";
}

addModalClose.onclick = function() {
  addModal.style.display = "none";
}
  
// When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//   deleteModal.style.display = "none";
//   addModal.style.display = "none";
// }

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == addModal) {
      addModal.style.display = "none";
  }
}
