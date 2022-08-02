const followed_id = document.querySelector(".followed_id").value;
let actionBtn = document.querySelector(".profile-action-btn");
let actionBtnDesk = document.querySelector(".profile-action-btn-desktop");




setInterval(() => {
    
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "../profile/follow_process.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                actionBtnDesk.innerHTML = data;
                actionBtn.innerHTML = data;
            }
        }
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("followed_id="+followed_id);
}, 500);