<?php

  session_start();

 ?>

 <!DOCTYPE html>

     <?php

       echo "
       <html>
         <head>
           <meta charset='utf-8'>
           <title>Admin Login</title>
           <link rel='stylesheet' href='../style/admin_login_css.css' type='text/css'>
         </head>
         <body>
       <div class = 'login-form'>
            <p>Admin Login</p>
            <form id = 'login' method = 'POST' action = '../includes/admin_login.inc.php'>
                <input type = 'text' name = 'username' placeholder='Username'>
                <input type = 'password' name = 'password' placeholder='Password'><br>
                <button class = 'login-submit'>Login</button>
            </form>
        </div>
        </body>
      </html>";


      ?>
