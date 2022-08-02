var notification = document.querySelector(".notifications");
const notification_open = document.getElementById("notification_open");


function openNotification(){
    alert("Good");
}

function notification_toggle(){
    notification.classList.toggle("notifications-hide");
}

function notification_close(){
    notification.classList.remove("notifications-hide");
}

