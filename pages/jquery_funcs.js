let inputs = document.getElementsByTagName("input");
var submittable = false;
const MinTimeDistance = -(60*10);
var TimeWidth = 0;

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
          submittable = false;
          error.style.margin="0px";
          error.style.marginBottom="20px";
          error.innerHTML="Too Late for this time please choose a new time or day.";
        }else{
          submittable = true;
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
        if(char_array[k] == "0" && k < 4){
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
  if(Number.parseInt(userPickArray[2]) < date.getFullYear()){
    error.style.margin="0px";
    error.style.marginBottom="20px";
    error.innerHTML="Cannot choose a year before " + date.getFullYear().toString();
    submittable = false;
    return;
  }
  //console.log(date.getFullYear())
  else if(Number.parseInt(userPickArray[0]) < date.getMonth()+1 ){
    error.style.margin="0px";
    error.style.marginBottom="20px";
    error.innerHTML="Cannot choose a date before today."
    submittable = false;
    return;
  }
  else if(date.getMonth()+1 >= Number.parseInt(userPickArray[0])){
    if(Number.parseInt(userPickArray[1]) < date.getDate()){
      console.log(Number.parseInt(userPickArray[1]), date.getDate());
      error.style.margin="0px";
      error.style.marginBottom="20px";
      error.innerHTML="Cannot choose a date before today."
      submittable = false;
      //console.log("legal not")
      //console.log("Cannot choose a date before today2.");
      return;
    }else{
      error.style.margin="0px";
      error.style.marginBottom="30px";
      error.innerHTML=""
      //console.log("legal")
      submittable = true;
      return;
    }
  }
  else{
    submittable = true;
    error.innerHTML="";
    //console.log("bruh");
    return;
  }
  //console.log(new Date())
    
  console.log(splitStrings(value));
}

function submission(e){
  let form = document.getElementById("reserve_form");
  if(submittable){
    let error = document.getElementsByClassName("space")[4];
        if(TimeWidth > MinTimeDistance){
          submittable = false;
          error.style.margin="0px";
          error.style.marginBottom="20px";
          error.innerHTML="Too Late for this time please choose a new time or day.";
          return;
        }else{
          submittable = true;
          error.style.margin="0px";
          error.style.marginBottom="30px";
          error.innerHTML="";
          valid_date();
        }
    form.submit();
  }
}
