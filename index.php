<?php
    require "koneksi.php";
    $queryProduk = mysqli_query($con, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6 ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Pakaian | HOME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/css/style2.css">

</head>
<body>
    <?php require "navbar.php"; ?>
    <!-- banner -->
<div class="container-fluid banner d-flex align-items-center">
    <div class="container text-center">
        <h1 class="stroke-text-white">Toko Online Fashion</h1>
        <h3 class="stroke-text-white">Mau Cari Apa</h3>
            <div class="col-md-8 offset-md-2">
                <form action="produk.php" method="get">
            <div class="input-group input-group-lg my-4" bis_skin_checked="1">
                <input type="text" class="form-control" placeholder="Nama Barang" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                <button type="submit" class="btn warna2 text-white">Telusuri</button>
            </div>
            </form>
            </div>
    </div>
    
</div>

<!-- highlight kategori -->
    <div class="container-fluid py-5 text-center">
        <div class="container">
            <h3>Kategori Teratas</h3>


            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-baju-pria d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Baju Pria">Baju Pria</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-baju-wanita d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Baju Wanita">Baju Wanita</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-sepatu d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Sepatu">Sepatu</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- tentang kami -->
    <div class="container-fluid warna3 py-5">
        <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-5 mt-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Impedit est voluptate rem eius, dolores odit quaerat praesentium fugiat animi recusandae saepe quis officia at autem facere perspiciatis explicabo, quidem ipsa, voluptatem suscipit. Hic, odio
                 autem veniam, quaerat consequuntur nulla aspernatur ad molestiae necessitatibus nemo saepe esse deserunt quae nisi! Alias porro quod cum accusantium quidem incidunt architecto fuga, voluptatum sapiente veniam? Deleniti natus iure nam maxime expedita vero sed eaque voluptatibus! Omnis eius neque provident error soluta, quia expedita quisquam.</p>
        </div>
    </div>


    <!-- produk -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>

            <div class="row mt-5">
                <?php 
                    while($data = mysqli_fetch_array($queryProduk)){
                ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card">
                        <img src="image/<?php echo $data['foto'];?> " class="card-img-top" alt="...">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $data['nama'] ?></h4>
                                <p class="card-text text-truncate"><?php echo $data['detail']?></p>
                                <p class="card-text text-harga">Rp <?php echo $data['harga']?></p>
                                <a href="#" class="btn warna2 text-white">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../fontawesome/js/all.min.js></script>
</body>
</html>