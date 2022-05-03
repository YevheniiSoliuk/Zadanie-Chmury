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
  file_put_contents("info.log", "Data uruchomienia ".date("d-m-Y")." "."Autor skryptu: Yevhenii Soliuk"." "."port TCP:" . $_SERVER['SERVER_PORT'] . PHP_EOL, FILE_APPEND);

  echo "<h1 style='text-align: center; text-decoration: underline;'> Your IP address: ". $_SERVER['REMOTE_ADDR'] ." </h1>";

  $ip = $_SERVER['REMOTE_ADDR']; //"189.240.194.147"
  $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
  $ipInfo = json_decode($ipInfo);
  $timezone = $ipInfo->timezone;
  date_default_timezone_set($timezone);
  echo "Twoja strefa czasowa: " . date_default_timezone_get()."<br>";
  echo "Data i czas: " . date('Y/m/d H:i:s');
  ?>

</body>
</html>

