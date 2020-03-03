<?php

/**
 * TMDB query function
 * @param string $urlcomponent (after the prefix)
 * @param array (associative) GET parameters (ex. ['language' => 'fr'])
 * @return string $content
**/
function tmdbget($urlcomponent, $params=null) {
    $apikey = 'ebb02613ce5a2ae58fde00f4db95a9c1';
    $apiprefix = 'http://api.themoviedb.org/3/';  //3rd API version

	$targeturl = $apiprefix . $urlcomponent . '?api_key=' . $apikey;
    $targeturl .= (isset($params) ? '&' . http_build_query($params) : '');
    list($content, $info) = smartcurl($targeturl);

    return $content;
}


/**
 * curl wrapper
 * @param string $url
 * @return string $content
 **/
function smartcurl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "php-libcurl");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $rawcontent = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    return [$rawcontent, $info];
}

function creationDeLien($id,$langue) {
    return "https://www.themoviedb.org/movie/".$id."?language=".$langue;
}

 function afficheDataFilm($data,$langue="en") {
     echo "<h2>Titre du film : ",$data["title"],"</h2>";
     echo "<h4>Titre original : ",$data["original_title"],"</h4>";
     echo "<h4>Tag : ",($data["tagline"]!=NULL ? $data["tagline"] : "Aucun"),"</h4>";
     echo "<h4>Description :</h4>";
     echo "<p>",$data["overview"],"</p>";
     echo "<h5>Retrouver plus d'information : <a href='",creationDeLien($data["id"],$langue),"'>ICI</a></h4>";
     echo "<img src='https://image.tmdb.org/t/p/w300/",$data["poster_path"],"'>";
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
     afficheDataFilm($data_vo,$vo);
     echo "</td>";
     echo "<td>";
     afficheDataFilm($data_fr,"fr");
     echo "</td>";
     echo "<td>";
     afficheDataFilm($data_en);
     echo "</td>";
     echo "</tr>";
     echo "</tbody>";
     echo "</table>";
 }

 
