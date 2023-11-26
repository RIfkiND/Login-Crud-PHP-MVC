<?php
include("./controllers/PostController.php");
include("./controllers/LoginController.php");
include("./controllers/RegisterController.php");
include("./controllers/DashBoardController.php");

$main = new PostController();
$auth = new LoginController();
$reg = new RegisterController();
$dash = new DashBoardController();

if (isset($_GET["action"])) {
    $action = $_GET["action"];

    switch ($action) {
        case "home/register":
            $reg->registerView();
            break;
        case "home/login":
            $auth->loginview();
            break;
        case "create":
            $main->viewInsert();
            break;  
        case "update":
            $id_post = isset($_GET["id_post"]) ? $_GET["id_post"] : null;
            $main->viewUpdate($id_post);
            break;
        case "delete":
            $id_post = isset($_GET["id_post"]) ? $_GET["id_post"] : null;
            $main->DeletePost($id_post);
            break;
        case "home/show":
            $id_post = isset($_GET["id_post"]) ? $_GET["id_post"] : null;    
            $main->show($id_post);
            break;
        case "home/dashboard":
            $dash->index();
            break;
        case "home/pembuat":
            $dash->forto();
            break;
        default:
            $main->index();
            break;
    }
} else {

    $main->index();
}
