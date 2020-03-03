<!DOCTYPE html>
<?php
require_once('tp3-helpers.php');
?>
<html lang="en" dir="ltr">
<head>;
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
  <body>
      <?php
      afficheTableId($_GET['film_key']);
      for ($i = 120; $i<123; $i++) {
          afficheTableId($i);
      }
      ?>
  </body>
</html>
