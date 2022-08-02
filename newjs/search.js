const searchInput = document.querySelector('.mobile-message-search input');
const searchInput2 = document.querySelector('.mobile-message-search2 input');
const userAllLists = document.querySelector(".mobile-message");
const searchPage = document.querySelector(".mobile-search-page-pop-up");
const msgRequest = document.querySelector(".mobile-search-page-pop-up-msg-request");
const searchResult = document.querySelector(".mobile-search-result");


searchInput2.onclick = ()=>{
    searchPage.style.display = "block";
    searchInput.focus();
}

function closes(){
    searchPage.style.display = "none";
}

function msgReq(){
    msgRequest.style.display = "block";
}


function closed(){
    msgRequest.style.display = "none";
}


searchInput.onkeyup = ()=>{
    
    let searchTerm = searchInput.value;
    // Start Ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../servescrip/search.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                searchResult.innerHTML = data;
                if(searchInput.value === ""){
                    searchResult.innerHTML = "";
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}