const form = document.querySelector(".mobile-message-input"),
inputField = form.querySelector(".mobile-message-input-input"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".mobile-chat-box");



form.onsubmit = (e)=>{
    e.preventDefault();
}


sendBtn.onclick = ()=>{
    // Start Ajax for Instering Chat into DB
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../servescrip/chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = ""; // Clear the input field after the Data is inserted into the db
                scrollToBottom();
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}




// Scroll Chat to Bottom Automatically
function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}





// Stop Ajax from Refreshing when user scrolls the chatbox
chatBox.ontouchmove = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}





setInterval(() => {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../servescrip/get_chat.php", true);

    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "block"){
                    chatBox.innerHTML ="<p style='margin-top: 6rem; padding: 2rem; text-align: center'>You are not a friend with this user Click on the user's name above to send a friend request to this user</p>";;
                }else{
                    chatBox.innerHTML = data;
                }
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}, 500);