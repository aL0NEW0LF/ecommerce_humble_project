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
   <title>Acceuil</title>

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
      <h3>Simple & parfaite</h3>
      <p></p>
      <a href="about.php" class="white-btn">découvrez plus</a>
   </div>

</section>

<section class="category">

<h1 class="title">Catégories</h1>


<div class="gallery">
  <div class="content1">
    <img src="images/event.jpg">
    <h6>robes-Event</h6>
    <ul>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
    </ul>
    <button class="buy"><a href="eventweardresses.php"style="color:#666">voir plus</a></button>
  </div>
  <div class="content1">
    <img src="images/wedding.jpg">
    <h6>robes-mariage</h6>
    <ul>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
    </ul>
 <button class="buy"><a href="weddingdresses.php"style="color:#666">voir plus</a></button>
  </div>
  <div class="content1">
    <img src="images/day dress.jpg">
    <h6>robes-jour</h6>
    <ul>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
    </ul>
    <button class="buy"><a href="daydresses.php"style="color:#666">voir plus</a></button>
  </div>
</div>

</section>

<section class="about">

<div class="flex">

 <div class="image">
    <img src="images/2.jpeg" alt="">
 </div>

 <div class="content">
    <h3>à propos de nous</h3>
    <p> on est un groupe de designers qui garantissent des
     collections sous le thème de notre marque "simple and  perfect " en combinant des couleurs claires et très peu de textes pour refléter toujours le mode de la femme élégante et gracieuse .</P>
</p>
    <a href="about.php" class="btn">voir plus</a>
 </div>

</div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
</div>

</body>
</html>
