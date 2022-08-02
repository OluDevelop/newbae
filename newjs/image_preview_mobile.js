
// Image Preview for Mobile View
var captureImg = document.getElementById("imageFile"); // File Input (Capture)
var fileImg = document.getElementById("uploadFile"); // File Input
var imagePreview = document.querySelector(".preview_images img");
var clearRemoveText = document.getElementById("clearImg");


// Preview Functions
function showPreviewCam(event){
    if(event.target.files.length > 0){
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("files-ip-1-preview");
        preview.src = src;
        imagePreview.style.display = "block";
        clearRemoveText.style.display = "block"; // Display the Remove Text Button
    }
}


function showPreviewFile(event){
    if(event.target.files.length > 0){
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("files-ip-1-preview");
        preview.src = src;
        imagePreview.style.display = "block";
        clearRemoveText.style.display = "block"; // Display the Remove Text Button
    }
}

// Remove the Image and the Remove Text Button when the Remove Text button is Clicked
clearRemoveText.onclick = ()=>{
    clearRemoveText.style.display = "none";
    imagePreview.style.display = "none";
    document.getElementById("files-ip-1-preview").src = '';
    captureImg.removeAttribute('name');
    fileImg.removeAttribute('name');
}


