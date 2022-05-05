# Zadanie-Chmury
## 1. Program serwera

```php
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
```

## 2. Zawartość pliku Dockerfile

```docker
#Autor skryptu: Yevhenii Soliuk
FROM php:7.0-apache    
COPY index.php /var/www/html
```

<aside>
🐋 Dany obraz kontenera jest tworzony na podstawie scratch-u z użyciem systemu operacyjnego Alpine mini root file system. Na tym systemie instaluje apache i php. Po czym usuwam plik z keszem oraz tworzę dyrektorie dla apacha. Usuwam z htdocs plik .html i przenoszę plik z programem do tego miejsca. Również ustawiam dla pliku prawa do wykonywania. Po ustawieniu portu, na którym nasłuchuje serwer wykonuję polecenie do uruchomienia serwera oraz wyświetlaniu informacji z logów.

</aside>

## 3. Użyte polecenia

a) DOCKER_BUILDKIT=1 docker build --progress=plain -f Dockerfile2 -t zadanie1:v1.0 .

![Untitled](https://s3-us-west-2.amazonaws.com/secure.notion-static.com/de0f7105-3b09-4cbc-8083-329c0ce0f819/Untitled.png)

> Utworzony obraz kontenera “zadanie1”
> 

b) docker run -it --rm -p 8000:80 --name zadanie1 zadanie1:v1.0

![Untitled](https://s3-us-west-2.amazonaws.com/secure.notion-static.com/58c6500d-b0a0-4003-8207-5230967f0c26/Untitled.png)

c) -

d) docker image inspect zadanie1:v1.0 -f '{{.RootFS.Layers}}’
