<?php

class IncidentsController extends Controller {
    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function afterFilter() {
        parent::afterFilter();
    }

    public function browse() {
        return incidents_browse($this->db);
    }

    public function get($id) {
        return incidents_browse($this->db, $id);
    }

    public function post($data) {
        return incidents_create($data);
    }

    public function put($id, $data) {
        return incidents_update($id, $data);
    }

    public function delete($id) {
        return incidents_delete($id);
    }
}