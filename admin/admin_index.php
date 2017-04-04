<?php

  session_start();

 ?>

 <?php

 if(isset($_SESSION['id'])){

   echo "
   <html>
     <head>
       <meta charset='utf-8'>
       <title>Admin Page</title>
       <link rel='stylesheet' href='../style/admin_login_css.css' type='text/css'>
     </head>
     <body>

       <h2>Hello Store Manager !</h2>
       <h3>What would you like to do today?</h3>

       <nav>
         <ul>
           <li><a href='manage_inventory.php'>Manage Inventory</a></li>
           <li><a href='#'>Do something else</a></li>
           <li><a href='../includes/logout.inc.php'>LOG OUT</a><li>
         </ul>
       </nav>

     </body>
   </html>";

 }
 else{
   header("Location: admin_login.php");
 }

  ?>
