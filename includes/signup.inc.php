<?php
session_start();
include '../dbh.php';

$first = $_POST['first'];
$last = $_POST['last'];
$uid = $_POST['uid'];
$pwd = $_POST['pwd'];
$bank_no = $_POST['bank_number'];

function generatePIN($digits = 4){
    $i = 0;
    $pin = "";
    while($i < $digits){
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}

if(empty($first)){
    header("Location: ../signup.php?error=empty");
    exit();
}
if(empty($last)){
    header("Location: ../signup.php?error=empty");
    exit();
}
if(empty($uid)){
    header("Location: ../signup.php?error=empty");
    exit();
}
if(empty($pwd)){
    header("Location: ../signup.php?error=empty");
    exit();
}
if(empty($bank_no)){
    header("Location: ../signup.php?error=empty");
    exit();
}
else{

  $sql = "SELECT uid FROM user WHERE uid='$uid'";
  $result = mysqli_query($conn, $sql);
  $uidcheck = mysqli_num_rows($result);

  if($uidcheck > 0){
    header("Location: ../signup.php?error=username");
    exit();
  }
  $unique = 0;
  while ($unique == 0) {

  $pin = generatePIN();
  $sql = "SELECT pin FROM user WHERE pin='$pin'";
  $result = mysqli_query($conn, $sql);
  $pincheck = mysqli_num_rows($result);

  if($pincheck>0){

  }
  else{

  $sql = "INSERT INTO user (first, last, uid, pwd, bank_number, pin) VALUES ('$first', '$last', '$uid', '$pwd', '$bank_no', '$pin')";

  $result = mysqli_query($conn, $sql);

  $id = mysqli_insert_id($result);
    $unique = 1;

}
}

  $_SESSION['id'] = $uid;
  header("Location: ../login_result.php?id=$uid");
}

 ?>
