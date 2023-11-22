<?php

// $postdata = http_build_query();

// $opts = array('https' =>
//     array(
//         'method'  => 'POST',
//         'header'  => 'Content-Type: application/x-www-form-urlencoded',
//         'content' => $postdata
//     )
// );

// $context  = stream_context_create($opts);

// $result = file_get_contents('https://quizart.co.in/admin/quiz_creation', false, $context);

$ch = curl_init();
$curlConfig = array(
    CURLOPT_URL            => "https://quizart.co.in/admin/quiz_creation",
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS     => array()
);
curl_setopt_array($ch, $curlConfig);
$result = curl_exec($ch);
curl_close($ch);
?>
