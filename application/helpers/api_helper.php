<?php
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getAfasMemberData($context, $memberId)
{
    $apiUsername = "portal_srv_usr";
    $apiPassword = "RkxVSCNUZWNoNjBka2hHRA==";

    $client = new Client([ // Maak API client object
        'base_uri' => "https://$apiUsername:$apiPassword@188.202.124.134/connector/public/",
        'verify' => false,
        'timeout' => 10.0
    ]);
    // Doe verzoek, zonder auth header
    try {
        $res = $client->request('GET', 'getmember/' . $memberId);
    } catch (BadResponseException $e) {
        $message = 'Backoffice foutmelding: Er trad een fout op bij het ophalen van uw lidmaatschapsinformatie. Statuscode: ' . $e->getCode() . '<br /> Vanwege veiligheidsoverwegingen bent u automatisch uitgelogd';
        $context->AuthModel->destroySession($message);
    }

    if ($res->getStatusCode() == 200) {
        return $res->getBody();
    }
}

function getDossiesOverviewData($context, $memberId)
{
    $apiUsername = "portal_srv_usr";
    $apiPassword = "RkxVSCNUZWNoNjBka2hHRA==";

    $client = new Client([ // Maak API client object
        'base_uri' => "https://$apiUsername:$apiPassword@188.202.124.134/connector/public/",
        'verify' => false,
        'timeout' => 10.0
    ]);
    // Doe verzoek, zonder auth header
    try {
        $res = $client->request('GET', 'getdossiers/' . $memberId);
    } catch (BadResponseException $e) {
        $message = 'Backoffice foutmelding: Er trad een fout op bij het ophalen van uw dossierinformatie. Statuscode: ' . $e->getCode() . '<br /> Vanwege veiligheidsoverwegingen bent u automatisch uitgelogd';
        $context->AuthModel->destroySession($message);
    }


    if ($res->getStatusCode() == 200) {
        return $res->getBody();
    }
}


function getDossierFiles($context, $dossierId)
{
    $apiUsername = "portal_srv_usr";
    $apiPassword = "RkxVSCNUZWNoNjBka2hHRA==";

    $client = new Client([ // Maak API client object
        'base_uri' => "https://$apiUsername:$apiPassword@188.202.124.134/connector/public/",
        'verify' => false,
        'timeout' => 10.0
    ]);
    // Doe verzoek, zonder auth header
    try {
        $res = $client->request('GET', 'getdossierfiles/' . $dossierId);
    } catch (BadResponseException $e) {
        $message = 'Backoffice foutmelding: Er trad een fout op bij het ophalen van uw dossierinformatie. Statuscode: ' . $e->getCode() . '<br /> Vanwege veiligheidsoverwegingen bent u automatisch uitgelogd';
        $context->AuthModel->destroySession($message);
    }


    if ($res->getStatusCode() == 200) {
        return $res->getBody();
    }

}


function getHandelingFile($context, $decodedId)
{
    $apiUsername = "portal_srv_usr";
    $apiPassword = "RkxVSCNUZWNoNjBka2hHRA==";

    $client = new Client([ // Maak API client object
        'base_uri' => "https://$apiUsername:$apiPassword@188.202.124.134/connector/public/",
        'verify' => false,
        'timeout' => 10.0
    ]);
    // Doe verzoek, zonder auth header
    try {
        $res = $client->request('GET', 'gethandelingfile/' . $decodedId);
    } catch (BadResponseException $e) {
        $message = 'Backoffice foutmelding: Er trad een fout op bij het ophalen van uw contributieteruggaaf formulier. Statuscode: ' . $e->getCode() . '<br /> Vanwege veiligheidsoverwegingen bent u automatisch uitgelogd';
        $context->AuthModel->destroySession($message);
    }

    if ($res->getStatusCode() == 200) {
        return $res->getBody();
    }
}


function getContributionFile($context, $decodedId)
{
    $apiUsername = "portal_srv_usr";
    $apiPassword = "RkxVSCNUZWNoNjBka2hHRA==";

    $client = new Client([ // Maak API client object
        'base_uri' => "https://$apiUsername:$apiPassword@188.202.124.134/connector/public/",
        'verify' => false,
        'timeout' => 10.0
    ]);
    // Doe verzoek, zonder auth header
    try {
        $res = $client->request('GET', 'getcontributionfile/' . $decodedId);
    } catch (BadResponseException $e) {
        $message = 'Backoffice foutmelding: Er trad een fout op bij het ophalen van uw contributieteruggaaf formulier. Statuscode: ' . $e->getCode() . '<br /> Vanwege veiligheidsoverwegingen bent u automatisch uitgelogd';
        $context->AuthModel->destroySession($message);
    }


    if ($res->getStatusCode() == 200) {
        return $res->getBody();
    }
}