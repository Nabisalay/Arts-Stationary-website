<?php 
session_start();
if(!isset($_SESSION['Employee'])) {
    if(isset($_SESSION['Admin'])) {
        echo "<script>window.location.href='../arts-admin-panel/index.php';</script>";
    }else if(isset($_SESSION['user'])) {
        echo "<script>window.location.href='../index.php';</script>";
    }else {
        echo "<script>window.location.href='../login.php';</script>";
    }
}
require('../arts-admin-panel/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Employee Dashbord</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.css">
    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- bootstrap  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- bootstrap data tables  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- Custom styles for this template-->
    <link href="../arts-admin-panel/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
    #userName {
        color:#333;
        font-size: 20px;
    }
</style>
</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3" style="font-size: 13px;">Employee Panel</div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <div class="container">
            <h3>Welcome Back <span id="userName"><?php echo $_SESSION['Employee']?></span></h3>
            </div>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['Employee']?></span>
                    <img class="img-profile rounded-circle"
                    src="../arts-admin-panel/img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">

                    <a class="dropdown-item" href="../changepassword.php">
                        <i class="fa-solid fa-key mr-2 text-gray-400"></i>
                        Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- End of Topbar -->
        <style>
.form-check-input[type="radio"] {
  background-color: rgba(0, 0, 0, 0.3);
}
.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
</style>
<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">
        <h2 id="mainHeading" >All Orders</h2>
        <hr>
        <div class="filter-btn">
            <div class="form-check form-check-inline">
                <input value="Order Details" class="form-check-input" type="radio" name="orderResult" id="filterResult1" >
                <label class="form-check-label" for="filterResult1" >
                   Order Details
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input value="All Orders" class="form-check-input" type="radio" name="orderResult" id="filterResult2" checked>
                <label class="form-check-label" for="filterResult2">
                    All Orders
                </label>
            </div>
        </div>

    <table id="orderTable" class="table table-striped" style="width:100%" >
        <thead id="orderHead" class="bg-warning p-2 text-dark bg-opacity-10" style="opacity: 75%;">



        </thead>
        <tbody id="orderBody">

        </tbody >
    </table>

    </div>

</div>

</div>
    </div>


<?php
if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    echo "<script> window.location.href='../login.php'; </script>";
}
?>
<!-- End of Main Content -->
<!-- Footer -->
<style>
    #background-color {
        /* background: #F2F2F2; */
    }
</style>
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" Method="POST">
            <input type="submit" name="logout" class="btn btn-success" value="Logout">
            </form>
        </div>
    </div>
</div>
</div>




<!-- jquery  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="../arts-admin-panel/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- datatables links  -->
<script src= "https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<!-- Core plugin JavaScript-->
<!-- Custom scripts for all pages-->
<script src="../arts-admin-panel/js/sb-admin-2.min.js"></script>
<script src="../arts-admin-panel/js/admin-panel.js"></script>
<!-- Page level plugins -->
<!-- Page level custom scripts -->
</body>
</html>