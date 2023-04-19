<?php 

function getMonth(){
  
}

function convertDate($date = null){
  global $newString;
  $char_array = str_split($date);
  $newString = "";
  define("first_five", 5);
  if($char_array){
    for($k=0; $k < strlen($date); $k++)
      if($char_array[$k] == "0" & $k < first_five){
        continue;
      }else{
        $newString = $newString . $char_array[$k];
      }
  }
  $newString = preg_split("/\//", $newString);
  return $newString[2];
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
<body>
  <h1><?php echo convertDate($_GET['date']) ?></h1>
  <h1>
    <?php echo $_GET['fn'] . " " . $_GET['ln'] . "'s" ?> seat has been reserved for 
    <?php echo $_GET['time'] ?> at 
    <?php echo $_GET['date'] ?>
</h1>
</body>
</html>