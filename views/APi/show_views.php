<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/public/CSS/Home.css">
    <title>Document</title>
</head>

<body>

    <div class="navbar bg-base-200 ">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl">Test</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li><a>Link-></a></li>
                <li>
                    <details>
                        <summary>
                            Menu
                        </summary>
                        <ul class="p-2 bg-base-100">
                            <li><a href="index.php">Kembali</a></li>
                            
                        </ul>
                    </details>
                </li>
            </ul>
        </div>
    </div>
    <br>

    <!--CARD-->
    <?php foreach ($data as $post) : ?>
        <div class="carousel carousel-end rounded-box">
            <div class="carousel-item">
                <img class=" max-w-lg" src="Storage/image/post/<?php echo $post['image']; ?>" alt="<?php echo $post['nama']; ?>" />
            </div>

            <div class="carousel-item">
                <div class="card w-96 bg-base-100 shadow-xl max-w-full">
                    <div class="card-body">
                        <h2 class="card-title text-7xl"><?php echo $post['nama']?></h2>
                        <br>
                        <p class="text-2xl"><?php echo $post['deskripsi']?></p>
                        <div class="card-actions justify-end">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

    <!--card END-->


</body>

</html>