<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

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
<h1 class="title"> ORDERS </h1>
<table>
    <tr>
                <th class="name">
                    Client name
                </th>
                <th class="email">
                    Client email
                </th>
                <th class="telephone">
                    Client phone number
                </th>
                <th class="date">
                    Order date
                </th>
                <th class="total">
                    Total
                </th>
    </tr>
    <?php
      $select_orders = "SELECT * FROM `users`, `order_details` WHERE user_idpk = user_id ORDER BY `order_created_at`;";
      $result = $conn->query($select_orders);
      $conn->close();
      if(mysqli_num_rows($result) > 0){
        while($rows=$result->fetch_assoc())
        {
      ?>
            <tr>
                <td class="name" style="padding: 10px 0;">
                    <?php echo $rows['fname'] ." ". $rows['lname'];?>
                </td>
                <td class="email" style="padding: 10px 0;">
                    <?php echo $rows['email'];?>
                </td>
                <td class="telephone" style="padding: 10px 0;">
                    <?php echo $rows['telephone'];?>
                </td>
                <td class="date" style="padding: 10px 0;">
                    <?php echo $rows['order_created_at'];?>
                </td>
                <td class="total" style="padding: 10px 0;">
                    <?php echo $rows['total'];?>
                </td>
            </tr>
            <?php
                }
            }else{
                echo '<tr><td class="empty" colspan="5">no orders placed yet!</td></tr>';
            }
            ?>
        </table>
    
    
           </div>
        </div>
<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>


</body>
</html>