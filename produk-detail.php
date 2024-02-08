<?php
    require "koneksi.php";

    $nama = htmlspecialchars($_GET['nama']);
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama = '$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    $queryProdukTerkait = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id = '$produk[kategori_id]'
     AND id!='$produk[id]' LIMIT 4");
    $produkTerkait = mysqli_fetch_array($queryProdukTerkait);

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
                <div class="col-lg-5 mb-3">
                    <img src="image/<?php echo $produk['foto'] ?>" class="w-100" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
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

    <!-- Produk Terkait -->
    <div class="container-fluid py-5 warna2">
        <div class="container">
            <h2 class="text-center text-white mb-5">Produk Terkait</h2>

            <div class="row">
                <?php
                    while($data = mysqli_fetch_array($queryProdukTerkait)){
                ?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="produk-detail.php?nama=<?php echo $data['nama'];?>">
                    <img src="image/<?php echo $data['foto']; ?>" alt="" class="img-fluid img-thumbnail produk-terkait-image">
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php
        require "footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../fontawesome/js/all.min.js></script>

</body>
</html>