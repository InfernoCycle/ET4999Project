<?php 

  //require '../lib/email.php';
  require_once '../lib/utilities.php';
  require_once './connect.php';

  //error_reporting(E_ERROR | E_PARSE);

  $invalid_entry = false;

  $obj = new sql4();

  define("first_five", 4);
  $newString = null;
  session_start();

  /*function getMonth($month_int){
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
  }*/

  if($_GET['email'] != ""){
    //convertDate($_GET['date']);

    ////email send has been moved to connect.php
    //sendEmail(<user's email>, <message to send>);
    //sendEmail($_GET['email'], "Thank You for reserving a seat at {$_GET['time']} on " . getMonth($newString[0]) . " " . $newString[1] . ", " . $newString[2]);

    //return;
    $obj->mysql_conn(); //call this first to use any other function from this class
    $result_set = $obj->any("SELECT email FROM users WHERE email='{$_GET['email']}';");
    $result = mysqli_fetch_all($result_set);
    if(count($result) != 0){
      $_SESSION["invalid_entry"] = true;
      $obj->close();
      //header("Location: ./reserve.php");
    }
    else{
      session_unset();
      session_destroy();
      //$obj->addUser();
    }
    $obj->close();
  }
  else{
    echo "how did you get here?";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../index.css">
  <title>Document</title>
</head>
<body style="background:none;">

  <div id="confirm_message">
    <!--<h1><?php echo convertDate($_GET['date']) ?></h1>-->
    <h1>
      <?php echo $_GET['fn'] . " " . $_GET['ln'] . "'s" ?> seat has been reserved for 
      <?php echo convertDate($_GET['date']) ?> at 
      <?php echo $_GET['time'] ?> for <?php echo explode(",", $_GET["table"])[0];?>
    </h1>
    <h1 style="color:red;">An email has been sent to <?php echo $_GET['email'] ?></h1>
    <img src="../img/Confirmed.jpg" >

    <button><a style="text-decoration:none; color:inherit;" href="../index.html">Back to Home</a></button>
  </div>
</body>
</html>