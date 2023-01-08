<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE  email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['username'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['user_idpk'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'customer'){

         $_SESSION['user_name'] = $row['username'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['user_idpk'];
         header('location:home.php');

      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-container">

<form action="" method="post">
   <h3>se connecter</h3>
   <input type="email" name="email" placeholder="entrer votre email" required class="box">
   <input type="password" name="password" placeholder="entrer votre mot de pass" required class="box">
   <input type="submit" name="submit" value="login now" class="btn">

   <?php
      if(isset($message)){
         foreach($message as $message){
            echo '
            <div class="message">
               <span>'.$message.'</span>
            </div>
            ';
         }
      }
   ?>

   <p>Vous n’avez pas de compte? <a href="register.php">s'inscrire</a></p>
</form>

</div>

</body>
</html>