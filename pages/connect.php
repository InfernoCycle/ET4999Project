<?php 
  require_once '../lib/email.php';
  
  //require './confirmed.php';
  
  $servername = "localhost"; //host name for sql server
  $username = "ODBC"; //username that owns sql server
  $password = "icarlyFan"; //password for server
  $database = "reserve"; //name of database being used

  $conn = null;
  $newString = null;
  $table_id = 0;

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

    function get_table_id(){
      global $table_id;
      
      switch(trim(explode(",", $_GET["table"])[0])){
        case "Single Seat":
          $table_id = 1;
          break;
        case 'Table of 2':
          $table_id = 2;
          break;
        case 'Table of 4':
          $table_id = 3;
          break;
        case 'Table of 6':
          $table_id = 4;
          break;
        case 'Table of 10':
          $table_id = 5;
          break;
        default:
          $table_id = 1;
      }
    }

    function addUser(){
      global $conn;
      global $table_id;

      convertDate($_GET['date']);

      //'user_id' is the column name for storing user's unique id
      //'users' is the table name in chosen database
      $query = "select user_id from users";

      //$stuff = mysqli_fetch_all(mysqli_query($conn, $query));

      //get's the table_id so we can use it for deletions
      $this->get_table_id();

      //generate a unique random number for user.
      $rand_number = $this->generate_cancel_code();

      //insert given credentials from user's entry in form into database
      $query = "INSERT INTO users(first_name, last_name, email, cancel_id, table_id) 
      VALUES('{$_GET['fn']}', '{$_GET['ln']}', '{$_GET['email']}', {$rand_number}, {$table_id});";

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

      $this->subtract_available_tables();

      $this->newSend($rand_number);
    }

    function newSend($cancellation_number){
      global $newString;
      sendEmail($_GET['email'], "Thank You for reserving a seat at {$_GET['time']} on " . getMonth($newString[0]) . " " . $newString[1] . ", " . $newString[2] 
    . ". Your Cancellation Code is: {$cancellation_number}");
    }

    function generate_cancel_code(){
      global $conn;
      //$random_number = rand(100000, 999999);
      //set a min and max here. the higher the max the more unique codes
      //can be generated
      $rand_numb = rand(100000, 100100);

      $query = "SELECT cancel_id FROM users WHERE cancel_id={$rand_numb}";
      
      $stuff = mysqli_fetch_all(mysqli_query($conn, $query));
      
      if(count($stuff) != 0){
        return $this->generate_cancel_code();
      }
      
      return $rand_numb;
    }

    function removeUser($id){
      global $conn;
      $query = "DELETE FROM users WHERE user_id={$id}";

      mysqli_query($conn, $query);

      $query = "DELETE FROM reservations WHERE user_id={$id}";

      mysqli_query($conn, $query);

      $this->add_available_tables();
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

    function add_available_tables(){
      global $table_id;

      $query = "SELECT available FROM tables WHERE id={$table_id}";
      $result = mysqli_fetch_array($this->any($query));

      $new_number = intval($result["available"])+1; //subtract available tables rn

      $query = "UPDATE tables SET available={$new_number} WHERE id={$table_id}";
      $result = $this->any($query);
    }

    function subtract_available_tables(){
      global $table_id;

      $query = "SELECT available FROM tables WHERE id={$table_id}";
      $result = mysqli_fetch_array($this->any($query));

      $new_number = intval($result["available"])-1; //subtract available tables rn

      $query = "UPDATE tables SET available={$new_number} WHERE id={$table_id}";
      $result = $this->any($query);
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