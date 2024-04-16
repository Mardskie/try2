<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $Username = mysqli_real_escape_string($conn, $_POST['Username']);
   $Password = mysqli_real_escape_string($conn, $_POST['Password']);
   $ConfirmPassword = mysqli_real_escape_string($conn, $_POST['ConfirmPassword']);
   $user_type = $_POST['user_type'];

   $select = "SELECT * FROM registration WHERE Username = '$Username'";
   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'Username already exists!';
   } else {
      if($Password != $ConfirmPassword){
         $error[] = 'Passwords do not match!';
      } else {
         $insert = "INSERT INTO registration (Username, Password, ConfirmPassword, user_type) VALUES ('$Username', '$Password', '$ConfirmPassword', '$user_type')";
         mysqli_query($conn, $insert);
         // Get the ID of the inserted user
         $userID = mysqli_insert_id($conn);
         // Redirect to login page or wherever you want
         header('location:login_form.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>Register Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="Username" required placeholder="Enter your username">
      <input type="password" name="Password" required placeholder="Enter your password">
      <input type="password" name="ConfirmPassword" required placeholder="Confirm your password">
      <select name="user_type">
         <option value="athlete">Athlete</option>
         <option value="coach">Coach</option>
         <option value="dean">Dean</option>
         <option value="department">Department</option>
         <option value="tournamentmanager">Tournament Manager</option>
      </select>
      <input type="submit" name="submit" value="Register Now" class="form-btn">
      <p>Already have an account? <a href="login_form.php">Login Now</a></p>
   </form>
</div>

</body>
</html>
