<?php 
  
  $servername = "localhost";
  $username = "ODBC";
  $password = "icarlyFan";
  $database = "reserve";

  $conn = null;

  class sql4{
    function mysql_conn(){
      global $servername, $username, $password, $database, $conn;
  
      $conn = mysqli_connect($servername, $username, $password, $database);
  
      if($conn){
        return;
      }
      else{
        return "connection failed";
      }
    }

    function addUser(){
      global $conn;

      $query = "select user_id from users";

      $stuff = mysqli_fetch_all(mysqli_query($conn, $query));

      $nextId = 1;
      if(count($stuff) == 0){
        $nextId = 1;
      }else{
        $nextId = $stuff[count($stuff)-1][0] + 1;
      }

      $query = "INSERT INTO users(first_name, last_name, email) 
      VALUES('{$_GET['fn']}', '{$_GET['ln']}', '{$_GET['email']}');";

      if($conn){
        mysqli_query($conn, $query);
      }

      $query = "INSERT INTO reservations(time, notify, user_id, date) 
      VALUES('{$_GET['time']}', 0, {$nextId}, '{$_GET['date']}');";

      mysqli_query($conn, $query);
    }

    function removeUser($id){
      global $conn;
      $query = "DELETE FROM users WHERE user_id={$id}";

      mysqli_query($conn, $query);
    }

    function any($query){
      global $conn;

      return mysqli_query($conn, $query);
    }

    function close(){
      global $conn;
      $conn->close();
    }
  }
    

  /*$obj = new sql4();

  $obj->mysql_conn();
  $obj->addUser();*/
?>