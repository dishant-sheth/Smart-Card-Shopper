<?php

session_start();

 ?>
<html>
<head>
  <title>Registration</title>
</head>
<body>

  <div class  = "nav">
    <div class = "nav-name">
        <p>Smart Billing</p>
    </div>



        <?php

        if(isset($_SESSION['id'])){
          echo '
          <ul class = "nav-list">
              <li id = "logout" >
                <form id = "l-f" action="includes/logout.inc.php" method="post">
                </form>
                <p>Logout</p>
              </li>
              <li id = "cart" >
                <form id = "c-f" action="cart.php" method="post">
                </form>
                <p>Cart</p>
              </li>
              <li id = "all_products">
                <form id = "a-p" action="home.php" method="post">
                </form>
                <p>All Products</p>
              </li>
          </ul>
          ';
        }
        else {
          echo "<ul class = 'nav-list'>
              <li id = 'login'><p>Login</p></li>
              <li id = 'reg'><p>Register</p></li>
          </ul>";
        }


         ?>


</div>
