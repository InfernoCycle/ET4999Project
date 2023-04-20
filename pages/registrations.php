<?php
  include '../lib/email.php';
  sendEmail($_GET['mail1'], $_GET["user"] . " has been registered");

  header("Location:../index.html");
?>