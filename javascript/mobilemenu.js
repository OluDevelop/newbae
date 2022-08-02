// Mobile Menu 

var mobileMenu = document.querySelector(".mobile-menu");
var mobileMenuBtn = document.querySelector(".mobile-menu-open");
var mobileMenuCloseBtn = document.querySelector(".mobile-menu-close-btn");

mobileMenuBtn.onclick = ()=>{
    mobileMenu.classList.toggle("mobile-menu-height");
}

mobileMenuCloseBtn.onclick = ()=>{
    mobileMenu.classList.remove("mobile-menu-height");
}