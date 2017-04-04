<?php

include 'header.php';

 ?>

 <head>
     <link rel='stylesheet' type='text/css' href='main.css'>
     <style type = "text/css">
      .product-main {
        height: 70%;
        width: 60%;
        margin: 0 auto;
        transform: translateY(25%);
        font-size: 0;
        -webkit-box-shadow: 3px 1px 17px 0px rgba(0,0,0,0.3);
       -moz-box-shadow: 3px 1px 17px 0px rgba(0,0,0,0.5);
       box-shadow: 3px 1px 17px 0px rgba(0,0,0,0.3);
      }

      .img-box {
        height: 100%;
        width: 30%;
        display: inline-flex;
        vertical-align: top;
        align-items: center;
        justify-content: center;
        border-right: 2px solid #0097A7;
      }

      .img-box img {
        margin-left: 38px;
        height: 35%;
        width: 70%;
        text-align: center;
      }

      .con-box {
        height: 100%;
        width: 60%;
        display: inline-block;
        vertical-align: top;
      }

      .name {
        margin-top: 15%;
        font-size: 30px;
      }

      .price {
        font-size: 25px;
      }

      .category,.details {
        font-size: 21px;
      }

      .add {
        background: #0097A7;
        height: 8%;
        width: 35%;
        outline: none;
        border: none;
        color: white;
        font-size: 17px;
        margin-left: 50px;
      }

      .con-box p {
        color: #0097A7;
        line-height: 10px;
        padding-left: 10%;
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

if(isset($_GET['id'])){
  $id = $_GET['id'];
  include 'dbh.php';
  $dynamicList = "";
  $sql = "SELECT * FROM products WHERE id='$id' LIMIT 1";
  $result = mysqli_query($conn, $sql);

  $count = $result->num_rows;

  if($count > 0){

    while($row = mysqli_fetch_assoc($result))
    {

      $name = $row['product_name'];
      $price = $row['price'];
      $date_added = strftime("%b %d %Y", strtotime($row['date_added']));
      $category = $row['category'];
      $sub = $row['sub_category'];
      $details = $row['details'];
    }

}
  else{
    echo "Item not found.";
  }

mysqli_close($conn);

}
else{
  echo "Error 404. Page not found!";
}


 ?>

 <html>
   <head>
     <meta charset="utf-8">
     <title><?php echo $name; ?></title>
   </head>
   <body>


     <div class = "product-main">
       <div class = "img-box">
         <a href="inventory_images/<?php echo $id; ?>.jpg"><img src = "inventory_images/<?php echo $id; ?>.jpg"></a>
       </div>
       <div class = 'con-box'>
         <p class = "name"><?php echo $name; ?></p><br>
         <p class = "price"><?php echo "Rs.".$price; ?></p><br>
         <p class = "category"><?php echo $category; ?></p><br>
         <p class = "details"><?php echo $details; ?></p><br>
         <br>
         <form action="cart.php" method="post" >
           <input type="hidden" name="pid" value="<?php echo $id; ?>"/>
           <input type="submit" class = "add" name="button" value="Add to shopping cart"/>
         </form>
       </div>
     </div>

     <script type = "text/javascript" src = "jquery.js"></script>
     <script type = "text/javascript" src = "login_main.js"></script>
   </body>
 </html>
