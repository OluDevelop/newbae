var love_react_form = document.getElementById("love_react_form");
var like_count_general = document.getElementById("like_count_general");


// Send Love Reaction to POST
function love_react_general_post(post_id){

    let the_post_id = post_id;
    let unique_id = document.getElementById("unique_id");

    let the_data = ''
        + 'post_id=' +window.encodeURIComponent(the_post_id);
        // + 'session_id=' +window.encodeURIComponent(unique_id);

    // Send post id to ajax
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
    xhr.send(the_data);
}


// Count Love Reaction From Post