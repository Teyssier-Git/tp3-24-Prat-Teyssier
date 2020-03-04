<!DOCTYPE html>
<?php
require_once('tp3-helpers.php');
require_once('model.php');
require_once('view_fonction.php');
?>
<html lang="en" dir="ltr">
<head>;
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
  <body>
      <?php
      afficheTableId($_GET['film_key']);
      ?>
  </body>
</html>
