// Dark Mode and Light Mode Swtich 
var darkModeSwitch = document.querySelector("#dark-btn");



if(localStorage.getItem("theme") == "light"){
    darkModeSwitch.classList.remove("clicked");
    document.body.classList.remove("dark-mode-color");
}
else if(localStorage.getItem("theme") == "dark"){
    darkModeSwitch.classList.add("clicked");
    document.body.classList.add("dark-mode-color");
}
else{
    localStorage.setItem("theme", "light"); 
}


darkModeSwitch.onclick = ()=>{
    darkModeSwitch.classList.toggle("clicked");
    document.body.classList.toggle("dark-mode-color");

    if(localStorage.getItem("theme") == "light"){
        localStorage.setItem("theme", "dark");
    }
    else if(localStorage.getItem("theme") == "dark"){
        localStorage.setItem("theme", "light");
    }

}
// End of Dark Mode and Light Mode Swtich
