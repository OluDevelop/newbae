let ajaxBtn = document.querySelector(".ajax_submit");
let form = document.querySelector(".form_comment");
let formTextArea = document.querySelector(".form_comment textarea");
let post_page_height = document.querySelector(".user-profile-page-comments");

const scrollBottom = document.getElementById("scrollBottom");
const commentSection = document.getElementById("getComment");
const desktop_comment = document.getElementById("desktopComment");



form.onsubmit = (e)=>{
    e.preventDefault();
}

function scrollToBottom() {
    scrollBottom.scrollTop = scrollBottom.scrollHeight;
}


// Send Comments
ajaxBtn.onclick = ()=>{

    scrollBottom.classList.add("active");
    
    // Start Ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "send_comment.php", true);

    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(scrollBottom.classList.contains("active")){
                    scrollToBottom();
                }
                formTextArea.value = ""; // Clear the textarea
            }
        }
    }

    let formdata = new FormData(form);
    xhr.send(formdata);
}


// Fetch Comments
setInterval(() => {
    // Start Ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "get_comment.php", true);

    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                commentSection.innerHTML = data;
                desktop_comment.innerHTML = data;
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}, 500);


// Like Function Test
function likeIt(){
    alert("Good");
}
















