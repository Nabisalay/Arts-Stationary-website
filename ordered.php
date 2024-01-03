<?php
include("includes/header.php");

if(!isset($_SESSION['user'])) {
    echo "<script>alert ('please login first to see your cart items');
    window.location.href='login.php';
    </script>";
}
?>



        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Ordered</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Ordered</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Warranty</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Dispatched</th>
                            <th scope="col">Placed At</th>
                          </tr>
                        </thead>
                        <tbody id="orderedProducts">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Cart Page End -->


        <?php
include("includes/footer.php")
?>