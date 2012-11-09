/****
 * app.js
 * Handles user data with CitySync as well as DarkSkies api calls
 */
    
var App = function(){

    return{
        getCurrentWeather:function(){
                
            $.getJSON(
                'libs/darksky.php',
                {
                    lat:CitySync.user.location.lat,
                    lon:CitySync.user.location.long
                },
                function(data){
                    //console.log(data);
                    $('div.now p.temp').html(data.currentTemp + "&ordm;");
                    $('div.now p.summary').text(data.hourSummary).css('textTransform','captalize');
                    $('div.now img').attr('src','images/'+data.hourSummary+'.png').attr('alt',data.hourSummary);
                    
                    CitySync.resizeFrame(document.body.scrollHeight, socket);
                }    
            );
        }
    }
};

$(function(){
    // The connect method creates the socket and establishes the connection,
    // and provides a callback to let you know when everything is ready to go.
    CitySync.connect(function(){
        var app = App();
        app.getCurrentWeather();
    });
               
});