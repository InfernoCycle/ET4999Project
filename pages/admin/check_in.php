<?php 
  require_once "../connect.php";
  require_once "../../lib/utilities.php";

  session_start();

  $associative_arr = [];
  $obj = new sql4();
  $obj->mysql_conn();

  $results = $obj->get_available_tables();
  //mysqli_fetch_array($obj->get_available_tables())
  for($i = 0; $i < mysqli_num_rows($results); $i++){
    if(!mysqli_data_seek($results, $i)){
      continue;
    }

    if(!($row = mysqli_fetch_assoc($results))){
      continue;
    }

    $associative_arr += array($row["table_size"] => $row["available"]);
  }

  $result = $obj->any("SELECT user_id, is_in, first_name, last_name, table_id FROM users;");
  $res_array = mysqli_fetch_all($result);
  $count = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check-In</title>
  <link rel="stylesheet" href="../../index.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="../jquery-3.6.3.min.js"></script>
  <script src="../jquery-ui.js"></script>

  <link rel="stylesheet" href="./jquery.timepicker.min.css"></link>
  <script src="./jquery.timepicker.min.js"></script>
  <!--<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>-->
  
  <!--C:\Users\ecollege\Downloads\jquery-ui-1.13.2.custom\jquery-ui.js-->
</head>
<body>
  <?php if(isset($_SESSION['logged'])){?>
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

    <div class="modal_cont">
      <div id="exit_div"><button class="exit_button" class="modal_cont_exit">X</button></div>
      <h2 class="modal_info" style="text-align:center;">Check-in</h2>
      <div id="info_cancel_cont">
        <div id="info_cont">
          <p class="modal_info">First Name: <span class="modal_values"><span></p>
          <p class="modal_info">Last Name: <span class="modal_values"><span></p>
          <p class="modal_info">Reservation Date: <span class="modal_values"><span></p>
          <p class="modal_info">Reservation Time: <span class="modal_values"><span></p>
          <p class="modal_info">Reserved Table: <span class="modal_values"><span></p>
        </div>
        <div id="cancel_modal1">
          <p id="accepted_msg" class="confirm_question">Accepted</p>
          <button type="button" class="ok_close_emp_modal">Close</button>
        </div>
      </div>
      <div id="b_buttons_cont">
        <button class="b_action exit_button">Close</button>
        <button id="accept_rsv_btn" class="b_action">Accept</button>
      </div>
  </div>
  
    <div style="width:100%; text-align:center;">
      <form class="custom_form custom_form_v2" id="table_in_form1" action="status.php" method="POST">
        <fieldset id="status_fieldset">
          <legend style="padding:10px; font-weight: bolder; font-size:35px">Reservation Status</legend>
          <label class="employee_forms_labels">Pre-Registers: </label>
          <br>
          <input name="registrations" style="width:50%;" list="registrations" id="registrations_input" required/>
          <datalist id="registrations">
            <?php while($count < count($res_array)){ 
              $inner_res = mysqli_fetch_array($obj->any("SELECT reserved_time, reserved_date FROM reservations WHERE user_id={$res_array[$count][0]};"));
              if($inner_res == null){
                $count+=1;
                continue;
              }?>
              <option id=<?=$res_array[$count][0]?> value="<?=$res_array[$count][2]." ".$res_array[$count][3].",".$inner_res['reserved_date'].",".$inner_res['reserved_time'].",".get_table_by_id($res_array[$count][4]);?>" ><?=$res_array[$count][2]." ".$res_array[$count][3]." for ".$inner_res['reserved_date']." at ".$inner_res['reserved_time'].", ".get_table_by_id($res_array[$count][4]);?></option>
              <?php $count+=1;}?>
            <?php $obj->close();?>
          </datalist>
          <p class="space"></p>
          <button id="register_in_btn" class="employee_submits" type="button">Check-In</button>
        </fieldset>
      </form>
      
      <div id="cancel_modal2">
        <p id="accepted_msg2" class="confirm_question">Accepted</p>
        <button type="button" class="ok_close_emp_modal_2">Close</button>
      </div>
      <form class="custom_form custom_form_v2" id="table_in_form2" action="status.php" method="POST">
        <fieldset id="status_fieldset2">
          <legend style="padding:10px; font-weight: bolder; font-size:35px">Walk-In</legend>
          <label>All Tables:</label>
          <br>
          <table id="availability_table">
            <thead>
              <tr>
                <th>Table</th>
                <th>Available</th>
              </tr>
            </thead>
            <tbody>
            <?php 
                foreach($associative_arr as $key => $value){
              ?>
                <?php if($value > 0){ ?>
                  <tr>           
                      <td><?=$key;?></td>
                      <td><?=$value?></td>
                  </tr>
                <?php }else{?>
                  <tr>
                    <td><?=$key;?></td>
                    <td><?='Unavailable'?></td>
                  </tr>
                <?php }?>
              <?php }?>
            </tbody>
          </table>
          <br>
          <label class="employee_forms_labels">Tables Available: </label>
          <br>
          <select name="table">
            <?php 
              foreach($associative_arr as $key => $value){
            ?>
              <?php if($value > 0){ ?>
                <option value="<?=$key . ', Available: ' . $value?>">           
                    <?=$key . ', Available: ' . $value?>
                </option>
              <?php }else{?>
                <option disabled value="<?=$key . ' is Unavailable'?>">
                  <?=$key . ' is Unavailable'?>
                </option>
              <?php }?>
            <?php }?>
          </select>
          <p class="space"></p>
          <button id="walk_in_btn" class="employee_submits" type="button">Add-on</button>
        </fieldset>
      </form>

      <form class="custom_form custom_form_v2" id="table_in_form3" action="status.php" method="POST">
        <fieldset id="status_fieldset">
          <legend style="padding:10px; font-weight: bolder; font-size:35px">Cancel</legend>
          <label class="employee_forms_labels">Pre-Registers: </label>
          <br>
          <button id="cancel_out_btn" class="employee_submits" type="button">Cancel</button>
        </fieldset>
      </form>
    </div>
    <footer></footer>
    <script src="./admin_12xF3.js"></script>
    <script>
      const minutes = 1;
      const milliseconds = 1000 * (minutes * 60);
      const interval = setInterval(()=>{
        console.log("this is running every 1 minute");
      }, milliseconds);
      $(document).ready(function(){
        var user_id = "";
        $("#register_in_btn").on("click", function(e){
          let el = $("#registrations_input")[0];
          let dl=$("#registrations")[0];
          if(el.value.trim() != ''){
            let opSelected = dl.querySelector(`[value="${el.value}"]`);
            user_id = opSelected.getAttribute('id');
            
            let value = el.value.split(",");
            let name = value[0].split(" ");
            let first_name = name[0];
            let last_name = name[1];
            let reserved_date = value[1];
            let reserved_time = value[2];
            let reserved_table = value[3];

            const modal_value = document.getElementsByClassName("modal_values");
            let count = 0;
            modal_value[0].innerHTML=first_name;
            modal_value[1].innerHTML=last_name;
            modal_value[2].innerHTML=reserved_date;
            modal_value[3].innerHTML=reserved_time;
            modal_value[4].innerHTML=reserved_table;

            box_out_body();
          }
        })

        $("#accept_rsv_btn").on("click", function(e){
          $.post("./requests/accept.php", {option:user_id}, function(data){
              const acc_msg = document.getElementById("accepted_msg");
              if(data.toString() === "true"){
                acc_msg.innerText = "Accepted";
              }else if(JSON.parse(data) === "Exist"){
                acc_msg.innerText = "Already Checked-In";
              }else if(JSON.parse(data) === "Error"){
                acc_msg.innerText = "Something Went Wrong. Please Manually Check Party.";
              }
            });
        });
      });

    </script>
  <?php }else{?>
    <header class="header_cont">
      <h1 class="header_title">TOO BAD SO SAD &#x0024;</h1>
    </header>
  <?php }?>
</body>
</html>