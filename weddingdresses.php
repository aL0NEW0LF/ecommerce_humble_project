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
    $product_quantity = $_POST['product_quantity'];
 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart_item`.`product` WHERE product_id_fk = productid AND name = '$product_name' AND user_id_fk = '$user_id'") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart!';
    }else{
       mysqli_query($conn, "INSERT INTO `cart_item`(user_id_fk, product_id_fk, quantity, item_created_at) VALUES('$user_id', '$product_name', '$product_quantity', CURRENT_TIMESTAMP())") or die('query failed');
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
   <title>wedding-dresses</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
  <div class="l1">



<?php include 'header.php'; ?>

<div class="heading">
   <h3>wedding-dresses</h3>

</div>

<section class="products" id="products">



    <div class="box-container">


        <div class="box">
            <span class="discount">-18%</span>
            <div class="image">
                <img src="images/wedding.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>wedding-dress</h3>
                <div class="price"> $12.99 <span>$15.99</span> </div>
            </div>
        </div>

    </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
  </div>

</body>
</html>
