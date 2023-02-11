<?php

function response(int $status, string $status_text, array $data = null) {
    header("HTTP/1.1 ".$status);
		
    $response['status'] = $status;
    $response['status_text'] = $status_text;
    $response['data'] = $data;
    
    echo json_encode($response);
    exit();
}

function app() {
    return \App\Core\App::getInstance();
}