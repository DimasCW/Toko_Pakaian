<?php
    require "session.php";
    require "../js/koneksi.php";
    
    $id = $_GET['p'];

    $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
    $data= mysqli_fetch_array($query);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

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
    <title>Produk Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <?php 
            require "navbar.php";
        ?>
        <div class="container mt-5">
        <h2>Detail Kategori</h2>
        

        <div class="col-12 col-md-6 mb-5">
        <form action="" method="post" enctype="multipart/form-data">
            <div>
            <label for="nama">nama</label>
            <input type="text" id="nama" name="nama" value="<?php echo $data['nama'];?>" 
            class="form-control" autocomplete="off" required>

            </div>
            <div>
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori']; ?></option>
                        <?php    
                            while($dataKategori=mysqli_fetch_array($queryKategori)){
                                ?>
                                    <option value="<?php echo $dataKategori['id'];?>"><?php echo $dataKategori['nama'];?></option>
                                <?php
                            }
                        ?>   
                        </select>
                    </div>
                    <div>
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga" value="<?php echo $data['harga']?>"required>
                    </div>
                    <div>
                        <label for="currentFoto">Foto Produk Sekarang</label>
                        <img src="../image/<?php echo $data['foto']?>" alt="" width="300px">
                    </div>
                    <div>
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div>
                        <label for="detail">Detail</label>
                        <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
                            <?php 
                                echo $data['detail'];
                            ?>
                        </textarea>
                    </div>
                    <div>
                        <label for="Ketersediaan_stok">Ketersediaan Stok</label>
                        <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                            <option value="<?php echo $data['ketersediaan_stok']?>"><?php echo $data['ketersediaan_stok']?></option>
                            <?php
                                if($data['$ketersediaan_stok']=='tersedia'){
                                    ?>
                                        <option value="habis">habis</option>
                                    <?php
                                }
                                else{
                                    ?>
                                        <option value="tersedia">tersedia</option>
                                    <?php
                                }
                            ?>
                            <option value="Habis">Habis</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-2" name="simpan">Simpan</button>
                    </div>

                    </form>
                    <?php
                        if(isset($_POST['simpan'])){
                            $nama = htmlspecialchars($_POST['nama']);
                            $kategori = htmlspecialchars($_POST['kategori']);
                            $harga = htmlspecialchars($_POST['harga']);
                            $detail = htmlspecialchars($_POST['detail']);
                            $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);
                        
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
                            }
                            else{
                                $queryUpdate = mysqli_query($con, "UPDATE produk SET 
                                kategori_id ='$kategori', nama='$nama', harga='$harga', detail='$detail', 
                                ketersediaan_stok='$ketersediaan_stok' WHERE id=$id");

                                // untuk cek apakah admin mengaupload foto baru atau tidak
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
                                            $queryUpdate = mysqli_query($con, "UPDATE produk SET foto = '$new_name' WHERE id='$id'");

                                            if($queryUpdate){
                                                ?>
                                                    <div class="alert alert-primary mt-3" role="alert"> 
                                                    Produk berhasil diupdate
                                                    </div>
                                                    <meta http-equiv="refresh" content="2; url=produk.php"/>

                                                <?php
                                            }
                                            else{
                                                echo mysqli_error($con);
                                            }
                                        }
                                    }
                                
                                }
                            }
                            
                        }
                    ?>

                    </div>
                    </div>





            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>