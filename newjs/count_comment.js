let num = document.getElementById("count");
const forms = document.querySelector(".count_comments");


setInterval(() => {
    // Count the number of comments on post
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "count_comments.php", true);

    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                num.innerHTML = data;
            }
        }
    }

    let formdata = new FormData(forms);
    xhr.send(formdata);
}, 500);