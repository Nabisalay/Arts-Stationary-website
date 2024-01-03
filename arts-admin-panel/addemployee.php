<?php
include('admin/includes/header.php');
include('admin/includes/sidebar.php');
include('admin/includes/topbar.php');
include('config.php');

if(isset($_POST['regEmployee'])) {
    $fname = filter_var($_POST['FName'], FILTER_SANITIZE_STRING);
    $lname = filter_var($_POST['LName'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
    $confirmPass = $_POST['repeatPass'];
    $sqlQuery = mysqli_query($conn, "SELECT email FROM `arts_users` WHERE email = '$email'");
    if(mysqli_num_rows($sqlQuery) > 0) {
        echo "<script>
        alert ('email already exist')
        window.location.href='addemployee.php'
        </script>";
    }else if($_POST['pass'] !== $confirmPass) {
        echo "<script>
        alert ('password does not match please try again')
        window.location.href='addemployee.php'
        </script>";
    }else {
        $stmt = $conn->prepare("INSERT INTO `arts_users` (fname, lname, email, pass, is_employee) VALUES (?, ?, ?, ?, 1)");
        if($stmt) {
            $stmt->bind_param("ssss", $fname, $lname, $email, $pass);
            if($stmt->execute()) {
                echo "<script>
                alert ('Employee has been registered')
                window.location.href='viewemployee.php'
                </script>";
            }else {
                echo "<script>
                alert ('some issue occured while running the statement')
                window.location.href='addemployee.php'
                </script>";
            }
        }else {
            echo "<script>
            alert ('not able to prepare the statement')
            window.location.href='addemployee.php'
            </script>";   
        }
    }


}



?>


    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <h2>Add Employee</h2>
                <hr>
        <form class="user" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName"
                        placeholder="First Name" name="FName" required>
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName"
                        placeholder="Last Name" name="LName" required>
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
                        id="exampleRepeatPassword" placeholder="Repeat Password" name="repeatPass" required>
                </div>
            </div>
            <!-- <a class="btn btn-primary btn-user btn-block" name="register">
                Register Account
            </a> -->
            <input type="submit" class="btn btn-primary btn-user btn-block" name="regEmployee" >

                                
        </form>

            </div>

        </div>

    </div>


</body>

</html>










<?php
include('admin/includes/footer.php');


?>