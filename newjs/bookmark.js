
var saveIconVal = document.querySelector(".post_id_bookmark");
var saveIcon = document.querySelector(".saveIcon");

window.onload = ()=>{
    let post_id = document.querySelector(".post_id_bookmark").value;

    let post_ida = ''
        + 'post_id=' +window.encodeURIComponent(post_id);
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "bookmarks/process_req.php", true)

    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                
            }
        }
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(post_ida);
}


// Send the Clicked Post To the Users Bookmark with Ajax
function post_id(post_id){
    
    var post_ids = post_id;
    
    let post_ida = ''
        + 'post_id=' +window.encodeURIComponent(post_ids);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "bookmarks/process_req.php", true);

    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "0"){
                    alert("Post saved already!");
                }
            }
        }
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(post_ida);

}