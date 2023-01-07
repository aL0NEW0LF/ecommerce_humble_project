<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_brand'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['desc']);
 
    $select_brand_name = mysqli_query($conn, "SELECT brand_name FROM `product_brand` WHERE brand_name = '$name'") or die('query failed');
 
    if(mysqli_num_rows($select_brand_name) > 0){
       $message[] = 'brand name already added';
    }else{
       $add_product_query = mysqli_query($conn, "INSERT INTO `product_brand`(brand_name, brand_description, created_at) VALUES('$name', '$description', CURRENT_TIMESTAMP())") or die('query failed');
    }
 }

 if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `product_brand` WHERE brand_id = '$delete_id'") or die('query failed');
    header('location:admin_brands.php');
 }

 if(isset($_POST['update_brand'])){

    $update_b_id = $_POST['update_b_id'];
    $update_name = $_POST['update_brand_name'];
    $update_desc = $_POST['update_brand_desc'];

    mysqli_query($conn, "UPDATE `product_brand` SET brand_name = '$update_name', brand_description = '$update_desc' WHERE brand_id = '$update_b_id'") or die('query failed');
  
    header('location:admin_brands.php');
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
                <div class="add-product">
                    <form id="add-brand" action="" method="post" enctype="multipart/form-data">
                        <table>
                        <tr>
                              <td>
                                <h1 class="title">add brand</h1>
                              </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="name" placeholder="enter brand name" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea rows="4" cols="50" name="desc" form="add-brand" placeholder="Brand description" id="desc"></textarea>              
                                </td>
                            </tr>
                            <tr>
                                <td>
                                  <input type="submit" value="add brand" name="add_brand" class="btn">
                              </td>
                            </tr>
                        </table>
                    </form>
                </div>

 <h1 class="title">Brands</h1>
<table>
    <tr>
                <th class="name">
                    Brand
                </th>
                <th class="description">
                    Brand description
                </th>
    </tr>
    <?php
      $select_orders = "SELECT * FROM `product_brand`;";
      $result = $conn->query($select_orders);
      if(mysqli_num_rows($result) > 0){
        while($rows=$result->fetch_assoc())
        {
      ?>
            <tr>
                <td class="name">
                    <?php echo $rows['brand_name'];?>
                </td>
                <td class="description">
                    <?php echo $rows['brand_description'];?>
                </td>
                <td>
                    <a href="admin_brands.php?update=<?php echo $rows['brand_id']; ?>" class="delete-btn" style="margin: 0 0 5px 0;">update brand</a>
                    <a href="admin_brands.php?delete=<?php echo $rows['brand_id']; ?>" onclick="return confirm('delete this brand?');" class="delete-btn">delete brand</a>
                </td>
            </tr>
            <?php
                }
                ?>
        </table>
    
    <?php
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
    </div>
</div>
<section class="edit-product-form">

<?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `product_brand` WHERE brand_id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>

          <form id="update-brand" action="" method="post" enctype="multipart/form-data">
          <table>
                        <tr>
                              <td colspan="2">
                                <h1 class="title">update brand</h1>
                              </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <input type="hidden" name="update_b_id" value="<?php echo $fetch_update['brand_id']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="text" name="update_brand_name" value="<?php echo $fetch_update['brand_name']; ?>" placeholder="update brand name">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea rows="4" cols="50" name="update_brand_desc" form="update-brand" placeholder="Brand description" id="update_desc"><?php echo $fetch_update['brand_description']; ?></textarea>              
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <input type="submit" value="update product" name="update_brand" class="btn">
                            </td>
                            <td>
                                <input type="reset" value="cancel" id="close-update" style="margin: 0 0 0 5px; width: calc(100% - 5px);">
                            </td>
                            </tr>
                        </table>
        </form>
        <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>
       </section>
<!-- custom admin js file link  -->
<script>
 document.querySelector('#close-update').onclick = () =>{
   document.querySelector('.edit-product-form').style.display = 'none';
   window.location.href = 'admin_brands.php';
}
</script>

</body>
</html>