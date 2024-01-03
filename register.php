<?php 
require('arts-admin-panel/config.php');
require('arts-admin-panel/mail/emailsander.php');

if(isset($_POST['registerUser'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
    $confirmPass = $_POST['confirmPass'];
    $sqlQuery = mysqli_query($conn, "SELECT email FROM `arts_users` WHERE email = '$email'");
    if(mysqli_num_rows($sqlQuery) > 0) {
        echo "<script>
        alert ('email already exist')
        window.location.href='register.php'
        </script>";
    }else if($_POST['pass'] !== $confirmPass) {
        echo "<script>
        alert ('password does not match please try again')
        window.location.href='register.php'
        </script>";
    }else {
        $stmt = $conn->prepare("INSERT INTO `arts_users` (fname, lname, email, pass) VALUES (?, ?, ?, ?)");
        if($stmt) {
            $stmt->bind_param("ssss", $fname, $lname, $email, $pass);
            if($stmt->execute()) {
                echo "<script>
                alert ('account has been created please login to continue your activity')
                window.location.href='login.php'
                </script>";
                $result = sendEmail($email, 'Account has been Created Successfully', 'Thank you for creating an account with Art-Stationary. We welcome you warmly into our online shopping family.');
            }else {
                echo "<script>
                alert ('some issue occured while running the statement')
                window.location.href='register.php'
                </script>";
            }
        }else {
            echo "<script>
            alert ('not able to prepare the statement')
            window.location.href='register.php'
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

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="arts-admin-panel/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="arts-admin-panel/css/customstyle.css">


</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block form-reg-bg"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action='<?php htmlspecialchars($_SERVER['PHP_SELF'])?>' method='POST'>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name" name="fname" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name" name="lname" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name="email" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="pass" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" name="confirmPass" required>
                                    </div>
                                </div>
                                <input class="btn btn-primary btn-user btn-block" type="submit" value="Register Account"
                                name="registerUser">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
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