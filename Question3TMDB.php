<!DOCTYPE html>
<?php
require_once('tp3-helpers.php');
$data_fr = json_decode(tmdbget("movie/".$_GET['film_key'],['language' => 'fr']), TRUE);
$data_en = json_decode(tmdbget("movie/".$_GET['film_key'],['language' => 'en']), TRUE);
$vo = $data_en['original_language'];
$data_vo = json_decode(tmdbget("movie/".$_GET['film_key'],['language' => "$vo"]), TRUE);
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
            <th>VO</th>
            <th>FR</th>
            <th>EN</th>
            </tr>
            <tr>
            <?php
                $data = $data_vo;
                echo "<td>";
                echo "<h2>Titre du film : ",$data["title"],"</h2>";
                echo "<h4>Titre original : ",$data["original_title"],"</h4>";
                echo "<h4>Tag : ",($data["tagline"]!=NULL ? $data["tagline"] : "Aucun"),"</h4>";
                echo "<h4>Description :</h4>";
                echo "<p>",$data["overview"],"</p>";
                echo "<h5>Retrouver plus d'information : <a href='",$data["homepage"],"'>ICI</a></h4>";
                echo "<img src='https://image.tmdb.org/t/p/w300/",$data["poster_path"],"'>";
                echo "</td>";
                $data = $data_fr;
                echo "<td>";
                echo "<h2>Titre du film : ",$data["title"],"</h2>";
                echo "<h4>Titre original : ",$data["original_title"],"</h4>";
                echo "<h4>Tag : ",($data["tagline"]!=NULL ? $data["tagline"] : "Aucun"),"</h4>";
                echo "<h4>Description :</h4>";
                echo "<p>",$data["overview"],"</p>";
                echo "<h5>Retrouver plus d'information : <a href='",$data["homepage"],"'>ICI</a></h4>";
                echo "<img src='https://image.tmdb.org/t/p/w300/",$data["poster_path"],"'>";
                echo "</td>";
                $data = $data_en;
                echo "<td>";
                echo "<h2>Titre du film : ",$data["title"],"</h2>";
                echo "<h4>Titre original : ",$data["original_title"],"</h4>";
                echo "<h4>Tag : ",($data["tagline"]!=NULL ? $data["tagline"] : "Aucun"),"</h4>";
                echo "<h4>Description :</h4>";
                echo "<p>",$data["overview"],"</p>";
                echo "<h5>Retrouver plus d'information : <a href='",$data["homepage"],"'>ICI</a></h4>";
                echo "<img src='https://image.tmdb.org/t/p/w300/",$data["poster_path"],"'>";
                echo "</td>";
             ?>
             </tr>
        </tbody>
    </table>
  </body>
</html>
