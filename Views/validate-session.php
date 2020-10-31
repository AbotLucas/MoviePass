<?php
 
  if(!isset($_SESSION["loginUser"]) ){
    /*require_once(FRONT_ROOT."Home/MostrarHome");*/
    header("location:../index.php");  
  }
?>