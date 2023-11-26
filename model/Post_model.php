    <?php


    class Post_model
    {
        private $db;

        public function __construct()
        {
            $this->db = new mysqli("localhost", "root", "", "belajar_php");

            if ($this->db->connect_error) {
                die("Connection failed: " . $this->db->connect_error);
            }
        }

        public function execute($query)
        {
            return $this->db->query($query);
        }

        public function selectALL()
        {
            $query = "SELECT * FROM tb_post";
            $result = $this->db->query($query);

            if (!$result) {
                die("Query failed: " . $this->db->error);
            }
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }


        public function getTotalItems()
        {
            $result = $this->db->query("SELECT COUNT(*) as total FROM tb_post");
            $row = $result->fetch_assoc();
            return $row['total'];
        }


        public function selectByPage($limit, $offset)
        {
            $query = "SELECT * FROM tb_post LIMIT $limit OFFSET $offset";
            return $this->execute($query);
        }


        public function insertPost($image, $nama, $deskripsi)
        {
            $image = $this->db->real_escape_string($image);

            $query = "INSERT INTO tb_post (image, nama, deskripsi) VALUES ('$image', '$nama', '$deskripsi')";

            $result = $this->execute($query);

            if ($result) {
                echo "<script>alert ('Data berhasil di simpan')</script>";
                return true;
            } else {
                return false;
            }
        }
        public function updatePost($id_post, $image, $nama, $deskripsi)
        {
            if ($image !== null) {
                $query = "UPDATE tb_post SET image = '$image', nama = '$nama', deskripsi = '$deskripsi' WHERE id_post = '$id_post'";
            } else {
                $query = "UPDATE tb_post SET nama = '$nama', deskripsi = '$deskripsi' WHERE id_post = '$id_post'";
            }

            return $this->execute($query);
        }


        public function deletePost($id_post)
        {
            $query = "DELETE FROM tb_post WHERE id_post='$id_post'";
            return $this->execute($query);
        }
        public function getRow($var)
        {
            return mysqli_fetch_array($var);
        }
        function selectPost($id_post)
        {
            $query = "SELECT * FROM tb_post WHERE id_post='$id_post'";
            return $this->execute($query);
        }


        public function __destruct()
        {
            $this->db->close();
        }
    }
