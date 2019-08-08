<?php
session_start();

if (!isset($_SESSION['type'])) {
    header('location: ../views/login.php');
}
if (($_SESSION['type']) != 0) {
    header('location: ../views/login.php');
}

if (isset($_POST['submit_button'])) {
    require_once '../classes/studentManagement.php';
    $studentManagement = New studentManagement();
    $message = $studentManagement->enrollIntoASport(filter_input_array(INPUT_POST));
}

if (isset($_POST['remove_sport'])) {
    require_once '../classes/studentManagement.php';
    $studentManagement = New studentManagement();
    $message = $studentManagement->withdrawFromASport(filter_input_array(INPUT_POST));
}

$message = '';
require_once '../classes/studentManagement.php';
$studentManagement = new studentManagement();
$student_id = "$_SESSION[student_id]";
$department_name = "$_SESSION[department_name]";
$query_result = $studentManagement->selectASingleUserByID($student_id);
$userInfo = mysqli_fetch_assoc($query_result);
$enrolledSports = $studentManagement->selectAllSportsOfAStudent($student_id);
$nonEnrolledSports = $studentManagement->nonEnrolledSportsOfAStudent($student_id);


if (isset($_GET['status'])) {
    if ($_GET['status'] == 'delete') {
        $user_id = $_GET['id'];
        $message = $studentManagement->deleteUser($user_id);
    }
}

if (isset($_GET['logout'])) {
    require_once '../classes/Login.php';
    $login = new Login();
    $login->logout();
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Student - Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/front_end/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../assets/front_end/css/custom_css/home.css"/>
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
                        <li><a href="student_home.php">Home</span></a></li>
                        <li><a href="manage_courses.php">Manage Courses</a></li>
                        <li class="active"><a href="manage_sports.php">Manage Sports<span class="sr-only">(current)</a></li>                        
                    </ul>                    
                    <ul class="nav navbar-nav navbar-right">
                        <li><a style="padding-right: 0px"><b><span style="color:black; margin-right: 5px">Welcome</span><span style="color:green"><?php echo "$_SESSION[first_name]" ?></span></b></a></li>
                        <li><a href="?logout=logout" class="btn btn-success" style="margin: 11px 11px 11px 11px; padding: 3px; color: #424949; background-color: transparent" href="views/register.php" role="button">Logout</a></li>                        
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="text-center moto col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 10px 0px 10px 0px; color: white">
                    <h3><b><u>Manage Sports</u></b></h3>
                </div>
                <div class="row">
                    <div class='col-md-12' style="margin-top: 100px; color: white">
                        <div class='col-md-4'>
                            <h4><b><u>Select a sport to enroll</u></b></h4>
                            <form class="form-horizontal" action="manage_sports.php" method="post">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <input class="form-control" id="student_id" name="student_id" type="hidden" value="<?php echo "$student_id"; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sports_name" class="col-sm-4 control-label">Sport Name</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="sports_name" name="sports_name">
                                            <?php while ($nonEnrolledSportsInfo = mysqli_fetch_assoc($nonEnrolledSports)) { ?>
                                                <option><?php echo "$nonEnrolledSportsInfo[sports_name]"; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>                                    
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-4">
                                        <button type="submit" name="submit_button" value="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class='col-md-4'>
                            <h4><b><u>Select a sport to withdraw from</u></b></h4>
                            <form class="form-horizontal" action="manage_sports.php" method="post">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <input class="form-control" id="student_id" name="student_id" type="hidden" value="<?php echo "$student_id"; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sports_name" class="col-sm-4 control-label">Sports Name</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="sports_name" name="sports_name">
                                            <?php while ($enrolledSportsInfo = mysqli_fetch_assoc($enrolledSports)) { ?>
                                                <option><?php echo "$enrolledSportsInfo[sports_name]"; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>                                    
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-4">
                                        <button type="submit" name="remove_sport" value="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
        <script src="../assets/front_end/jQuery/jquery-3.2.1.min.js"></script>
        <script src="../assets/front_end/js/bootstrap.min.js"></script>
    </body>
</html>

