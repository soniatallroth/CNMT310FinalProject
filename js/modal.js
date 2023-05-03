// Get the modal
var addModal = document.getElementById("addModal");
var deleteModal = document.getElementById("deleteModal");
var modalContent = document.querySelector(".modal-content");

// Get the button that opens the modal
var addBtn = document.getElementById("addBtn");
var deleteBtn = document.getElementById("deleteBtn");

// Get the <span> element that closes the modal
var addModalClose = document.getElementById("addModal").getElementsByClassName("close")[0];
var deleteModalClose = document.getElementById("deleteModal").getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
addBtn.onclick = function() {
  setTimeout(function() {
    modal.style.opacity = "1";
  }, 50);
  addModal.style.display = "block";
}

deleteBtn.onclick = function() {
  setTimeout(function() {
    modal.style.opacity = "1";
  }, 50);
  deleteModal.style.display = "block";
}

addModalClose.onclick = function() {
  addModal.style.display = "none";
}
  
deleteModalClose.onclick = function() {
  deleteModal.style.display = "none";
}

// When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//   deleteModal.style.display = "none";
//   addModal.style.display = "none";
// }

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == addModal || event.target == deleteModal) {
      addModal.style.display = "none";
      deleteModal.style.display = "none";
  }
}
