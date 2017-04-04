<?php
  include 'header.php';
?>

<head>
    <link rel='stylesheet' type='text/css' href='main.css'>
</head>

<?php

    $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    if(strpos($url, 'error=empty') !== false){
        echo "Fill all fields please";
    }
    elseif (strpos($url, 'error=username') !== false) {
      echo "username already exists";
    }

    if(isset($_SESSION['id'])){
      echo "<h2 style='text-align:center;'>Already logged in</h2>";
    }
    else {
      echo "<h2 style='text-align:center;'>Not logged in</h2>";;
    }

   ?>


<?php

if(isset($_SESSION['id'])){
  echo "Already logged in";
}
else {
  echo '<div class = "main-content">
      <div class = "content-box">
          <div class = "login-form">
              <p>Login</p>
              <form id = "login" method = "POST" action = "includes/login.inc.php">

                  <input type = "text" name = "uid" placeholder="Mobile Number">
                  <input type = "password" name = "pwd" placeholder="Password"><br>
                  <button class = "login-submit">Login</button>
                  <p id = "new-user">New User? Then <span id = "link-to-reg">Signup</span></p>
              </form>
          </div>
          <div class = "register-form">
              <p>Register</p>
               <form id = "register" method = "POST" action = "includes/signup.inc.php">
               <input type="text" name="first" placeholder="Firstname" />
               <input type="text" name="last" placeholder="Lastname" />
                    <input type = "text" name = "uid" placeholder="Mobile Number">
                    <input type = "password" name = "pwd" placeholder="Password">
                    <input type = "text" name = "bank_number" placeholder = "Bank Account Number"><br>
                    <button class = "login-submit">Register</button>
              </form>
          </div>
      </div>
  </div>';
}




?>
<script type = "text/javascript" src = "jquery.js"></script>
<script type = "text/javascript" src = "main.js"></script>
<script type = "text/javascript" src = "login_main.js"></script>
</body>
</html>
