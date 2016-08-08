<?php

header('Content-Type: application/json');

include('dump.php');
include('countries.php');
include 'vendor/autoload.php';
use PHPInsight\Sentiment;


$score_array = array();
$stories = array();


$BBC_URL = "http://feeds.bbci.co.uk/news/rss.xml";
// $AP_URL = "http://hosted2.ap.org/atom/APDEFAULT/cae69a7523db45408eeb2b3a98c0c9c5";
$REUTERS_URL = "http://feeds.reuters.com/reuters/INworldNews";
$NDTV_URL = "http://feeds.feedburner.com/ndtvnews-world-news";

parse_sentiments($BBC_URL);
parse_sentiments($REUTERS_URL);
parse_sentiments($NDTV_URL);

function parse_sentiments($url) {

  $newsoutput = new SimpleXMLElement($url, LIBXML_NOCDATA, true);
  $newsoutput = json_decode(json_encode($newsoutput), TRUE);
  // do_dump($newsoutput);
  $sentiment = new Sentiment();

  foreach($newsoutput['channel']['item'] as $story) {
    $title = $story["title"];
    $description = $story["description"];
    $link = $story['link'];
    $scores = $sentiment->score($title." ".$description);
  	$class = $sentiment->categorise($title." ".$description);
    $country_array = extract_country($title." ".$description);
    $score = $scores[$class];
    if($class == "neg") {
      $score = - $score;
    }

    foreach($country_array as $code) {
        if(!in_array($code, $GLOBALS['score_array'])) {
          $GLOBALS['score_array'][$code] = $score;
        }
        else {
          $GLOBALS['score_array'][$code] += $score;
        }
    }

    if(sizeof($country_array) > 0) {
      $GLOBALS['stories'][] = array("country" => $country_array[0], "title" => $title, "description" => $description, "link" => $link);
    }
    // echo "$description is <b> $class </b> with score <b> $score</b> </br>";
  }
    // do_dump($GLOBALS['score_array']);
}

function extract_country($text) {
  $text = strtolower($text);
  $country_array = array();
  foreach($GLOBALS['COUNTRY_NAMES']as $code => $terms) {
    foreach ($terms as $key => $value) {
      if(strpos($text, $value) != false) {
        if(!in_array($code, $country_array)) {
          $country_array[] = $code;
        }
      }
    }
  }

  return $country_array;
}

$map_array = array();
foreach($score_array as $code => $value) {
  $map_array[] = array("id" => $code, "value" => $value);
}

echo json_encode(array("areas" => $map_array, "stories" => $stories));





?>
