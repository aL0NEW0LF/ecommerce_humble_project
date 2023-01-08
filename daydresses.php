<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_id = mysqli_query($conn, "SELECT productid FROM product WHERE name = '$product_name'");
    $product_row = $product_id->fetch_assoc();
    $prod_id = $product_row['productid'];
 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart_item` WHERE product_id_fk = $prod_id AND user_id_fk = '$user_id'") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart!';
    }else{
       mysqli_query($conn, "INSERT INTO `cart_item`(user_id_fk, product_id_fk, quantity, item_created_at) VALUES('$user_id', '$prod_id', 1, CURRENT_TIMESTAMP())") or die('query failed');
       $message[] = 'product added to cart!';
    }
 
 }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Robes de jour</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
  <div class="l1">



<?php include 'header.php'; ?>

<div class="heading">
   <h3>Robes de jour</h3>

</div>
<section class="products" id="products">


<div class="box-container">
    <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `product` WHERE category_id_fk = 7") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="post">
        <div class="box">
            <div class="image">
                <img src="<?php echo $fetch_products['product_picture']; ?>.png" alt="">
                <div class="icons">
                    <input type="submit" value="add to cart" name="add_to_cart" class="cart-btn">
                </div>
            </div>
            <div class="content">
                <h3><?php echo $fetch_products['name']; ?></h3>
                <div class="price"> <?php echo $fetch_products['price']; ?> dh</div>
            </div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['product_picture']; ?>">
        </div>
        </form>
        <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
    </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
  </div>

</body>
</html>
