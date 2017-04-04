<?php

include 'header.php';

 ?>


<?php

$uid = $_GET['id'];

include 'dbh.php';

$sql = "SELECT * FROM user WHERE uid='$uid' LIMIT 1 ";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$first = $row['first'];
$last = $row['last'];
$uid = $row['uid'];
$bank_no = $row['bank_number'];
$pin = $row['pin'];

 ?>


<head>

  <link rel='stylesheet' type='text/css' href='login_main.css'>
</head>
<div class = "main-content">
    <div class = "content-box">
       <p class = "main-head">Hello <?php echo $first; ?></p>
       <p class = "sub-title">Here's all the information you need.</p>
       <p class = "info"><span>Name :</span> <?php echo $first." ".$last; ?></p>
       <p class = "info"><span>Mobile Number :</span> <?php echo $uid; ?></p>
       <p class = "info"><span>Bank Account Number :</span> <?php echo $bank_no; ?> </p>
       <p class = "info"><span> 4-Digit PIN :</span> <?php echo $pin; ?></p>
    </div>
</div>

<script type = "text/javascript" src = "jquery.js"></script>
<script type = "text/javascript" src = "main.js"></script>
<script type = "text/javascript" src = "login_main.js"></script>
</body>
</html>
