<?php

req("/controllers/Controller.php");
req("/lib/database.php");
req("/lib/header.php");

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
    private static $getid = '/((\/(?<action>[a-zA-Z_]\w+))?\/(?<id>\w+))/';

    private $method;
    private $input;
    private $params;
    private $controller;
    private $action;
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
        $this->action = null;

        $m = [];
        preg_match_all(self::$getid,$this->query,$m);
        if (count($m['id'    ])) $this->id     = $m['id'    ][0];
        if (count($m['action'])) $this->action = $m['action'][0];

        if (empty($this->action)) {
            $this->action = strtolower($this->method);
        }
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
        $data = json_decode(file_get_contents("php://input"));
        $action = $this->action;
        switch($this->method) {
            case 'POST':
                //$data = (object)['data' => 123];
                if (method_exists($ctrl, $action)) $result = $ctrl->$action($data);
                else err_not_found("Method {$this->method} not available",'http');
                $call = "\$ctrl->$action(".json_encode($data).")";
                break;
            case 'PUT':
                //$data = (object)['data' => 123];
                if (method_exists($ctrl, $action)) $result = $ctrl->$action($this->id, $data);
                else err_not_found("Method {$this->method} not available",'http');
                $call = "\$ctrl->$action({$this->id},".json_encode($data).")";
                break;
            case 'DELETE':
                if (method_exists($ctrl, $action)) $result = $ctrl->$action($this->id);
                else err_not_found("Method {$this->method} not available",'http');
                $call = "\$ctrl->$action({$this->id})";
                break;
            case 'GET':
            default:
                if (empty($this->id)) {
                    if (method_exists($ctrl, $action)) $result = $ctrl->$action();
                    else err_not_found("Method {$this->method} not available",'http');
                    $call = "\$ctrl->$action()";
                }
                else {
                    if (method_exists($ctrl, $action)) $result = $ctrl->$action($this->id);
                    else err_not_found("Method {$this->method} not available",'http');
                    $call = "\$ctrl->$action({$this->id})";
                }
                break;
            
        }
        $ctrl->afterFilter();
        $db->close();

        incidents_header();
        //echo json_encode(['r'=>$result,'call' => $call]);//exit(0);
        echo json_encode($result);//exit(0);
    }

    public function json() {
        incidents_header();
        $cc = ucwords(strtolower($this->controller), "_-").'Controller';
        $cf = "/controllers/$cc.php";
        $data = (object)json_decode(file_get_contents("php://input"));
        echo json_encode([
            'method' => $this->method,
            'input' => $this->input,
            'controller' => $this->controller,
            'controllerClass' => $cc,
            'controllerFile' => $cf,
            'action' => $this->action,
            'query' => $this->query,
            'data' => $data,
            'params' => $this->params,
            'id' => $this->id,
            'get' => $_GET
        ]);
    }
}