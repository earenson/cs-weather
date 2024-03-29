<!DOCTYPE html>

<html>
<head>
    <link href="http://pdxcitysync.org/apps/citysync_styles.css" rel="stylesheet" type="text/css">
</head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <script src="http://pdxcitysync.org/apps/citysync-app.js" type="text/javascript"></script>

<body>
    <?php

    /**
     * CitySync App: Weather
     * Author: Eric Arenson
     * Version: 1.4
     * - Adding Dark Sky API call for Current Temp
     */

        $region = $_GET['region'];  // The context in which the app is being displayed
    
        switch($region){
        
            case('center'):
                include('views/center.php');
                break;
            case('sidebar'):
                include('views/side.php');
                break;
            case('full'):
                include('views/full.php');
                break;
        }
    
    ?>

</body>
</html>
