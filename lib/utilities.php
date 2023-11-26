<?php 
  function getMonth($month_int){
    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 
    'September', 'October', 'November', 'December'];
    
    $month = $month_int-1;
    //define("trueMonth", $month_int-1);
    return $months[$month];
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

  function get_table_id($table_type){
    $table_id = null;
    
    switch($table_type){
      case "Single Seat":
        $table_id = 1;
        break;
      case 'Table of 2':
        $table_id = 2;
        break;
      case 'Table of 4':
        $table_id = 3;
        break;
      case 'Table of 6':
        $table_id = 4;
        break;
      case 'Table of 10':
        $table_id = 5;
        break;
      default:
        $table_id = 1;
    }

    return $table_id;
  }

  function get_table_by_id($id){
    $table_type = null;
    
    switch($id){
      case 1:
        $table_type = "Single Seat";
        break;
      case 2:
        $table_type = 'Table of 2';
        break;
      case 3:
        $table_type = 'Table of 4';
        break;
      case 4:
        $table_type = 'Table of 6';
        break;
      case 5:
        $table_type = 'Table of 10';
        break;
      default:
        $table_type = 1;
    }
    return $table_type;
  }
?>