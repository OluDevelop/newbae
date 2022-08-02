let textHeight2 = document.querySelector(".focusHere");
let textHeight = document.querySelector(".focusHere2");
let posterImg = document.querySelector(".user-profile-page-actions-comment");

function heightS(){
    textHeight2.style.height = "4rem";
}


// --------------- Show Less and More Function For Mobile Screen ------------------------
let showMores = document.getElementById("more");

function showMore(){
    
    showMores.style.display = "block";
    var showMoreBtn = document.getElementById("showMore").style.display = "none";
    var hideBtn = document.getElementById("hideBtn").style.display = "block";
}

function showLess(){
    showMores.style.display = "none";
    var showMoreBtn = document.getElementById("showMore").style.display = "block";
    var hideBtn = document.getElementById("hideBtn").style.display = "none";
}




// ---------------Show Less and More Function For Desktop Screen ------------------------
let showMores2 = document.getElementById("more2");

function showMore2(){
    
    showMores2.style.display = "block";
    var showMoreBtn2 = document.getElementById("showMore2").style.display = "none";
    var hideBtn2 = document.getElementById("hideBtn2").style.display = "block";
}

function showLess2(){
    showMores2.style.display = "none";
    var showMoreBtn2 = document.getElementById("showMore2").style.display = "block";
    var hideBtn2 = document.getElementById("hideBtn2").style.display = "none";
}


