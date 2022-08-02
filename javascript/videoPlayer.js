


function playBtn(){
    let playBtn = document.querySelector(".uploadVid");
    playBtn.play();

    let playImage = document.querySelector(".playImage");
    playImage.style.display = "none";
    
}

function pauseBtn(){
    let pausePlay = document.querySelector(".uploadVid");
    pausePlay.pause();

    let imageVid = document.querySelector(".playImage");
    imageVid.style.display = "block";
}