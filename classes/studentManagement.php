<?php


/**
 * Description of student_management
 *
 * @author Md Abdullah Al Momin
 */
class studentManagement {

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

    public function registerNewUser($data, $countryName) {
        global $link;
        
        $sql = "INSERT INTO student_info (first_name, last_name, gender, email, phone, grade, street, city, state, country, password, department_name) VALUES ('$data[first_name]', '$data[last_name]', '$data[gender]', '$data[email]', '$data[phone]', '$data[grade]', '$data[street]', '$data[city]', '$data[state]', '$countryName', '$data[password]', '$data[department_name]')";
        echo $sql;
        if (mysqli_query($this->link, $sql)) {
            $message = "You have successfully registered! Now you can sign in.";
            header('Location: register.php');
            return $message;
        } else {
            die('Query Problem' . mysqli_error($link));
        }
    }

    public function deleteUser($user_id) {
        global $link;
        $sql = "DELETE FROM student_course WHERE student_id = '$user_id'";
        
        
        if (mysqli_query($this->link, $sql)) {
            header('Location: student_management.php');
            $message = "User deleted!";
        } else {
            die('Query Problem' . mysqli_error($link));
        }
        
        $sql = "DELETE FROM student_sports WHERE student_id = '$user_id'";
        
        if (mysqli_query($this->link, $sql)) {
            header('Location: student_management.php');
        } else {
            die('Query Problem' . mysqli_error($link));
        }
        
        $sql = "DELETE FROM student_info WHERE student_id = '$user_id'";
        
        if (mysqli_query($this->link, $sql)) {
            header('Location: student_management.php');            
            return $message;
        } else {
            die('Query Problem' . mysqli_error($link));
        }
    }

    public function editUserInfo($data, $countryName, $user_id) {
        global $link;
        $password = md5($data['password']);
        $sql = "UPDATE tbl_users SET first_name = '$data[first_name]', last_name = '$data[last_name]', email = '$data[email]', password = '$password', address = '$data[address]', telephone = '$data[telephone]', country = '$countryName' WHERE user_id = $user_id";

        if (mysqli_query($this->link, $sql)) {
            $message = "User information updated successfully.";
            header('Location: student_management.php');
            return $message;
        } else {
            die('Query Problem' . mysqli_error($link));
        }
    }

    public function selectAllUsersInfo() {
        global $link;
        $sql = "SELECT * FROM student_info";
        
        if (mysqli_query($this->link, $sql)) {
            $query_result = mysqli_query($this->link, $sql);
            return $query_result;
        } else {
            die('Query Problem' . mysqli_error($link));
        }
    }

    public function selectASingleUserByID($user_id) {
        global $link;
        $sql = "SELECT * FROM student_info WHERE student_id = '$user_id'";
        
        if (mysqli_query($this->link, $sql)) {
            $query_result = mysqli_query($this->link, $sql);
            return $query_result;
        } else {
            die('Query Problem' . mysqli_error($link));
        }
    }
    
    public function selectAllCoursesOfAStudent($user_id) {
        global $link;
        $sql = "select course_name from course where course_id IN (select course_id from student_course where student_id = '$user_id')";
        
        if (mysqli_query($this->link, $sql)) {
            $query_result = mysqli_query($this->link, $sql);
            return $query_result;
        } else {
            die('Query Problem' . mysqli_error($link));
        }
    }
    
    public function selectAllSportsOfAStudent($user_id) {
        global $link;
        $sql = "select sports_name from sports where sports_id In (select sports_id from student_sports where student_id = '$user_id')";
        
        if (mysqli_query($this->link, $sql)) {
            $query_result = mysqli_query($this->link, $sql);
            return $query_result;
        } else {
            die('Query Problem' . mysqli_error($link));
        }
    }
    
    public function nonEnrolledSportsOfAStudent($user_id) {
        global $link;
        $sql = "select sports_name from sports where sports_id not in (select sports_id from student_sports where student_id = '$user_id')";

        if (mysqli_query($this->link, $sql)) {
            $query_result = mysqli_query($this->link, $sql);
            return $query_result;
        } else {
            die('Query Problem' . mysqli_error($link));
        }
    }
    
    public function enrollIntoASport($data) {
        global $link;
        $result;
        $sports_id = "select sports_id from sports where sports_name = '$data[sports_name]'";
        if (mysqli_query($this->link, $sports_id)) {
            $query_result = mysqli_query($this->link, $sports_id);
            $result = mysqli_fetch_assoc($query_result);
            $sportId = implode( $result );
        } else {
            die('Query Problem' . mysqli_error($link));
        }
        $sql = "INSERT INTO student_sports (student_id, sports_id) VALUES ($data[student_id], $sportId)";
        echo $sql;
        if (mysqli_query($this->link, $sql)) {
             $query_result = mysqli_query($this->link, $sql);
             header('Location: manage_sports.php');
            return $query_result;
        } else {
            die('Query Problem' . mysqli_error($link));
        }
    }
    
    public function withdrawFromASport($data) {
        global $link;
        $sql = "delete FROM student_sports where student_id = '$data[student_id]' and sports_id = (select sports_id from sports where sports_name = '$data[sports_name]')";
        if (mysqli_query($this->link, $sql)) {
            $query_result = mysqli_query($this->link, $sql);
            header('Location: manage_sports.php');
            return $query_result;
        } else {
            die('Query Problem' . mysqli_error($link));
        }
    }
    
    public function selectNonEnrolledCoursesOfAStudent($department_name, $user_id) {
        global $link;
        $sql = "select course_name from course where department_name = '$department_name' and course_name not in (select course_name from course where course_id in (select course_id from student_course where student_id = '$user_id'))";
        
        if (mysqli_query($this->link, $sql)) {
            $query_result = mysqli_query($this->link, $sql);
            return $query_result;
        } else {
            die('Query Problem' . mysqli_error($link));
        }
    }
    
    public function enrollIntoACourse($data) {
        global $link;
        $result;
        $course_id = "select course_id from course where course_name = '$data[course_name]'";
        if (mysqli_query($this->link, $course_id)) {
            $query_result = mysqli_query($this->link, $course_id);
            $result = mysqli_fetch_assoc($query_result);
            $courseId = implode( $result );
        } else {
            die('Query Problem' . mysqli_error($link));
        }
        $sql = "INSERT INTO student_course (student_id, course_id) VALUES ($data[student_id], $courseId)";
        echo $sql;
        if (mysqli_query($this->link, $sql)) {
             $query_result = mysqli_query($this->link, $sql);
             header('Location: manage_courses.php');
            return $query_result;
        } else {
            die('Query Problem' . mysqli_error($link));
        }
    }
    
    public function removeACourse($data) {
        global $link;
        $sql = "delete FROM student_course where student_id = '$data[student_id]' and course_id = (select course_id from course where course_name = '$data[course_name]')";
        if (mysqli_query($this->link, $sql)) {
            $query_result = mysqli_query($this->link, $sql);
            header('Location: manage_courses.php');
            return $query_result;
        } else {
            die('Query Problem' . mysqli_error($link));
        }
    }
}
