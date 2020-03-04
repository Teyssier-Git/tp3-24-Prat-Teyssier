<!DOCTYPE html>
<?php
require_once('Podcaster/vendor/dg/rss-php/src/Feed.php');
$rss = Feed::loadRss("http://radiofrance-podcast.net/podcast09/rss_14312.xml");
 ?>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title></title>
    </head>
    <body>
        <table>
            <tbody>
            <tr>
                <th>Date</th>
                <th>Titre</th>
                <th>Lecteur MP3</th>
                <th>Durree</th>
                <th>Download</th>
            <tr>
                <?php
                foreach ($rss->item as $item) {
                    $audio = $item->enclosure->attributes();
                    echo '<tr>';
                    echo '<td>', $item->pubDate, '</td>';
                    echo '<td><h3><a href ="',$item->link,'">', $item->title, '</a>', '</h3></td>';
                    echo '<td><audio controls><source src="', $audio->url, '" type=', $audio->type, '></audio></td>';
                    echo '<td>', $item->{"itunes:duration"}, '</td>';
                    echo '<td><a href ="',$audio->url,'"download>-->Ici<--</a></td></tr>';
                }
                 ?>

             </tbody>
        </table>
    </body>
</html>
