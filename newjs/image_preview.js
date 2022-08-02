const imgUpload = document.querySelector(".up");
const preview_images = document.querySelector(".preview_images img");
const preview_image_desk = document.getElementById("deskPrev img");
const uploadFile = document.getElementById("uploadFile");
const clearImg = document.getElementById("clearImg");
const removeArt = document.getElementById("imageFile");

const prevDiv = document.querySelector(".preview_images_desk img");

let preTag = document.getElementById("files-ip-1-preview");

imgUpload.onclick = ()=>{
    preview_images.style.display = "block";
}

// Show image Preview
function showPreview(event) {
    
    if(event.target.files.length > 0){
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("files-ip-1-preview");
        preview.src = src;
        preview.style.display = "block";
        clearImg.style.display = "block";
    }
    
}

// Clear Text
clearImg.onclick = ()=>{
    prevDiv.style.display = "none";
    clearImg.style.display = "none";
    document.getElementById("files-ip-1-preview").src = '';
    uploadFile.removeAttribute('name');
}


function clearImgName(){
    pivTheDiv = document.querySelector(".preview_images_desk img");
    pivTheDiv.style.display = "none";
    
    imgClear = document.getElementById("clearImg");
    imgClear.style.display = "none";

    source = document.getElementById("files-ip-1-preview");
    source.scr = '';


    removeAttri = document.getElementById("imageFile");
    removeAttri.removeAttribute('name');
}