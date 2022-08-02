var settings_menu = document.querySelector(".settings-menu");

// For the Create Post Pop-up for Desktop
var clickInput = document.querySelector(".input-btn");
var inputFocus = document.querySelector(".new-post-input textarea");
var flex = document.querySelector(".flex");
var closes = document.querySelector(".close-function");


function settings_menu_toggle(){
    settings_menu.classList.toggle("settings-menu-height")
}

clickInput.onclick = ()=>{
    flex.style.display = "block";
    inputFocus.focus();
}

closes.onclick = ()=>{
    flex.style.display = "none";
}
