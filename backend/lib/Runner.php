<?php

class Runner {
    private $method;
    private $input;
    private $params;
    private $controller;
    private $id;
    private $query;

    public function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $q = preg_replace('/^\/backend/','', $_ENV['REQUEST_URI']);
        $this->input = $q;
        $m = [];
        preg_match_all('/^'
            .'(('
                .'\/(?<controller>[^\/]*)('
                    .'(?<query>\/[^?]*)('
                        .'\?(?<params>.*)'
                    .')?'
                .')?'
            .'))?'
        .'/',$q,$m);
        $this->controller = $m['controller'][0];
        $this->query = $m['query'][0];
        $this->params = $m['params'][0];
        $this->anchor = $m['anchor'][0];

        $m = [];
        preg_match_all('/(\/(?<id>\w+))/',$this->query,$m);
        $this->id = $m['id'][0];
    }

    public function json() {
        header("Content-Type: application/json");
        echo json_encode([
            'method' => $this->method,
            'input' => $this->input,
            'controller' => $this->controller,
            'query' => $this->query,
            'params' => $this->params,
            'anchor' => $this->anchor,
            'id' => $this->id,
            'get' => $_GET
        ]);
    }
}