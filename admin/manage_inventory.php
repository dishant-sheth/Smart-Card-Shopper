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
  //Delete items in admin section

  if(isset($_GET['deleteid'])){

    $did = $_GET['deleteid'];
    echo "Do you really want to delete product with id -".$_GET['deleteid']." ? <a href='manage_inventory.php?yesdelete=".$did."'>YES</a> | <a href='manage_inventory.php'>NO</a>";
    exit();
  }

  //Permanently remove
  if(isset($_GET['yesdelete'])){

    include '../dbh.php';

    $id_to_delete = $_GET['yesdelete'];
    $sql = "DELETE FROM products WHERE id='$id_to_delete'";
    $result = mysqli_query($conn, $sql);

    $pic_to_delete = ("/opt/lampp/htdocs/rishav/inventory_images/$id_to_delete.jpg");
    if(file_exists($pic_to_delete)){
      unlink($pic_to_delete);
    }
    header("Location: manage_inventory.php");
  }


   ?>

  <?php

  //add products to products db

    if(isset($_POST['name'])){

    include '../dbh.php';

    $pname = $_POST['name'];
    $pprice = $_POST['price'];
    $pcategory = $_POST['category'];
    $psub = $_POST['sub-category'];
    $pdetails = $_POST['details'];

    $sql = "SELECT product_name FROM products WHERE product_name='$pname'";
    $result = mysqli_query($conn, $sql);
    $pnamecheck = mysqli_num_rows($result);

    if($pnamecheck > 0){
      echo "Sorry! Product already exists with same name. To try again, <a href='manage_inventory.php'>CLICK HERE</a>";
      exit();
    }

    //Add product

    $sql = "INSERT INTO products (product_name, price, details, category, sub_category, date_added) VALUES  ('$pname', '$pprice', '$pdetails', '$pcategory', '$psub', now())";
    $result = mysqli_query($conn, $sql);

    $pid = mysqli_insert_id($conn);

    $newname = "$pid.jpg";
    $root = getcwd();
    move_uploaded_file($_FILES['image']['tmp_name'], "/opt/lampp/htdocs/rishav/inventory_images/$newname");

    header("Location: manage_inventory.php");
    exit();

 }
   ?>






    <html>
      <head>
        <meta charset="utf-8">
        <title>Admin Page</title>

      </head>
      <body>

        <h2>Hello Store Manager !</h2>
        <p>Manage your Inventory here.</p>

        <hr />

        <?php

           //display all products
           include '../dbh.php';
           $product_list = "";
           $sql = "SELECT * FROM products";
           $result = mysqli_query($conn, $sql);

           $count = $result->num_rows;

           if($count > 0){

             while($row = mysqli_fetch_assoc($result))
             {
               $id = $row['id'];
               $name = $row['product_name'];
               $product_list = $id." - ".$name."&nbsp; &nbsp; &nbsp; <a href='inventory_edit.php?pid=$id'>edit</a> &bull; <a href='manage_inventory.php?deleteid=$id'>delete</a> <br />";
               echo $product_list;
             }

           }
           else{
             $product_list = "Sorry! No products here !";
        }

         ?>

         <hr />


         <br/>
         <br>
         <br>

         <form action="manage_inventory.php" method="post" enctype="multipart/form-data" name="myForm" id="myForm">
         <table border="1px" cellspacing="5px" cellpadding="15px">
           <tr>
             <td>Product Name</td>
             <td><input type="text" name="name" size="64"></td>
           </tr>
           <tr>
             <td>Product Price</td>
             <td><input type="text" name="price" size="11"></td>
           </tr>
           <tr>
             <td>Category</td>
             <td><input type="text" name="category"></td>
           </tr>
           <tr>
             <td>Sub-Category</td>
             <td><input type="text" name="sub-category"></td>
           </tr>
           <tr>
             <td>Product Details</td>
             <td><input type="textarea" name="details" cols="64" rows="5"></td>
           </tr>
           <tr>
             <td>Product Image</td>
             <td><input type="file" name="image"></td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td><input type="submit" name="button" value="Add this item now"></td>
           </tr>
         </table>
       </form>
      </body>
</html>
