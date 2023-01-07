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
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">

   <div class="flex">



      <div class="content">
         <h3>why choose us?</h3>
         <p>ASTER est une marque dediee particulièrement aux femmes on est un groupe de designers qui vous garantissent des
          collections sous le thème de notre  marque "simple and  perfect " en combinant des couleurs claires et très peu de textes pour refléter toujours le mode de la femme élégante et gracieuse .</P>


         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">laidies's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/a.png" alt="">
         <p>I started shopping from ASTER lately and I love how affordable aster  is .</p>
         <div class="stars">

            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Dalida jack</h3>
      </div>

      <div class="box">
         <img src="images/b.jpg" alt="">
         <p> whenever I get an ASTER dress I ALWAYS get compliments, it’s honestly such a good site .</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Luna deo</h3>
      </div>

      <div class="box">
         <img src="images/c.jpg" alt="">
         <p>I'm 18 and I love the fact they have lots of clothes I can wear,I have found lots of dresses.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3> Mima kami</h3>
      </div>

      <div class="box">
         <img src="images/d.jpg" alt="">
         <p> ive had some fantastic discounts
            from them and delievery has always been on time, its really good.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Anna maria</h3>
      </div>

      <div class="box">
         <img src="images/e.jpg" alt="">
         <p>I actually had a pretty good experience when I ordered from , I think you get what you pay for Everything looked so cute.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Sara slami</h3>
      </div>

      <div class="box">
         <img src="images/f.jpeg" alt="">
         <p>i just ordered 5 tank tops from this website and i was soooo happy with them they litterally look exactly like the website .</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Jasmin watersun </h3>
      </div>

   </div>

</section>

<section class="authors">

   <h1 class="title">our great designers </h1>

   <div class="box-container">

      <div class="box">
         <img src="images/at1.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Yuko northon </h3>
      </div>

      <div class="box">
         <img src="images/at2.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3> Cami sopht </h3>
      </div>

      <div class="box">
         <img src="images/at3.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3> Cyprein del </h3>
      </div>


   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
