<?php

req('/controllers/Controller.php');
req('/lib/countries.php');

class CountriesController extends Controller {
    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function afterFilter() {
        parent::afterFilter();
    }

    public function browse() {
        return countries_browse($this->db);
    }

    public function get($id) {
        return countries_get($this->db, $id);
    }

    public function post($data) {

    }

    public function put($id, $data) {
    }

    public function delete($id) {

    }
}