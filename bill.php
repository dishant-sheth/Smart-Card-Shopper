<?php

include 'header.php';
include 'dbh.php';

 ?>

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

  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Your cart</title>
      <link rel='stylesheet' type='text/css' href='main.css'>
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
         text-align: center;
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
          border-left: 1px solid #0097A7;
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


    </style>

    </head>
    <body>


      <div class = "whole-cart">
        <div class = "cart-item">
        <div class = "item-name">
          <p style="color:black; "><strong>PRODUCT NAME</strong></p>
        </div>
        <div class = "unit-price">
          <p style="color:black; "><strong>PRICE</strong></p>
        </div>
        <div class = "quan">
            <p style="color:black; "><strong>QUANTITY</strong></p>
        </div>
        <div class = "total">
          <p style="color:black; "><strong>AMOUNT</strong></p>  
        </div>
      </div>


<?php

$cartOutput = "";
$cartTotal = 0;
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
  <div class = "item-name">
    <p>'.$product_name.'</p>
  </div>
  <div class = "unit-price">
    <p>'.$price.'</p>
  </div>
  <div class = "quan">
      <p>'.$each_item['quantity'].'</p>
  </div>
  <div class = "total">
    <p>'.$priceTotal.'</p>
  </div>
</div>
</div>';

echo $cartOutput;
$i++;
}

?>

</div>
<div class = "g_total">
  <p>Your Total: <?php echo $cartTotal; ?> </p>
</div>
<script type = "text/javascript" src = "jquery.js"></script>
<script type = "text/javascript" src = "login_main.js"></script>
