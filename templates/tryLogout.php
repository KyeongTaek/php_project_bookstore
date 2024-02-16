<?php
  session_start();
  
  $_SESSION = []; // delete all session variable
  
  echo '<script type="text/javascript">location = "../index.php";</script>';
?>