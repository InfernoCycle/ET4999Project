<?php 

  require_once '../pages/connect.php';
  require_once '../lib/email.php';

  $obj = new sql4();
  $obj->mysql_conn();

  date_default_timezone_set("America/Detroit");
  $current_time = time();

  //check if waiter confirmed registration. if not and 15 minutes passed then remove registration
  $result = $obj->any("SELECT user_id, is_in FROM users;");
  $res_array = mysqli_fetch_all($result);
  
  $delete_limit = -15; //minutes after reservation has gone unchecked
  $stay_limit = -90; //minutes after reservation and sit down time

  $count = 0;

  while($count < count($res_array)){
    //$res_array = mysqli_fetch_array($result);
    /*if($res_array == null){
      break;
    }*/
    $inner_res = mysqli_fetch_array($obj->any("SELECT reserved_time, reserved_date FROM reservations WHERE user_id={$res_array[$count][0]};"));
    if($inner_res == null){
      $count+=1;
      continue;
    }
    
    $formatted_date = explode("/", $inner_res["reserved_date"]);
    $month = $formatted_date[0];
    $day = $formatted_date[1];
    $year = $formatted_date[2];

    $formatted_timeP1 = explode(":", $inner_res["reserved_time"]);
    $formatted_timeP2 = explode(" ", $formatted_timeP1[1]); // index 1 is minutes, index 2 is abbreviation pm or am
    $hour = $formatted_timeP1[0];
    $minute = $formatted_timeP2[0];
    $abbreviation = $formatted_timeP2[1];

    //echo $hour . " " . $minute ."<br>";
    $date_format = "d-m-Y h:i:s a";
    $date_itself = $day."-".$month."-".$year." ".$hour.":".$minute.":00"." ".$abbreviation;

    $date = date_create_from_format("d-m-Y h:i:s a", $day."-".$month."-".$year." ".$hour.":".$minute.":00"." ".$abbreviation);
    $user_time = date_timestamp_get($date);

    //get difference and see if they are at 15 or more mins unchecked
    $difference = $user_time - $current_time;
    //convert difference(ms) to mins
    $difference_to_mins = ($difference/60);

    if($difference_to_mins <= $delete_limit && $res_array[$count][1] == 0){
      //$obj->removeUser($res_array['user_id']);
      //echo "Bruh<br>";
    }
    if($difference_to_mins <= $stay_limit){
      $obj->removeUser($res_array[$count][0]);
      echo "Get Out of My Restaurant<br>";
    }
    //echo $difference_to_mins . "<br>";
    $count+=1;
    //echo date_timestamp_get($date) . " 'User Time' <br>";
    //echo $res_array['is_in'];
  }

  //check if 90 minutes after user's registration has passed then remove all info about them and return missing table


  $obj->close();

  $results = null;
  $results2 = null;
?>