const picBtn = document.querySelector(".edit-profile-pic");
const popUp = document.querySelector(".mobile-profile-pic-update-modal");
const subBtn = document.querySelector(".subInput");
const inputBtn = document.querySelector(".img-input");
const inputBtn2 = document.querySelector(".img-input2");



inputBtn.onclick = ()=>{
    if(inputBtn.value != ""){
        subBtn.style.background = "#31A24C";
    }else{
        subBtn.style.background = "";
    }
}

inputBtn2.onclick = ()=>{
    if(inputBtn2.value != ""){
        subBtn.style.background = "#31A24C";
    }else{
        subBtn.style.background = "";
    }
}

picBtn.onclick = ()=>{
    popUp.classList.toggle("mobile-profile-pic-update-modal-click");
}