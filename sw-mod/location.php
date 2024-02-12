<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;


if (empty($connection)) {
    header('location:./404');
} else {
    $query_isp   = "SELECT * FROM isp limit 1";
    $result_isp  = mysqli_query($connection, $query_isp);
    $myip = $_SERVER['REMOTE_ADDR'];

    $client = new Client();
    $response = $client->request('GET', "http://ip-api.com/json/" . $myip, [
        'headers' => [
            'Accept' => 'application/json', // Specify that you expect JSON
        ],
    ]);

    // Get the response body as a string
    $body = $response->getBody()->getContents();
    $body = json_decode($body, true);

    // Check if decoding was successful
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        die("Error decoding JSON: " . json_last_error_msg());
    }

    while ($row = mysqli_fetch_assoc($result_isp)) {
        if ($row['isp_name'] != $body['isp']) {
            header('location:../404');
        }
    }
}
