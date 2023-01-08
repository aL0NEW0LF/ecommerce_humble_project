<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn,$_POST['address1']);
   $city = mysqli_real_escape_string($conn,$_POST['city']);
   $postal_code = mysqli_real_escape_string($conn,$_POST['postal_code']);

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart_item`,`product` WHERE user_id_fk = '$user_id' AND product_id_fk = productid") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] *
          $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
         mysqli_query($conn, "INSERT INTO `order_details`(user_id, order_customer_phone, order_customer_email, total, order_created_at) VALUES('$user_id', '$number', '$email', '$cart_total', CURRENT_TIMESTAMP())") or die('query failed');
         $last_inserted_order = mysqli_insert_id($conn);
         mysqli_query($conn, "INSERT INTO `payment`(payment_method, payment_created_at, order_id) VALUES('$method', CURRENT_TIMESTAMP(), $last_inserted_order)") or die('query failed');
         mysqli_query($conn, "INSERT INTO `orderaddress`(order_id_fk, city, postal_code, address_line1) VALUES('$last_inserted_order', '$city', '$postal_code', '$address')") or die('query failed');
         mysqli_query($conn, "INSERT INTO order_item(product_id, order_item.quantity, order_id) SELECT product_id_fk, cart_item.quantity, $last_inserted_order FROM cart_item WHERE user_id_fk = '$user_id'") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart_item` WHERE user_id_fk = '$user_id'") or die('query failed');
      }
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>la caisse</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>la caisse</h3>
   <p> <a href="home.php">acceuil</a> / la caisse </p>
</div>
<div class="chek">


<section class="display-order">

   <?php
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart_item`, `product` WHERE user_id_fk = '$user_id' AND product_id_fk = productid") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '$'.$fetch_cart['price'].' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> total : <span>$<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

<form action="" method="post">
      <h3>Passez votre commande</h3>
      <div class="flex">
         <div class="inputBox">
            <span>votre nom :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>votre numéro :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>votre email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>Mode de paiement:</span>
            <select name="method">
               <option value="cash on delivery">Paiement à la livraison</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>ligne d’adresse 01:</span>
            <input type="text" min="0" name="address1" required placeholder="e.g. flat no.">
         </div>
         <div class="inputBox">
            <span>ville :</span>
            <input type="text" name="city" required placeholder="e.g. mumbai">
         </div>
         <div class="inputBox">
            <span>pays :</span>
            <input type="text" name="country" required placeholder="e.g. india">
         </div>
         <div class="inputBox">
            <span> code PIN:</span>
            <input type="number" min="0" name="postal_code" required placeholder="e.g. 123456">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>

</section>
</div>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
