<?php

function error($message,$type='') {
    header("Content-Type: application/json");
    http_response_code(400);
    echo json_encode(['message' => $message,'type' => $type]);
    exit(1);
}