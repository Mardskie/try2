<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['athlete_Username'])){
   header('location: login_form.php');
   exit; // Stop further execution
}

$Username = $_SESSION['athlete_Username'];

if(isset($_GET['logout'])){
   unset($_SESSION['athlete_Username']);
   session_destroy();
   header('location: login_form.php');
   exit; // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>coach page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style1.css">

</head>
<body>
   
<div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `registration` WHERE Username = '$Username'") or die('Query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
            // Display profile details
            echo '<h3>Welcome, '.$fetch['Username'].'</h3>';
         } else {
            echo '<h3>Welcome</h3>';
         }
      ?>
      <a href="update_profile.php" class="btn">Update Profile</a>
      <a href="login_form.php" class="delete-btn">Logout</a>
   </div>

</div>

</body>
</html>