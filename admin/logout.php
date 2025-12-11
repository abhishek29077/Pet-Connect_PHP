<?php
if(isset($_SESSION['aname']))
  {
    session_unset();
    session_destroy();
    header('Location:../login.php');
  }
?>