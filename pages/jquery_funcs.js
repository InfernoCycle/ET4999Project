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
  ["10", "29", currentYear],
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
        let currentTime = new Date();
        let day = inputs[3].value.split("/");
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

        let error = document.getElementsByClassName("space")[4];
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
        }
        //console.log(splitUserTime);
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
      
      interval: 15 // 15 minutes
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

  if(submittable_time && submittable_date && (fn!="" && ln!="" && email!="")){
    let error = document.getElementsByClassName("space")[4];
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
        console.log(TimeWidth, MinTimeDistance)
    form.submit();
  }
}
