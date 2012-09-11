<?php 

// Init some vars
$days = 5;

// Pulling some data from NOAA API
//$xmlDoc = simplexml_load_file('http://graphical.weather.gov/xml/sample_products/browser_interface/ndfdBrowserClientByDay.php?lat=45.51&lon=-122.68&format=12+hourly&numDays='.$days);

$xmlDoc = simplexml_load_file('weather-gov.xml'); // Sample file for testing

$weatherData = $xmlDoc->data;

// the XML nodes from NOAA have hyphens in the node names, which trip up the parser. They need 
// to be accessed as {'node-name'}

/*
echo '<pre>';
print_r($weatherData);
echo '</pre>';
*/

// Build weather array from XML feed
$i = 0;
$weatherArray = array();


/*
foreach($weatherData->time-layout->start-valid-time as $time){

    echo $time

}
*/


while($i<=$days-1){
    $weatherArray[$i] = array(
        'time_start' => (string)$weatherData->{'time-layout'}->{'start-valid-time'}[$i][0],
        'time_end' => (string)$weatherData->{'time-layout'}->{'end-valid-time'}[$i][0],
        'max_temp' => (string)$weatherData->parameters->temperature[0]->value[$i],
        'min_temp' => (string)$weatherData->parameters->temperature[1]->value[$i]
    );
    
    $i++;
    
}

echo '<pre>';
print_r($weatherArray);
echo '</pre>';

// var_dump($xmlDoc->data->parameters->weather)


?>


<div class="widget-side" style="width:220px;">
    <div class="current">
        <?php

            
        
        ?>
    </div>
    <h2 class="next">Tomorrow:</h2>
</div>

<script type="text/javascript">
    imageURL = $('.noaaWeatherIcon').attr('src');
    $('.noaaWeatherIcon').attr('src', 'http://weather.gov' + imageURL);
</script>
<link href="libs/styles.css" rel="stylesheet" type="text/css">

