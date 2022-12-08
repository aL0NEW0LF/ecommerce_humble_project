<?php

// Create connection
$conn = mysqli_connect('localhost', 'root', '', 'ecommerce_site');
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>