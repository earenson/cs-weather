<?php 


// Pulling some data from NOAA API
$xmlDoc = simplexml_load_file('http://graphical.weather.gov/xml/sample_products/browser_interface/ndfdBrowserClientByDay.php?lat=45.51&lon=-122.68&format=12+hourly&numDays=5');

echo '<pre>';
print_r($xmlDoc);
echo '</pre>';


$weather = $xmlDoc->data->parameters->weather;
//print_r($weather->name);

// var_dump($xmlDoc->data->parameters->weather)


?>


<div class="widget-side" style="width:220px;">
    <div class="current">
        <?php

            $temp = $xmlDoc->data->parameters->temperature->name;
            $conditions = $xmlDoc->data->parameters->weather->{'weather-conditions'};

            $img = $weather[0];
    
            foreach($conditions AS $condition) {
                $attr = $condition->attributes();
                echo $attr['weather-summary'] , '<br />';
            }

            echo $img;
        
        ?>
    </div>
    <h2 class="next">Tomorrow:</h2>
</div>

<script type="text/javascript">
    imageURL = $('.noaaWeatherIcon').attr('src');
    $('.noaaWeatherIcon').attr('src', 'http://weather.gov' + imageURL);
</script>
<link href="libs/styles.css" rel="stylesheet" type="text/css">

