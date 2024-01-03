<?php
session_start();
require("arts-admin-panel/config.php");

if(isset($_POST['updateCart'])) {
    $prodId = $_POST['prodID'];
    $userEmail = $_SESSION['email'];
    if(isset($_POST['decrease'])) {
        $stmt = $conn->prepare("UPDATE `user_cart` SET quantity = quantity - 1 WHERE
        `userEmail` = '$userEmail' AND productID = '$prodId';");
    }else if(isset($_POST['increase'])) {
        $stmt = $conn->prepare("UPDATE `user_cart` SET quantity = quantity + 1 WHERE
        `userEmail` = '$userEmail' AND productID = '$prodId';");
    }
    if($stmt->execute()) {
        $response = array('success' => true, 'message' => 'quantity updated successfully');
    }else {
        $response = array('success' => false, 'message' => 'couldn\'t update quantity please try again by refreshing the page');
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>

<?php 
if(isset($_POST['deleteCart'])) {
    $prodId = $_POST['prodID'];
    $userEmail = $_SESSION['email'];
    $fetchCart = $conn->prepare("DELETE FROM `user_cart` WHERE
    `userEmail` = '$userEmail' AND productID = '$prodId';");
    if($fetchCart->execute())  {
        $response = array('success' => true, 'message' => 'quantity updated successfully');
    }else {
        $response = array('success' => false, 'message' => 'couldn\'t update quantity please try again by refreshing the page');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>

<?php 
if(isset($_POST['cancelOrder'])) {
    $OrderId = $_POST['OrderId'];
    $orderStatus = intval($_POST['orderStatus']);
    $userEmail = $_SESSION['email'];
    if($orderStatus !== 1) {
    $fetchCart = $conn->prepare("UPDATE `orders` SET `has_cancel` = 1 WHERE
    `userEmail` = '$userEmail' AND OrderID = '$OrderId';");
    if($fetchCart->execute())  {
        $response = array('success' => true, 'message' => 'Order has been cancel successfully');
    }else {
        $response = array('success' => false, 'message' => 'couldn\'t cancel Order please try again by refreshing the page or contact admin');
    }
}else {
    $response = array('success' => false, 'message' => 'You can not cancel the order after it\'s dispatched');
}
    header('Content-Type: application/json');
    echo json_encode($response);

}
?>
<?php 
if(isset($_POST['doPayment'])) {
    $OrderId = $_POST['OrderId'];
    $userEmail = $_SESSION['email'];
    $fetchCart = $conn->prepare("UPDATE `orders` SET `Payment_done` = 1 WHERE
    `userEmail` = '$userEmail' AND OrderID = '$OrderId';");
    if($fetchCart->execute())  {
        $response = array('success' => true, 'message' => 'Payment has been done successfully');
    }else {
        $response = array('success' => false, 'message' => 'some error occur please try again or contact admin');
    }

    header('Content-Type: application/json');
    echo json_encode($response);

}
?>
