let countFollowers = document.querySelector(".followers_class");
let profile_id = document.querySelector(".profile_id");


setInterval(() => {
    
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "../profile/count_followers.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                countFollowers.innerHTML = data;
            }
        }
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("profile_id="+profile_id.value);

}, 500);