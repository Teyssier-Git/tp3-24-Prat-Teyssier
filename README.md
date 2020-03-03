# TMDB, Podcasts

#### TMDB 
##### I/ Mise en jambe
**1)** Le format de réponse est du JSON, il s'agit de Fight Club le fameux film de XXXXXX. Avec le paramètre : language=fr on récuprère un contenu en français. 
**2)** On a tester avec curl :
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
**3)**
>```php
> $data_vo = json_decode(tmdbget("movie/".$id,['language' => "$vo"]), TRUE);
>```
La fonction tmdbget nous permet de recupéré le json renvoyer par l'API de TMDB, en utilisant json_decode on peut récupérer toute les donnée du film dans un tableau. On a juste à aller les chercher et les mettre en page.
**4)**
#### Podcast
##### I/ Mise en jambe
Composer ajoute ces fichier : *composer.json  composer.lock  vendor/*
**1)** 
