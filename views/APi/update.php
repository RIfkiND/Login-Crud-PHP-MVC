<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Post - SantriKoding.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="index.php?action=update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_post" value="<?php echo $id_post; ?>">
                            <div class="form-group">
                                <label class="font-weight-bold">GAMBAR</label>
                                <input type="file" class="form-control" name="image">
                               
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">NAMA</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Post"   value="<?php echo htmlspecialchars($row['nama']); ?>" autocomplete="off" required />
                               
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">KONTEN</label>
                                <textarea class="form-control" name="deskripsi" id="content" rows="5" placeholder="Masukkan Deskripsi Post" value="<?php echo htmlspecialchars($row['deskripsi']); ?>" autocomplete="off" required></textarea>
                         
                            </div>

                            <button type="submit" class="btn btn-md btn-primary" name="update">UPdate</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <a class="btn btn-md btn-secondary" href="index.php">Kembali</a>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>
</body>
</html>




<?php

if (isset($_POST["update"])) {
        $main= new PostController();
        $main->update();
}
?>