<?php

include("./model/Post_model.php");
include("ValidateController.php");

class PostController
{
    public $model;
    public $validate;
    public function __construct()
    {
        $this->model= new Post_model();
        $this->validate=new ValidateController();
    }
    public function index()
    {
        $batas = 8;
        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        $halamanawal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
        $previous = $halaman - 1;
        $next = $halaman + 1;
        
    
        $totalCards= $this->model->getTotalItems(); 
        $loggedInUserName = isset($_SESSION['username']) ? $_SESSION['username'] : null;
        $data = $this->model->selectByPage($batas, $halamanawal);
    
        $total_halaman = ceil($totalCards / $batas); 
    
        include("./views/home_views.php");
    }
    
    

    public function show($id_post){
        $data = $this->model->selectPost($id_post);
        $row = $this ->model->getRow($data);
        include("./views/APi/show_views.php");
    }

    public function viewInsert()
    {
        include("./views/API/create.php");
    }
    public  function viewUpdate($id_post)
    {
        $data = $this->model->selectPost($id_post);
        $row = $this->model->getRow($data);
        include ("./views/APi/update.php");
    }

    public function insert()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $image = $_FILES["image"]["name"];
            $nama = htmlspecialchars($_POST["nama"]);
            $deskripsi = htmlspecialchars($_POST["deskripsi"]);
            $image_tmp = $_FILES["image"]["tmp_name"];

            $errors = $this->validate->validateInsert( $image, $nama, $deskripsi );
            if (move_uploaded_file($image_tmp, "Storage/image/post/" . $image)) {
                $insert = $this->model->insertPost($image, $nama, $deskripsi);
                if ($insert) {
                    header("Location: index.php");
                } else {
                    echo "Failed to insert data.";
                }
            } else {
                echo "Failed to upload the image.";
            }
            foreach ($errors as $error) {
                echo  $error ."Check";
            }
        }
    }

    public function update()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["id_post"])) {
            $id_post = $_POST["id_post"];
            $nama = $_POST["nama"];
            $deskripsi = $_POST["deskripsi"];

            if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
                $image = $_FILES["image"]["name"];
                $image_tmp = $_FILES["image"]["tmp_name"];
                $image_directory = "Storage/image/post/";

                $errors = $this->validate->validateInsert($image, $nama, $deskripsi);

                if (move_uploaded_file($image_tmp, $image_directory . $image)) {

                    $update = $this->model->updatePost($id_post, $image ,$nama, $deskripsi);

                    if ($update) {
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "Failed to update data.";
                    }
                } else {
                    echo "Failed to upload the image.";
                }
            } else {
                $update = $this->model->updatePost($id_post, null, $nama, $deskripsi);

                if ($update) {
                    header("Location: index.php");
                    exit(); 
                } else {
                    echo "Failed to update data.";
                }
            }
        } else {
            echo "Missing id_post ";
        }
    }
}



    public function DeletePost( $id_post )
    {
        $postData = $this->model->deletePost($id_post);
    
        if ($postData) {
            $imageFileName = $postData['image'];
    
            $delete = $this->model->deletePost($id_post);
            if ($delete) {
                $imageDirectory = "Storage/image/post/";
                if ($imageFileName && file_exists($imageDirectory . $imageFileName)) {
                    unlink($imageDirectory . $imageFileName);
                }
                header("Location: index.php");
            } else {
                echo "<script>alert('Failed To Delete Data')</script>";
            }
        } else {
            echo "<script>alert('Berhasil')</script>";
            header("Location: index.php");
        }
    }
    
}

//end in 150 line