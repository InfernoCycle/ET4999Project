<?php 
  /* check if user reservation is still active. */
  require_once './connect.php';
  require_once '../lib/utilities.php';

  $exists = false;
  $invalid_creds = false;
  $fn = null;
  $ln = null;
  $table = null;
  $rsv_time = null;
  $rsv_date = null;

  $obj = null;
  $user_id = null;

  if(isset($_POST["fn"])){
    $obj = new sql4();
    $obj->mysql_conn();
    $result = $obj->any("SELECT table_id, user_id FROM users WHERE cancel_id={$_POST["unique_code"]} AND first_name='{$_POST["fn"]}' AND last_name='{$_POST["ln"]}';");
    $obj->close();

    $data = mysqli_fetch_array($result);

    if(is_null($data)){
      $invalid_creds = true;
      $exists = false;
      //echo "<h1 style='color:white;'>data came back empty</h1>";
    }else{
      $exists = true;
      $fn = $_POST["fn"];
      $ln = $_POST["ln"];
      $table = get_table_by_id((int)$data[0]);

      //get rest of info
      $user_id = (int)$data[1];
      $obj->mysql_conn();
      $result2 = $obj->any("SELECT reserved_time, reserved_date FROM reservations WHERE user_id={$user_id};");
      $obj->close();
      $data_two = mysqli_fetch_row($result2);
      $rsv_time = $data_two[0];
      $rsv_date = $data_two[1];
      //echo "<br><h1 style='color:white;'>" . $data_two[] ."</h1>";
      //echo "<br><h1 style='color:white;'>" . implode($data) . " " . camel_case($_POST["fn"]) ."</h1>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Worldly Bites - Reservation Status</title>
  <link rel="stylesheet" href="../index.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="./jquery-3.6.3.min.js"></script>
  <script src="./jquery-ui.js"></script>

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
        <a href="../index.html">Home</a>
        <a href="./menu.html">Menu</a>
        <a href="./reserve.php">Reserve</a>
        <a href="./about.html">About</a>
    </nav>
  </div>
  <!-- modal content showing users stuff -->
  <div class="modal_cont">
    <div id="exit_div"><button class="exit_button" class="modal_cont_exit">X</button></div>
    <h2 class="modal_info" style="text-align:center;">Registration Status</h2>
    <div id="info_cancel_cont">
      <div id="info_cont">
        <p class="modal_info">First Name: <?=$fn;?></p>
        <p class="modal_info">Last Name: <?=$ln;?></p>
        <p class="modal_info">Reservation Date: <?=$rsv_date;?></p>
        <p class="modal_info">Reservation Time: <?=$rsv_time;?></p>
        <p class="modal_info">Reserved Table: <?=$table;?></p>
      </div>
      <div id="cancel_modal">
        <p id="confirm_question" class="confirm_question">Are you sure you want to cancel?</p>
        <form id="cancel_form">
          <input type="button" name="options" value="yes" id="accept_cancel" class="cancel_btns"/>
          <input type="button" name="options" value="no" id="decline_cancel" class="cancel_btns"/>
          <p id="cancel_msg">We successfully removed your reservation. You will be sent to home in <span id="count_down">15</span> seconds</p>
        </form>
      </div>
    </div>
    <div id="b_buttons_cont">
          <button class="b_action exit_button">Close</button>
          <button id="cancel_rsv_btn" class="b_action">Cancel Reservation</button>
        </div>
  </div>

    <form id="status_form" action="status.php" method="POST">
      <fieldset id="status_fieldset">
        <legend style="padding:10px; font-weight: bolder; font-size:35px">Reservation Status</legend>
        
        <label>First Name:</label>
        <p class="innerSpace"></p>
        <input placeholder="Clark" type="text" name="fn" required="true">

        <p class="space"></p>
        
        <label>Last Name:</label>
        <p class="innerSpace"></p>
        <input placeholder="Griswold" type="text" name="ln" required="true">
        
        <p class="space"></p>

        <label>Confirmation Code:</label>
        <p class="innerSpace"></p>
        <input placeholder="123456" type="text" maxlength="6" name="unique_code" required="true">
        <p class="innerSpace"><br></p>

        <button name="submit_btn" id="status_submit" type="button" value="Submit">Submit</button>

        <p class="space"></p>

        <p id="error_log"></p>
      </fieldset>
      
    </form>
    <footer></footer>
  <script src="./jquery_funcs.js"></script>
  <script src="../index.js"></script>
  <script src="./logOut.js"></script>
  <?php if($exists){?>
    <script>box_out_body();</script>
  <?php }?>
  <?php if($invalid_creds){ ?>
    <script>
      let error_msg = document.getElementById("error_log");
      error_msg.style.display="block";
      error_msg.innerText = "No records For this user.";
    </script>
  <?php }else{?>
    <script>
      let error_msg = document.getElementById("error_log");
      error_msg.style.display="none";
      error_msg.innerText = "";
    </script>
  <?php }?>
  <script>
    $(document).ready(function(){
      $("#accept_cancel").on("click", async function(){
        //credit to site: https://tecadmin.net/submit-form-without-page-refresh-php-jquery/
        $.post("../lib/specificRemove.php", {option:<?=$user_id?>}, function(data){
          console.log(data)
          if(data.toString() === "true"){
            const buttons = document.getElementsByClassName("cancel_btns");
            for(btns of buttons){
              btns.style.display="none";
            }

            const question = document.getElementById("confirm_question");
            question.style.display = "none";

            const accept_msg = document.getElementById("cancel_msg");
            accept_msg.style.display="block";

            const cancel_modal = document.getElementById("cancel_modal");
            cancel_modal.style.background="none";

            timer();

          }else{
            console.log("it's false");
          }
        })       
      })
    })
  </script>
</body>
</html>