<?php 
  
  $servername = "localhost"; //host name for sql server
  $username = "ODBC"; //username that owns sql server
  $password = "icarlyFan"; //password for server
  $database = "reserve"; //name of database being used

  $conn = null;

  class sql4{
    function mysql_conn(){
      global $servername, $username, $password, $database, $conn;
  
      $conn = mysqli_connect($servername, $username, $password, $database);
      if($conn->connect_errno){
        die("failed to connect to mysql: " . $conn->connect_error);
      }
      if($conn){
        return;
      }
      else{
        return "connection failed";
      }
    }

    function addUser(){
      global $conn;

      //'user_id' is the column name for storing user's unique id
      //'users' is the table name in chosen database
      $query = "select user_id from users";

      $stuff = mysqli_fetch_all(mysqli_query($conn, $query));

      //insert given credentials from user's entry in form into database
      $query = "INSERT INTO users(first_name, last_name, email) 
      VALUES('{$_GET['fn']}', '{$_GET['ln']}', '{$_GET['email']}');";

      if($conn){
        mysqli_query($conn, $query);
      }

      $query = "select user_id from users";
      $stuff = mysqli_fetch_all(mysqli_query($conn, $query));
      $nextId = 1;
      if(count($stuff) == 0){
        $nextId = 1;
      }else{
        $nextId = $stuff[count($stuff)-1][0];
      }

      $query = "INSERT INTO reservations(time, notify, user_id, date) 
      VALUES('{$_GET['time']}', 0, {$nextId}, '{$_GET['date']}');";

      mysqli_query($conn, $query);
    }

    function removeUser($id){
      global $conn;
      $query = "DELETE FROM users WHERE user_id={$id}";

      mysqli_query($conn, $query);

      $query = "DELETE FROM reservations WHERE user_id={$id}";

      mysqli_query($conn, $query);
    }

    function any($query){
      global $conn;

      return mysqli_query($conn, $query);
    }

    function get_available_tables(){
      global $conn;
      if($conn){
        $result = mysqli_query($conn, "SELECT table_size, available FROM tables");

        return $result;
      }
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