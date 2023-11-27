let inputs = document.getElementsByTagName("input");
var submittable_time = false;
var submittable_date = false;
const MinTimeDistance = -(60*10); // the difference a reservation time can be submitted. in this case it's 10 mins
var TimeWidth = 0;

let currentYear = new Date().getFullYear().toString();

//You can enter default date closures for your store
//Format: ["m/mm", "d/dd", "yyyy"]
//Note: do not add leading 0's
var closures = [
  ["1","1","2024"],
  ["12","25","2024"],
  ["10", "29", currentYear], //recommended to hand type the year
];

function valid_time(){
  console.log("");
}

$( function() {
    $( "#datepicker" ).datepicker();
  } );

  function ltrim(cut, string){
    let copy = string;
    if(string.charAt(0) == cut){
      copy = string.substring(1, string.length);
    }
    return copy;
  }

$(document).ready(function(){
  const date = new Date();
  if(date.getDay() != 0){
    //console.log(new Date())
    let beginningTime = "08:45";
    let endTime = "10:00";

    $(".timepicker").timepicker({
      scrollbar: true,
      timeFormat: 'hh:mm p',
      minTime: '8:45 AM', // 11:45:00 AM,
      maxTime: '10:00 PM',
      maxMinutes: 30,
      dynamic:false,
      change: function(e){
        const date_value = document.getElementsByName("date");
        if(date_value[0].value != "" && submittable_date){
          let currentTime = new Date();
          let value = document.getElementById("datepicker").value;
          let userPickArray = splitStrings(value);

          let picked_time = new Date(userPickArray[2], userPickArray[0]-1, userPickArray[1], e.getHours(), e.getMinutes(), e.getSeconds())
          console.log(currentTime.getTime());
          console.log(picked_time.getTime());
          let difference_in_minutes = ((currentTime - picked_time)/1000)/60;
          let difference_in_hours = difference_in_minutes/60;
          console.log(difference_in_minutes);
          console.log(difference_in_hours);

          let error = document.getElementsByClassName("space")[4];

          if(difference_in_hours > -1){
            submittable_time = false;
            error.style.margin="0px";
            error.style.marginBottom="20px";
            error.innerHTML="Please choose a time at least a hour before the chosen time";
            return;
          }

          submittable_time = true;
          error.style.margin="0px";
          error.style.marginBottom="30px";
          error.innerHTML="";
          valid_date();

          /*let day = inputs[3].value.split("/");
          let time =  inputs[4].value.split(" ");

          //console.log(time[0])
          let splitUserTime = time[0].split(":");//0 is hour, 1 is minute
          splitUserTime[0] = ltrim('0', splitUserTime[0]);
          let prefix = time[1];

          //console.log(time[0])
          splitUserTime[2] = "00";
          if(prefix == "PM" && Number.parseInt(splitUserTime[0]) != 12){
            splitUserTime[0] = (Number.parseInt(splitUserTime[0]) + 12) + ":00";
            if(Number.parseInt(splitUserTime[0]) < 10){
              splitUserTime[0] = "0" + (Number.parseInt(splitUserTime[0]) + 12).toString() + ":00";
            }
          }
          else if(prefix == "PM" && splitUserTime[0] == 12){
            splitUserTime[0] = "12";
          }
          if(prefix == "AM" && splitUserTime[0] != 12){
            splitUserTime[0] = time[0];
          }
          else if(prefix == "AM" && splitUserTime[0] == 12){
            splitUserTime[0] = "00";
          }
          let formattedUserPick = day[2] + "-" + day[0] + "-" + day[1]
          + "T" + splitUserTime[0].toString() + ":00.000-04:00";
          
          let userDate = new Date(Date.parse(formattedUserPick));
          
          //this variable says that if user comes within 10 mins before reservation then they cannot choose it.
          const MinTimeDistance = -(60*10); //10 mins

          TimeWidth = (currentTime.getTime()/1000) - (userDate.getTime()/1000)
          /*console.log(TimeWidth);
          console.log(userDate/1000)
          console.log(currentTime/1000);*/

          /*let error = document.getElementsByClassName("space")[4];
          if(TimeWidth > MinTimeDistance){
            submittable_time = false;
            error.style.margin="0px";
            error.style.marginBottom="20px";
            error.innerHTML="Too Late for this time please choose a new time or day.";
          }else{
            submittable_time = true;
            error.style.margin="0px";
            error.style.marginBottom="30px";
            error.innerHTML="";
            valid_date();
          }*/
          //console.log(splitUserTime);
        }else{
          let error = document.getElementsByClassName("space")[4];
          submittable_time = false;
          error.style.margin="0px";
          error.style.marginBottom="20px";
          error.innerHTML="Please choose a date first";
          console.log("error checkpoint at timepicker if");
        };
        
      },
      interval: 15 // 15 minutes
    });
  }
  else{
    $(".timepicker").timepicker({
      scrollbar: true,
      timeFormat: 'hh:mm p',
      minTime: '11:00 AM', // 11:45:00 AM,
      maxTime: '8:30 PM',
      maxMinutes: 30,
      
      interval: 15, // 15 minutes
      change: function(e){
        const date_value = document.getElementsByName("date");
        if(date_value[0].value != "" && submittable_date){
          let currentTime = new Date();
          let value = document.getElementById("datepicker").value;
          let userPickArray = splitStrings(value);

          let picked_time = new Date(userPickArray[2], userPickArray[0]-1, userPickArray[1], e.getHours(), e.getMinutes(), e.getSeconds())
          //console.log(currentTime.getTime());
          //console.log(picked_time.getTime());
          let difference_in_minutes = ((currentTime - picked_time)/1000)/60;
          let difference_in_hours = difference_in_minutes/60;
          //console.log(difference_in_minutes);
          //console.log(difference_in_hours);

          let error = document.getElementsByClassName("space")[4];

          if(difference_in_hours > -1){
            submittable_time = false;
            error.style.margin="0px";
            error.style.marginBottom="20px";
            error.innerHTML="Please choose a time at least a hour before the chosen time";
            return;
          }

          submittable_time = true;
          error.style.margin="0px";
          error.style.marginBottom="30px";
          error.innerHTML="";
          valid_date();
        }else{
          let error = document.getElementsByClassName("space")[4];
          submittable_time = false;
          error.style.margin="0px";
          error.style.marginBottom="20px";
          error.innerHTML="Please choose a date first";
        };
      }
    });
  }
})

function splitStrings(value){
  char_array = value.split('');
    newString = "";
    
    if(char_array.length != 0){
      for(let k=0; k < value.length; k++)
        if(char_array[k] == "0" && (k == 0 || k == 3)){
          continue;
        }else{
          newString = newString + char_array[k];
        }
    }
    newString = newString.split("/");
  return newString;
}

function valid_date(e){
  let value = document.getElementById("datepicker").value;
  let userPickArray = splitStrings(value);
  let error = document.getElementsByClassName("space")[3];
  
  //console.log(error)
  //indexes
  //0 = month, 1 = day, 2 = year
  let date = new Date();

  //first check if value is equal to a closed date
  for(let i = 0; i < closures.length; i++){
    if(JSON.stringify(userPickArray) == JSON.stringify(closures[i])){
      error.style.margin="0px";
      error.style.marginBottom="20px";
      error.innerHTML="We are closed on this date";
      submittable_date = false;
      return;
    }
  }

  if(Number.parseInt(userPickArray[2]) < date.getFullYear()){
    error.style.margin="0px";
    error.style.marginBottom="20px";
    error.innerHTML="Cannot choose a year before " + date.getFullYear().toString();
    submittable_date = false;
    return;
  }
  if(Number.parseInt(userPickArray[2]) > date.getFullYear()){
    error.style.margin="0px";
    error.style.marginBottom="20px";
    error.innerHTML="Cannot choose a year before " + date.getFullYear().toString();
    submittable_date = true;
    return;
  }
  //console.log(date.getFullYear())
  //if user's chosen month number (1-12) is less than current month (1-12 cause i add 1 since in JS months start at 0)
  else if(Number.parseInt(userPickArray[0]) < date.getMonth()+1 ){
    error.style.margin="0px";
    error.style.marginBottom="20px";
    error.innerHTML="Cannot choose a date before today."
    submittable_date = false;
    return;
  }
  //else if current month is greater than or equal to user's chosen month
  else if(date.getMonth()+1 >= Number.parseInt(userPickArray[0])){
    //if user chosen day is less than current day
    if(Number.parseInt(userPickArray[1]) < date.getDate()){
      //console.log(Number.parseInt(userPickArray[1]), date.getDate());
      error.style.margin="0px";
      error.style.marginBottom="20px";
      error.innerHTML="Cannot choose a date before today."
      submittable_date = false;
      //console.log("legal not")
      //console.log("Cannot choose a date before today2.");
      return;
    }else{
      error.style.margin="0px";
      error.style.marginBottom="30px";
      error.innerHTML=""
      console.log("legal")
      submittable_date = true;
      return;
    }
  }
  else{
    submittable_date = true;
    error.innerHTML="";
    //console.log("bruh");
    return;
  }
  //console.log(new Date())
    
  console.log(splitStrings(value));
}

function submission(e){
  let form = document.getElementById("reserve_form");
  let inputs = document.getElementsByTagName("input");
  let fn = inputs.namedItem("fn").value;
  let ln = inputs.namedItem("ln").value;
  let email = inputs.namedItem("email").value;

  console.log(submittable_time, submittable_date);
  if(submittable_time && submittable_date && (fn!="" && ln!="" && email!="")){
    /*let error = document.getElementsByClassName("space")[4];
        if(TimeWidth > MinTimeDistance){
          submittable_time = false;
          error.style.margin="0px";
          error.style.marginBottom="20px";
          error.innerHTML="Too Late for this time please choose a new time or day.";
          return;
        }else{
          submittable_time = true;
          error.style.margin="0px";
          error.style.marginBottom="30px";
          error.innerHTML="";
          valid_date();
        }
        console.log(TimeWidth, MinTimeDistance)*/
    form.submit();
  }
}


/* Everything here pertains to status page */
$(document).ready(function(){
  $("#status_submit").click((e)=>{
    //define and declare the variables
    let form = document.getElementById("status_form");
    let status_fieldset = document.getElementById("status_fieldset").getElementsByTagName("input");
    let error_msg = document.getElementById("error_log");
    error_msg.style.display="none";
    error_msg.innerText = "";

    //check if any of the input fields are empty
    for(let i = 0; i < status_fieldset.length; i++){
      if(status_fieldset[i].value.trim() == ""){
        console.log("empty field detected")
        error_msg.style.display="block";
        error_msg.innerText = "Cannot have empty fields.";
        return;
      }
      if(status_fieldset[i].name == "unique_code"){
        if(Number.isNaN(Number(status_fieldset[i].value))){
          console.log("Error with unique Code");
          error_msg.style.display="block";
          error_msg.innerText = "Invalid Confirmation Code.";
          return;
        }
      }
    }
    
    //submit the form if everything is not empty
    form.submit();
  })
})

var interval = null;
var count = 15;
function timer(){
  interval = setInterval(timer_handler, 1000)
}

function timer_handler(){
  if(count == 0){
    clearInterval(interval);
    window.location.replace("../index.html");
  }
  document.getElementById("count_down").innerText = count.toString();
  count-=1;
}

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

$(document).ready(function(){
  $(".exit_button").on("click", function(e){
    clearInterval(interval);
    close_modal(e);
  });
//block
  $("#cancel_rsv_btn").on("click", function(e){
    const cancel_modal = document.getElementById("cancel_modal");
    cancel_modal.style.display="block";
  })

  $("#decline_cancel").on("click", function(e){
    const cancel_modal = document.getElementById("cancel_modal");
    cancel_modal.style.display="none";
  });
})