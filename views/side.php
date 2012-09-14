<?php 

// In practice, the simplexml_load_file call should pass the user's lat & long given to the app by CitySync

// Init some vars
$days = 5;

// Pulling some data from NOAA API
$xmlDoc = simplexml_load_file('http://graphical.weather.gov/xml/sample_products/browser_interface/ndfdBrowserClientByDay.php?lat=45.51&lon=-122.68&format=12+hourly&numDays='.$days);

// $xmlDoc = simplexml_load_file('sample-return.xml'); // Sample file for testing
$weatherData = $xmlDoc->data;

// the XML nodes from NOAA have hyphens in the node names, which trip up the parser. They need 
// to be accessed as {'node-name'}

// echo '<pre>';
// print_r($weatherData);
// echo '</pre>';

// Build weather array from XML feed
$i = 0;
$weatherArray = array();

// Loop through and reformat weather XML into a nice array
while($i<=$days-1){
        
    $weatherArray[$i] = array(
        'time_start' => (string)$weatherData->{'time-layout'}->{'start-valid-time'}[$i][0],
        'time_end' => (string)$weatherData->{'time-layout'}->{'end-valid-time'}[$i][0],
        'max_temp' => (string)$weatherData->parameters->temperature[0]->value[$i],
        'min_temp' => (string)$weatherData->parameters->temperature[1]->value[$i],
        'chance_of_rain_am'=> (string)$weatherData->parameters->{'probability-of-precipitation'}->value[$i+$i],
        'chance_of_rain_pm'=> (string)$weatherData->parameters->{'probability-of-precipitation'}->value[$i+($i+1)],
        'hazards'=>'',
        'weather_summary_am'=>(string)$weatherData->parameters->weather->{'weather-conditions'}[$i+$i]['weather-summary'],
        'weather_summary_pm'=>(string)$weatherData->parameters->weather->{'weather-conditions'}[$i+($i+1)]['weather-summary']
    );
    
    $i++;
    
}

// echo '<pre>';
// print_r($weatherArray);
// echo '</pre>';


?>


<div class="widget-side">
    <h1>Local Weather</h1>
    <div class="now">
        <div class="data">
            <h2>Now</h2>
            <p class="temp"><?php echo $weatherArray[0]['max_temp'] ?>&ordm;</p>
            <p class="summary"><?php echo $weatherArray[0]['weather_summary_am']; ?></p>
        </div>
        <img src="images/<?php echo strtolower(str_replace(" ","-",$weatherArray[0]['weather_summary_am'])) ?>.png" alt="<?php echo strtolower(str_replace(" ","-",$weatherArray[0]['weather_summary_am'])) ?>">
    </div>
    <div class="forecast">
        <div class="tonight">
            <h2>Tonight</h2>
            <div class="data">
                <p class="temp"><?php echo $weatherArray[0]['min_temp']; ?>&ordm;</p>
                <p class="summary"><?php echo $weatherArray[0]['weather_summary_pm']; ?></p>
            </div>
            <img src="images/<?php echo strtolower(str_replace(" ","-",$weatherArray[0]['weather_summary_pm'])) ?>_night.png" alt="<?php echo strtolower(str_replace(" ","-",$weatherArray[0]['weather_summary_pm'])) ?>">
        </div>
        <div class="tomorrow">
            <h2>Tomorrow</h2>
            <div class="data">
                <p class="temp"><?php echo $weatherArray[1]['min_temp']; ?>&ordm;</p>
                <p class="summary"><?php echo $weatherArray[1]['weather_summary_pm']; ?></p>
            </div>
            <img src="images/<?php echo strtolower(str_replace(" ","-",$weatherArray[0]['weather_summary_am'])) ?>.png" alt="<?php echo strtolower(str_replace(" ","-",$weatherArray[0]['weather_summary_am'])) ?>">
        </div>
    </div>
    <p class="attribution">Weather information provided by</p>
</div>

<link href="libs/styles.css" rel="stylesheet" type="text/css">

