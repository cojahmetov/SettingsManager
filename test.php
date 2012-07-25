<?php

include_once 'class.SettingsManager.php';

define("RSS_URL", "http://vancouver.en.craigslist.ca/search/bfs?query=business%20for%20sale&srchType=A&format=rss");

SettingsManager::add_param('url', RSS_URL);

$url = SettingsManager::get_param('url');

var_dump( $url );