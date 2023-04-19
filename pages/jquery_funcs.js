$( function() {
    $( "#datepicker" ).datepicker();
  } );

$(document).ready(function(){
  const date = new Date();
  if(date.getDay() != 0){
    $(".timepicker").timepicker({
      scrollbar: true,
      timeFormat: 'hh:mm p',
      minTime: '8:45 AM', // 11:45:00 AM,
      maxTime: '10:00 PM',
      maxMinutes: 30,
      
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

var submittable = false;

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
      error.style.marginBottom="40px";
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
    form.submit();
  }
}
