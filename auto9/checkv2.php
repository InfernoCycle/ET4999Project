<?php 

  require '../pages/connect.php';
  require '../lib/email.php';

  $obj = new sql4();
  $obj->mysql_conn();

  $results = null;
  $results2 = null;
?>