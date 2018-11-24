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

    public function state_count() {
        return incidents_state_count($this->db);
    }

    public function state_count_by_year($year) {
        return incidents_state_count_by_year($this->db,$year);
    }

    public function year_count_by_state($state_id) {
        return incidents_year_count_by_state($this->db, $state_id);
    }

    public function city_count_by_state($state_id) {
        return incidents_city_count_by_state($this->db, $state_id);
    }

    public function city_count_by_state_year($state_id) {
        echo json_encode(['state' => $state_id, 'p0'=>$this->p0,'params'=>$this->params]);
        $year = 2004;
        if (!empty($this->p0)) $year = 0+$this->p0;
        return incidents_city_count_by_state_year($this->db, $state_id, $year);
    }

    public function year_count_by_city($city_id) {
        return incidents_year_count_by_city($this->db, $city_id);
    }
}