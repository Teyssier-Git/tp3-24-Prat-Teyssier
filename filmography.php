<!DOCTYPE html>
<?php
require_once('tp3-helpers.php');
require_once('model.php');
require_once('view_fonction.php');

?>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
  <body>
      <table>
          <tbody>
              <tr>
                  <th>Filmography</th>
              </tr>
              <?php
                $films = get_filmographie($_GET['acteur_id']);
                foreach ($films as $film) {
                  echo "<tr><td>\n";
                  echo "<h2>Titre du film : ",$film["original_title"],"</h2>\n";
                  echo "<h3>Role : ",$film["character"],"</h3>\n";
                  echo "</tr></td>\n";
                }
               ?>
          </tbody>
      </table>
  </body>
</html>
