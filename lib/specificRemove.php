<?php 
  require_once "../pages/connect.php";
  if(isset($_POST["option"])){
    $obj = new sql4();
    $obj->mysql_conn();
    echo json_encode($obj->removeUser($_POST["option"]));
    $obj->close();
  }
?>