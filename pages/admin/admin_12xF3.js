function box_out_body(e){
  const modal = document.getElementsByClassName("modal_cont")[0];
  modal.style.display = "block";
  
  const body = document.getElementsByTagName("body")[0];

  // //Credit to stack user: Samuli Hakoniemi
  //Link: https://stackoverflow.com/questions/45607982/how-to-disable-background-when-modal-window-pops-up
  body.style.pointerEvents = "none";
  modal.style.pointerEvents = "auto";

  const children = body.children;

  for(let i = 0; i < children.length; i++){
    if(children[i] === modal){
      children[i].style.opacity="1";
    }else{
      children[i].style.opacity="0.1";
    }
  }
}

function close_modal(e){
  const modal = document.getElementsByClassName("modal_cont")[0];
  modal.style.display = "none";
  
  const body = document.getElementsByTagName("body")[0];

  const children = body.children;

  for(let i = 0; i < children.length; i++){
    if(children[i] === modal){
      children[i].style.opacity="1";
    }else{
      children[i].style.opacity="1";
    }
  }

  body.style.pointerEvents = "auto";
}

function box_out_body_cancelModal(e){
  const innerModal = document.getElementById("cancel_modal2");
  innerModal.style.display = "block";
  
  const body = document.getElementsByTagName("body")[0];

  // //Credit to stack user: Samuli Hakoniemi
  //Link: https://stackoverflow.com/questions/45607982/how-to-disable-background-when-modal-window-pops-up
  body.style.pointerEvents = "none";
  innerModal.style.pointerEvents = "auto";

  const children = body.children;

  for(let i = 0; i < children.length; i++){
    if(children[i] === innerModal){
      children[i].style.opacity="1";
    }else{
      children[i].style.opacity="0.1";
    }
  }
}

function close_cancel_modal(e){
  const modal = document.getElementById("cancel_modal2");
  modal.style.display = "none";
  
  /*const body = document.getElementsByTagName("body")[0];

  const children = body.children;

  for(let i = 0; i < children.length; i++){
    if(children[i] === modal){
      children[i].style.opacity="1";
    }else{
      children[i].style.opacity="1";
    }
  }

  body.style.pointerEvents = "auto";*/

  window.location.reload();
}

$(document).ready(function(){
  $(".exit_button").on("click", function(e){
    close_modal(e);
  });
//block
  $("#accept_rsv_btn").on("click", function(e){
    const modal = document.getElementsByClassName("modal_cont")[0];
    modal.style.pointerEvents = "none";

    const cancel_modal = document.getElementById("cancel_modal1");
    cancel_modal.style.display="block";
    cancel_modal.style.pointerEvents = "auto";
  })

  $(".ok_close_emp_modal").on("click", function(e){
    const cancel_modal = document.getElementById("cancel_modal1");
    cancel_modal.style.display="none";

    const modal = document.getElementsByClassName("modal_cont")[0];
    modal.style.pointerEvents = "auto";
  });

  $(".supplement_ok_close").on("click", function(e){
    close_cancel_modal();
  });
})