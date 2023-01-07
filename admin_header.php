
<svg class="ham hamRotate ham4" viewBox="0 0 100 100" width="80" onclick="this.classList.toggle('active')">
  <path
        class="line top"
        d="m 70,33 h -40 c 0,0 -8.5,-0.149796 -8.5,8.5 0,8.649796 8.5,8.5 8.5,8.5 h 20 v -20" />
  <path
        class="line middle"
        d="m 70,50 h -40" />
  <path
        class="line bottom"
        d="m 30,67 h 40 c 0,0 8.5,0.149796 8.5,-8.5 0,-8.649796 -8.5,-8.5 -8.5,-8.5 h -20 v 20" />
</svg>
<div class="grid-container">
            <div class="sidebar">
                <h2 style="font-weight: 700;">ADMIN</h2>
                <p class="userinfo">username : <?php echo $_SESSION['admin_name']; ?></p>
                <p class="userinfo" style="margin-bottom: 20px;">email : <?php echo $_SESSION['admin_email']; ?></p>
                <a href="logout.php" class="logout-btn">logout</a>
                <ul>
                    <li><a href="admin_page.php"><i class="fas fa-home"></i>Home</a></li>
                    <li><a href="admin_categories.php"><i class="fas fa-list"></i>Categories</a></li>
                    <li><a href="admin_products.php"><i class="fas fa-barcode"></i>Products</a></li>
                    <li><a href="admin_orders.php"><i class="fas fa-money-bill-trend-up"></i>Orders</a></li>
                    <li><a href="admin_users.php"><i class="fas fa-users"></i>Users</a></li>
                </ul> 
                <div class="social_media">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
           </div>

