<?php ?>

<!DOCTYPE html>
<html>
    <head>
        <title>STUDENT MANAGEMENT SYSTEM - Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/front_end/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="assets/front_end/css/custom_css/home.css"/>
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
                        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
<!--                        <li><a href="#">Manage Courses</a></li>
                        <li><a href="#">Manage Sports</a></li>                        -->
                    </ul>                    
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="views/login.php" style="margin-right: 0px; padding-right: 0px">Sign In</a></li>
                        <li><a class="btn btn-success" style="margin: 11px 11px 11px 11px; padding: 3px; color: #424949; background-color: transparent" href="views/register.php" role="button">Register!</a></li>                        
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="text-center moto col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 50px 0px 10px 0px; color: white">
                    <h3>Welcome to the student management system!</h3>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default navbar-fixed-bottom" style="margin-bottom: 0px">
            <div class="container-fluid">
                <div class="text-center">
                    <p style="margin-top: 14px">&copy; C00411025 & C00397172 | 2019</p>
                </div>
            </div>
        </nav>
        <script src="assets/front_end/jQuery/jquery-3.2.1.min.js"></script>
        <script src="assets/front_end/js/bootstrap.min.js"></script>
    </body>
</html>




