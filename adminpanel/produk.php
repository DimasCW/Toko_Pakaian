<?php
    require "session.php";
    require "../js/koneksi.php";

    $query= mysqli_query($con, "SELECT * FROM produk");
    $jumlahProduk = mysqli_num_rows($query);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

    // code rename file
    function generationRandomString($lenght = 10){
        $characters = '0123456789abcdefghijklmnopqrsrtuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLenght = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $lenght; $i++){
            $randomString = $characters[rand(0, $charactersLenght - 1)];
        }
        return $randomString;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">

</head>

<style>
        .no-decoration{
        text-decoration: none;
    }

    form div{
        margin-bottom: 10px;
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
                        <i class="fas fa-align-justify"></i> Produk
                    </li>
                </ol>
            </nav>

            <div class="my-5 col-12 col-md-6">
            <h3>Tambah Produk</h3>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="nama" input="text" id="nama" >nama</label>
                        <input type="text" id="nama" name="nama" class="form-control"required>
                    </div>
                    <div>
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <option value="">Pilih Satu</option>
                        <?php    
                            while($data=mysqli_fetch_array($queryKategori)){
                                ?>
                                    <option value="<?php echo $data['id'];?>"><?php echo $data['nama'];?></option>
                                <?php
                            }
                        ?>   
                        </select>
                    </div>

                    <div>
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga" required>
                    </div>
                    <div>
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div>
                        <label for="detail">Detail</label>
                        <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div>
                        <label for="Ketersediaan_stok">Ketersediaan Stok</label>
                        <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                            <option value="tersedia">Tersedia</option>
                            <option value="Habis">Habis</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>
                            <?php
                                if(isset($_POST['simpan']))
                                {
                                    $nama = htmlspecialchars($_POST['nama']);
                                    $kategori = htmlspecialchars($_POST['kategori']);
                                    $harga = htmlspecialchars($_POST['harga']);
                                    $detail = htmlspecialchars($_POST['detail']);
                                    $ketersediaan_Stok = htmlspecialchars($_POST['ketersediaan_stok']);
                                
                                    $target_dir = "../image/";
                                    $nama_file = basename($_FILES["foto"]["name"]);
                                    $target_file = $target_dir . $nama_file;
                                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                                    $image_size = $_FILES["foto"]["size"];
                                    $random_name = generationRandomString(20);
                                    $new_name = $random_name . "." . $imageFileType;
                                    
                                    if($nama=='' || $kategori=='' || $harga==''){
                                ?>
                                    <div class="alert alert-warning mt-3" role="alert"> 
                                        Nama, Kategori dan harga wajib di isi

                                    </div>
                                <?php
                                    }else{
                                        if($nama_file!=''){
                                            if($image_size> 500000){
                                                ?>
                                             <div class="alert alert-warning mt-3" role="alert"> 
                                                File tidak boleh lebih dari 500kb
                                             </div>

                                                <?php
                                            }
                                            else{
                                                if($imageFileType!= 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif'){
                                                    ?>
                                                    <div class="alert alert-warning mt-3" role="alert"> 
                                                File wajib jpg, png atau gif
                                             </div>
                                                    <?php
                                                }else{
                                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                                                }
                                            }
                                        }
                                        
                                        
                                        //query insert to produk table
                                        $queryTambah = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga', '$new_name')");

                                    }
                                }
                            ?>

                            
            </div>

            <div class="mt-3">
                <h2>List Produk</h2>

                <div class="table-responsive mt-5">
                <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Ketersediaan Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($jumlahProduk == 0){
                                    ?>
                                        <tr>
                                            <td colspan=5 class="text-center">Data Produk Tidak Tersedia</td>   
                                        </tr>
                                    <?php
                                }else{
                                    $jumlah = 1;
                                    while($data=mysqli_fetch_array($query)){
                                ?>

                                    <tr>
                                        <td><?php echo $jumlah?></td>
                                        <td><?php echo $data['nama'];?></td>
                                        <td><?php echo $data['kategori_id'];?></td>
                                        <td><?php echo $data['harga'];?></td>
                                        <td><?php echo $data['ketersediaan_stok'];?></td>
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