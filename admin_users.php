<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

$sql = "SELECT * FROM `users` ORDER BY id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://kit.fontawesome.com/5fba574a6f.js" crossorigin="anonymous"></script>
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

             <div class="main">
                <div class="title">
                    Users
                </div>
                <div class="card-cont">
                     <?php
                        $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                        while($fetch_users = mysqli_fetch_assoc($select_users)){
                     ?>
                    <div class="card">
                        <p class="name"><?php echo $fetch_users['fname']. " " .$fetch_users['lname']; ?></p>
                        <p class="email"><?php echo $fetch_users['email']; ?></p>
                        <p class="tel"><?php echo $fetch_users['telephone']; ?></p>
                        <p class="usertype"><?php echo $fetch_users['user_type']; ?></p>
                        <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete user</a>
                    </div>
                    <?php
                     };
                  ?>
                </div>
           </div>
        </div>
<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>