<?php

req('/controllers/Controller.php');
req('/lib/states.php');

class StatesController extends Controller {
    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function afterFilter() {
        parent::afterFilter();
    }

    public function browse() {
        return states_browse($this->db);
    }

    public function get($id) {
        return states_get($this->db, $id);
    }

    public function post($data) {

    }

    public function put($id, $data) {
    }

    public function delete($id) {

    }
}