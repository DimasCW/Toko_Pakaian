<?php
    require "koneksi.php";

    $nama = htmlspecialchars($_GET['nama']);
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama = '$nama'");
    $produk = mysqli_fetch_array($queryProduk);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/css/style2.css">


</head>
<body>
<?php require "navbar.php"; ?>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="image/<?php echo $produk['foto'] ?>" class="w-100" alt="">
                </div>
                <div class="col-md-6 offset-md-1">
                    <h1><?php echo $produk['nama']?></h1>
                    <p class="fs-5"><?php echo $produk['detail'] ?></p>
                    <p class="text-harga">
                        Rp <?php echo $produk['harga'] ?>
                    </p>
                    <p>Status Ketersediaan : <strong><?php echo $produk['ketersediaan_stok'] ?></strong></p>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../fontawesome/js/all.min.js></script>

</body>
</html>