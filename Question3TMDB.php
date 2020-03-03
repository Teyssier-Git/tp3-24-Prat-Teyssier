<!DOCTYPE html>
<?php
require_once('tp3-helpers.php');
$data_fr = json_decode(tmdbget("movie/".$_GET['film_key'],['language' => 'fr']), TRUE);
$data_en = json_decode(tmdbget("movie/".$_GET['film_key'],['language' => 'en']), TRUE);
$vo = $data_en['original_language'];
$data_vo = json_decode(tmdbget("movie/".$_GET['film_key'],['language' => "$vo"]), TRUE);
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
            <th>VO</th>
            <th>FR</th>
            <th>EN</th>
            </tr>
            <tr>
            <td><?php afficheDataFilm($data_vo); ?></td>
            <td><?php afficheDataFilm($data_fr); ?></td>
            <td><?php afficheDataFilm($data_en); ?></td>
            </tr>
        </tbody>
    </table>

    <?php
    for ($i = 120; $i<123; $i++) {
        $data_fr = json_decode(tmdbget("movie/".$i,['language' => 'fr']), TRUE);
        $data_en = json_decode(tmdbget("movie/".$i,['language' => 'en']), TRUE);
        $vo = $data_en['original_language'];
        $data_vo = json_decode(tmdbget("movie/".$i,['language' => "$vo"]), TRUE);
        echo "<table>";
        echo "<tbody>";
        echo "<tr>";
        echo "<th>VO</th>";
        echo "<th>FR</th>";
        echo "<th>EN</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        afficheDataFilm($data_vo);
        echo "</td>";
        echo "<td>";
        afficheDataFilm($data_fr);
        echo "</td>";
        echo "<td>";
        afficheDataFilm($data_en);
        echo "</td>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
    }
     ?>

  </body>
</html>
