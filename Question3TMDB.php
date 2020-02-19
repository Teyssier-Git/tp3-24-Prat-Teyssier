<!DOCTYPE html>
<?php
require_once('tp3-helpers.php');
$data = json_decode(tmdbget("movie/".$_GET['film_key']), TRUE);
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Film info : <?php echo $data["title"]?></title>
  </head>
  <body>
    <h2>Titre du film : <?php echo $data["title"]?></h2>
    <h4>Titre original : <?php echo $data["original_title"]?></h4>
    <h4>Tag : <?php echo ($data["tagline"]!=NULL ? $data["original_title"] : "Aucun")?></h4>
    <h4>Description :</h4>
    <p><?php echo $data["overview"]?></p>
    <h5>Retrouver plus d'information : <a href="<?php echo $data["homepage"]?>">ICI</a></h4>
  </body>
</html>
