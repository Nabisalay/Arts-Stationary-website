<?php
session_start();
require('arts-admin-panel/config.php');
require('arts-admin-panel/mail/emailsander.php');
if (isset($_GET['token'])) {
    $userToken = trim($_GET['token']);
    $currentTime = time();
    $getToken = $conn->prepare("SELECT * FROM `forgetpass_requests` WHERE `forgetpassToken` = ?");
    if ($getToken) {
        $getToken->bind_param('s', $userToken);
        if ($getToken->execute()) {
            $result =  $getToken->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row['has_used'] != 1) {
                    if ($row['tokenExpiry'] > $currentTime) {
                        $email = $row['userEmail'];
                        $requestUsed = $conn->prepare("UPDATE `forgetpass_requests` SET has_used = 1 WHERE `userEmail` = ? AND `forgetpassToken` = ?;");
                        if ($requestUsed) {
                            $requestUsed->bind_param('ss', $email, $userToken);
                            if ($requestUsed->execute()) {
                                $_SESSION['validToken'] = true;
                                $_SESSION['newPassEmail'] = $email;
                                echo "<script>
                                window.location.href='reset-password.php';
                                </script>";
                            }
                        }
                    } else {
                        $_SESSION['Token'] = 'tokenExpired';
                        echo "<script>alert('token expired. Try again')
                        window.location.href='forgotpassword.php';
                        </script>";
                    }
                } else {
                    $_SESSION['Token'] = 'tokenUsed';
                    echo "<script>alert('this token has been used. Try again')
                    window.location.href='forgotpassword.php';
                    </script>";
                }
            } else {
                $_SESSION['Token'] = 'tokenInvalid';
                echo "<script>alert('token invalid. Try again')
                window.location.href='forgotpassword.php';
                </script>"; 
            }
        }
    }
}   
 if(isset($_POST['createNewPass'])) {
    if(isset($_SESSION['validToken']) && $_SESSION['validToken'] === true) {
        $userEmail = $_SESSION['newPassEmail'];
        $newPass = $newPass = password_hash($_POST['newPass'], PASSWORD_BCRYPT);
        if($_POST['newPass'] === $_POST['confPass']) {
        $changePass = $conn->prepare("UPDATE `arts_users` SET `pass` = ? WHERE `email` = ?;");
        if($changePass) {
            $changePass->bind_param('ss', $newPass, $userEmail);
            if($changePass->execute()) {
                session_unset();
                session_destroy();
                echo "<script>
                alert ('New Password has been created successfully');
                window.location.href='login.php';
                </script>";
                $result = sendEmail($userEmail, 'Security Alert', 'Password has been reset successfully. if it\'s not you please contact admin as soon as possible');
            }
        }
    }else {
        echo "<script>
        alert ('Rewrite password didn\'t match with the new password');
        window.location.href='reset-password.php';
        </script>";
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="arts-admin-panel/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="arts-admin-panel/css/customstyle.css">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block  form-login-bg">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create new Password</h1>
                                    </div>
                                    <form class="user" action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                                    <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter new Password" name="newPass" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Re-write Password" name="confPass">
                                        </div>
                                        <input type="submit" name="createNewPass" value="Create New Password" class="btn btn-primary btn-user btn-block" required>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Log In</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="arts-admin-panel/vendor/jquery/jquery.min.js"></script>
    <script src="arts-admin-panel/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="arts-admin-panel/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="arts-admin-panel/js/sb-admin-2.min.js"></script>

</body>

</html>