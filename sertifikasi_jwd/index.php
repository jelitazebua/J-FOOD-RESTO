<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di J FOOD RESTO</title>

        <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">

    <header>
        <img src="Image/header6.png" alt="">
        </header>
        <nav>
            <ul>
                <li><a href="Index.php">Home</a></li>
                <li><a href="Index.php?page=order_input">Pemesanan</a></li>
                <li><a href="Index.php?page=order_tampil">Daftar Pesanan</a></li>
                <li><a href="Index.php?page=kontak">Kontak</a></li>
                <li><a href="Index.php?page=About">About</a></li>
            </ul>
        </nav>
        <main>
                <?php
                if (isset($_GET['page'])) {
                    require $_GET['page'].".php";
                } else {
                    require "main.php";
                }
                    ?>
        </main>
        <footer>

                <p>copyright &copy; 2024. Jelita - Juni 2024 UIN Sumatera Utara</p>
        </footer>
    




    </div>
</body>
</html>