var likeBtn = document.querySelector(".like_icon");
var like_count = document.querySelector(".like_count");

var post_id = document.querySelector(".post_id");
var session_id = document.querySelector(".session_id");

post_num = post_id.value;
session_num = session_id.value;


// Check if this user has already liked this post
onload = ()=> {
    // Start Ajax
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "../baechat/posts/check_process.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == 'true'){
                    likeBtn.classList.toggle("feed-span_span_color_change");
                }
            }
        }
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("post_id="+post_num);
}




// Allow Users to Like the Post
likeBtn.onclick = ()=>{

    // Start Ajax
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "../baechat/posts/react_process.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                
            }
        }
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("post_id="+post_num);

    likeBtn.classList.toggle("feed-span_span_color_change");
}


// Get the number of post like
setInterval(() => {
    
    // Start Ajax
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "../baechat/posts/count_likes.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                like_count.innerHTML = data;
            }
        }
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("post_id="+post_num);

}, 200);

