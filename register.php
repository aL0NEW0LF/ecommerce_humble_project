<?php

include 'config.php';

if(isset($_POST['submit'])){

   $username = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $fname = mysqli_real_escape_string($conn, $_POST['fname']);
   $lname = mysqli_real_escape_string($conn, $_POST['lname']);
   $telephone = mysqli_real_escape_string($conn, $_POST['phone']);

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' OR username = '$username'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(username, email, password, fname, lname, telephone, created_at) VALUES('$username', '$email', '$cpass', '$fname', '$lname', '$telephone', CURRENT_TIMESTAMP())") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
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
    <title>Sign up</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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
<div class="form-container">
    <div id="logbox">
    <form id="signup" method="post" action="">
        <h3>Créer un compte</h3>
        <input class="box" name="name" type="text" placeholder="What's your username?" pattern="^[\w]{3,16}$" autofocus="autofocus" required/>
        <input class="box" name="password" type="password" placeholder="mot de pass" required/>
        <input class="box" name="cpassword" type="password" placeholder="confirmer le mot de pass" required/>
        <input class="box" name="email" type="email" placeholder="addresse email" required/>
        <input class="box" name="fname" type="text" placeholder="prenom" required/>
        <input class="box" name="lname" type="text" placeholder="nom" required/>
        <input class="box" name="phone" type="tel" placeholder="numero de telephone" required pattern="[0]{1}[6]{1}[\d \W \S]{8}"/>
        <input class="btn" name="submit" type="submit" value="Sign up"/>
        <p>Si vous avez déjà un compte, <a href="login.php">Connectez-vous à votre compte </a></p>
      </form>
    </div>
  </div>
</body>
</html>