<?php 
  function getMonth($month_int){
    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 
    'September', 'October', 'November', 'December'];

    define("trueMonth", $month_int-1);
    return $months[trueMonth];
  }
  
  function convertDate($date = null){
    global $newString;
    $char_array = str_split($date);
    $newString = "";
    
    if($char_array){
      for($k=0; $k < strlen($date); $k++)
        if($char_array[$k] == "0" & $k < first_five){
          continue;
        }else{
          $newString = $newString . $char_array[$k];
        }
    }
    $newString = preg_split("/\//", $newString);
    return (getMonth($newString[0]) . " " . $newString[1] . ", " . $newString[2]);
  }

  function camel_case($str){
    $newString = "";

    for($i = 0; $i < strlen($str); $i++){
      if($i == 0){ $newString .= strtoupper($str[0]); continue;}
      $newString .= strtolower($str[$i]);
    }

    return $newString;
  }
?>