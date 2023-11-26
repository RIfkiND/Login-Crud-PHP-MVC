<?php 
include("./model/Post_model.php");
class Search_Controller {

    private $model;
    public function __construct() {
     $this->model = new Post_model();
    }

    public function search() {
         
    }
}