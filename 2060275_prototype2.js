
fetch("http://localhost/weather/my-api.php?city=Liverpool")
.then(response => response.json())
.then(data => {
    console.log(data);
    document.getElementById("name").innerHTML = "City🏙️ - "+data.city;
    document.getElementById("description").innerHTML = "Weather_description- "+data.description;
    document.getElementById("windspeed").innerHTML =  " 💨Wind speed - "+ data.windspeed +" "+ "km/h";
    document.getElementById("temp").innerHTML = "Temperature:🌡️"+data.temperature+"°C";
    document.getElementById("pressure").innerHTML = "🕣Pressure -"+data.pressure  + " " + "mb";
    document.getElementById("humidity").innerHTML = " 💧Humidity-"+data.humidity+"%" ;
    document.getElementById("Icon").innerHTML = `<img src='http://openweathermap.org/img/w/${data.icon}.png'width="200" height="200">`;
    document.getElementById("Updated").innerHTML = "Latest upadated:"+data.weather_when;
    
})
.catch(err => {
    // Display errors in console
    console.log(err);
  });