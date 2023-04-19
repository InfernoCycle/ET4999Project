<?php 
//PHP file to check every 10 mins and if time
//is for user reservation is within 30 mins or less
//then send an email automatically to them.


  require '../pages/connect.php';
  require '../lib/email.php';

  $obj = new sql4();
  $obj->mysql_conn();

  $time = time();
  $today = date("m/d/Y");
  //retrieve all dates along with user id of date
  //we will then keep checking date and compare with todays date
  //if the date matches today notify matching userid
  //send a notification as soon as possible reminding them their 
  //reservation is coming up.

  $query = "select date, user_id, time, notify from reservations";

  $results = mysqli_fetch_all($obj->any($query));

  for($i = 0; $i < count($results); $i++){
    $notify = true;
    if($results[$i][3] == 1){
      $notify = false;
    }
    if($results[$i][0] == $today && $notify){
      $query = "select email, first_name, last_name, user_id from users where user_id = {$results[$i][1]}";
      $results2 = mysqli_fetch_all($obj->any($query));
      $message = "Hello {$results2[0][1]} {$results2[0][2]}, we wanted to remind you that 
      you have a seat reservation set for today, {$results[$i][0]}, at {$results[$i][2]}";
      
      //send email below
      sendEmail($results2[0][0], $message);

      //then remove user from database for safety reason and to make sure cron job doesn't spam user
      $query = "DELETE FROM users WHERE user_id={$results[$i][1]}";
      $obj->removeUser($results[$i][1]);
      //$obj->any($query); //don't have to get return value of this
      //echo($results[$i][1]);
      //echo "User has successfully been remove from list / ";
    }
  }
  $obj->close();
?>