<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cloud serwer</title>
</head>
<body style="background-color: lightblue;">
  <?php
    //pobranie adresu IP klienta
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
    {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } 
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } 
    else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    //pobranie API z informacją o miejscu lokalizacji użytkownika
    $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
    //dekodowanie pliku JSON do obiektu
    $ipInfo = json_decode($ipInfo); 
    //pobranie strefy czasowej z obiektu
    $timezone = $ipInfo->timezone;
    //ustawienie standardowej strefy czasowej, jako strefy czasowej użytkownika
    date_default_timezone_set($timezone);

    //Wyświetlenie po stronie klienta jego adresu IP, strefy czasowej oraz daty i czasu
    echo "<h1 style='text-align: center; text-decoration: underline;'> Twój adres IP: " . $ip . " </h1>";
    echo "<strong>Twoja strefa czasowa:</strong> " . date_default_timezone_get() . "<br>";
    echo "<strong>Data i czas:</strong> " . date('Y/m/d H:i:s');
  ?>
</body>
</html>