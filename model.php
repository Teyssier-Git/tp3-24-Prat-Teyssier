<?php

/**
 * Recuperer la filmographie d un acteur identifier par son id
 * @param integer $acteur_id l id de l acteur
 * @return array $castData liste des films dans lequels il joue
**/
function get_filmographie($acteur_id){
  $castData = json_decode(tmdbget("person/".$acteur_id."/movie_credits"), TRUE);
  return $castData['cast'];
}

/**
 * Recuperer le premier realisateur dun film identifier par son id
 * @param integer $film_id l id du film
 * @return array $current_cast contenant les information du premier realisateur trouver
**/
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

/**
 * Renvoi une liste de film dont le titre et realisateur corresponde au parametre de recherche
 * @param string $title chaine contenut dans le titre du film
 * @param string $director_name nom du realisateur
 * @return array $films_data contient les information des film correspondant a la recherche
**/
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

/**
 * Renvoie la liste des acteur ayant travailler dans un film identifier par sont id
 * @param integer $id identifiant du film
 * @return array $cdata["cast"] contient tout les acteur ayant participer au film
**/
function get_actors($id) {
    $cdata = json_decode(tmdbget("movie/".$id."/credits"), TRUE);
    return $cdata["cast"];
}

/**
 * Renvoie l'id sur youtube du trailer du film donner en entre
 * @param integer $movie_id identifiant du film
 * @return array $video_data['results'][0]['key']
**/
function get_youtube_id($movie_id){
  $video_data = json_decode(tmdbget("movie/".$movie_id."/videos"), TRUE);
  return $video_data['results'][0]['key'];
}

 ?>
