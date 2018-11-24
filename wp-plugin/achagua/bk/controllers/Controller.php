<?php

class Controller {

    protected $db;
    protected $p0;
    protected $params;

    public function __construct($db) {
        $this->db = $db;
    }

    public function setP0($p0) {
        $this->p0 = $p0;
    }

    public function setParams($params) {
        $this->params = $params;
    }

    public function beforeFilter() {

    }

    public function afterFilter() {

    }
}