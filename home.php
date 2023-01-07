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
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
  <div class="l1">

  <?php include 'header.php'; ?>


<section class="home">

   <div class="content">
      <h3>Simple & perfect</h3>
      <p></p>
      <a href="about.php" class="white-btn">discover more</a>
   </div>

</section>

<section class="category">

   <h1 class="title">Categories</h1>


     <div class="gallery">
       <div class="content1">
         <img src="images/event.jpg">
         <h6>Event wear dresses</h6>
         <ul>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
         </ul>
         <button class="buy"><a href="eventweardresses.php"style="color:#666">have a look</a></button>
       </div>
       <div class="content1">
         <img src="images/wedding.jpg">
         <h6>wedding dresses</h6>
         <ul>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
         </ul>
      <button class="buy"><a href="weddingdresses.php"style="color:#666">have a look</a></button>
       </div>
       <div class="content1">
         <img src="images/day dress.jpg">
         <h6>day dresses</h6>
         <ul>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
         </ul>
         <button class="buy"><a href="daydresses.php"style="color:#666">have a look</a></button>
       </div>
     </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/2.jpeg" alt="">
      </div>

      <div class="content">
         <h3>about us</h3>
         <p> on est un groupe de designers qui garantissent des
          collections sous le thème de notre marque "simple and  perfect " en combinant des couleurs claires et très peu de textes pour refléter toujours le mode de la femme élégante et gracieuse .</P>
</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
</div>

</body>
</html>
