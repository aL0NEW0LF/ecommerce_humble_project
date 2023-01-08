<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js"></script>
    <script src="https://kit.fontawesome.com/5fba574a6f.js" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <div class="main" style="background-color: #EAEAEA;">
    <div class="quick-info-box-container">
                  <div class="quick-info-box">
                    <table>
                      <tr>
                        <td class="icon">
                          <i class="fas fa-users"></i> 
                        </td>
                      </tr>
                      <tr>
                        <td>
                        Utilisateurs
                        </td>
                      </tr>
                      <tr>
                        <td class="data">
                          <?php
                            $users_num_query = mysqli_query($conn, "SELECT count(user_idpk) as Users_num FROM `users`") or die('query failed');
                            $fetch_users_num = mysqli_fetch_assoc($users_num_query);
                            echo $fetch_users_num['Users_num'];
                          ?>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="quick-info-box">
                    <table>
                      <tr>
                        <td class="icon">
                          <i class="fas fa-money-bill-trend-up"></i>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Commandes
                        </td>
                      </tr>
                      <tr>
                        <td class="data">
                          <?php
                            $Orders_num_query = mysqli_query($conn, "SELECT count(orderid) as Orders_num FROM `order_details`") or die('query failed');
                            $fetch_Orders_num = mysqli_fetch_assoc($Orders_num_query);
                            echo $fetch_Orders_num['Orders_num'];
                          ?>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="quick-info-box">
                    <table>
                      <tr>
                        <td class="icon">
                          <i class="fas fa-money-bill-transfer"></i>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Dépenses totales
                        </td>
                      </tr>
                      <tr>
                        <td class="data">
                          <?php
                            $Orders_total_query = mysqli_query($conn, "SELECT sum(total) as Orders_total FROM `order_details`") or die('query failed');
                            $fetch_Orders_total = mysqli_fetch_assoc($Orders_total_query);
                            echo $fetch_Orders_total['Orders_total'];
                          ?>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="quick-info-box">
                    <table>
                      <tr>
                        <td class="icon">
                          <i class="fas fa-user-shield"></i>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Admins
                        </td>
                      </tr>
                      <tr>
                        <td class="data">
                          <?php
                            $Admins_num_query = mysqli_query($conn, "SELECT count(user_idpk) as Admins_num FROM `users` WHERE user_type = 'admin'") or die('query failed');
                            $fetch_Admins_num = mysqli_fetch_assoc($Admins_num_query);
                            echo $fetch_Admins_num['Admins_num'];
                          ?>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>

                
    </div>

    
</body>
</html>
