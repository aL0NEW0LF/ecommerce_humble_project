<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Commandes</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>Vos commandes</h3>
   <p> <a href="home.php">acceuil</a> / commandes </p>
</div>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

   <?php
         $order_query = mysqli_query($conn, "SELECT DISTINCT * FROM `order_details`, `orderaddress`, `payment` WHERE order_id = orderid AND order_id_fk = orderid AND user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> nom : <span><?php echo $fetch_orders['order_customer_name']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['order_customer_email']; ?></span> </p>
         <p> address : <span><?php echo $fetch_orders['address_line1'] .', '. $fetch_orders['city'] .' - '. $fetch_orders['postal_code']; ?></span> </p>
         <p> numéro telephone : <span><?php echo $fetch_orders['order_customer_phone']; ?></span> </p>
         <p> mode de payment : <span><?php echo $fetch_orders['payment_method']; ?></span> </p>
         <p> prix total : <span><?php echo $fetch_orders['total']; ?></span> </p>
         </div>
         <?php
       }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
