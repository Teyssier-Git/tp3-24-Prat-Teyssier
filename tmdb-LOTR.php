<!DOCTYPE html>
<?php
require_once('tp3-helpers.php');

function afficheDataFilmBis($data,$langue="en") {
    echo "<td>",$data["title"],"</td>";
    echo "<td>",$data["release_date"],"</td>";
    echo "<td><img src='https://image.tmdb.org/t/p/w300/",$data["poster_path"],"'></td>";
}

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
                  <!-- <th>Acteurs</th> -->
              </tr>
              <?php
                for ($id=120; $id<123; $id++) {
                    echo "<tr>";
                    afficheDataFilmBis(json_decode(tmdbget("movie/".$id,['language' => 'en']), TRUE));
                    echo "</tr>";
                }
               ?>
          </tbody>
      </table>
  </body>
</html>
