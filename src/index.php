<?php

$autoload = __DIR__ . '/vendor/autoload.php';
if (!file_exists($autoload)) {
    echo $autoload . " was not found";
    exit;
}

include __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

use Zendesk\API\HttpClient as ZendeskAPI;

$subdomain = "yellowcorphelp";
$username  = "dmytrovatral@gmail.com"; // replace this with your registered email
$token     = "SOPWVDaiupdzVKrAIGQdN5evYajGjCwNEMRJ16Y2"; // replace this with your token

$client = new ZendeskAPI($subdomain);
$client->setAuth('basic', ['username' => $username, 'token' => $token]);

$tickets = $client->tickets()->findAll()->tickets;

$headers = [
    "Ticket ID",
    "Description",
    "Status",
    "Priority",
    "Agent ID",
    "Agent Name",
    "Agent Email",
    "Contact ID",
    "Contact Name",
    "Contact Email",
    "Group ID",
    "Group Name",
    "Company ID",
    "Company Name",
    "Comments"
];

$parameters = [
    "id",
    "description",
    "status",
    "priority",
    "assignee_id",
    "assignee_name",
    "assignee_email",
    "contact_id",
    "contact_name",
    "contact_email",
    "group_id",
    "group_name",
    "organization_id",
    "organization_name",
    "comments"
];

$csvName = "file.csv";
$fileHandle = fopen($csvName, 'w');

fputcsv($fileHandle,$headers,";");

foreach($tickets as $ticket) {
    foreach($parameters as $parameter) {
        if(isset($ticket->$parameter))
            $string[] = $ticket->$parameter;
        else
            $string[] = '-';
    }
    fputcsv($fileHandle,$string,";");
    unset($string);
}

fclose($fileHandle);