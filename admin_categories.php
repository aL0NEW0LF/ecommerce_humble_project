<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_category'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['desc']);
 
    $select_category_name = mysqli_query($conn, "SELECT category_name FROM `product_category` WHERE category_name = '$name'") or die('query failed');
 
    if(mysqli_num_rows($select_category_name) > 0){
       $message[] = 'category already added';
    }else{
       $add_category_query = mysqli_query($conn, "INSERT INTO `product_category`(category_name, category_description, created_at) VALUES('$name', '$description', CURRENT_TIMESTAMP())") or die('query failed');
    }
 }

 if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `product_category` WHERE category_id = '$delete_id'") or die('query failed');
    header('location:admin_categories.php');
 }

 if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `product_category` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_categories.php');
 }

 if(isset($_POST['update_category'])){

    $update_c_id = $_POST['update_c_id'];
    $update_name = $_POST['update_category_name'];
    $update_desc = $_POST['update_category_desc'];

    mysqli_query($conn, "UPDATE `product_category` SET category_name = '$update_name', category_description = '$update_desc' WHERE category_id = '$update_c_id'") or die('query failed');
  
    header('location:admin_categories.php');
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://kit.fontawesome.com/5fba574a6f.js" crossorigin="anonymous"></script>
   <title>Catégories</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<div class="main">
                <div class="add-product">
                    <form id="add-cat" action="" method="post" enctype="multipart/form-data">
                        <table>
                        <tr>
                              <td>
                                <h1 class="title">Ajouter une catégorie</h1>
                              </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="name" placeholder="enter product name" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea rows="4" cols="50" name="desc" form="add-cat" placeholder="description de la category" id="desc"></textarea>              
                                </td>
                            </tr>
                            <tr>
                                <td>
                                  <input type="submit" value="add category" name="add_category" class="btn">
                              </td>
                            </tr>
                        </table>
                    </form>
                </div>

 <h1 class="title"> Catégories </h1>
<table>
    <tr>
                <th class="name">
                Nom de la catégorie
                </th>
                <th class="description">
                Description de la catégorie
                </th>
    </tr>
    <?php
      $select_orders = "SELECT * FROM `product_category`;";
      $result = $conn->query($select_orders);
      if(mysqli_num_rows($result) > 0){
        while($rows=$result->fetch_assoc())
        {
      ?>
            <tr>
                <td class="name">
                    <?php echo $rows['category_name'];?>
                </td>
                <td class="description">
                    <?php echo $rows['category_description'];?>
                </td>
                <td>
                    <a href="admin_categories.php?update=<?php echo $rows['category_id']; ?>" class="delete-btn" style="margin: 0 0 5px 0;">modifier la catégorie</a>
                    <a href="admin_categories.php?delete=<?php echo $rows['category_id']; ?>" onclick="return confirm('delete this brand?');" class="delete-btn">supprimer la catégorie</a>
                </td>
            </tr>
            <?php
                }
                }else{
         echo '<tr><td colspan="2" class="empty">Aucune commande n’a encore été passée!<tr></td>';
      }
                ?>
        </table>
    </div>
</div>

<section class="edit-product-form">

<?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `product_category` WHERE category_id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>

          <form id="update-category" action="" method="post" enctype="multipart/form-data">
          <table>
                        <tr>
                              <td colspan="2">
                                <h1 class="title">modifier la catégorie</h1>
                              </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <input type="hidden" name="update_c_id" value="<?php echo $fetch_update['category_id']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="text" name="update_category_name" value="<?php echo $fetch_update['category_name']; ?>" placeholder="update category name">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea rows="4" cols="50" name="update_category_desc" form="update-category" placeholder="category description" id="update_desc"><?php echo $fetch_update['category_description']; ?></textarea>              
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <input type="submit" value="update product" name="update_category" class="btn">
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
   window.location.href = 'admin_categories.php';
}
</script>


</body>
</html>