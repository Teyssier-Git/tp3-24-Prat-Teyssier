<?php
require_once('tp3-helpers.php');
printf("\n\n Fonction smartcurl : \n\n");
var_dump(smartcurl($argv[1]));
printf("\n\n Fonction tmdbget : \n\n");
var_dump(tmdbget($argv[2]));
 ?>
