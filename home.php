<?php

include 'header.php';

 ?>
 <head>
     <link rel='stylesheet' type='text/css' href='main.css'>
     <style type = "text/css">

        .nav {
          z-index: 99;
        }
        .product-list {
          height: 100%;
          transform: translateY(15%);
          overflow: hidden;
          width: 50%;
          margin: 0 auto;
        }

        .product {
          height: 17%;
          width: 100%;
          font-size: 0;
          border-bottom: 2px solid #0097A7;
        }

        .product img {
          height: 94%;
          width: 15%;
        
          display: inline-block;
          vertical-align: top;
        }

        .product-content {
          height: 94%;
          width: 70%;
          display: inline-block;
          vertical-align: top;
          position: relative;
        }

        .product-id {
          font-size: 15px;
        }

        .product-name {
          font-size: 20px;
        }


        .product-price {
          font-size: 17px;
        }

        .product-content p{
          line-height: 10px;
          padding-left: 5%;
          color: #0097A7;
        }

        .view {
          background: #0097A7;
          height: 28%;
          width: 25%;
          outline: none;
          border: none;
          color: white;
          position: absolute;
          right: 0;
          bottom: 5%;
          font-size: 16px;
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


<div class = "product-list">


        <?php

        //Get the latest items
        include 'dbh.php';
        $dynamicList = "";
        $sql = "SELECT * FROM products ORDER BY date_added DESC LIMIT 5";
        $result = mysqli_query($conn, $sql);

        $count = $result->num_rows;

        if($count > 0){

          while($row = mysqli_fetch_assoc($result))
          {
            $id = $row['id'];
            $name = $row['product_name'];
            $price = $row['price'];
            $date_added = strftime("%b %d %Y", strtotime($row['date_added']));
            $dynamicList = '<div class = "product">
              <img src = "inventory_images/'. $id .'.jpg" alt="'. $name .'">
              <div class = "product-content">
                <p class = "product-id">'. $id .'</p>
                <p class = "product-name">'. $name .'</p>
                <p class = "product-price">Rs. '. $price .'</p>
                <a href="product.php?id='.$id.'">
                  <button type = "submit" class = "view">View</button>
                  </a>
              </div>
            </div>';

            echo $dynamicList;


          }

        }
        else{
          $product_list = "Sorry! No products here !";
        }
        mysqli_close($conn);

         ?>
</div>

<script type = "text/javascript" src = "jquery.js"></script>
<script type = "text/javascript" src = "login_main.js"></script>
</body>
</html>
