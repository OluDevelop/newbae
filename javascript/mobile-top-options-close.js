var mobileTopOptions = document.querySelector(".mobile-top-options");
var off = document.querySelector(".mobile-top-options .off");


function openTopOption(){
    mobileTopOptions.classList.toggle("mobile-top-options-close");
    off.style.display = "none";
}

function closeTopOption(){
    mobileTopOptions.classList.toggle("mobile-top-options-close");
    off.style.display = "block";
}