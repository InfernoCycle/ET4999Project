<?php 
  require_once '../../connect.php';
  if(isset($_POST['xf32m'])){
    //echo json_encode(true);
    $table_id = get_table_id($_POST['xf32_is_in']);

    $obj = new sql4();
    $obj->mysql_conn();
    
    try{
      $date = date("m/d/Y");
      $time = date("h:i A");
      $obj->add_user_none($table_id, $date, $time);
      echo json_encode(true);
    }catch(Exception $e){
      echo "Error";
    }

    $obj->close();
  }
?>