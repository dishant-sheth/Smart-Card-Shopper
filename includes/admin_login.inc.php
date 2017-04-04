<?php
session_start();
include '../dbh.php';

$uid = $_POST['username'];
$pwd = $_POST['password'];

if(empty($uid)){
    header("Location: ../signup.php?error=empty");
    exit();
}
elseif(empty($pwd)){
    header("Location: ../signup.php?error=empty");
    exit();
}
else{
$sql = "SELECT * FROM admin WHERE username='$uid' AND password='$pwd' ";

$result = mysqli_query($conn, $sql);

if(!$row = mysqli_fetch_assoc($result)){
  echo "Your credentials are incorrect";
}
else{
   $_SESSION['id'] = $row['id'];
}

header("Location: ../admin/admin_index.php");
}
?>
