<?php 
//PHP file to check every 10 mins and if time
//is for user reservation is within 30 mins or less
//then send an email automatically to them.


  require '../pages/connect.php';
  require '../lib/email.php';

  $obj = new sql4();
  $obj->mysql_conn();

  $results = null;
  $results2 = null;

  //setting time zone based on new_york aka U.S. eastern time
  date_default_timezone_set("America/New_York");
  $time1 = time();
  $today = date("m/d/Y", $time1);
  $time = date("h:i", $time1);
  $timePrefix = date("A");

  function getTimeWidth($Time, $prefix, $i, $message){
    global $obj, $results, $results2;
    //echo $Time . $prefix;
    $fullDate = date("Y-m-d H:i:00");

    //splitting user time
    $splitUserTime = explode(":", $Time);//0 is hour, 1 is minute
    $splitUserTime[2] = "00";
    if($prefix == "PM" && $splitUserTime[0] != 12){
      $splitUserTime[0] = $splitUserTime[0] + 12;
    }
    if($prefix == "PM" && $splitUserTime[0] == 12){
      $splitUserTime[0] = "12";
    }
    if($prefix == "AM" && $splitUserTime[0] != 12){
      $splitUserTime[0] = $splitUserTime[0];
    }
    if($prefix == "AM" && $splitUserTime[0] == 12){
      $splitUserTime[0] = "00";
    }

    $splitUserDate = explode("/",$results[$i][0]); //messed up formatting in sql so had to manually mend it back to normal
    $FullUserDate = $splitUserDate[2] . "-" . $splitUserDate[0] . "-" . $splitUserDate[1] . " " . $splitUserTime[0] . ":" . $splitUserTime[1] . ":" . "00";
    
    $minTime = -(60 * 5); // 5 minutes
    $maxTime = -(60 * 60); // 1 hour

    //echo $minTime . " " . $maxTime . " ";

    $datetime = date("Y-m-d H:i:s");
    $UserFullTime = strtotime($FullUserDate);
    $CurrentFullTime = strtotime($datetime);

    $TimeToReservation = $CurrentFullTime - $UserFullTime;
    /*echo $datetime . "\n";
    echo $UserFullTime . "\n";
    echo $CurrentFullTime . "\n";*/
    if($TimeToReservation < $minTime && $TimeToReservation > $maxTime){
      $obj->removeUser($results[$i][1]);
      //send email below
      sendEmail($results2[0][0], $message);
      //echo "User has been removed";
      return;
    };
  }

  //retrieve all dates along with user id of date
  //we will then keep checking date and compare with todays date
  //if the date matches today notify matching userid
  //send a notification as soon as possible reminding them their 
  //reservation is coming up.

  $query = "select date, user_id, time, notify from reservations";

  $results = mysqli_fetch_all($obj->any($query));

  $limit = 0;
  for($i = 0; $i < count($results); $i++){
    $notify = true;
    if($results[$i][3] == 1){
      $notify = false;
    }
    if($results[$i][0] == $today && $notify){
      //fetch users details so I can delete them later.
      $query = "select email, first_name, last_name, user_id from users where user_id = {$results[$i][1]}";
      $results2 = mysqli_fetch_all($obj->any($query));
      $message = "Hello {$results2[0][1]} {$results2[0][2]}, we wanted to remind you that 
      you have a seat reservation set for today, {$results[$i][0]}, at {$results[$i][2]}";

      //then remove user from database for safety reason and to make sure cron job doesn't spam user
      //$query = "DELETE FROM users WHERE user_id={$results[$i][1]}";
      //$obj->removeUser($results[$i][1]);

      $split_str = explode(" ", $results[$i][2]);
      getTimeWidth($split_str[0], $split_str[1], $i, $message);
      
      //echo $time . " " . $results[$i][2];

      //$obj->any($query); //don't have to get return value of this
      //echo($results[$i][1]);
      //echo "User has successfully been remove from list / ";
    }
  }
  $obj->close();
?>