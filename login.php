<?php
session_start();
require('arts-admin-panel/config.php');
require('arts-admin-panel/mail/emailsander.php');

if (isset($_SESSION['Name']) || isset($_SESSION['user'])) {

    echo "<script> window.location.href='index.php'</script>";
}
if (isset($_POST['loginUser'])) {

    $email = $_POST['logEmail'];
    $pass = $_POST['logPass'];
    $stmt = $conn->prepare("SELECT * FROM `arts_users` WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param('s', $email);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($row) {
                if ($row['is_admin'] !== 1) {
                    if ($row['is_active'] !== 0) {
                        if ($row['is_employee'] !== 1) {
                            if (password_verify($pass, $row['pass'])) {
                                $result = sendEmail($email, 'Security Alert', 'Some one has Log in to your account if it\'s not you change your password');
                                if ($result == true) {
                                    $_SESSION['user'] = $row['lname'];
                                    $_SESSION['email'] = $row['email'];
                                    echo "<script>;
                                    alert ('you have login as a user');
                                    window.location.href='index.php';
                                    </script>";
                                } else {
                                    echo "<script>;
                                    alert ('some thing happened wrong please try again');
                                    window.location.href='login.php';
                                    </script>";
                                }
                            } else {
                                echo "<script>
                         alert ('Email or Password is incorrect');
                         window.location.href='login.php';
                         </script>";
                            }
                        } else {
                            if (password_verify($pass, $row['pass'])) {
                                $result = sendEmail($email, 'Security Alert', 'Some one has Log in to your account if it\'s not you change your password');
                                if ($result == true) {
                                    $_SESSION['Employee'] = $row['lname'];
                                    $_SESSION['EmployeeEmail'] = $row['email'];
                                    echo "<script>
                             alert ('you have login as a Employee');
                             window.location.href='employee-panel/index.php';
                             </script>";
                                } else {
                                    echo "<script>;
                                    alert ('some thing happened wrong please try again');
                                    window.location.href='login.php';
                                    </script>";
                                }
                            } else {
                                echo "<script>
                         alert ('Email or Password is incorrect');
                         window.location.href='login.php';
                         </script>";
                            }
                        }
                    } else {
                        echo "<script>
                alert ('You have been blocked by admin so you can\'t login contact admin for more details');
                window.location.href='index.php';
                </script>";
                    }
                } else {
                    if ($pass == $row['pass']) {
                        $_SESSION['Name'] = $row['lname'];
                        $_SESSION['Admin'] = $row['is_admin'];
                        echo "<script>
                         alert ('you have login as admin');
                         window.location.href='arts-admin-panel/index.php';
                         </script>";
                    } else {
                        echo "<script>
                         alert ('Email or Password is incorrect');
                         window.location.href='login.php';
                         </script>";
                    }
                }
            } else {
                echo "<script>
                alert ('There is no such email account. Create a new account or check the email');
                window.location.href='login.php';
                </script>";
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
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="logEmail" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="logPass">
                                        </div>

                                        <input type="submit" name="loginUser" value="Log In" class="btn btn-primary btn-user btn-block" required>
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