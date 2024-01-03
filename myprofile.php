<?php

include("includes/header.php");
require('arts-admin-panel/config.php');
if(!isset($_SESSION['user'])) {
    echo "<script>alert ('please login first to do any activity');
    window.location.href='login.php';
    </script>";
}


if(isset($_POST['changeInfo'])) {
    $userEmail = $_SESSION['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $stAddress = $_POST['stAddress'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $zipCode = $_POST['zipCode'];
    $mobileNo = $_POST['MobileNo'];
    // echo $userEmail;
    $updateInfo = $conn->prepare("UPDATE `arts_users` AS u
    INNER JOIN `user_details` AS ud ON u.email = ud.email
    SET u.fname = ?, u.lname = ?, ud.fname = ?, ud.lname = ?, ud.st_address = ?,
    ud.city = ?, ud.country = ?, ud.zip = ?, ud.mobile = ?
    WHERE u.email = ? AND u.is_employee = 0 AND u.is_admin = 0;");
    if($updateInfo) {
      $updateInfo->bind_param('ssssssssss', $fname, $lname, $fname, $lname, $stAddress,
      $city, $country, $zipCode, $mobileNo, $userEmail);
      if($updateInfo->execute()) {
        echo "<script>
        alert ('Information Has been updated Successfully');
        </script>";
      }else {
        echo "<script>
        alert ('Got some Problem while updating the info');
        </script>";
      }
    }else {
        echo "<script>
        alert ('Got some Problem while preparing the statement');
        </script>"; 
    }
  }

if(isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];
    $stmt = $conn->prepare("SELECT u.id, u.fname, u.lname, u.email, u.is_active,
    ud.st_address, ud.city, ud.country, ud.zip, ud.mobile FROM
    `arts_users` as u INNER JOIN `user_details` as ud ON u.email = ud.email WHERE
    u.email = '$userEmail' AND u.is_employee = 0 AND u.is_admin = 0;");
    if($stmt) {
      $stmt->execute();
      $stmt->bind_result($id, $fname, $lname, $email, $is_active, $st_address,
      $city, $country, $zip, $mobile);
      $stmt->fetch();
    }
  }
?>
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">My Profile</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">My Profile</li>
    </ol>
</div>
<div class="container-fluid py-5">
    <div class="container-fluid py-5">
        <h1 class="mb-4 text center">User Profile</h1>
        <form class="user" action='<?php htmlspecialchars($_SERVER['PHP_SELF'])?>' method='POST'>
            <div class="form-group row mt-4">
                <div class="col-sm-6  mb-sm-0">
                    <input type="text" value="<?php echo $fname?>" class="form-control form-control-user" id="FirstName"
                    placeholder="First Name" name="fname" required>
                </div>
                <div class="col-sm-6 ">
                    <input type="text" value="<?php echo $lname?>" class="form-control form-control-user" id="LastName"
                    placeholder="Last Name" name="lname" required>
                </div>
            </div>
            <div class="form-group mt-4">
                <input type="text" value="<?php echo $st_address?>" class="form-control form-control-user mb-3" id="stAddress"
                placeholder="Street Address" name="stAddress" required>
            </div>
            <div class="form-group row  mt-4">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" value="<?php echo $city?>" class="form-control form-control-user"
                    id="city" placeholder="City" name="city" required>
                </div>
            <div class="col-sm-6 ">
                <input type="text" value="<?php echo $country?>" class="form-control form-control-user"
                id="Country" placeholder="Country" name="country" required>
            </div>
        </div>
        <div class="form-group row  mt-4">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" value="<?php echo $zip?>" class="form-control form-control-user"
                id="zip" placeholder="Zip" name="zipCode" required>
            </div>
            <div class="col-sm-6 ">
                <input type="text" value="<?php echo $mobile?>" class="form-control form-control-user"
                id="MobileNo" placeholder="Mobile Number" name="MobileNo" required>
            </div>
        </div>
        <input class="btn btn-primary btn-user btn-block mt-5" type="submit" value="Change Info"
        name="changeInfo">
    </form>
</div>
</div>


<?php
include("includes/footer.php")
?>