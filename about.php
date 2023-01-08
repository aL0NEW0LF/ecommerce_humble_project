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
   <h3>à propos de nous</h3>
   <p> <a href="home.php">acceuil</a> / à propos </p>
</div>

<section class="about">

   <div class="flex">



      <div class="content">
         <h3>pourquoi nous?</h3>
         <p>ASTER est une marque dediee particulièrement aux femmes on est un groupe de designers qui vous garantissent des
          collections sous le thème de notre  marque "simple and  perfect " en combinant des couleurs claires et très peu de textes pour refléter toujours le mode de la femme élégante et gracieuse .</P>


         <a href="contact.php" class="btn">contacter nous</a>
      </div>

   </div>

</section>

<section class="reviews">

<h1 class="title">avis clients</h1>

<div class="box-container">

   <div class="box">
      <img src="images/a.png" alt="">
      <p>J’ai commencé à magasiner chez ASTER récemment et j’adore à quel point l’aster est abordable .</p>
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
      <p>  chaque fois que je reçois une robe ASTER, je reçois TOUJOURS des compliments, c’est honnêtement un si bon site .</p>
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
      <p>J’ai 18 ans et j’adore le fait qu’ils ont beaucoup de vêtements que je peux porter, j’ai .trouvé beaucoup de robes.</p>
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
      <p> J’ai eu des réductions fantastiques
         D’eux et Delievery a toujours été à l’heure, c’est vraiment bon.</p>
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
      <p>Je viens de commander 5 débardeurs sur ce site Web et j’étais tellement content d’eux qu’ils ressemblent littéralement exactement au site Web.</p>
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
      <p>En fait, j’ai eu une assez bonne expérience quand j’ai commandé de, je pense que vous obtenez ce que vous payez Tout avait l’air si mignon.</p>
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

<h1 class="title">Nos designers </h1>

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
