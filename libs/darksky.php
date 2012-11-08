<?php

require_once('darksky.conf.php');

// Grab lat and long passed by JS ajax call
$lat = $_GET['lat'];
$lon = $_GET['lon'];

// Make API call to get weather data
$call = $briefURL . $apiKey . '/' . $lat . ',' . $lon;

// Call Format:
// https://api.darkskyapp.com/v1/brief_forecast/API_KEY/45.601236,-122.757352
// https://api.darkskyapp.com/v1/forecast/API_KEY/45.601236,-122.757352

// Sample for brief_forecast
//$currentWeather = '{"currentTemp":53,"currentSummary":"clear","hourSummary":"clear","daySummary":"moderate chance of rain starting this evening","isPrecipitating":false,"currentIntensity":0,"minutesUntilChange":0,"checkTimeout":7200}';

//echo $call;
$currentWeather = file_get_contents($call);
echo $currentWeather;


?>