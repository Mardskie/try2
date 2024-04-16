<?php
session_start();
include 'config.php';

if(isset($_SESSION['athlete_UserID'])) {
    $UserID = $_SESSION['athlete_UserID'];

    // Fetch athlete details from the database
    $query = "SELECT * FROM athletes WHERE UserID = '$UserID'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $fetch = mysqli_fetch_assoc($result);
    } else {
        // Handle if no athlete data found
        die('Athlete details not found');
    }
} 

if(isset($_POST['update_profile'])){
   // Sanitize and validate input data
   // Also, consider using prepared statements for security
   $Firstname = mysqli_real_escape_string($conn, $_POST['Firstname']);
   $Lastname = mysqli_real_escape_string($conn, $_POST['Lastname']);
   $MiddleInitial = mysqli_real_escape_string($conn, $_POST['MiddleInitial']);
   $Course = mysqli_real_escape_string($conn, $_POST['Course']);
   $Year = mysqli_real_escape_string($conn, $_POST['Year']);
   $Civistatus = mysqli_real_escape_string($conn, $_POST['Civistatus']);
   $Gender = mysqli_real_escape_string($conn, $_POST['Gender']);
   $Birthdate = mysqli_real_escape_string($conn, $_POST['Birthdate']);
   $Contacno = mysqli_real_escape_string($conn, $_POST['Contacno']);
   $Address = mysqli_real_escape_string($conn, $_POST['Address']);

   // Update athlete details in the database
   $update_query = "UPDATE `athletes` SET Firstname = '$Firstname', Lastname = '$Lastname', MiddleInitial = '$MiddleInitial', Course = '$Course', Year = '$Year', Civilstatus = '$Civistatus', Gender = '$Gender', Birthdate = '$Birthdate', Contactno = '$Contacno', Address = '$Address' WHERE UserID = '$UserID'";
   $update_result = mysqli_query($conn, $update_query);
   if (!$update_result) {
       die('Query failed: ' . mysqli_error($conn));
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style1.css">
</head>
<body>
   
<div class="update-profile">
   <form action="" method="post">
      <div class="flex">
         <div class="inputBox">
            <span>First Name:</span>
            <input type="text" name="Firstname" value="<?php echo $fetch['Firstname'] ?? ''; ?>" class="box">
            <span>Last Name:</span>
            <input type="text" name="Lastname" value="<?php echo $fetch['Lastname'] ?? ''; ?>" class="box">
            <span>Middle Initial:</span>
            <input type="text" name="MiddleInitial" value="<?php echo $fetch['MiddleInitial'] ?? ''; ?>" class="box">
            <span>Course:</span>
            <input type="text" name="Course" value="<?php echo $fetch['Course'] ?? ''; ?>" class="box">
            <span>Year:</span>
            <input type="text" name="Year" value="<?php echo $fetch['Year'] ?? ''; ?>" class="box">
            <span>Civil Status:</span>
            <input type="text" name="Civistatus" value="<?php echo $fetch['Civilstatus'] ?? ''; ?>" class="box">
            <span>Gender:</span>
            <input type="text" name="Gender" value="<?php echo $fetch['Gender'] ?? ''; ?>" class="box">
            <span>Birthdate:</span>
            <input type="text" name="Birthdate" value="<?php echo $fetch['Birthdate'] ?? ''; ?>" class="box">
            <span>Contact Number:</span>
            <input type="text" name="Contacno" value="<?php echo $fetch['Contactno'] ?? ''; ?>" class="box">
            <span>Address:</span>
            <input type="text" name="Address" value="<?php echo $fetch['Address'] ?? ''; ?>" class="box">
         </div>
      </div>
      <input type="submit" value="Update Profile" name="update_profile" class="btn">
      <a href="athlete_page.php" class="delete-btn">Go back</a>
   </form>
</div>

</body>
</html>
