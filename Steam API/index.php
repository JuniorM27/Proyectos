<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steam API</title>
</head>
<body>
    <form action="" method="post">
        <label>SteamID</label>
        <input type="text" name="steamid" required>
        <input type="submit" value="Consultar">
    </form>
<?php

$curl = curl_init();
$url2 = "https://api.steampowered.com/ISteamApps/GetAppList/v2/";
curl_setopt($curl, CURLOPT_URL, $url2);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$respuesta2 = curl_exec($curl);
$respuestaArray2 = json_decode($respuesta2, true);
$list = array();
for($i = 0; $i < count($respuestaArray2['applist']['apps']); $i++)
{
    $list += [$respuestaArray2['applist']['apps'][$i]['appid'] => $respuestaArray2['applist']['apps'][$i]['name']];
}
curl_close($curl);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $steamkey = "C831889C1CDE336D06A6CD81189D4CAB";
        $steamid = $_POST['steamid'];
        $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$steamkey."&steamids=".$steamid;
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $respuesta = curl_exec($curl);
        $respuestaArray = json_decode($respuesta, true);
        echo "<b>Datos:</b><br>";
        print("<pre>".print_r($respuestaArray,true)."</pre>");
        echo "<img src=". $respuestaArray['response']['players'][0]['avatarfull'] ."><br>";
        
        $url = "http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key=".$steamkey."&steamid=".$steamid."&format=json";
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $respuesta = curl_exec($curl);
        $respuestaArray = json_decode($respuesta, true);
        echo "<b>Jugados recientemente:</b><br>";
        print("<pre>".print_r($respuestaArray,true)."</pre>");

        $url = "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=".$steamkey."&steamid=".$steamid."&format=json";
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $respuesta = curl_exec($curl);
        $respuestaArray = json_decode($respuesta, true);
        if(count($respuestaArray['response']) != 0) {
        echo "<b>Juegos:</b><br>";
        for($i = 0; $i < count($respuestaArray['response']['games']); $i++)
        {
            if(isset($list[$respuestaArray['response']['games'][$i]['appid']]))
                echo "<br>Nombre: ".$list[$respuestaArray['response']['games'][$i]['appid']];
                echo "<br>AppID: ".$respuestaArray['response']['games'][$i]['appid'];
                echo "<br>Playtime_forever: ".$respuestaArray['response']['games'][$i]['playtime_forever'];
                echo "<br>Playtime_windows: ".$respuestaArray['response']['games'][$i]['playtime_windows_forever'];
                echo "<br>Playtime_linux: ".$respuestaArray['response']['games'][$i]['playtime_linux_forever'];
                echo "<br>Playtime_mac: ".$respuestaArray['response']['games'][$i]['playtime_mac_forever'];
                echo "<br>rtime_last_played: ".$respuestaArray['response']['games'][$i]['rtime_last_played'];
                echo "<br>";
        }
        }

        $url = "http://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key=".$steamkey."&steamid=".$steamid."&relationship=friend";
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $respuesta = curl_exec($curl);
        $respuestaArray = json_decode($respuesta, true);
        echo "<br><br><b>Amigos:</b><br>";
        if(count($respuestaArray['friendslist']['friends']) != 0) {
        for($i = 0; $i < count($respuestaArray['friendslist']['friends']); $i++)
        {
            $url2 = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$steamkey."&steamids=".$respuestaArray['friendslist']['friends'][$i]['steamid'];
            curl_setopt($curl, CURLOPT_URL, $url2);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $respuesta2 = curl_exec($curl);
            $respuestaArray2 = json_decode($respuesta2, true);
            if(!is_bool($respuesta2))
            {                
                echo "<br>Nombre: ".$respuestaArray2['response']['players'][0]['personaname'];
                echo "<br>SteamID: ".$respuestaArray['friendslist']['friends'][$i]['steamid'];
                echo "<br>Friend_since: ".$respuestaArray['friendslist']['friends'][$i]['friend_since'];
            }
        }
        }        
        curl_close($curl);
    }
    ?>
</body>
</html>