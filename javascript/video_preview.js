var fileVid = document.getElementById("uploadFileVid");

function vidPrev(){
    
    document.getElementById("clearVid").style.display = "block";

}

function removeVid(){
    document.getElementById("clearVid").style.display = "none";
    fileVid.removeAttribute('name');
}