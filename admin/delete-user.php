<?php
  include "config.php";
  
    if($_SESSION['user_role'] == '0'){
      header("{$hostname}/admin/post.php");
    }
  if($_SESSION['user_role'] == '0'){
    header("{$hostname}/admin/post.php");
  }
  $userid = $_GET['id'];
  $sql = "DELETE FROM user WHERE user_id={$userid}";
  if(mysqli_query($conn, $sql)){
      header("{$hostname}/admin/users.php");
  }else{
      echo "<p style='color:Red; margin:10px 0;'>Can't delete user record! </p>";
  }
  mysqli_close($conn);
?>