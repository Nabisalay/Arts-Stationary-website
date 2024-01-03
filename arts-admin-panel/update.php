<?php
session_start();
require('config.php');
require('mail/emailsander.php');
// Check if the user is logged in
if (!isset($_SESSION['Name'])) {
    if (!isset($_SESSION['Employee'])) {
        echo "<script> alert ('please login first to continue your activity');
        window.location.href='../login.php'
        </script>";
    }
}

// this is to update the employe info 
if (isset($_POST['uempid'])) {
    $empid = $_POST['uempid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $updEmp = $conn->prepare("UPDATE `arts_users` SET fname = ?, lname = ?, email = ? WHERE id = ?;");
    if ($updEmp) {
        $updEmp->bind_param('sssi', $fname, $lname, $email, $empid);
        if ($updEmp->execute()) {
            $response = array('success' => true, 'message' => 'Update successful');
        } else {
            $response = array('success' => false, 'message' => 'Update failed');
        }
    } else {
        $response = array('success' => false, 'message' => 'Statement preparation failed');
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}


// Check if empid and status are set in the POST request
if (isset($_POST['empid'], $_POST['status'])) {
    $empId = $_POST['empid'];
    $status = ($_POST['status'] == 1 ? 0 : 1);

    $stmt = $conn->prepare("UPDATE `arts_users` SET is_active = ? WHERE id = ?;");

    if ($stmt) {
        $stmt->bind_param('ii', $status, $empId);

        if ($stmt->execute()) {
            $response = array('success' => true, 'message' => 'action completed successful');
        } else {
            $response = array('success' => false, 'message' => 'action failed');
        }
    } else {
        $response = array('success' => false, 'message' => 'Statement preparation failed');
    }

    // Set the proper JSON header
    header('Content-Type: application/json');
    echo json_encode($response);
}


// this to put the product in trash and restore
if (isset($_POST['trashProduct'])) {
    $prodId = $_POST['prodId'];
    $prodcode = $_POST['prodcode'] ?? '00';
    $prodStatus = ($_POST['prodStatus'] == 1 ? 0 : 1);
    $catStatus = $conn->prepare("SELECT * FROM `category` WHERE cid = $prodcode AND is_active = 0");
    if ($catStatus->execute()) {
        $catStatus->store_result();
        if ($catStatus->num_rows < 1) {
            // perform action 
            $stmt = $conn->prepare("UPDATE `products` SET `Status` = ? WHERE id = ?;");

            if ($stmt) {
                $stmt->bind_param('ii', $prodStatus, $prodId);

                if ($stmt->execute()) {
                    $response = array('success' => true, 'message' => 'action completed successful');
                } else {
                    $response = array('success' => false, 'message' => 'action failed');
                }
            } else {
                $response = array('success' => false, 'message' => 'Statement preparation failed');
            }
        } else {
            $response = array('success' => false, 'message' => 'Can\'t restore the item it\'s parent category is deactived');
        }
    }

    // Set the proper JSON header
    header('Content-Type: application/json');
    echo json_encode($response);
}


// this is to update the product info  
if (isset($_POST['upid'])) {
    $upid = $_POST['upid'];
    $updes = $_POST['updes'];
    $upprice = $_POST['upprice'];
    $upwarrenty = $_POST['upwarrenty'];
    $updProd = $conn->prepare("UPDATE `products` SET description = ?, price = ?, warranty = ? WHERE id = ?;");
    if ($updProd) {
        $updProd->bind_param('sisi', $updes, $upprice, $upwarrenty, $upid);
        if ($updProd->execute()) {
            $response = array('success' => true, 'message' => 'Product Update successful');
        } else {
            $response = array('success' => false, 'message' => 'Product Update failed');
        }
    } else {
        $response = array('success' => false, 'message' => ' Statement preparation failed of Product update');
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

// this code is used to activate or deactivate category
if (isset($_POST['activateCat'])) {
    $catid = $_POST['catid'];
    $catstatus = ($_POST['catstatus'] == 1 ? 0 : 1);
    $stmt = $conn->prepare("UPDATE `category` SET `is_active` = ? WHERE cid = ?;");
    if ($stmt) {
        $stmt->bind_param('ii', $catstatus, $catid);
        if ($stmt->execute()) {
            if ($catstatus == 0) {
                $prodStmt = $conn->prepare("UPDATE `products` SET `Status` = 0 WHERE prodCode = $catid;");
                $prodStmt->execute();
            } else {
                $prodStmt = $conn->prepare("UPDATE `products` SET `Status` = 1 WHERE prodCode = $catid;");
                $prodStmt->execute();
            }
            $response = array('success' => true, 'message' => 'action completed successful');
        } else {
            $response = array('success' => false, 'message' => 'action failed');
        }
    } else {
        $response = array('success' => false, 'message' => 'Statement preparation failed');
    }

    // Set the proper JSON header
    header('Content-Type: application/json');
    echo json_encode($response);
}


// this is to update the category info  
if (isset($_POST['catuid'])) {
    $catid = $_POST['catuid'];
    $catName = $_POST['catName'];

    $updProd = $conn->prepare("UPDATE `category` SET cname = ? WHERE cid = ?;");
    if ($updProd) {
        $updProd->bind_param('ss', $catName, $catid);
        if ($updProd->execute()) {
            $response = array('success' => true, 'message' => 'Product Update successful');
        } else {
            $response = array('success' => false, 'message' => 'Product Update failed');
        }
    } else {
        $response = array('success' => false, 'message' => ' Statement preparation failed of Product update');
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}


// Check if empid and status are set in the POST request
if (isset($_POST['uid'], $_POST['status'])) {
    $uid = $_POST['uid'];
    $status = ($_POST['status'] == 1 ? 0 : 1);

    $stmt = $conn->prepare("UPDATE `arts_users` SET is_active = ? WHERE id = ?;");

    if ($stmt) {
        $stmt->bind_param('ii', $status, $uid);

        if ($stmt->execute()) {
            $response = array('success' => true, 'message' => 'action completed successful');
        } else {
            $response = array('success' => false, 'message' => 'action failed');
        }
    } else {
        $response = array('success' => false, 'message' => 'Statement preparation failed');
    }

    // Set the proper JSON header
    header('Content-Type: application/json');
    echo json_encode($response);
}


if (isset($_POST['dispatchOrder'])) {
    $OrderId = $_POST['OrderId'];
    $paymentMethod = $_POST['paymentMethod'];
    $paymentStatus = $_POST['paymentStatus'];
    if ($paymentStatus == 1 || $paymentStatus == 0 && $paymentMethod == 'Cash On Delivery') {
        $fetchCart = $conn->prepare("UPDATE `orders` SET `has_dispatched` = 1 WHERE
            OrderID = '$OrderId';");
        if ($fetchCart->execute()) {
                $response = array('success' => true, 'message' => 'Order has been dispatched successfully');
        } else {
            $response = array('success' => false, 'message' => 'some error occur please try again or contact admin');
        }
    } else {
        $response = array('success' => false, 'message' => 'Can\'t dispatch user has not clear the payment yet');
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
if (isset($_POST['orderDispatched'])) {
    $email = $_POST['email'];
    $orderid = $_POST['orderid'];
    $result = sendEmail($email, 'Order Dispatched', 'Order has been dispatched for the following order ID: <b>' . $orderid . '</b>');
    if ($result == true) {
        $response = array('success' => true, 'message' => 'Email Sent');
    }else {
        $response = array('success' => false, 'message' => 'Email Failed');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
