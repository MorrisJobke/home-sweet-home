<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$TOKEN = 'PUT_YOUR_TOKEN_HERE';

$client = new Client([
	'base_uri' => 'http://www.mapquestapi.com/',
	'query' => [
		'key' => $TOKEN,
	],
]);



$fileData = json_decode(file_get_contents(__DIR__ . '/../data.json'), true);

if ($fileData === null) {
    echo "Failed to read data: " . json_last_error_msg() . "\n";
    exit(1);
}

foreach ($fileData['list'] as $id => $entry) {

    if (isset($entry['lat'])) {
        continue;
    }
    $data = [
        "location" => "Chemnitz, " . $entry['streetname'],
        "options" => [
        "thumbMaps" => false,
        ],
    ];

    $response = $client->post('/geocoding/v1/address', [
        'json' => $data,
    ]);

    $body = $response->getBody()->getContents();

    $responseData = json_decode($body, true);

    $coords = $responseData['results'][0]['locations'][0]['latLng'];

    $fileData['list'][$id]['lat'] = $coords['lat'];
    $fileData['list'][$id]['lng'] = $coords['lng'];
}

file_put_contents(__DIR__ . '/../data.json', json_encode($fileData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); 
