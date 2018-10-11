<?php

function error($message,$type='', $responseCode = 500) {
    header("Content-Type: application/json");
    http_response_code($responseCode);
    echo json_encode(['message' => $message,'type' => $type]);
    exit(1);
}

function err_bad_request($message, $type='') {
    return error($message, $type, 400);
}

function err_unauthorized($message, $type='') {
    return error($message, $type, 401);
}

function err_forbidden($message, $type='') {
    return error($message, $type, 403);
}

function err_not_found($message, $type='') {
    return error($message, $type, 404);
}

