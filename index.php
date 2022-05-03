<?php
    //wyłączenie uprzedzeń w PHP
    //error_reporting(E_ALL & ~E_NOTICE);
    //Zapisanie informacji o dacie uruchomienia, imieniu i nazwisku autora oraz porcie TCP do pliku info.log
    file_put_contents("info.txt", "Data uruchomienia ".date("d-m-Y")." "."Autor skryptu: Yevhenii Soliuk"." "."port TCP:" . $_SERVER['SERVER_PORT'] . PHP_EOL, FILE_APPEND);

    //pobranie adresu IP klienta
    $ip = $_SERVER['REMOTE_ADDR'];
    //pobranie API z informacją o miejscu lokalizacji użytkownika
    $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
    //dekodowanie pliku JSON do obiektu
    $ipInfo = json_decode($ipInfo); 
    //pobranie strefy czasowej z obiektu
    $timezone = $ipInfo->timezone;
    //ustawienie standardowej strefy czasowej, jako strefy czasowej użytkownika
    date_default_timezone_set($timezone);

    //Wyświetlenie po stronie klienta jego adresu IP, strefy czasowej oraz daty i czasu
    // echo "<h1 style='text-align: center; text-decoration: underline;'> Your IP address: ". $ip ." </h1>";
    // echo "<strong>Twoja strefa czasowa:</strong> " . date_default_timezone_get()."<br>";
    // echo "<strong>Data i czas:</strong> " . date('Y/m/d H:i:s');
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cloud serwer</title>
</head>
<body style="background-color: lightblue;">
  <h1>Hello world!</h1>
  
  <h1 style='text-align: center; text-decoration: underline;'> Your IP address:<?php $ip ?></h1>
  <strong>Twoja strefa czasowa:</strong> <?php date_default_timezone_get() ?> <br>
  <p>
    <strong>Data i czas:</strong><?php date('Y/m/d H:i:s') ?>
  </p>
</body>
</html>