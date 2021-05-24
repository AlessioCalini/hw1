<?php
    $curl=curl_init();
    curl_setopt($curl,CURLOPT_URL, "https://wger.de/api/v2/exerciseimage/?key=d6908488de27fe20034dc0616e4653902e4cf206?format=json&limit=118");
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    $result=curl_exec($curl);
    curl_close($curl);

    echo $result;
    ?>