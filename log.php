<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>member</title>
  </head>
  <body>
    <p>
      <?php echo "hello !! " .$_SESSION["username"]; ?>
    </p>

  </body>
</html>
