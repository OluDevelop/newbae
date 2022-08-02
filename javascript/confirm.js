var PopUp = document.querySelector(".friends-right-pop-up");

function launchPopUp(){
    PopUp.classList.toggle("friends-right-pop-up-click");
}

function cancel(){
    PopUp.classList.remove("friends-right-pop-up-click")
}