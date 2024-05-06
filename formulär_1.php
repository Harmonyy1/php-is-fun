<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <div class="loginbox">

        <?php

            $host="localhost";
            $user="root";
            $pass="";
            $db="login";
            $conn=mysqli_connect($host, $user, $pass, $db);

            if(isset($_POST['btnLogin'])){
                $username=$_POST['username'];
                $password=md5($_POST['password']);
                $strQuery="SELECT * FROM login_tbl WHERE username='$username' AND password='$password';";

                if($result=mysqli_query($conn,$strQuery)){
                    if(!mysqli_num_rows($result)==1){
                        echo "Inte inloggad";
                        $_SESSION
                    }
                }
            }


        ?>

        <div class="formbox">
            <form action="formulär_1.php" method="post" id="frmLogin">
                <input type="text" name="username" id="username" placeholder="Username">
                <input type="password" name="password" id="password">
                <input type="submit" name="btnLogin" id="btnLogin" value="Login">
            </form>
        </div>

    </div>
</body>
</html>