# TMDB, Podcasts
### Instruction d'installation
#### Installation
Pour que les pages fonctionne il faut utiliser un serveur. Nous utilisons un serveur apache en plaçant les fichier dans le repertoire
##### TMDB
Pour utiliser Question3TMDB.php il faut rajouter un parametre film_key={film_id} par exemple :
```
Question3TMDB.php?film_key=120
```
Les autres pages s'utilise sans parametre.
##### Podcast
Pas d'instruction particulière.
#### Les differents fichiers
##### TMDB
- **minimalUseOfhelpers.php** : pour la question 1
- **Question3TMDB.php** : pour les questions 3, 4, 5 et 10
- **view_fonction.php** : pour les question 3, 4, 5, 6, 7 et 9
- **tmdb-LOTR.php** : pour la question 6, 7 et 9
- **model.php** : pour les question 6, 7 et 9
- **filmography.php** : pour la question 9
### Compte rendu
#### TMDB
##### I/ Mise en jambe
- **1)** Le format de réponse est du JSON, il s'agit de Fight Club le fameux film de XXXXXX. Avec le paramètre : language=fr on récuprère un contenu en français.
- **2)** On a tester avec curl :
  >```shell
  > curl http://api.themoviedb.org/3/movie/550?api_key=ebb02613ce5a2ae58fde00f4db95a9c1
  >```
  Puis on à réaliser un code minimal pour tester les fonction de tp3_helpers.php :
  >```php
  ><?php
  >require_once('tp3-helpers.php');
  >printf("Fonction smartcurl : \n\n");
  >var_dump(smartcurl($argv[1]));
  >printf("\n\n Fonction tmdbget : \n\n");
  >var_dump(tmdbget($argv[2]));
  > ?>
  >```
  Et nous utiliont ce programme en ligne de commande de la façon suivante :
  >```shell
  >  php minimalUseOfhelpers.php http://api.themoviedb.org/3/movie/550?api_key=ebb02613ce5a2ae58fde00f4db95a9c1 movie/550
  >```
- **3)**
  >```php
  > $data = json_decode(tmdbget("movie/".$id, TRUE);
  >```
  La fonction tmdbget nous permet de recupéré le json renvoyer par l'API de TMDB, en utilisant json_decode on peut récupérer toute les donnée du film dans un tableau. On a juste à aller les chercher et les mettre en page.
##### II/ Les choses serieuses
- **4)** On peut rajouter des paramètres avec tmdbget notament le parametre langage, ensuite on appel la fonction 3 fois pour avoir toute les donnés des 3 versions.
  >```php
  > $data_vo = json_decode(tmdbget("movie/".$id,['language' => "$vo"]), TRUE);
  > $data_vf = json_decode(tmdbget("movie/".$id,['language' => "$vf"]), TRUE);
  >```
- **5)** Les poster sont accessible avec l'url suivante :
  >```php
  > https://image.tmdb.org/t/p/w300/$movie_data["poster_path"]
  >```
  On peut changer la taille du poster en modifiant la valeur apres w dans cette partie : *.../w300...*
- **6)** Pour obtenir les film seigneur des anneaux de peter Jackson nous utilsons la possibilité de faire des recherches dans l'api tmdb avec l'attribut dans l'url d'acces *query* ensuite nous faisont un trie en verifiant que Peter Jackson etait bien le realisateur du film. Cette methode est assez peut efficiente car on doit appelé l'API 1 fois par film ce qui ralenti enormement cette page, notre solution est probablement inutilisable avec un parametre *title* trop peut specifique.  
    >```php
    >function get_films_by_title_and_director($title, $director_name){
    >    str_replace(' ','+',$title);
    >    $data = json_decode(tmdbget("search/movie/",['query' => $title]), TRUE);
    >    $films_data = array();
    >    foreach ($data['results'] as $film) {
    >      if(strcmp(get_film_director($film["id"])['name'],$director_name)==0){
    >          array_push($films_data, $film['id']);
    >      }
    >    }
    >    return $films_data;
    >}
    >```
    Cette fonction nous renvoie les identifiants des films seigneur des anneaux de Peter Jackson avec un appel comme suit :
    >```php
    > $ids = get_films_by_title_and_director("the lord of the ring","Peter Jackson");
    >```
- **7)** Pour recuperer les acteurs ayant participer à un film on vas les chercher dans les credits en utilisant l'id du film :
  >```php
  > function get_actors($id) {
  > $cdata = json_decode(tmdbget("movie/".$id."/credits"), TRUE);
  > return $cdata["cast"];
  > }
  >```

- **8)** Non on ne peut pas afficher tout les acteurs jouant des hobbits car la race n est pas une information fournis, il serais possible de tous les afficher en listant le nom des hobbits et en filtrant les acteur ayant jouer tel ou tel personnage.
- **9)** Oui c'est relativement simple a faire, nous recuperont tous les acteurs et generons pour chacun un lien vers la page *filmography.php* avec en argument sont identifiant :
  >```php
  > echo "<p id='a'><a href='filmography.php?acteur_id=",$actor["id"],"'>",$actor["name"],"</a></p>";
  >```
- **10)** Une fonction nous renvois l'id sur youtube du trailer du film representé par son id :
  >```php
  > function get_youtube_id($movie_id){
  >   $video_data = json_decode(tmdbget("movie/".$movie_id."/videos"), TRUE);
  >   return $video_data['results'][0]['key'];
  > }
  >```
  Ensuite nous inseront un iframe de youtube pour avoir le trailer accessible depuis notre page :
  >```HTML
  > <iframe width="300" height="170" src="https://www.youtube.com/embed/$youtube_id" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  >```
#### Podcast
##### I/ Mise en jambe
  Composer ajoute ces fichier : *composer.json  composer.lock  vendor/*
- **1)** Une methode loadRss nous est fournis par la bibliotheque Composer cette fonction nous permet de recuperer un tableau avec les information de tous les episodes d un podcast ici radio france :
  >```php
  > $rss = Feed::loadRss("http://radiofrance-podcast.net/podcast09/rss_14312.xml");
  >```
  Ensuite on a juste a afficher ces informations :
  >```php
  >foreach ($rss->item as $item) {
  >    $audio = $item->enclosure->attributes();
  >    echo '<tr>';
  >    echo '<td>', $item->pubDate, '</td>';
  >    echo '<td><h3><a href ="',$item->link,'">', $item->title,  '</a>', '</h3></td>';
  >    echo '<td><audio controls><source src="', $audio->url, '"  type=', $audio->type, '></audio></td>';
  >    echo '<td>', $item->{"itunes:duration"}, '</td>';
  >    echo '<td><a href ="',$audio->url,'"download>-->Ici<--</ a></td></tr>';
  >}
  >```
