<!DOCTYPE html>
<?php
require_once('tp3-helpers.php');
require_once('model.php');
require_once('view_fonction.php');

function afficheDataFilmBis($data,$id,$langue="en") {
    echo "<td>",$data["title"],"</td>";
    echo "<td>",$data["release_date"],"</td>";
    echo "<td><img src='https://image.tmdb.org/t/p/w300/",$data["poster_path"],"'></td>";
    echo "<td>";
    $actors = get_actors($id);
    foreach ($actors as $actor) {
        echo "<p id='a'>",$actor["character"],"</p>";
    }
    echo "</td><td>";
    foreach ($actors as $actor) {
        echo "<p id='a'><a href='filmography.php?acteur_id=",$actor["id"],"'>",$actor["name"],"</a></p>";
    }
    echo "</td>";
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
