<?php

header('Content-type: application/json');

function sendResponse($success, $message, $data) {
    $response = [
        'success' => $success,
        'message' => $message,
        'data' => $data
    ];
    echo json_encode($response);
    die();
}

function checkParameter($params) {
    $available = true;
    $missingParams = array();
    foreach($params as $param) {
        if(!isset($_REQUEST[$param]) || strlen($_REQUEST[$param]) <= 0 ) {
            $available = false;
            array_push($missingParams, $param);
        }
    }
    if (!$available) {
        $message = 'Error Missing Field : ' . implode(', ', $missingParams);
        sendResponse(false, $message, null);
    }
}