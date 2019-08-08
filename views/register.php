<?php
/**
 * filter_input(INPUT_POST, 'var_name') instead of $_POST['var_name']
 * filter_input_array(INPUT_POST) instead of $_POST
 */
$message = '';

if (isset($_POST['submit_button'])) {
    require_once '../classes/isoCountryList.php';
    $fullCountryName = $isoCountryList[filter_input(INPUT_POST, 'country')];
    require_once '../classes/studentManagement.php';
    $studentManagement = New studentManagement();
    $message = $studentManagement->registerNewUser(filter_input_array(INPUT_POST), $fullCountryName);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student Management System - Registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../assets/front_end/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
        <link href="../assets/front_end/css/custom_css/register.css" rel="stylesheet" media="screen"/>
        <link href="../assets/BootstrapFormHelpers-master/dist/css/bootstrap-formhelpers.min.css" rel="stylesheet" media="screen"/>
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
                        <li><a class="btn btn-success" style="margin: 11px 11px 11px 11px; padding: 3px; color: #424949; background-color: transparent" href="login.php" role="button">Sign In</a></li>                                               
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container-fluid">
            <div class="text-center" style="margin-bottom: 50px">
                <h3><u>STUDENT REGISTRATION FORM</u></h3>
            </div>
            <h3 style="text-align: center; color: green; margin-bottom: 40px"><?php echo"$message"; ?></h3>
            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">First Name</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="first_name" name="first_name" type="text"  placeholder="First Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="last_name" class="col-sm-4 control-label">Last Name</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="last_name" name="last_name" type="text"  placeholder="Last Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="col-sm-4 control-label">Gender</label>
                    <div class="col-sm-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender1" value="M" checked>
                            <label class="form-check-label" for="gender1">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender2" value="F">
                            <label class="form-check-label" for="gender2">Female</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-4 control-label">Email</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="email" name="email" type="text"  placeholder="Email" required>
                        <span id="helpBlock2" class="help-block text-left">(Email will serve as the username)</span>
                    </div>

                </div>                
                <div class="form-group">
                    <label for="password" class="col-sm-4 control-label">Password</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="password" name="password" type="password"  placeholder="Password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-4 control-label">Phone</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="phone" name="phone" type="text"  placeholder="Phone">
                    </div>
                </div>
                <div class="form-group">
                    <label for="department_name" class="col-sm-4 control-label">Department Name</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="department_name" name="department_name">
                            <option>CACS</option>
                            <option>EEE</option>
                            <option>CIVIL</option>
                            <option>MATH</option>
                            <option>MECHANICAL</option>
                            <option>PETROLEUM</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-4 control-label">Grade</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="grade" name="grade" type="text"  placeholder="Grade">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-4 control-label">Street</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="street" name="street" type="text"  placeholder="Street">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-4 control-label">City</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="city" name="city" type="text"  placeholder="City">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-4 control-label">State</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="state" name="state" type="text"  placeholder="State">
                    </div>
                </div>
                <div class="form-group">
                    <label for="country" class="col-sm-4 control-label">Country</label>
                    <div class="col-sm-4">
                        <div class="bfh-selectbox text-left bfh-countries" data-country="US" data-name="country" data-flags="true">
                            <input type="hidden" id="country" name="country" value="">
                            <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#"> 
                                <span class="bfh-selectbox-option input-medium" data-option=""></span> <b class="caret"></b> </a>
                            <div class="bfh-selectbox-options">
                                <div role="listbox">
                                    <ul role="option"> </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4">
                        <button type="submit" name="submit_button" value="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div> 
        <div style="height: 250px"></div>
        <nav class="navbar navbar-default navbar-fixed-bottom" style="margin-bottom: 0px">
            <div class="container-fluid">
                <div class="text-center">
                    <p style="margin-top: 14px">&copy; C00411025 & C00397172 | 2019</p>
                </div>
            </div>
        </nav>
        <script src="../assets/front_end/jQuery/jquery-3.2.1.min.js"></script>
        <script src="../assets/front_end/js/bootstrap.min.js"></script>
        <script src="../assets/BootstrapFormHelpers-master/dist/js/bootstrap-formhelpers.min.js"></script>
        <script src="../assets/BootstrapFormHelpers-master/js/bootstrap-formhelpers-countries.js"></script>
    </body>
</html>