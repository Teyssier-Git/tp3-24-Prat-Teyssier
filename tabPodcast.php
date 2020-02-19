<!DOCTYPE html>
<?php
require_once('vendor/dg/rss-php/src/Feed.php');
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
                <?php
                foreach ($rss->item as $item) {
                    echo '<tr>';
                    echo '<h3>Title: ', $item->title, '</h3><br>';
                    echo 'Link: ', $item->link, '<br>';
                    echo 'Timestamp: ', $item->timestamp, '<br>';
                    echo 'Description ', $item->description, '<br>';
                    echo 'HTML encoded content: ', $item->{'content:encoded'}, '<br>';
                    echo '</tr>';
                }
                 ?>
        </table>
    </body>
</html>
