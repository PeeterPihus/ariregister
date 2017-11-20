<?php

function getname($isikukood)
{

    $url = 'https://projects.diarainfra.com/xtee/request/';

    $data = [
        'socialId1' => $isikukood,
        'socialId2' => $isikukood,
        'organization' => 'äriregister',
        'destination' => 'Rahvastikuregister',
        'request' => 'äriregister-request',
        'endpoint' => 'persons/get?person_code=' . $isikukood
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_VERBOSE, true);

    $verbose = fopen('php://temp', 'w+');
    curl_setopt($ch, CURLOPT_STDERR, $verbose);


    $json = curl_exec($ch);
    if ($json === FALSE) {
        printf("cUrl error (#%d): %s<br>\n", curl_errno($ch),
            htmlspecialchars(curl_error($ch)));
    }

//    rewind($verbose);
//    $verboseLog = stream_get_contents($verbose);
//    echo "Verbose information:\n<pre>", htmlspecialchars($verboseLog), "</pre>\n";
//    var_dump($json);
    curl_close($ch);

    $p_data = json_decode($json, true);

    if ($p_data['status'] == 400) {
        return ['person_first_name' => '',
            'person_last_name' => ''];
    }

    if (!isset($p_data['data'])) {
        return ['person_first_name' => '',
            'person_last_name' => ''];
    }

    return $p_data['data'];
}
