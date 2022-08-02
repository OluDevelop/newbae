const picView = document.querySelector(".user-profile-profile-top-details-photo");
const picCoverView = document.querySelector(".user-profile-profile-top-photo");
const pic = document.querySelector(".image_view_pop_up");
const picCover = document.querySelector(".image_view_pop_up_cover");

const hide = document.querySelector(".image_view_pop_up .hide");
const hide2 = document.querySelector(".image_view_pop_up_cover .hide");


picCoverView.onclick = ()=>{
    picCover.style.display = "block";
}


picView.onclick = ()=>{
    
    pic.style.display = "block";

}

hide2.onclick = ()=>{
    picCover.style.display = "none";
}

hide.onclick = ()=>{
    pic.style.display = "none";
}