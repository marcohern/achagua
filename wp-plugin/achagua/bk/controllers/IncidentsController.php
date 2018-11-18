<?php

req('/controllers/Controller.php');
req('/lib/incidents.php');

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
        return incidents_get($this->db, $id);
    }

    public function post($data) {
        $errors = incidents_validate($data);
        if (count($errors)>0) {
            return err_bad_request('Validation failed.','validate');
        }
        return incidents_create($this->db, $data);
    }

    public function put($id, $data) {
        return incidents_update($this->db, $id, $data);
    }

    public function delete($id) {
        return incidents_delete($this->db, $id);
    }
}