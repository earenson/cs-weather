<?php 


// Pulling some data from Yahoo! Weather API
$xmlDoc = simplexml_load_file('http://graphical.weather.gov/xml/sample_products/browser_interface/ndfdBrowserClientByDay.php?lat=45.51&lon=-122.68&format=12+hourly&numDays=5');

echo '<pre>';
print_r($xmlDoc);
echo '</pre>';


$weather = $xmlDoc->data->parameters->weather;
//print_r($weather->name);

?>


<?php 

// Get current weather from Weather.gov
$current = simplexml_load_file('http://www.weather.gov/xml/current_obs/KHIO.rss');
echo '<pre>';
print_r($current);
echo '</pre>';

?>




<div class="widget-side" style="width:220px;">
    <div class="current">
        <?php
            
            $desc = $current->channel->item->description;
            
            $desc = explode("<br>",$desc);
            $text = $desc[1];
            $img = $desc[0];
    
            echo $img;
            // NOTE: This isn't working;
        
        ?>
    </div>
<!--     <h2 class="next">Tomorrow:</h2> -->
</div>

<script type="text/javascript">
    imageURL = $('.noaaWeatherIcon').attr('src');
    $('.noaaWeatherIcon').attr('src', 'http://weather.gov' + imageURL);
</script>
<link href="libs/styles.css" rel="stylesheet" type="text/css">

