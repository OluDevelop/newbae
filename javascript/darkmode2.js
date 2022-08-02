// Dark Mode and Light Mode Swtich 
var darkModeSwitch2 = document.querySelector("#dark-btn2");

// Dark Mode for For Mobile
if(localStorage.getItem("theme") == "light"){
    darkModeSwitch2.classList.remove("clicked");
    document.body.classList.remove("dark-mode-color");
}
else if(localStorage.getItem("theme") == "dark"){
    darkModeSwitch2.classList.add("clicked");
    document.body.classList.add("dark-mode-color");
}
else{
    localStorage.setItem("theme", "light"); 
}

darkModeSwitch2.onclick = ()=>{
    darkModeSwitch2.classList.toggle("clicked");
    document.body.classList.toggle("dark-mode-color");

    if(localStorage.getItem("theme") == "light"){
        localStorage.setItem("theme", "dark");
    }
    else if(localStorage.getItem("theme") == "dark"){
        localStorage.setItem("theme", "light");
    }
}

// End of Dark Mode and Light Mode Swtich




