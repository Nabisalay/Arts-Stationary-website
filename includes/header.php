<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>ARTS—The Stationary Shop</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">  -->

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <!-- <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet"> -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>

        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div> -->
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">123 Street, New York</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
                    </div>
                    <!-- <div class="top-link pe-2">
                        <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                        <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                        <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                    </div> -->
                </div>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-lg">
                    <a href="index.php" class="navbar-brand"><h1 class="text-primary display-6">Arts Stationary</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.php" class="nav-item nav-link ">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Shop</a>

                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <a href="cart.php" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                            </a>
                            <?php if(isset($_SESSION['user'])) {?>
                                <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?php echo $_SESSION['user']?></a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a id="userlogout" class="dropdown-item" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                            </a>
                                <div>
                                <a href="cart.php" class="dropdown-item" >
                                <i class="fa-solid fa-cart-shopping mr-2 text-gray-400"></i>
                                    MY Cart
                            </a>
                                <a  href="ordered.php" class="dropdown-item" >
                                <i class="fa-solid fa-bag-shopping mr-2 text-gray-400"></i>
                                My Orders
                            </a>
                                <a  href="changepassword.php" class="dropdown-item" >
                                <i class="fa-solid fa-key mr-2 text-gray-400"></i>
                                Change Password
                            </a>
                                <a  href="myprofile.php" class="dropdown-item" >
                                <i class="fa fa-user mr-2 text-gray-400"></i>
                                My Profile
                            </a>
                                </div>
                                </div>
                            </div>

                            <?php }else {?>
                            <a href="login.php" class="my-auto">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                            <?php }?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->

        <script>
    // Get the current URL
    let currentURL = window.location.href;

    let navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(function (link) {
        let linkURL = link.getAttribute('href');
        // Check if the current URL matches the link's URL
        // Create URL objects for the current URL and link's URL
        let currentURLObject = new URL(currentURL);
        let linkURLObject = new URL(linkURL, currentURL);
        // Check if the URLs match
        if (currentURLObject.href === linkURLObject.href) {
            link.classList.add('active');
        }
    });
</script>