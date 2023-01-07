<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['add_product'])){

    $name = $_POST['name'];
    $description = $_POST['desc'];
    $product_category = $_POST['select-cat'];
    $product_inventory = $_POST['inventory'];
    $product_price = $_POST['price'];
    $product_category_id = mysqli_query($conn, "SELECT category_id FROM product_category WHERE category_name = '$product_category'");
    $category_row = $product_category_id->fetch_assoc();
    $cat_id = $category_row['category_id'];

    $select_product_name = mysqli_query($conn, "SELECT name FROM `product` WHERE name = '$name'") or die('query failed');

    
    if(mysqli_num_rows($select_product_name) > 0){
       $message[] = 'product already added';
    }else{

        $file = $_FILES['product_picture'];

        $fileName = $_FILES['product_picture']['name'];
        $fileSize = $_FILES['product_picture']['size'];
        $fileTmpName = $_FILES['product_picture']['tmp_name'];
        $fileError = $_FILES['product_picture']['error'];
        $fileType = $_FILES['product_picture']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'png', 'jpeg');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true).".".$fileActualExt;

                    $fileDestination = 'images/'.$fileNameNew;

                    move_uploaded_file($fileTmpName,$fileDestination);
                } else {
                    echo "error";
                }
            } else {
                echo "error";
            }
        }
        else {
            echo "error";
        }

        move_uploaded_file($fileTmpName,$fileDestination);
        $Productpicinsert = $fileDestination.'.'.$fileType;
        $add_product_query = mysqli_query($conn, "INSERT INTO `product`(name, description, category_id_fk, inventory, price, created_at, product_picture) VALUES('$name', '$description', $cat_id, $product_inventory, $product_price, CURRENT_TIMESTAMP(), '$Productpicinsert')") or die('query failed');
    }
 }

 if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  $delete_image_query = mysqli_query($conn, "SELECT product_picture FROM `product` WHERE id = '$delete_id'") or die('query failed');
  $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
  $picture_to_delete = $fetch_delete_image['product_picture'];
  unlink($picture_to_delete);
  mysqli_query($conn, "DELETE FROM `product` WHERE id = '$delete_id'") or die('query failed');
  header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_desc = $_POST['update_desc'];
    $update_cat = $_POST['update_cat'];
    $update_inventory = $_POST['update_inventory'];
    $update_price = $_POST['update_price'];
    $update_product_category_id = mysqli_query($conn, "SELECT category_id FROM product_category WHERE category_name = '$update_cat'");
    $update_category_row = $update_product_category_id->fetch_assoc();
    $update_cat_id = $update_category_row['category_id'];

    $update_file = $_FILES['update_picture'];

    $update_fileName = $_FILES['update_picture']['name'];
    $update_fileSize = $_FILES['update_picture']['size'];
    $update_fileTmpName = $_FILES['update_picture']['tmp_name'];
    $update_fileError = $_FILES['update_picture']['error'];
    $update_fileType = $_FILES['update_picture']['type'];

    $update_fileExt = explode('.', $update_fileName);
    $update_fileActualExt = strtolower(end($update_fileExt));

    $allowed = array('jpg', 'png', 'jpeg');

    if (in_array($update_fileActualExt, $allowed)) {
        if ($update_fileError === 0) {
            if ($update_fileSize < 1000000) {
                $update_fileNameNew = uniqid('', true).".".$update_fileActualExt;

                $update_fileDestination = 'images/'.$update_fileNameNew;

                move_uploaded_file($update_fileTmpName,$update_fileDestination);
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }
    else {
        echo "error";
    }

    mysqli_query($conn, "UPDATE `product` SET name = '$update_name', description = '$update_desc', category_id_fk = $update_cat_id, inventory = '$update_inventory', price = '$update_price', modified_at = CURRENT_TIMESTAMP(), product_picture = '$update_fileDestination' WHERE id = '$update_p_id'") or die('query failed');
  
    header('location:admin_products.php');
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
                <form id="add-product" action="" method="post" enctype="multipart/form-data">
                        <table>
                            <tr>
                              <td colspan="2">
                                <h1 class="title">add product</h1>
                              </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="text" name="name" class="box" placeholder="enter product name" required>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea rows="4" cols="50" name="desc" form="add-product" placeholder="description de la category" id="desc"></textarea>              
                                </td>
                            </tr>
                            <tr>
                              <td colspan="2">
                                <?php 
                                    $select_category_query ="SELECT `category_name` FROM `product_category`";
                                    $select_category_result = $conn->query($select_category_query);
                                    if($select_category_result->num_rows> 0){
                                    $category_options= mysqli_fetch_all($select_category_result, MYSQLI_ASSOC);
                                    }
                                ?>
                                  <select name="select-cat" id="select-cat">
                                    <?php 
                                        foreach ($category_options as $category_option) {
                                    ?>
                                        <option><?php echo $category_option['category_name']; ?> </option>
                                        <?php 
                                            }
                                        ?>
                                  </select>
                              </td>
                          </tr>
                          <tr>
                            <td colspan="2">
                                <input type="number" name="inventory" class="box" placeholder="enter product inventory" min="0" required>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">
                                <input type="number" name="price" class="box" placeholder="enter product price" min="0" required>
                            </td>
                          </tr>
                          <tr>  
                            <td>
                            <input type="file" id="file" name="product_picture" accept="image/png, image/jpeg">
                            <label for="file" class="picupload">La photo du produit</label>
                            </td>
                                <td>
                                  <input type="submit" value="add product" name="add_product" class="btn">
                              </td>
                            </tr>
                        </table>
                    </form>
                </div>

 <h1 class="title"> Products </h1>
<table>
    <tr>
                <th class="name">
                    Name
                </th>
                <th class="description">
                    Description
                </th>
                <th class="category">
                    Category
                </th>
                <th class="inventory">
                    Inventory
                </th>
                <th class="price">
                    Price
                </th>
    </tr>
    <?php
        $select_products = "SELECT * FROM `product`, `product_category` WHERE `category_id_fk` = `category_id` ORDER BY `product`.`created_at`;";      
        $result = $conn->query($select_products);
      if(mysqli_num_rows($result) > 0){
        while($rows=$result->fetch_assoc())
        {
      ?>
            <tr>
                <td class="name">
                    <?php echo $rows['name'];?>
                </td>
                <td class="description">
                    <?php echo $rows['description'];?>
                </td>
                <td class="category">
                    <?php echo $rows['category_name'];?>
                </td>
                <td class="inventory">
                    <?php echo $rows['inventory'];?>
                </td>
                <td class="price">
                    <?php echo $rows['price'];?>
                </td>
                <td>
                    <a href="admin_products.php?update=<?php echo $rows['productid']; ?>" class="option-btn" style="margin: 0 0 5px 0;">update product</a>
                    <a href="admin_products.php?delete=<?php echo $rows['productid']; ?>" onclick="return confirm('delete this product?');" id="delete" class="delete-btn">delete product</a>
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
<section class="edit-product-form">

<?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `product` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>

          <form id="update-product" action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                  <td colspan="2">
                    <h1 class="title">update product</h1>
                  </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="text" name="update_name" class="box" value="<?php echo $fetch_update['name']; ?>" placeholder="update product name">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea rows="4" cols="50" name="update_desc" form="update-product" placeholder="update product description" id="desc"><?php echo $fetch_update['description']; ?></textarea>              
                    </td>
                </tr>
                <tr>
                              <td>
                                <?php 
                                    $select_category_query ="SELECT `category_name`, `category_id` FROM `product_category`";
                                    $select_category_result = $conn->query($select_category_query);
                                    if($select_category_result->num_rows> 0){
                                    $category_options= mysqli_fetch_all($select_category_result, MYSQLI_ASSOC);
                                    }
                                ?>
                                  <select name="update_cat" id="update_cat">
                                    <?php 
                                        foreach ($category_options as $category_option) {
                                    ?>
                                        <option <?php if($category_option['category_id'] == $fetch_update['category_id_fk']) { echo 'selected';} ?>><?php echo $category_option['category_name']; ?> </option>
                                        <?php 
                                            }
                                        ?>
                                  </select>
                              </td>
                          </tr>
              <tr>
                <td colspan="2">
                    <input type="number" name="update_inventory" class="box" value="<?php echo $fetch_update['inventory']; ?>" placeholder="update product inventory" min="0">
                </td>
              </tr>
              <tr>
                <td colspan="2">
                    <input type="number" name="update_price" class="box" value="<?php echo $fetch_update['price']; ?>" placeholder="update product price" min="0">
                </td>
                </tr>
                <tr>
                  <td colspan="2" style="padding: 10px;">
                   <input type="file" id="update_picture" name="update_picture" accept="image/png, image/jpeg">
                   <label for="update_picture" class="picupload" style="padding: 14px 20px;">Votre photo</label>
                  </td>
                </tr>
                <tr>
                    <td>
                      <input type="submit" value="update product" name="update_product" class="btn">
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
   window.location.href = 'admin_products.php';
}
</script>


</body>
</html>
