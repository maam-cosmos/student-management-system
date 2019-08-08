<?php
session_start();

if (isset($_SESSION['type'])) {
    if ($_SESSION['type'] != NULL) {
        if ($_SESSION['type'] == 1) {
            header('Location: ../admin/admin_home.php');
        } else {
            header('Location: ../students/student_home.php');
        }
    }
}

if (isset($_POST['login'])) {
    require_once '../classes/Login.php';

    $login = new Login();
    $login->login_check(filter_input_array(INPUT_POST));
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Student Management System - Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/front_end/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../assets/front_end/css/custom_css/login.css"/>
    </head>
    <body>   
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><p id="brandStyle">STUDENT MANAGEMENT SYSTEM</p></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="../index.php">Home <span class="sr-only">(current)</span></a></li>
                        <!--                        <li><a href="#">Manage Courses</a></li>
                                                <li><a href="#">Manage Sports</a></li>                        -->
                    </ul>                    
                    <ul class="nav navbar-nav navbar-right">                        
                        <li><a class="btn btn-success" style="margin: 11px 11px 11px 11px; padding: 3px; color: #424949; background-color: transparent" href="../views/register.php" role="button">Register!</a></li>                        
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container-fluid">
            <div class="loginForm col-xs-10 col-sm-6 col-md-4 col-lg-3">
                <h3 id="welcome" style="padding-bottom: 20px; text-align: center">Welcome! Please Sign In</h3>
                <form class="form-horizontal" action="" method="post">     
                    <div class="form-group form-group-sm">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2 col-md-offset-1 col-lg-offset-1">
                                    <label for="email" class="control-label">Email</label>
                                </div>
                                <div class="col-md-8 col-lg-8">
                                    <input class="form-control input-sm" id="email" name="email" type="text"  placeholder="email" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-3 col-lg-3">
                                    <label for="Password" class="control-label">Password</label>
                                </div>
                                <div class="col-md-8 col-lg-8">
                                    <input type="password" class="form-control input-sm" id="Password" name="password"  placeholder="Password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-3 col-lg-3">
                                </div>
                                <div class="col-md-8 col-lg-8">
                                    <button type="submit" name="login" class="btn btn-success">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <nav class="navbar navbar-default navbar-fixed-bottom" style="margin-bottom: 0px">
            <div class="container-fluid">
                <div class="text-center">
                    <p style="margin-top: 14px">&copy; C00411025 & C00397172 | 2019</p>
                </div>
            </div>
        </nav>
        <script src="../assets/front_end/jQuery/jquery-3.2.1.min.js"></script>
        <script src="../assets/front_end/js/bootstrap.min.js"></script>
    </body>
</html>