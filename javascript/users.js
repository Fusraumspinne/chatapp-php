const searchBar = document.querySelector(".users .search input"),
searchBtn = document.querySelector(".users .search button"),
usersList = document.querySelector(".users .users-list"),
settingsBtn = document.querySelector(".settings"),
usersBackBtn = document.querySelector(".usersBack"),
users = document.querySelector(".usersPanel"),
settings = document.querySelector(".settingsPanel");

searchBtn.onclick = ()=>{
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";
}

settingsBtn.onclick = ()=>{
    users.classList.toggle("disabled");
    settings.classList.toggle("disabled");
}

usersBackBtn.onclick = ()=>{
    users.classList.toggle("disabled");
    settings.classList.toggle("disabled");
}

searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;
    if(searchTerm != ""){
        searchBar.classList.add("active");
    }else{
        searchBar.classList.remove("active");
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/search.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/users.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            if(!searchBar.classList.contains("active")){
                usersList.innerHTML = data;
            }
          }
      }
    }
    xhr.send();
}, 10000);

window.onload = function() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/users.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            if(!searchBar.classList.contains("active")){
                usersList.innerHTML = data;
            }
          }
      }
    }
    xhr.send();
}
