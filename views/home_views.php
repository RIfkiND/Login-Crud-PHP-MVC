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
    <!--Navbar-->
    <div class="navbar bg-gray-200 flex-grow-5 rounded-full m-1">
        <div class="flex-1">
            <a class="btn btn-ghost normal-case text-xl">Test</a>
        </div>
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost ">
                <div class="w-10 rounded-full">
                    <?php if ($loggedInUserName) : ?>
                        <span class="text-lg"><?php echo htmlspecialchars($loggedInUserName); ?></span>
                    <?php else : ?>
                        <span class="text-lg">Guest</span>
                    <?php endif; ?>
                </div>
            </label>
            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                <?php if ($loggedInUserName) : ?>
                    <!--menampilkan bila sudah alogin -->
                    <a class="justify-between">
                        <?php echo "Profile - " . htmlspecialchars($loggedInUserName); ?>
                        <span class="badge">COOL!</span>
                    </a>
                    </li>
                    <li><a href="index.php?action=home/dashboard">Dashboard</a></li>
                    <li><a href="index.php?action=create">Add Post?</a></li>
                    <li>
                        <form method="post">
                            <button type="submit" name="logout">Logout</button>
                        </form>
                    </li>
                    <li><a href="index.php?action=home/pembuat">@Pembuat </a></li>
                <?php else : ?>
                    <!-- Menujukan Bila Belum Login akan seperti ini -->
                    <li><a href="index.php?action=home/register">Register</a></li>
                    <li><a href="index.php?action=home/login">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <!--Navbar END-->
    <br>
    <!--CARD-->
    <br>
    <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 " id="postGrid">
        <?php foreach ($data as $post) : ?>
            <div class="card card-compact bg-base-100 shadow-xl max-w-md">
                <figure><img src="Storage/image/post/<?php echo $post['image']; ?>" alt="<?php echo $post['nama']; ?>" /></figure>
                <div class="card-body">
                    <h2 class="card-title"><?php echo $post['nama']; ?></h2>
                    <p><?php echo $post['deskripsi']; ?></p>
                    <div class="card-actions justify-end">
                        <div class="dropdown dropdown-bottom dropdown-hover">
                            <label tabindex="0" class="btn m-1"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 128 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z" />
                                </svg></label>
                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                <li><a href="index.php?action=home/show&id_post=<?php echo $post['id_post']; ?>">ShowFUll</a></li>
                                <li><a href="index.php?action=update&id_post=<?php echo $post['id_post']; ?>">Edit</a></li>
                                <button class="btn btn-secondary" onclick="deletePost(<?php echo $post['id_post']; ?>)">Delete</button>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!--CARD END-->


    
  <!-- Pagination -->
<div class="flex justify-center mt-4">
    <div id="pagination" class="mt-4 justify-center">
        <?php if ($halaman > 1) : ?>
            <a class='btn btn-secondary mx-1' href="?halaman=<?php echo $previous; ?>">&laquo; Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_halaman; $i++) : ?>
            <a class='btn btn-secondary mx-1' href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($halaman < $total_halaman) : ?>
            <a class='btn btn-secondary mx-1' href="?halaman=<?php echo $next; ?>">Next &raquo;</a>
        <?php endif; ?>
    </div>
</div>
<!-- Pagination END -->

    <script>
        let currentPage = 1;

        function loadPage(page) {
            document.getElementById('postGrid').innerHTML = newCard + document.getElementById('postGrid').innerHTML;
            currentPage = page;
        }

        function deletePost(id_post) {
            if (confirm('Yakin Delete?')) {
                window.location.href = 'index.php?action=delete&id_post=' + id_post;
            }
        }
    </script>

</body>

</html>

<?php
if (isset($_POST['logout'])) {
    $auth = new LoginController();
    $auth->logout();
}
?>