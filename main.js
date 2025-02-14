

const urlParams = new URLSearchParams(window.location.search);

const register_status = urlParams.get('regSts');
console.log(register_status);

if(register_status == "err"){
    document.getElementById("register_message").innerHTML = "<span class='text-danger'> Registration not successfully ! </span>";
}
if(register_status == "success"){
    document.getElementById("register_message").innerHTML = "<span class='text-success'> Registration  successfully ! </span>";

    setTimeout(()=>{
        window.location.href = "./index.html";
    } , 6000)
}
if(register_status == "errComfirmPassw"){
    document.getElementById("register_message").innerHTML = "<span class='text-danger'> Password and confirm password does not match ! </span>";
}



const login_status = urlParams.get('logSts');
console.log(login_status);
if(login_status == "err"){
    document.getElementById("login_messege").innerHTML = "<span class='text-danger'> Sign In not successfully ! </span>";
}



function getCookie(name) {
    const cookieString = document.cookie;
    const cookies = cookieString.split(';');
    for (let i = 0; i < cookies.length; i++) {
      const cookie = cookies[i].trim();
      const [cookieName, cookieValue] = cookie.split('=');
      if (cookieName === name) {
        return cookieValue;
      }
    }
    return null;
  }
  
  const loginStatus = getCookie('loginStatus');
  

  if(loginStatus == "ok"){
    document.getElementById("loginButton").style.display = "none";
    document.getElementById("logoutButton").style.display = "block";

  }

  
  function deleteCookie() {
    document.cookie = `${'loginStatus'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
    document.getElementById("loginButton").style.display = "block";
    document.getElementById("logoutButton").style.display = "none";
  }

  function deleteCookie2() {
    document.cookie = `${'isAdmin'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
    window.location.href = "./index.html";
  }
  
  //deleteCookie('username');
  
  

