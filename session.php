<?php
// session_start

//if the user is logged in, go to main page

if(isset($_SESSION["userid"]) && $_SESSION["userid"] === true){
  header("location: welcome.php"); // that would be the welcome file.
}
 ?>
