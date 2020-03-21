<?php
$googleApiUrl = "api.openweathermap.org/data/2.5/weather?zip=3506,ph&appid=2c3250b9cf15932fec969fcf2db45b40";

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = date_default_timezone_set('Asia/Manila');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Weather Widget</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="pages/css/index.css">
</head>
<body>
    <div class="row-location">
        <!-- Town location -->
        <div class="weather-container">
            <h2>
                <?php 
                    echo $data->name;
                ?>
            </h2>
            <h4>Cagayan, Philippines</h4>
            <!-- Current time -->
            <h6>
                <?php  
                    echo $currentTime = date('l h:m a');
                ?>
            </h6>
            <!-- Current date -->
            <h6>
                <?php  
                    echo $currentTime = date('F j, Y');
                ?>
            </h6>
        </div>
        <div class="row-temp">
            <table>
                <tr>
                    <td> <!-- Weather icon -->
                        <img src="https://img.icons8.com/clouds/100/000000/snow-storm.png"/>
                    </td>
                    <td>
                       <h2> <!-- Current Temperature -->
                           <?php  
                               $max = $data->main->temp_max  ;
                               $min =$data->main->temp_min;
                               $minoutput = $min - 273.15;
                               $maxoutput = $max - 273.15;
                              
                               echo $minoutput . "&#8451";
                           ?>
                       </h2> 
                    </td>
                </tr>
                <tr>
                    <td>Humidity</td>
                    <td> <!-- Current Humidity -->
                        <?php  
                            echo $data->main->humidity . "%";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Wind</td>
                    <td> <!-- Current wind -->
                        <?php  
                            $meter = $data->wind->speed;
                            $speedResult = $meter * 3.6;
                            echo $speedResult . " km/h";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Cloudliness</td>
                    <td> <!-- Current cloudiness -->
                        <?php  
                            echo ucwords($data->weather[0]->description);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Sunrise</td>
                    <td> <!-- Sunrise time -->
                        <?php  
                           echo date('h:m a', $data->sys->sunrise);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Sunset</td>
                    <td> <!-- Sunrise time-->
                        <?php  
                           echo date('h:m a', $data->sys->sunset);
                        ?>
                    </td>
                </tr>
            </table>
        </div>   
    </div>
</body>
</html>