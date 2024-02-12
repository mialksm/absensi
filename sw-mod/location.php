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
    $response = $client->request('GET', "http://ip-api.com/json/" . $myip);

    // Get the response body as a string
    $body = $response->getBody();

    while ($row = mysqli_fetch_assoc($result_isp)) {
        echo ($row['isp_name']);
        echo " (" . $myip . " aa)";
        echo " (" . $body['country'] . ")";
        echo " (" . $body['countryCode'] . ")";
        echo " (" . $body['city'] . ")";
        echo " (" . $body['isp'] . ")";
    }
}
