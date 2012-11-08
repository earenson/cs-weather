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
                    
                    CitySync.resizeFrame(document.body.scrollHeight, smocket);
                }    
            );
        }
    }
};

$(function(){
      
    // Create new socket        
    smocket = new easyXDM.Socket({
        onReady:  function(){
            CitySync.resizeFrame(document.body.scrollHeight, smocket);
  			CitySync.getUserData(smocket);
        },
        onMessage: function(message){
            CitySync.routeMessage(message);

            parsed = JSON.parse(message);
            if(parsed.type=="userdata"){
                var app = App();
                app.getCurrentWeather();
            }
            
        }
    });
         
});