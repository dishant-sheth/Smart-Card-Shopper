<?php
session_start();
include '../dbh.php';

$uid = $_POST['uid'];
$pwd = $_POST['pwd'];

if(empty($uid)){
    header("Location: ../signup.php?error=empty");
    exit();
}
elseif(empty($pwd)){
    header("Location: ../signup.php?error=empty");
    exit();
}
else{
$sql = "SELECT * FROM user WHERE uid='$uid' AND pwd='$pwd' ";

$result = mysqli_query($conn, $sql);

if(!$row = mysqli_fetch_assoc($result)){
  echo "Your credentials are incorrect";
}
else{
   $_SESSION['id'] = $row['id'];
}

header("Location: ../home.php");
}
?>
