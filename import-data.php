<?php

$sql = "SELECT *
    FROM weather
    WHERE city = '{$_GET['city']}'
    AND weather_when >= DATE_SUB(NOW(), INTERVAL 10 SECOND)
    ORDER BY weather_when DESC limit 1";


$result = $mysqli -> query($sql);
// If 0 record found
if ($result->num_rows == 0) {
    $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $_GET['city'] . '&appid=d7e4a016a0f29a916f6a8c70e0e100ea&units=metric';
    $data = file_get_contents($url);
    $json = json_decode($data, true);
    // Fetch required fields
    $city = $json['name'];
    $weather_humidity = $json['main']['humidity'];
    $weather_pressure = $json['main']['pressure'];
    $weather_temperature = $json['main']['temp'];
    $weather_when = date("Y-m-d h:i:s");
    $weather_wind = $json['wind']['speed'];
    $icon = $json['weather'][0]['icon'];
    $weather_description = $json['weather'][0]['description'];
    // Build INSERT SQL statement
    $sql = "INSERT INTO weather(`city`, `humidity`, `pressure`, `temperature`, `weather_when`, `windspeed`, `icon`, `description`)
           VALUES ('{$city}','{$weather_humidity}','{$weather_pressure}','{$weather_temperature}','{$weather_when}','{$weather_wind}','{$icon}', '{$weather_description}')";
        // Run SQL statement and report errors
    if (!$mysqli -> query($sql)) {
        echo("<h4>SQL error description: " . $mysqli -> error . "</h4>");
    }
}
?>