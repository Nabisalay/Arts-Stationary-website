<?php
include("includes/header.php");
require('arts-admin-panel/config.php');
if(!isset($_SESSION['user'])) {
    echo "<script>alert ('please login first to do any activity');
    window.location.href='login.php';
    </script>";
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


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Checkout</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Checkout</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Checkout Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Billing details</h1>
                <form action="placeoder.php" method="POST">
                    <div class="row g-5">
                        <div class="col-md-12 col-lg-6 col-xl-7">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">First Name<sup>*</sup></label>
                                        <input type="text" name="fname" value="<?php echo $fname ?? ''?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Last Name<sup>*</sup></label>
                                        <input type="text" value="<?php echo $lname ?? ''?>" name="lname"class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-item">
                                <label class="form-label my-3">Address <sup>*</sup></label>
                                <input type="text" name="stAddress" value="<?php echo $st_address ?? ''?>" class="form-control"  required>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Town/City<sup>*</sup></label>
                                <input type="text" name="city" value="<?php echo $city ?? ''?>" class="form-control" required>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Country<sup>*</sup></label>
                                <input type="text" value="<?php echo $country ?? ''?>" name="country" class="form-control" required>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                                <input type="text" value="<?php echo $zip ?? ''?>" name="zipCode" class="form-control" required>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Mobile<sup>*</sup></label>
                                <input type="tel" value="<?php echo $mobile ?? ''?>" name="mobileNo" class="form-control" required>
                            </div>
    
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-5">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Products</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Warranty</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cartTablebody">
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <td class="py-5">
                                    <h3 class="mb-0 text-primary py-4">Shipping</h3>
                                </td>
                                <td colspan="3" class="py-5">
                                    <div class="form-check text-start">
                                        <input type="radio" class="form-check-input bg-primary border-0" id="Shipping-1" name="Shipping" data-totalprice="" value="standard" required>
                                        <label class="form-check-label" for="Shipping-1"><b> Standard Shipping:</b> Takes 4 to 5 business days</label>
                                        <p><b>Charges:</b> $5.0</p>
                                    </div>
                                    <div class="form-check text-start">
                                        <input type="radio" class="form-check-input bg-primary border-0" id="Shipping-2" name="Shipping" value="premium" required>
                                        <label class="form-check-label" for="Shipping-2"><b> Premium Shipping:</b> Takes 1 to 2 business days</label>
                                        <p><b>Charges:</b> $15.0</p>
                                    </div>
                                </td>
                            </div>
                            <hr>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0" id="Transfer-1" name="paymentMethod" value="Credit Card" required>
                                        <label class="form-check-label" for="Transfer-1">Credit Card Payment</label>
                                    </div>
                                    <p class="text-start text-dark">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0" id="Payments-1" name="paymentMethod" value="Cheque Payment" required>
                                        <label class="form-check-label" for="Payments-1">Cheque Payment</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0" id="Delivery-1" name="paymentMethod" value="Cash On Delivery" required>
                                        <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <td class="py-5">
                                <input id="finalAmountinp" type="hidden" name="finalAmountinp">
                                    <h3 class="mb-0 text-dark py-4">Total: <span id="finalAmount" ></span> </h3>
                                </td>
                                
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button type="submit" name="placeOrder" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Checkout Page End -->


        <?php
        include("includes/footer.php");
        ?>