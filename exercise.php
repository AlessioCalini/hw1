<?php
     $curl=curl_init();
     curl_setopt($curl,CURLOPT_URL, "https://wger.de/api/v2/exercise/?language=2&limit=229");
     curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
     $result=curl_exec($curl);
     curl_close($curl);
 
     echo $result;
    ?>