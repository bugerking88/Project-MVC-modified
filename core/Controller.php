<?php

class Controller {
    public function model($model,$data = NULL) {
        require_once "models/$model.php";
        return new $model($data);
    }
    public function view($view, $data = Array()) {
        require_once "views/$view.php";
    }
}

?>