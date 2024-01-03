<?php
include('admin/includes/header.php');
include('admin/includes/sidebar.php');
include('admin/includes/topbar.php');
require('config.php');
if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = $conn->prepare("SELECT u.id, u.fname, u.lname, u.email, u.is_active,
  ud.st_address, ud.city, ud.country, ud.zip, ud.mobile FROM
  `arts_users` as u INNER JOIN `user_details` as ud ON u.email = ud.email WHERE
  u.id = '$id' AND u.is_employee = 0 AND u.is_admin = 0;");
  if($stmt) {
    $stmt->execute();
    $stmt->bind_result($id, $fname, $lname, $email, $is_active, $st_address,
    $city, $country, $zip, $mobile);
    $stmt->fetch();
  }
}
?>

<div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo $fname . ' ' . $lname?></h4>

                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      
                    <?php echo $fname . ' ' . $lname?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div id="userEmail" class="col-sm-9 text-secondary">
                    <?php echo $email?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $mobile?>
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $st_address.', '.$city.', '.$country.' '.$zip?>
                    </div>
                  </div>
                  <hr>
  
                </div>
              </div>

<!-- table will be here  -->



            </div>
          </div>
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <h2>User History</h2>
                <hr>
            <table id="userHistry" class="table table-striped" style="width:100%" >
                <thead id="userHistryhead" class="bg-warning p-2 text-dark bg-opacity-10" style="opacity: 75%;">

                    <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Product</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Is Ok</th>
                    <th scope="col">Ordered On</th>
                    <th scope="col">Completed On</th>
                    </tr>

                </thead>
                <tbody id="userHistrybody">
 
                </tbody >
            </table>

            </div>

        </div>
        </div>
    </div>
    
    <?php
    include('admin/includes/footer.php');
    ?>