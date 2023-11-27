<?php 
  require_once '../../connect.php';

  if(isset($_POST["option"])){
    $obj = new sql4();
    $obj->mysql_conn();
    try{
      function change(){
        global $obj;
        try{
          $obj->any("UPDATE users SET is_in=1 WHERE user_id={$_POST['option']}");
          echo json_encode(true);
        }catch(Exception $e){
          echo json_encode(false);
        }
      };
      
      $result = $obj->any("SELECT is_in FROM users WHERE user_id={$_POST['option']}");
      $num = mysqli_fetch_row($result)[0];

      if($num == 1){
        echo json_encode("Exist");
      }else{
        change();
      }
      
    }catch(Exception $e){
      echo json_encode("Error");
    }

    $obj->close();
    //echo json_encode($_POST["option"]);
  }
?>