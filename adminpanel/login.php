<?php
session_start();
    require "../js/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <style>
    .main{
        height: 100vh;
    }

    .login-box{
        width: 500px;
        height: 300px;
        border: solid 1px;
        box-sizing: border-box;
        border-radius: 10px;
    }
    </style>
               <form class="login" action="" method="post">
                <input type="text" placeholder="Username" name="username" id="username">
                <input type="password" placeholder="Password" name="password" id="username">
                <button type="submit" name="loginbtn">Login</button>
                </form>

            <div class="mt-3" style="width: 500px">
                <?php
                    if(isset($_POST['loginbtn'])){
                        $username = htmlspecialchars($_POST['username']);
                        $password = htmlspecialchars($_POST['password']);

                        $query = mysqli_query($con, "SELECT * FROM users WHERE 
                        username= '$username'");
                        $countdata = mysqli_num_rows($query);
                        $data = mysqli_fetch_array($query);
                        if($countdata > 0){
                            if (password_verify($password, $data['password'])) {
                                $_SESSION['username'] = $data['username'];
                                $_SESSION['login'] = true;
                                header('location: ../adminpanel/');
                            }else{
                                ?>
                                <div class="alert alert-warning" role="alert">
                                    password salah
                                </div>
                                <?php
    
                            }
                            
                        }else{
                            ?>
                            <div class="alert alert-warning" role="alert">
                                Akun tidak tersedia
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>