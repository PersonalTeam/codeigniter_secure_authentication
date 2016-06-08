<?php
use \GuzzleHttp\Client;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getAfasMemberData($memberId)
{
    $apiUsername = "portal_srv_usr";
    $apiPassword = "RkxVSCNUZWNoNjBka2hHRA==";

    $client = new Client([ // Maak API client object
        'base_uri' => "https://$apiUsername:$apiPassword@188.202.124.134/connector/public/",
        'verify' => false,
        'timeout' => 10.0
    ]);
    // Doe verzoek, zonder auth header
    $res = $client->request('GET', 'getmember/' . 10724);

    if ($res->getStatusCode() == 200) {

        return $res->getBody();

    } else {
        //$this->logout(HTTPS_ERROR);
        return $res->getBody();
    }
}