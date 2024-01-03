<?php 
session_start();
require("arts-admin-panel/config.php");
require('arts-admin-panel/mail/emailsander.php');
if(isset($_POST['placeOrder'])) {
    // this is to get user info 
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $stAddress = $_POST['stAddress'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $zipCode = $_POST['zipCode'];
    $mobileNo = $_POST['mobileNo'];
    $userEmail = $_SESSION['email'];
    $deliveryType = ($_POST['Shipping'] == 'standard') ? 1: 2;
    $paymentMethod = $_POST['paymentMethod'];
    $finalAmountinp = $_POST['finalAmountinp'];
    // getting product id so we can generate order id as the requirement 
    $getprdid = $conn->prepare("SELECT productID FROM `user_cart` 
    WHERE userEmail = '$userEmail' AND is_active = 1 AND
    has_ordered = 0 LIMIT 1;");
    if($getprdid->execute()) {
        $getprdid->bind_result($productNumber);
        $getprdid->fetch();
        $getprdid->close();
        $getOrderId = $conn->query("SELECT MAX(OrderID) FROM `orders`;");
        $maxOrderId = $getOrderId->fetch_assoc()['MAX(OrderID)']; 
        $getOrderId->close();
        $orderId = str_pad($maxOrderId + 1, 8, '0', STR_PAD_LEFT);
        $orderNumber = $deliveryType . $productNumber . $orderId;
        // this code is used to insert into order table order number and other details 
        $stmt = $conn->prepare("INSERT INTO `orders` (`OrderID`, `userEmail`, 
        `DeliveryType`, `payment_method`, `OrderNumber`, total_amount) VALUES (?, ?, ?, ?, ?, ?);");
        if($stmt) {
            $stmt->bind_param('ssissi', $orderId, $userEmail, $deliveryType, $paymentMethod, $orderNumber, $finalAmountinp);
            if($stmt->execute()) {
                $stmt->close();
                // this code is used to insert order details 
                $insertDetails = $conn->prepare("INSERT INTO `orderdetails` (order_number, product_id, quantity, price, total_price)
                SELECT ?, u.productID, u.quantity, p.price, u.quantity * p.price
                FROM `user_cart` AS u INNER JOIN `products`
                AS p ON u.productID = p.prodID WHERE u.userEmail =
                '$userEmail' AND u.is_active = 1 AND u.has_ordered = 0");
                $insertDetails->bind_param('s', $orderNumber);
                if ($insertDetails->execute()) {
                    $insertDetails->close();
                    // this code is used to udpate the status to has ordered 
                    $updUserCart = $conn->prepare("DELETE FROM `user_cart` WHERE `userEmail` = '$userEmail' AND `is_active` = 1;");
                    if($updUserCart->execute()) {
                        $updUserCart->close();
                        // this code is used to insert user detail 
                        $checkUserInfo = $conn->prepare("SELECT `email` FROM `user_details` WHERE `email` = '$userEmail';");
                        if($checkUserInfo) {
                            $checkUserInfo->execute();
                            $checkUserInfo->store_result();
                            if($checkUserInfo->num_rows < 1) {
                                $insertUserInfo = $conn->prepare("INSERT INTO `user_details` (`fname`, lname,
                                st_address, city, country, zip, mobile, email) VAlUES
                                (?, ?, ?, ?, ?, ?, ?, ?)");
                                if($insertUserInfo) {
                                    $insertUserInfo->bind_param('sssssiss', $fname, $lname, $stAddress,
                                    $city, $country, $zipCode, $mobileNo, $userEmail 
                                );
                                if($insertUserInfo->execute()) {
                                    echo "<script> alert ('order has been successfully placed. Thank you for Shoping with us');
                                    window.location.href='ordered.php';
                                    </script>";
                                    $message = 'Your Order has been Placed Successfully. Your Order Number is ' . $orderId . '. Thank you for shopping with us.';
                                    $result = sendEmail($userEmail, 'Order Placed Successfully', $message);
                                }else {
                                    echo "<script> alert ('failed to insert user details please try again');
                                    window.location.href='checkout.php';
                                    </script>";
                                }
                                }else {
                                    echo "<script> alert ('prepare statement failed for inserting user info please try again');
                                    window.location.href='checkout.php';
                                    </script>";
                                }
                            }else {
                                echo "<script> alert ('order has been successfully placed. Thank you for Shoping with us');
                                window.location.href='ordered.php';
                                </script>";
                                $message = 'Your Order has been Placed Successfully. Your Order Number is <b>' . $orderId . '</b>. Thank you for shopping with us.';
                                $result = sendEmail($userEmail, 'Order Placed Successfully', $message);
                            }
                        }       
                    }else {
                        echo "<script> alert ('failed to update the status of has ordered please try again');
                        window.location.href='checkout.php';
                        </script>";
                    }
                    // Success message
                } else {
                    // Error message
                    echo "<script> alert ('failed to execute statement to insert order details please try again');
                    window.location.href='checkout.php';
                    </script>";
                }
            }else {
                echo "<script> alert ('failed to execute statement to insert order please try again');
                window.location.href='checkout.php';
                </script>";
            }
        }else {
            echo "<script> alert ('prepare statement failed for inserting order please try again');
            window.location.href='checkout.php';
            </script>";
        }
    }else {
        echo "<script> alert ('failed to execute statement to get product id. please try again');
        window.location.href='checkout.php';
        </script>";
    }

};
?>
