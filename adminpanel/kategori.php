<?php
    require "session.php";
    require "../koneksi.php";

    $querykategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($querykategori);


    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    
</head>
<style>
        .no-decoration{
        text-decoration: none;
    }

</style>
<body>
    <?php
        require "navbar.php";
    ?>
        <div class="container mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active " aria-current="page">
                        <a href="../adminpanel/" class="no-decoration text-muted"><i class="fas fa-home "></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active " aria-current="page">
                        <i class="fas fa-align-justify"></i> Kategori
                    </li>
                </ol>
            </nav>

            <!-- Menambahkan Data Kategori -->
            <div class="my-5  col-12 col-md-6">
                <h3>Tambah Kategori</h3>
                <form action="" method="post">
                    <div>
                        <label for="kategori">kategori</label>
                        <input class="form-control" type="text" name="kategori" id="kategori" placeholder="input nama kategori ">
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit" name="simpan_kategori">simpan</button>
                    </div>
                </form>
                <?php
                    if(isset($_POST['simpan_kategori'])){
                        $kategori = htmlspecialchars($_POST['kategori']);

                        $queryExist = mysqli_query($con, "SELECT nama FROM kategori WHERE
                        nama ='$kategori'");
                        $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);
                        if($jumlahDataKategoriBaru > 0){
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Kategori sudah ada
                            </div>
                            <?php
                        }
                        else{
                            $querySimpan = mysqli_query($con, "INSERT INTO kategori (nama) VALUES ('$kategori')");
                            if($querySimpan){
                                ?>
                                    <div class="alert alert-primary mt-3" role="alert">
                                        Kategori Tersimpan
                                    </div>
                                    <meta http-equiv="refresh" content="1; url=kategori.php">
                                <?php

                            }
                            else{
                                echo mysqli_error($con);
                            }
                        }
                    }
                ?>

            </div>    

            <div class="mt-3">
                <h2>List Kategori</h2>

                <div class="table-responsive mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($jumlahKategori == 0){
                                    ?>
                                        <tr>
                                            <td colspan=3 class="text-center">Data Kategori Kosong</td>
                                        </tr>
                                    <?php
                                }
                                else{
                                    $jumlah = 1;
                                    while($data = mysqli_fetch_array($querykategori)){
                                        ?>
                                            <tr>
                                                <td><?php echo $jumlah?></td>
                                                <td><?php echo $data['nama']?></td>
                                                <td>
                                                    <a href="kategori-detail.php?p=<?php echo $data['id']?>" class="btn btn-info">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                                </td>
                                                </td>
                                            </tr>
                                        <?php
                                        $jumlah++;
                                    }
                                    
                                }
                            
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../fontawesome/js/all.min.js></script>

</body>
</html>