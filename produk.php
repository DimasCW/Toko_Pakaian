<?php
    require "koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

    // get produk by nama produk/keyword
    if(isset($_GET['keyword'])){
        $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
    }
    // get produk by kategori
    else if(isset($_GET['kategori'])){
        $queryGetKategoriId = mysqli_query($con, "SELECT id FROM kategori WHERE nama = '$_GET[kategori]'");
        $kategoriId = mysqli_fetch_array($queryGetKategoriId);

        $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
        
    }
    // get produk default
    else{
        $queryProduk = mysqli_query($con, "SELECT * FROM produk");

    }

    $countData = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/css/style2.css">

</head>
<body>
    <?php
        require "navbar.php";
    ?>

    <!-- banner -->
    <div class="container-fluid banner-produk d-flex align-items-center ">
        <div class="container ">
            <h1 class="text-white text-center">
                Produk
            </h1>
        </div>
    </div>

    <!-- Body -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <?php
                    while($kategori = mysqli_fetch_array($queryKategori)){
                      ?>  
                        <a class="no-decoration" href="produk.php?kategori=<?php echo $kategori['nama'];?>">
                        <li class="list-group-item "><?php echo $kategori['nama']; ?></li>
                        </a>
                      <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                <?php
                    if($countData < 1){
                        ?>
                            <h4 class="text-center my-5">Produk yang anda cari tidak tersedia</h4>
                        <?php
                    }
                ?>

                    <?php
                        while($produk = mysqli_fetch_array($queryProduk)){?>
                    
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="image-box">
                            <img src="image/<?php echo $produk['foto'] ?> " class="card-img-top" alt="...">
                            </div>
                                <div class="card-body">
                                    <h4 class="card-title"><?php $produk['nama']; ?></h4>
                                    <p class="card-text text-truncate"><?php echo $produk['detail'];?></p>

                                     <!-- Ganti ID kategori dengan nama kategori -->
                                        <?php
                                            $queryGetKategori = mysqli_query($con, "SELECT nama FROM kategori WHERE id = '$produk[kategori_id]'");
                                            $kategori = mysqli_fetch_array($queryGetKategori);
                                        ?>
                                    <p class="card-text text-harga">Kategori :  <?php echo $kategori['nama'];?></p>
                                    <p class="card-text text-harga">Rp <?php echo $produk['harga'];?></p>
                                    <a href="produk-detail.php?nama=<?php echo $produk['nama']; ?>" class="btn warna2 text-white link-warning">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../fontawesome/js/all.min.js></script>

</body>
</html>