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
      maxTime: '11:00 PM',
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