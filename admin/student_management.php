<?php
session_start();

if (!isset($_SESSION['type'])) {
    header('location: ../views/login.php');
}
if (($_SESSION['type']) != 1) {
    header('location: ../views/login.php');
}

$message = '';
require_once '../classes/studentManagement.php';
$studentManagement = new studentManagement();
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'delete') {
        $user_id = $_GET['id'];
        $message = $studentManagement->deleteUser($user_id);
    }
}
$query_result = $studentManagement->selectAllUsersInfo();

if (isset($_GET['logout'])) {
    require_once '../classes/Login.php';
    $login = new Login();
    $login->logout();
}
?>

<!DOCTYPE html>
<html
    <head>
        <title>Student Management</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/front_end/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../assets/front_end/css/custom_css/student_management.css"/>

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
                    <a class="navbar-brand" href="#"><p id="brandStyle">Student Management System</p></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="admin_home.php">Home <span class="sr-only">(current)</span></a></li>
<!--                        <li><a href="#">Manage Courses</a></li>
                        <li><a href="#">Manage Sports</a></li>                        -->
                    </ul>                    
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="?logout=logout" class="btn btn-success" style="margin: 11px 11px 11px 11px; padding: 3px; color: #424949; background-color: transparent" role="button">Logout</a></li>                        
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>


        <div class='container-fluid' style="margin-bottom: 50px">

            <h3 style='text-align: center; margin-bottom: 40px'><u style='color: #0d3349'>Student's Information</u></h3>
            <h4 style="text-align: center; color: red; margin-bottom: 40px"><?php echo"$message"; ?></h4>

            <div class='table-responsive'>
                <table class="table table-bordered table-striped table-hover table-condensed">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th> 
                        <th>Gender</th> 
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Grade Point</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Department</th>
                        <th>Access level</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $count = 0;
                    while ($userInfo = mysqli_fetch_assoc($query_result)) {
                        ?>
                        <tr>
                            <td><?php
                                $sum = ++$count;
                                echo "$sum";
                                ?></td>
                            <td><?php echo $userInfo['first_name']; ?></td> 
                            <td><?php echo $userInfo['last_name']; ?></td>
                            <td><?php echo $userInfo['gender']; ?></td>
                            <td><?php echo $userInfo['email']; ?></td>
                            <td><?php echo $userInfo['phone']; ?></td> 
                            <td><?php echo $userInfo['grade']; ?></td> 
                            <td><?php echo $userInfo['street']; ?></td> 
                            <td><?php echo $userInfo['city']; ?></td> 
                            <td><?php echo $userInfo['state']; ?></td>
                            <td><?php echo $userInfo['country']; ?></td>
                            <td><?php echo $userInfo['department_name']; ?></td>
                            <td><?php
                                if (($userInfo['type']) == 0) {
                                    echo '<p style="color: blue; font-size: 15px">User</p>';
                                } else {
                                    echo '<p style="color: red; font-size: 15px">Admin</p>';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="?status=delete&&id=<?php echo $userInfo['student_id'];?>" class="btn btn-danger btn-sm" title="Delete User" onclick="return confirm('Do you really wish to delete this user?');">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
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