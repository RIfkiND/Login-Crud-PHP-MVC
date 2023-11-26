<?php 


require_once("./model/Post_model.php");


class DashBoardController{

    private $model;
    public $validate;
    public function __construct()
    {
        $this->model= new Post_model();
        $this->validate=new ValidateController();
    }

    public function index(){
        $data = $this->model->selectALL();
        include("./views/dashboard_vires.php");

    }

    public function forto(){

        include("./views/Forto/FortoFolio.php");
    }
}