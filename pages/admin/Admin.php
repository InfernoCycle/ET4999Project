<?php
  require '../connect.php';

  if(isset($_POST['fn'])){
    session_start();
    echo "<h1 style='color:white;'>".$_POST['fn'] . " " . $_POST['ln']."</h1>";
    $obj = new sql4();
    $obj->mysql_conn();
    $result = mysqli_fetch_array($obj->any("SELECT * FROM employee WHERE first_name='{$_POST['fn']}' and last_name='{$_POST['ln']}';"));
    $obj->close();

    if($result == null){
      session_unset();
      session_destroy();
    }else{
      echo "<h1 style='color:white;'>" . $result['store_id'] . "</h1>";
      $_SESSION['emp_first_name'] = $_POST['fn'];
      $_SESSION['emp_last_name'] = $_POST['fn'];
      $_SESSION['logged'] = true;
      header("Location: ./check_in.php");
      exit();
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../../index.css">
    <script src="../jquery-3.6.3.min.js"></script>
    <script src="../jquery-ui.js"></script>

    <link rel="stylesheet" href="./jquery.timepicker.min.css"></link>
    <script src="./jquery.timepicker.min.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>-->
    
    <!--C:\Users\ecollege\Downloads\jquery-ui-1.13.2.custom\jquery-ui.js-->
  </head>
  <body>
    <div id="loggedOut">
      <a href="register.html"><button>Register</button></a>
      <a href="loggin.html"><button>Login</button></a>
    </div>
    <div id="loggedIn">
        <h2 style="display:inline-block;" id="username">Null</h2>
        <button onclick="logout(this)">Log-Out</button>
    </div>
    <div class="card">
      <header class="header_cont">
        <h1 class="header_title">Worldly Bites</h1>
      </header>

      <nav class="nav_cont">
          <a href="../../index.html">Home</a>
          <a href="../menu.html">Menu</a>
          <a href="../reserve.php">Reserve</a>
          <a href="../about.html">About</a>
      </nav>
    </div>
    <form id="admin_form" class="custom_form" action="Admin.php" method="POST">
      <fieldset id="status_fieldset">
        <legend style="padding:10px; font-weight: bolder; font-size:35px">Staff-In</legend>
        
        <label>First Name:</label>
        <p class="innerSpace"></p>
        <input placeholder="Clark" type="text" name="fn" required="true">

        <p class="space"></p>
        
        <label>Last Name:</label>
        <p class="innerSpace"></p>
        <input placeholder="Griswold" type="text" name="ln" required="true">
        
        <p class="space"></p>

        <label>Store ID:</label>
        <p class="innerSpace"></p>
        <input placeholder="F2AP" type="text" maxlength="4" name="store_id" required="true">
        <p class="innerSpace"><br></p>

        <p class="space"></p>

        <label>Employee ID:</label>
        <p class="innerSpace"></p>
        <input placeholder="123456" type="text" maxlength="6" name="employee_id" required="true">
        <p class="innerSpace"><br></p>

        <button name="submit_btn" id="employee_submit" type="submit" value="Submit">Login</button>

        <p class="space"></p>

        <p id="error_log"></p>
      </fieldset>
    </form>
    <footer></footer>
    <script src="./jquery_funcs.js"></script>
    <script src="../index.js"></script>
    <script src="./logOut.js"></script>
    <script> 
      
    </script>
  </body>
</html>