const form = document.getElementById("reserve_form");
const inputs = document.getElementsByTagName("input");
const errors = document.getElementsByClassName("space");

const login = (e) =>{
  let lock = [0, 0];
  if(inputs[0].value != ""){
    if(inputs[0].value == localStorage.getItem("user")){
      //localStorage.setItem("user", inputs[0].value.toString())
      lock[0] = 1;
    }
  }
  if(inputs[1].value != ""){
    if(inputs[1].value == localStorage.getItem("pass")){
      //localStorage.setItem("pass", inputs[1].value);
      lock[1] = 1;
    }
  }
  if(lock[0] == 1 & lock[1] == 1){
    localStorage.setItem("logged_in", JSON.stringify(true));
    window.location.replace("../index.html");
  }
  else{
    errors[2].innerHTML = "No Such Login"
    errors[2].style.color = "red";
    console.log("No such Login");
  }
}