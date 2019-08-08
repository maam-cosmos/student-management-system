<?php
session_start();

if (!isset($_SESSION['type'])) {
    header('location: ../views/login.php');
}
if (($_SESSION['type']) != 0) {
    header('location: ../views/login.php');
}

$message = '';
$student_id = '';
require_once '../classes/studentManagement.php';
$studentManagement = new studentManagement();
$student_id = "$_SESSION[student_id]";
$query_result = $studentManagement->selectASingleUserByID($student_id);
$userInfo = mysqli_fetch_assoc($query_result);
$students_enrolled_courses = $studentManagement->selectAllCoursesOfAStudent($student_id);
$students_enrolled_in_sports = $studentManagement->selectAllSportsOfAStudent($student_id);

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
                        <li class="active"><a href="">Home <span class="sr-only">(current)</span></a></li>
                        <li><a href="manage_courses.php">Manage Courses</a></li>
                        <li><a href="manage_sports.php">Manage Sports</a></li>                        
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
                    <h3><b><u>YOUR PROFILE</u></b></h3>
                </div>
                <div class="row">
                    <div class='col-md-12' style="margin-top: 100px; color: white">
                        <div class='col-md-4'>
                            <h4><b><u>General Information</u></b></h4>
                            <table style="margin-bottom: 100px">
                                <tr><td><h4 style="color: white">First Name:  </h4></td><td style="color: black"><b><?php echo " $userInfo[first_name]"; ?></b></td></tr>
                                <tr><td><h4 style="color: white">Last Name:  </h4></td><td style="color: black"><b><?php echo " $userInfo[last_name]"; ?></b></td></tr>
                                <tr><td><h4 style="color: white">Gender: </h4></td><td style="color: black"><b><?php echo " $userInfo[gender]"; ?></b></td></tr>
                                <tr><td><h4 style="color: white">Email: </h4></td><td style="color: black"><b><?php echo " $userInfo[email]"; ?></b></td></tr>
                                <tr><td><h4 style="color: white">Phone: </h4></td><td style="color: black"><b><?php echo " $userInfo[phone]"; ?></b></td></tr>
                                <tr><td><h4 style="color: white">Department: </h4></td><td style="color: black"><b><?php echo " $userInfo[department_name]"; ?></b></td></tr>
                                <tr><td><h4 style="color: white">Grade: </h4></td><td style="color: black"><b><?php echo " $userInfo[grade]"; ?></b></td></tr>
                                <tr><td><h4 style="color: white">Street: </h4></td><td style="color: black"><b><?php echo " $userInfo[street]"; ?></b></td></tr>
                                <tr><td><h4 style="color: white">City: </h4></td><td style="color: black"><b><?php echo " $userInfo[city]"; ?></b></td></tr>
                                <tr><td><h4 style="color: white">State: </h4></td><td style="color: black"><b><?php echo " $userInfo[state]"; ?></b></td></tr>
                                <tr><td><h4 style="color: white">Country: </h4></td><td style="color: black"><b><?php echo " $userInfo[country]"; ?></b></td></tr>                        
                            </table>
                        </div>
                        <div class='col-md-4'>
                            <h4><b><u>Enrolled Courses</u></b></h4>
                            <h4><b><?php
while ($courseInfo = mysqli_fetch_assoc($students_enrolled_courses)) {
    echo "$courseInfo[course_name], ";
}
?></b></h4>
                        </div>
                        <div class='col-md-4'>
                            <h4><b><u>Sports Associations</u></b></h4>
                            <h4><b><?php
                                    while ($sportsInfo = mysqli_fetch_assoc($students_enrolled_in_sports)) {
                                        echo "$sportsInfo[sports_name], ";
                                    }
                                    ?></b></h4>
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
