<?php
  session_start();
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

<?php

$id = $_SESSION['id'];
$pin = $_POST['pin'];
$total = $_POST['total'];

echo $id;

if(empty($pin)){
    header("Location: ../payment.php?error=empty&total=$total");
    exit();
}
else{
  include '../dbh.php';
  $sql = "SELECT * FROM user WHERE id='$id' LIMIT 1";
  $result = mysqli_query($conn, $sql);

  $row = mysqli_fetch_assoc($result);

      $dpin = $row['pin'];
      $balance = $row['Balance'];

    if($pin == $dpin){
      if($total <= $balance){
      $balance = $balance - $total;

      $sql = "UPDATE user SET Balance='$balance' WHERE id='$id'";
      $result = mysqli_query($conn, $sql);
      header("Location: ../payment.php?payment=successful&total=$total");
    }
    else{
      header("Location: ../payment.php?error=balance&total=$total");
    }
    }
    else{
      header("Location: ../payment.php?error=match&total=$total");
    }

}

 ?>
