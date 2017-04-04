<?php
  //session handler
  session_start();
  if(!isset($_SESSION['id'])){
    header("Location: admin_login.php");
  }

 ?>

 <?php

  //Error reporting
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  ?>

  <?php

  if(isset($_GET['pid'])){
    //display all products

    $targetID = $_GET['pid'];

    include '../dbh.php';
    $product_list = "";
    $sql = "SELECT * FROM products WHERE id='$targetID'";
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
      $product_list = "Sorry! No such product found !";
 }
  }


   ?>

   <?php

   //add products to products db

     if(isset($_POST['name'])){

     include '../dbh.php';

     $pid = $_POST['thisID'];
     $pname = $_POST['name'];
     $pprice = $_POST['price'];
     $pcategory = $_POST['category'];
     $psub = $_POST['sub-category'];
     $pdetails = $_POST['details'];

     $sql = "UPDATE products SET product_name='$pname',price='$pprice',details='$pdetails',category='$pcategory',sub_category='$psub' WHERE id='$pid'";
     $result = mysqli_query($conn, $sql);

     if($_FILES['image']['tmp_name'] != ""){
     $newname = "$pid.jpg";
     $root = getcwd();
     move_uploaded_file($_FILES['image']['tmp_name'], "/opt/lampp/htdocs/rishav/inventory_images/$newname");
   }
     header("Location: manage_inventory.php");
     exit();

  }
    ?>


   <html>
     <head>
       <meta charset="utf-8">
       <title></title>
     </head>
     <body>

       <form action="inventory_edit.php" method="post" enctype="multipart/form-data" name="myForm" id="myForm">
       <table border="1px" cellspacing="5px" cellpadding="15px">
         <tr>
           <td>Product Name</td>
           <td><input type="text" name="name" size="64" value="<?php echo $name; ?>"></td>
         </tr>
         <tr>
           <td>Product Price</td>
           <td><input type="text" name="price" size="11" value="<?php echo $price; ?>"></td>
         </tr>
         <tr>
           <td>Category</td>
           <td><input type="text" name="category" value="<?php echo $category; ?>"></td>
         </tr>
         <tr>
           <td>Sub-Category</td>
           <td><input type="text" name="sub-category" value="<?php echo $sub; ?>"></td>
         </tr>
         <tr>
           <td>Product Details</td>
           <td><textarea name="details" cols="64" rows="5"><?php echo $details; ?></textarea></td>
         </tr>
         <tr>
           <td>Product Image</td>
           <td><input type="file" name="image"></td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td>
             <input type="hidden" name="thisID" value="<?php echo $targetID; ?>">
             <input type="submit" name="button" value="Make Changes"></td>
         </tr>
       </table>
     </form>

     </body>
   </html>
