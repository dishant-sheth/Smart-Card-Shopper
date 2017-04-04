<?php

include 'header.php';
include 'dbh.php'

 ?>
 <head>
     <link rel='stylesheet' type='text/css' href='main.css'>
 </head>
 <?php

  //Error reporting
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  ?>

 <?php
   //session handler

   if(!isset($_SESSION['id'])){
     header("Location: signup.php");
   }

  ?>

  <?php

  if(isset($_POST['item_to_adjust']) && $_POST['item_to_adjust']!= ""){

    $item_to_adjust = $_POST['item_to_adjust'];
    $quantity = $_POST['quantity'];

    $i=0;
    foreach ($_SESSION['cart_array'] as $each_item) {
      $i++;
      while (list($key, $value) = each($each_item)) {
        if ($key == "item_id" && $value == $item_to_adjust) {

          array_splice($_SESSION['cart_array'], $i-1, 1, array(array("item_id" => $item_to_adjust, "quantity" => $quantity)));


        }
      }
    }
    header("Location: cart.php");
    exit();

  }

   ?>

  <?php

  if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
    $wasfound = false;
    $i = 0;

    if(!isset($_SESSION['cart_array']) || count($_SESSION['cart_array'])<1){
      $_SESSION['cart_array'] = array(0 => array("item_id" => $pid, "quantity" => 1 ));
    }
    else{

      foreach ($_SESSION['cart_array'] as $each_item) {
        $i++;
        while (list($key, $value) = each($each_item)) {
          if ($key == "item_id" && $value == $pid) {

            array_splice($_SESSION['cart_array'], $i-1, 1, array(array("item_id" => $pid, "quantity" => $each_item['quantity'] + 1)));
            $wasfound = true;

          }
        }
      }

      if ($wasfound == false) {
        array_push($_SESSION['cart_array'], array("item_id" => $pid, "quantity" => 1));
      }

    }
    header("Location: cart.php");
    exit();

  }

   ?>

   <?php

   if(isset($_GET['cmd']) && $_GET['cmd']=="emptycart"){
     unset($_SESSION['cart_array']);
   }

    ?>

    <?php

    if(isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != ""){
      $key_to_remove = $_POST['index_to_remove'];
      echo $key_to_remove;
      if(count($_SESSION['cart_array']) <= 1){
        unset($_SESSION['cart_array']);
      }
      else{
        unset($_SESSION['cart_array'][$key_to_remove]);
        sort($_SESSION['cart_array']);

      }
    }

     ?>



  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Your cart</title>
      <style>
        .whole-cart {
          height: 70%;
          transform: translateY(20%);
          width: 95%;
          overflow: auto;
          margin: 0 auto;
          -webkit-box-shadow: 3px 1px 17px 0px rgba(0,0,0,0.3);
         -moz-box-shadow: 3px 1px 17px 0px rgba(0,0,0,0.5);
         box-shadow: 3px 1px 17px 0px rgba(0,0,0,0.3);
         font-size: 0;
        }

        .cart-item {
          height: 20%;
          width: 100%;
          font-size: 0;
          margin: 0;
        }

        .image-box,.item-name,.unit-price,.quan,.remove,.total {
          display: inline-table;
          vertical-align: top;
          margin: 0;
          height: 100%;
          border-right: 1px solid #0097A7;
          border-bottom: 1px solid #0097A7;
        }

        .image-box {
          width: 20%;
        }

        .item-name {
          width: 30%;
        }

        .unit-price {
          width: 15%;
        }

        .quan {
          width: 10%;
        }

        .total {
          width: 15%;
        }
        .remove {
          width: 9.5%;
        }

          .image-box p,.item-name p,.unit-price p,.quan p,.remove p,.total p {
            font-size: 20px;
            color: #0097A7;
            display: table-cell;
            vertical-align: middle;
            text-align: center;
          }

        #quantity {
          height: 25%;
          width: 30%;
          border: none;
          outline:  none;
          border-bottom: 2px solid #0097A7;
          margin: 0 auto;
          margin-top: 20%;
          font-size: 20px;
          margin-left: 35%;
          font-size: 25px;
          color: #0097A7;
          text-align: center;
        }

        .image-box img {
          height: 90%;
          width: 50%;
          margin-left: 25%;
          margin-top: 2%;
        }

        .g_total {
          height: 8%;
          width: 15%;
          border-radius: 5px;
          background: #0097A7;
          outline: none;
          border: none;
          color: white;
          display: flex;
          align-items: center;
          justify-content: center;
          position: absolute;
          left: 42.5%;
          bottom: 3%;
        }

        .g_total p {
          font-size: 20px;
          color: white;
        }

        .empty {
          height: 8%;
          width: 17%;
          border-radius: 5px;
          background: #0097A7;
          outline: none;
          border: none;
          color: white;
          display: flex;
          align-items: center;
          justify-content: center;
          position: absolute;
          left: 5%;
          bottom: 3%;
          text-decoration: none;
        }

        .empty a {
          text-decoration: none;
          color:white;
          font-size: 17px;
        }

        .edit {
          height: 10%;
          width: 50%;
          background: #0097A7;
          color: white;
          font-size: 15px;
          margin: 0 auto;
          margin-top: 5%;
          margin-left: 25%;
        }

        .b_remove {
          height: 10%;
          width: 50%;
          background: #0097A7;
          color: white;
          font-size: 15px;
          margin: 0 auto;
          margin-top: 35%;
          margin-left: 25%;
        }

    </style>

    </head>
    <body>


      <div class = "whole-cart">

                <?php

                  $cartOutput = "";
                  $cartTotal = 0;
                  if(!isset($_SESSION['cart_array']) || count($_SESSION['cart_array'])<1){
                    $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
                    echo $cartOutput;
                  }
                  else{
                    $i=0;
                    foreach ($_SESSION['cart_array'] as $each_item) {

                      $item_id = $each_item['item_id'];
                      $sql = "SELECT * FROM products WHERE id='$item_id' LIMIT 1";
                      $result = mysqli_query($conn, $sql);

                      while ($row = mysqli_fetch_array($result)) {
                          $pid = $row['id'];
                          $product_name = $row['product_name'];
                          $price = $row['price'];
                          $details = $row['details'];
                      }

                      $priceTotal = $price * $each_item['quantity'];
                      $cartTotal += $priceTotal;

                      $cartOutput = '<div class = "cart-item">
                      <div class = "image-box">
                        <img src = "inventory_images/'.$pid.'.jpg" alt="'.$product_name.'">
                      </div>
                      <div class = "item-name">
                        <p>'.$product_name.'</p>
                      </div>
                      <div class = "unit-price">
                        <p>'.$price.'</p>
                      </div>
                      <div class = "quan">
                        <form action = "cart.php" method = "post">
                          <input type = "text" name = "quantity" value = "'.$each_item['quantity'].'" id = "quantity">
                          <input type="hidden" name="item_to_adjust" value="'.$item_id.'">
                         <input type = "submit" name="adjustBtn'.$item_id.'" class = "edit" value="Edit" >
                       </form>
                      </div>
                      <div class = "total">
                        <p>Total</p>
                      </div>
                      <div class = "remove">
                        <form action = "cart.php" method = "POST">
                        <input type="hidden" name="index_to_remove" value="'.$i.'">
                         <input type = "submit" name="deleteBtn'.$item_id.'" class = "b_remove" value="Remove">

                       </form>
                    </div>
                  </div>';

                  echo $cartOutput;
                  $i++;
                  }
                  }

                 ?>

                 </div>
                 <div class = "g_total">
                   <p>Your Total: <?php echo $cartTotal; ?> </p>
                 </div>

                 <div class = "empty">
                     <a href="cart.php?cmd=emptycart"><p>Empty Your Cart</p></a>
                 </div>


      <script type = "text/javascript" src = "jquery.js"></script>
      <script type = "text/javascript" src = "login_main.js"></script>
    </body>
  </html>
