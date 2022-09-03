<?php
    include "../config/db.php";
    if(isset($_POST['key']) == "loginData"){
        $userId = mysqli_real_escape_string($conn, $_POST['userId']);
        $password = mysqli_real_escape_string($conn, $_POST['passKey']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);
        $session = mysqli_real_escape_string($conn, $_POST['Session']);
        $userCategory = mysqli_real_escape_string($conn, $_POST['userCategory']);
        $hash_pswd = substr(md5($password), 4);
        $check = $conn->query("SELECT * FROM $users_tbl WHERE (userId='$userId' OR email='$userId') AND password='$hash_pswd'");
       
        if($check->num_rows == 0){
             $response = [
                "title" => "User does not exist!",
                "text" => "Provide a valid user login.",
                "type" => "error"
            ];
        }else{
            while($row = $check->fetch_object()){
                $_SESSION['userId'] = $row->userId;
                $_SESSION['name'] = $row->name;
                $_SESSION['email'] = $row->email;
                $_SESSION['curr_class'] = $row->class;
                $_SESSION['log_term'] = $row->term;
                $_SESSION['log_session'] = $session;
                $_SESSION['log_term'] = $term;
                $_SESSION['position'] = $row->position;
                $_SESSION['staff_type'] = $row->staff_type;
                $_SESSION['token'] = $row->token;
                $_SESSION['pin'] = $row->pin;
                switch($row->user_type){
                    case "c3R1ZHk=":
                        $user_type = "Student";
                        break;
                    case "d29yaw==":
                        $user_type = "Staff";
                        break;
                }
                $_SESSION['user_type'] = $user_type;
                $_SESSION['userCategory'] = $userCategory;
            }
            $response = [
                "title" => "Successfully logged in!",
                "text" => "Redirecting...",
                "type" => "success"
            ];
        }

         $data = json_encode($response);
            echo '['.$data.']';
    }
?>