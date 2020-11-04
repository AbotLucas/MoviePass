<?php
 
  if(!isset($_SESSION["loginUser"]) ){
    header("location:../index.php");  
  }
?>