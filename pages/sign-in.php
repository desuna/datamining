﻿<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | </title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">


    
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Sistem<b> Data Mining</b></a>
            <small>Penentuan Jurusan  Calon Mahasiswa Lulusan SMK Menggunakan Metode K-Nearest Neighbor Classifier Pada Universitas Gunadarma.
</small>
        </div>
        <div class="card">
            <div class="body">
                <?php
                    include_once ('conf/conn.php');

                    if(isset($_POST['login'])){
                        $user = $_POST['username'];
                        $pass = $_POST['password'];

                        // Check username
                            $query = $conn->prepare('SELECT * FROM user WHERE username = ?');
                            $query->bind_param('s', $user);
                            $query->execute();
                            $result=$query->get_result();
                            $jumrow=$result->num_rows;
                            if($jumrow > 0){
                                $row=$result->fetch_array();
                                $user = $row['username'];
                                $hash = $row['hash'];
                                $name = $row['name'];
                                $lvl = $row['lvl'];
                                    $verif = password_verify($pass, $hash);
                                    if($verif == 1){
                                        $_SESSION['username']=$user;
                                        header('Location: index');    
                                    }else{
                                        echo '
                                        <div class="alert alert-danger">
                                            <strong>Wrong Password </strong>, please try again !!
                                        </div>
                                        ';
                                    }
                            }else {
                                echo '
                                    <div class="alert alert-danger">
                                        Unregister Username
                                    </div>
                                    ';
                            }
                    }
                ?>
				<form id="sign_in" method="POST">
                    <div class="msg">Login Kedalam Sistem</div>                    
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                           
                        </div>
                        <div class="col-xs-4">
                        	<input class="btn btn-block bg-pink waves-effect" type="submit" name="login" value="SIGN IN">
                        </div>
                    </div>
				</form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="../plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/examples/sign-in.js"></script>
</body>

</html>