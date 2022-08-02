const acceptBtn = document.querySelector(".acceptBtn").value;

let countFollowers = document.querySelector(".followers_class");

function acceptRequest(){
    
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "../profile/accept_request.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                alert(data);
            }
        }
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("sender_id="+acceptBtn);

}


countFollowers.onclick = ()=>{
    alert("Good");
}

// setInterval(() => {
    
//     let xhr = new XMLHttpRequest();

//     xhr.open("POST", "../profile/count_followers.php", true);
//     xhr.onload = ()=>{
//         if(xhr.readyState === XMLHttpRequest.DONE){
//             if(xhr.status === 200){
//                 let data = xhr.response;
//                 countFollowers.innerHTML = "hhhhs";
//             }
//         }
//     }

//     xhr.send();

// }, 500);