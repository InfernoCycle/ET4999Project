<?php 

  require '../lib/email.php';
  require './connect.php';

  $obj = new sql4();

  if($_GET['email'] != ""){
    sendEmail($_GET['email'], "Thank You for reserving a seat {$_GET['time']} on" . getMonth($newString[0]) . " " . $newString[1] . ", " . $newString[2]);
    
    $obj->mysql_conn(); //call this first to use any other function from this class
    $obj->addUser();
    $obj->close();
  }
  else{
    echo "how did you get here?";
  }

  define("first_five", 5);
  $newString = null;

  function getMonth($month_int){
    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 
    'September', 'October', 'November', 'December'];

    return $months[$month_int - 1];
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
      <?php echo $_GET['time'] ?>
    </h1>
    <h1 style="color:red;">An email has been sent to <?php echo $_GET['email'] ?></h1>
    <img src="../img/Confirmed.jpg" >

    <button><a style="text-decoration:none; color:inherit;" href="../index.html">Back to Home</a></button>
  </div>
</body>
</html>