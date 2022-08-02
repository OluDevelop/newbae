const followBtnSpace = document.querySelector(".profile-action-btn");
let followAction = document.querySelector(".click");


function follow(){
    
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "../profile/send_request.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                
            }
        }
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("followed_id="+followed_id);

}