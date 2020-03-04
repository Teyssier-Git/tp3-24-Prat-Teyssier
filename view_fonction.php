<?php

function insert_youtube_trailer($youtube_id) {
    return "<iframe width=\"300\" height=\"170\" src=\"https://www.youtube.com/embed/".$youtube_id."\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
}

function afficheDataFilm($data,$id,$language="en") {
    echo "<h2>Titre du film : ",$data["title"],"</h2>";
    echo "<h4>Titre original : ",$data["original_title"],"</h4>";
    echo "<h4>Tag : ",($data["tagline"]!=NULL ? $data["tagline"] : "Aucun"),"</h4>";
    echo "<h4>Description :</h4>";
    echo "<p>",$data["overview"],"</p>";
    echo "<h5>Retrouver plus d'information : <a href='https://www.themoviedb.org/movie/",$id,"?language=",$language,"'>ICI</a></h4>";
    echo "<img src='https://image.tmdb.org/t/p/w300/",$data["poster_path"],"'>";
    echo insert_youtube_trailer(get_youtube_id($data["id"]));
}

function afficheTableId($id) {
    $data_fr = json_decode(tmdbget("movie/".$id,['language' => 'fr']), TRUE);
    $data_en = json_decode(tmdbget("movie/".$id,['language' => 'en']), TRUE);
    $vo = $data_en['original_language'];
    $data_vo = json_decode(tmdbget("movie/".$id,['language' => "$vo"]), TRUE);
    echo "<table>";
    echo "<tbody>";
    echo "<tr>";
    echo "<th>VO</th>";
    echo "<th>FR</th>";
    echo "<th>EN</th>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    afficheDataFilm($data_vo,$id,$vo);
    echo "</td>";
    echo "<td>";
    afficheDataFilm($data_fr,$id,"fr");
    echo "</td>";
    echo "<td>";
    afficheDataFilm($data_en,$id);
    echo "</td>";
    echo "</tr>";
    echo "</tbody>";
    echo "</table>";
}

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
