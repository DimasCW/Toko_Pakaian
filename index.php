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
    
<div class="container-fluid banner d-flex align-items-center">
    <div class="container text-center white">
        <h1>Toko Online Fashion</h1>
        <h3>Mau Cari Apa</h3>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../fontawesome/js/all.min.js></script>
</body>
</html>