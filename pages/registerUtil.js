const form = document.getElementById("reserve_form");
const inputs = document.getElementsByTagName("input");
const errors = document.getElementsByClassName("space");

function login(){
  let lock = [0,0,0];
  if(inputs[0].value != ""){
    localStorage.setItem("user", inputs[0].value);
    lock[0] = 1;
  }
  if(inputs[1].value != ""){
    lock[1] = 1;
  }
  if(inputs[0].value != ""){
    localStorage.setItem("pass", inputs[2].value);
    lock[2] = 1;
  }
  if(lock[0] == 1 && lock[1] == 1 && lock[2] == 1){
    localStorage.setItem("logged_in", JSON.stringify(true));
    //form.submit();
    //window.location.replace("../index.html");
  }
}