const notifications = document.querySelector(".notifications");

function openNotification(){
    if(notifications.style.display == "block"){
        notifications.style.display = "none";
    }else{
        notifications.style.display = "block";
    }
}