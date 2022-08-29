<?php
    include "../config/db.php";
    if(isset($_POST['key']) == "getData"){
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $myClass = htmlspecialchars($_POST['myClass']);
        $staffType = htmlspecialchars($_POST['staffType']);
        $userCategory = htmlspecialchars($_POST['userCategory']);
        $password = htmlspecialchars($_POST['password']);
        $os = mysqli_real_escape_string($conn, $_POST['os']);
        $ip = mysqli_real_escape_string($conn, $_POST['ip']);
        $device = mysqli_real_escape_string($conn, $_POST['device']);
        $userId = rand(1000000000,9999999999);
        $token = md5(date('Y')*time());
        $hash_pswd = substr(md5($password), 4);

        $insert_data = $conn->query("INSERT INTO $users_tbl SET
                    name = '$name',
                    email = '$email',
                    user_type = '$userCategory',
                    curr_class = '$myClass',
                    password = '$hash_pswd',
                    os = '$os',
                    ip = '$ip',
                    device = '$device',
                    userId = '$userId',
                    token = '$token',
                    staff_type = '$staffType'
        ");

        if($insert_data){
             $message = '  
            <!DOCTYPE html>
                <html>
                    <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <link rel="stylesheet" href="style.css">
                <style type="text/css" rel="stylesheet" media="all">
                    /* Media Queries */
                    @media  only screen and (max-width: 500px) {
                        .button {
                            width: 100% !important;
                        }
                    }
                </style>
            </head>
            <body style="margin: 0; padding: 0; width: 100%; background-color: rgb(2, 2, 43); color:#fff">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="width: 100%; margin: 0; padding: 0; background-color: rgb(2, 2, 43); color:#fff" align="center">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <!-- Logo -->
                                <tr>
                                    <td style="padding: 25px 0; text-align: center;">
                                        <a style="font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
                 Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif; color:#000;" href="' . BASE_URL . '" target="_blank">
                                            <img src="' . $sch_short_icon . '" width="100">
                                        </a>
                                    </td>
                                </tr>
                    <tr>
                        <td style="width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;" width="100%">
                            <table style="width: auto; max-width: 570px; margin: 0 auto; padding: 0;" align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="font-family: Arial, &#039;Helvetica Neue&#039;, Helvetica, sans-serif; padding: 35px;">
                                        <!-- Greeting -->
                                        
                                        <h1 style="margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold;">
                                         Hi ' . $name . ',
                                        </h1>
                                                
                                        <!-- Salutation -->
                                        <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                         Thank you for registering with ' . $sch_name . '.
                                        </p>
                                        
                                        <h1 style="margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold;">
                                         Portal Features includes the following:
                                        </h1>
                                        
                                        <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                             <span> Assignment</span><br/>
                                             <span> Lesson note.</span><br/>
                                             <span> Online test</span><br/>
                                             <span> Computer Based Examination[CBE]</span><br/>
                                        </p>

                                        <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                           <strong> Regards <br/> ' . $sch_name . ' </strong>
                                        </p>
                                      </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
            
                      <!-- Footer -->
                        <tr>
                            <td>
                                <table style="width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;" align="center" width="570" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="font-family: Arial, &#039;Helvetica Neue&#039;, Helvetica, sans-serif; color: #AEAEAE; padding: 35px; text-align: center;">
                                            <p style="margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;">
                                                &copy; ' . date('Y') . ' <a href="' . BASE_URL . '">' . $sch_name . '</a>
                                                All right reserved
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            </table>
            </body>
            </html> 
            ';
            // $mail->send();
            ini_set('display_error', 1);
            $to = $email;

            $from = $mailer_email;
            $subject = 'Welcome to ' . $sch_name;

            // To send HTML mail, the Content-type header must be set
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From:" . $from;
            mail($to, $subject, $message, $headers);

            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['userId'] = $userId;
            $_SESSION['myClass'] = $myClass;
            $_SESSION['userCategory'] = $userCategory;
            $_SESSION['userId'] = $userId;
            $_SESSION['page'] = "Register";

           
?>
<script type="text/javascript">
let tabSucc = document.querySelector(".registerResponse");
tabSucc.innerHTML = `<div class="">
                            <p> <i class="bi bi-check-circle me-1"></i> Hi <strong> <?= $name; ?> </strong>, thanks for registering with <strong><?= $sch_name; ?></strong>!
                                We are glad to have you onboard.</p><br>
                                <em>Redirecting ...</em>
                                </div>
                  <div class="progress mt-3">
                          <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>`;
window.location.href = "<?= $monnify_res; ?>"
</script>
<?php
            }
        }else{
        $_SESSION['message'] = 'An error ocurred during the process!';
                $_SESSION['msg_type'] = "success";
                $_SESSION['remedy'] = '';
                $_SESSION['btn'] = "Ok";
                header("location:../register");
    }
?>