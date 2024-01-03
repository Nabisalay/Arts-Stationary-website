<?php
session_start();

require("arts-admin-panel/config.php");
if(isset($_POST['addtocart'])) {
    if(isset($_SESSION['user'])) {
        $productId = $_POST['prodId'];
        $userEmail = $_SESSION['email'];
        $checkItem = $conn->prepare("SELECT * FROM `user_cart` WHERE `userEmail` =
        '$userEmail' AND `productID` = '$productId' AND `is_active` = 1;");
        if($checkItem->execute()) {
            $checkItem->store_result();
            if($checkItem->num_rows > 0){
                $response = array('success' => false,
                'message' => 'product already exist in your cart');
            }else {
                $insertCart = $conn->prepare("INSERT INTO `user_cart` (`userEmail`, `productID`) VALUE (?, ?);");
                if($insertCart) {
                    $insertCart->bind_param('ss', $userEmail, $productId);
                    if($insertCart->execute()) {
                        $response = array('success' => true, 'message' => 'product has been added to cart successfully');
                    }else {
                        $response = array('success' => false,
                        'message' => 'sorry we couldn\'t add the product to cart Please try again',
                        'error' => mysqli_error($conn));
                    }
                    $insertCart->close(); 
                }else {
                    $response = array('success' => false,
                    'message' => 'sorry we couldn\'t able to prepare the statement',
                    'error' => mysqli_error($conn));
                }
            }
            $checkItem->close();
        }    
    }else {
        $response = array('success' => false,
        'message' => 'login first to do any activity',
        'is_login' => false);
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>