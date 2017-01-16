<?php
  session_start();
  session_destroy();
  $istaStranica = $_SERVER["HTTP_REFERER"];
  if(isset($istaStranica)) {
    header('Location: '.$istaStranica);
  }
  else {
    header('Location: index.php');
  }
?>
