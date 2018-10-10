<?php

req("/controllers/Controller.php");
req("/lib/database.php");

class Runner {

    private static $remove = '/^\/wp-content\/plugins\/achagua\/bk/';
    private static $extract = '/^'
        .'(('
            .'\/(?<controller>[^\/]*)('
                .'(?<query>\/[^?]*)('
                    .'\?(?<params>.*)'
                .')?'
            .')?'
        .'))?'
    .'/';
    private static $getid = '/(\/(?<id>\w+))/';

    private $method;
    private $input;
    private $params;
    private $controller;
    private $id;
    private $query;

    private $rel;
    private $full;
    private $pos;

    public function __construct() {
        $this->method = strtoupper($_SERVER['REQUEST_METHOD']);
        $q = preg_replace(self::$remove,'', $_ENV['REQUEST_URI']);
        $this->input = $q;
        $m = [];
        preg_match_all(self::$extract,$q,$m);
        $this->controller = $m['controller'][0];
        $this->query = $m['query'][0];
        $this->params = $m['params'][0];

        $m = [];
        preg_match_all(self::$getid,$this->query,$m);
        if (count($m['id'])) $this->id = $m['id'][0];
    }

    public function run() {
        $params = (object) req('/config/db.php');

        $cc = ucwords(strtolower($this->controller), "_-").'Controller';
        $cf = "/controllers/$cc.php";
        
        $db = db_connect($params);
        req($cf);
        
        $ctrl = new $cc($db);

        $result = null;
        $ctrl->beforeFilter();
        $call = '';
        switch($this->method) {
            case 'POST':
                $data = (object)['data' => 123];
                $result = $ctrl->post($data);
                $call = "\$ctrl->post(".json_encode($data).")";
                break;
            case 'PUT':
                $data = (object)['data' => 123];
                $result = $ctrl->put($this->id, $data);
                $call = "\$ctrl->put({$this->id},".json_encode($data).")";
                break;
            case 'DELETE':
                $result = $ctrl->delete($this->id);
                $call = "\$ctrl->delete({$this->id})";
                break;
            case 'GET':
            default:
                if (empty($this->id)) {
                    $result = $ctrl->browse();
                    $call = "\$ctrl->browse()";
                }
                else {
                    $result = $ctrl->get($this->id);
                    $call = "\$ctrl->get({$this->id})";
                }
                break;
            
        }
        $ctrl->afterFilter();
        $db->close();

        header("Content-Type: application/json");
        //echo json_encode(['r'=>$result,'call' => $call]);//exit(0);
        echo json_encode($result);//exit(0);
    }

    public function json() {
        header("Content-Type: application/json");
        $cc = ucwords(strtolower($this->controller), "_-").'Controller';
        $cf = "/controllers/$cc.php";
        echo json_encode([
            'method' => $this->method,
            'input' => $this->input,
            'controller' => $this->controller,
            'controllerClass' => $cc,
            'controllerFile' => $cf,
            'query' => $this->query,
            'params' => $this->params,
            'id' => $this->id,
            'get' => $_GET
        ]);
    }
}