<?php

function error($message,$type='') {
    header("Content-Type: application/json");
    echo json_encode(['message' => $message,'type' => $type]);
    exit(1);
}