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
      <table>
          <tbody>
              <tr>
                  <th>Titre</th>
                  <th>Date de sortie</th>
                  <th>Poster</th>
                  <th>Roles</th>
                  <th>Acteurs</th>
              </tr>
              <?php
                $ids = get_films_by_title_and_director("the lord of the ring","Peter Jackson");
                foreach ($ids as $id) {
                  echo "<tr>";
                  afficheDataFilmBis(json_decode(tmdbget("movie/".$id,['language' => 'en']), TRUE),$id);
                  echo "</tr>";
                }
               ?>
          </tbody>
      </table>
  </body>
</html>
