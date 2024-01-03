<?php
session_start();
require('arts-admin-panel/config.php');
require('arts-admin-panel/mail/emailsander.php');
if (!isset($_SESSION['user'])) {
    if (!isset($_SESSION['Employee'])) {
        echo "<script> window.location.href='index.php'</script>";
    }
}

if (isset($_POST['ChangePassword'])) {

    $currentPass = $_POST['currentPass'];
    $newPass = password_hash($_POST['newPass'], PASSWORD_BCRYPT);
    if (isset($_SESSION['user'])) {
        $userEmail = $_SESSION['email'];
        $stmt = $conn->prepare("SELECT * FROM `arts_users` WHERE email = ?
        AND is_admin = 0 AND is_employee = 0");
        $destination = 'index.php';
    } else {
        $userEmail = $_SESSION['EmployeeEmail'];
        $stmt = $conn->prepare("SELECT * FROM `arts_users` WHERE email = ?
        AND is_admin = 0 AND is_employee = 1");
        $destination = 'employee-panel/index.php';
    }
    if ($stmt) {
        $stmt->bind_param('s', $userEmail);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($row) {
                if (password_verify($currentPass, $row['pass'])) {
                    $changePass = $conn->prepare("UPDATE `arts_users` SET `pass` = ? WHERE `email` = ?;");
                    if ($changePass) {
                        $changePass->bind_param('ss', $newPass, $userEmail);
                        if ($changePass->execute()) {
                            echo "<script>
                            alert ('Password has been changed successfully');
                            window.location.href='$destination';
                            </script>";
                            $result = sendEmail($userEmail, 'Security Alert', 'Some one has just Change your account password if it\'s not you change your password');                     
                        }
                    }
                } else {
                    echo "<script>
                     alert ('Your Current password is incorrect');
                     window.location.href='changepassword.php';
                     </script>";
                }
            }
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

    <title>Arts Change Password Form</title>

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
                                        <h1 class="h4 text-gray-900 mb-4">Change Password!</h1>
                                    </div>
                                    <form class="user" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Current Password" name="currentPass" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter Your New Password" name="newPass">
                                        </div>

                                        <input type="submit" name="ChangePassword" value="Change Password" class="btn btn-primary btn-user btn-block" required>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgotpassword.php">Forgot Password?</a>
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