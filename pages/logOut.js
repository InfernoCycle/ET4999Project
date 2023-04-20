function logout(e){
  localStorage.setItem("logged_in", JSON.stringify(false));
  window.location.reload();
}