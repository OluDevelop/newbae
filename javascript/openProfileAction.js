var openProfile = document.querySelector(".user-profile-page-action");

function openProfileAction(){
    openProfile.classList.toggle("user-profile-page-action-click");
}

function closeProfile(){
    openProfile.classList.remove("user-profile-page-action-click");
}



// =================== For Desktop Profile Edit
var editPop = document.querySelector(".user-profile-edit-pop-up-bg");

function editPopUp(){
    editPop.style.display = "block";
} 

function closeEditPopUp(){
    editPop.style.display = "none";
}