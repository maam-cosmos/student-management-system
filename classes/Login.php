<?php


/**
 * echo "<pre>";
  print_r($userInfo);
  echo "</pre>";
 * 
 */

/**
 * Description of Login
 *
 * @author Md Abdullah Al Momin
 */
class Login {

    protected $link;

    public function __construct() {
        $host_name = 'localhost';
        $user_name = 'root';
        $password = '';
        $db_name = 'student_management_system';

        $this->link = mysqli_connect($host_name, $user_name, $password, $db_name);

        if (!$this->link) {
            die('Connection Fail' . mysqli_error($this->link));
        }
    }

    public function login_check($data) {
        global $link;
        $password = $data['password'];
        $sql = "SELECT * FROM student_info WHERE email = '$data[email]' AND password = '$password'";
        if (mysqli_query($this->link, $sql)) {
            $query_result = mysqli_query($this->link, $sql);
            $userInfo = mysqli_fetch_assoc($query_result);
        } else {
            die('Query Problem' . mysqli_error($link));
        }
        if ($userInfo) {
            session_start();
            $_SESSION['student_id'] = $userInfo['student_id'];
            $_SESSION['first_name'] = $userInfo['first_name'];
            $_SESSION['type'] = $userInfo['type'];  
            $_SESSION['department_name'] = $userInfo['department_name'];  
            
            if($userInfo['type'] == 1){
            header('Location: ../admin/admin_home.php');
            }else{
                header('Location: ../students/student_home.php');
            }
        } else {
            header('Location: login.php');
        }
    }
    
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['first_name']);
        unset($_SESSION['type']);
        unset($_SESSION['department_name']);
        header('Location: ../views/login.php');
    }   
}
