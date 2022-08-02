// Check for the Likes
let echo_like_btn = document.querySelector(".count_likes");

function postIdi(id){
    setInterval(() => {

        let postIds =  id;
        let postId = ''
        + 'post_id=' +window.encodeURIComponent(postIds);

        // List out the posts the user has liked
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "servescrip/love_reactions.php", true);

        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){

                    let data = xhr.response;

                }
            }
        }

        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(postId);

    }, 500);
}




// Add Likes

function postDrop(id){
    
    // Add Like to the post
    let new_post_id = id;

    let new_postId = ''
        + 'post_id=' +window.encodeURIComponent(new_post_id);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "servescrip/add_love_reactions.php", true);

    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){

                let data = xhr.response;

            }
        }
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(new_postId);

}