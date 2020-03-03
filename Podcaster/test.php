<?php
require_once('vendor/dg/rss-php/src/Feed.php');
$rss = Feed::loadRss("http://radiofrance-podcast.net/podcast09/rss_14312.xml");
echo 'Title: ', $rss->title;
echo 'Description: ', $rss->description;
echo 'Link: ', $rss->link;

foreach ($rss->item as $item) {
  var_dump($item);
	echo '<h1>Title: ', $item->title,'<h1>';
	echo '<h4>Link: ', $item->link,'<h4>';
	echo '<h4>Timestamp: ', $item->timestamp,'<h4>';
	echo '<h4>Description ', $item->description,'<h4>';
	echo '<h4>HTML encoded content: ', $item->{'content:encoded'},'<h4>';
}
?>
