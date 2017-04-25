<?php

include 'header.php';
include 'dbh.php';

 ?>

 <head>

   <link rel='stylesheet' type='text/css' href='main.css'>
   <style>

   .card{
     box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
     height: 75%;
     width: 30%;
     float: left;
     margin-left: 35px;
     margin-top: 130px;
   }

   .card:hover {
     box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
   }

   .container {
     padding: 2px 16px;
   }

   .image {
     height: 55%;
     width: 100%;
     display: inline-flex;
     vertical-align: top;
     align-items: center;
     justify-content: center;

   }

   .image img {
     height: 100%;
     width: 80%;
     align-self: center;
   }

   .pay {
     background: #0097A7;
     height: 8%;
     width: 35%;
     outline: none;
     border: none;
     color: white;
     font-size: 17px;
     align-self: center;

   }

   .smart-card input {
       height: 8%;
       width: 40%;
       border: none;
       outline: none;
       border-bottom: 2px solid #0097A7;
       font-size: 20px;
       align-self: center;
   }

   .smart-card input::placeholder {
       color: #0097A7;
       font-size: 20px;
       align-self: center;
   }

   .payment a {
     text-decoration: none;
     color:white;
     font-size: 17px;
     display: block;
   }

   .payment {
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
     align-self: center;
     margin-top: 15px;
     text-decoration: none;
   }


   </style>

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

   if(isset($_GET['total'])){
        $amount = $_GET['total'];
      }

    ?>

   <div class="card">
     <div class="image">
     <img src="inventory_images/qr.jpg" alt="QR code">
     </div>
     <div class="container">
       <h4><b>Paytm</b></h4>
       <p>Pay your bill by scanning the Paytm QR code given above
       </p>
       <div class="payment">
         <a href="bill.php"><p>Generate Receipt</p></a>

       </div>
     </div>
   </div>

   <div class="card">
     <div class="image">
     <img src="inventory_images/6.jpg" alt="Smart Card" >
   </div>
     <div class="container">
       <h4><b>SMART CARD</b></h4>
       <p>Pay your bill by using the Smart Card.</p>
       <form class="smart-card" action="includes/payment.inc.php" method="post">
         <input type="text" name="pin" placeholder="Enter pin" maxlength="4" >
         <input type="hidden" name="total" value="<?php echo $amount; ?>">
         <br/>
         <input type="submit" class = "pay" name="button" value="Pay"/>
       </form>
     </div>
   </div>

   <div class="card">
     <div class="image">
     <img src = "inventory_images/images.jpg">
     </div>
     <div class="container">
       <h4><b>CASH</b></h4>
       <p>If you choose to pay by cash, kindly move to the nearest cash counter.</p>
       <div class="payment">
         <a href="bill.php"><p>Generate Receipt</p></a>

       </div>
     </div>
   </div>

   <script type = "text/javascript" src = "jquery.js"></script>
   <script type = "text/javascript" src = "login_main.js"></script>
