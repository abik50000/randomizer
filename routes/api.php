<?php 

$routes = [
    [['GET'], '/numbers', ['NumberController', 'all'], [], 'all-numbers'],
    [['POST'], '/numbers/create', ['NumberController', 'create'], [], 'create-numbers'],
    [['GET'], '/numbers/{id}', ['NumberController', 'find'], ['id' => '[0-9]+'], 'find-numbers'],
    [['POST'], '/numbers/clear', ['NumberController', 'clear'], [], 'clear-numbers'],
];