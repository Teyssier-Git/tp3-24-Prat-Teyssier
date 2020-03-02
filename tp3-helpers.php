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

function get_film_director($film_id){
  $castData = json_decode(tmdbget("movie/".$film_id."/credits"), TRUE);
  $i = 0;
  $current_cast = $castData['crew'][$i];
  while ($current_cast['job'] != "Director" && isset($current_cast)) {
    $i++;
    $current_cast = $castData['crew'][$i];
  }
  return $current_cast;
}

function get_films_by_title_and_director($title, $director_name){
    str_replace(' ','+',$title);
    $data = json_decode(tmdbget("search/movie/",['query' => $title]), TRUE);
    $films_data = array();
    foreach ($data['results'] as $film) {
      if(strcmp(get_film_director($film["id"])['name'],$director_name)==0){
          array_push($films_data, $film['id']);
      }
    }
    return $films_data;
}
