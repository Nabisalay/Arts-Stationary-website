<?php
session_start();
require('config.php');
//  this to fetch the employees
if (!isset($_SESSION['Name'])) {
    if (!isset($_SESSION['Employee'])) {
        echo "<script> alert ('please login first to continue your activity');
    window.location.href='../login.php'
    </script>";
    }
}
if (isset($_POST['fetchEmployees'])) {
    $stmt = $conn->prepare("SELECT id, fname, lname, email, is_active FROM `arts_users` WHERE is_employee = 1 ORDER BY id DESC");
    if ($stmt) {

        $stmt->execute();
        $result = $stmt->get_result();
        $i = 0;
        ob_start();
        while ($row = $result->fetch_assoc()) {
?>
            <tr>
                <th scope="row"><?php echo ++$i ?></th>
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['lname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo ($row['is_active'] == 1) ? "active" : "blocked"; ?></td>
                <td><button class="btn btn-success update-modal" data-toggle="modal" data-target="#updatemodal" data-uempid="<?php echo $row['id']; ?>" data-ufname="<?php echo $row['fname']; ?>" data-ulname="<?php echo $row['lname']; ?>" data-uemail="<?php echo $row['email']; ?>">Update
                    </button></td>
                <td><button class="btn btn-danger deleteEmp" data-empid="<?php echo $row['id']; ?>" data-status="<?php echo $row['is_active']; ?>">
                        <?php echo ($row['is_active'] == 1) ? "block" : "unblock"; ?></button></td>
            </tr>
<?php
        }
        $tbody_content = ob_get_clean();
        $response = array('success' => true, 'message' => 'employee fetched successful', 'tbody' => $tbody_content);
    } else {
        $response = array('success' => false, 'message' => 'failed', 'error' => mysqli_error($conn));
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
<?php
// this is to fetch product
if (isset($_POST['fetchProd'])) {
    $stmt = $conn->prepare("SELECT * FROM `products` WHERE `Status` = 1;");
    if ($stmt) {
        // ob_start();
?>

        <?php
        // $thead_content = ob_get_clean();
        $stmt->execute();
        $result = $stmt->get_result();
        $i = 0;
        ob_start();
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <th scope="row"><?php echo ++$i ?></th>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['warranty']; ?></td>
                <td><img src="<?php echo 'images/' . $row['prodImg'] ?>" alt="" height='50px' width='50px'> </td>
                <td><button class="btn btn-primary updatePro-modal" data-toggle="modal" data-target="#updateProdModal" data-upid="<?php echo $row['id']; ?>" data-updes="<?php echo $row['description']; ?>" data-upprice="<?php echo $row['price']; ?>" data-upwarrenty="<?php echo $row['warranty']; ?>">Edit</button></td>
                <td><button class="btn btn-danger trash-product" data-prodid="<?php echo $row['id']; ?>" data-prodstatus="<?php echo $row['Status']; ?>">Delete</button></td>
            </tr>
<?php
        }
        $tbody_content = ob_get_clean();
        $response = array('success' => true, 'message' => 'category fetched successful', 'tbody' => $tbody_content);
    } else {
        $response = array('success' => false, 'message' => 'failed', 'error' => mysqli_error($conn));
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>

<?php
// this is to fetch category
if (isset($_POST['fetchCat'])) {
    $stmt = $conn->prepare("SELECT * FROM `category`;");
    if ($stmt) {
        // ob_start();
?>

        <?php
        // $thead_content = ob_get_clean();
        $stmt->execute();
        $result = $stmt->get_result();
        $i = 0;
        ob_start();
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <th scope="row"><?php echo ++$i ?></th>
                <td><?php echo $row['cname']; ?></td>
                <td><?php echo ($row['is_active'] == 1 ? 'active' : 'deactive'); ?></td>
                <td><button class="btn btn-primary updateCat-modal" data-toggle="modal" data-target="#updateCatModal" data-catid="<?php echo $row['cid'] ?>" data-catname="<?php echo $row['cname'] ?>">Edit</button></td>
                <td><button class="btn btn-success catStatus" data-catid="<?php echo $row['cid']; ?>" data-catstatus="<?php echo $row['is_active']; ?>">Change</button></td>
            </tr>
<?php
        }
        $tbody_content = ob_get_clean();
        $response = array('success' => true, 'message' => 'category fetched successful', 'tbody' => $tbody_content);
    } else {
        $response = array('success' => false, 'message' => 'failed', 'error' => mysqli_error($conn));
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>


<?php
// this is to fetch trash item
if (isset($_POST['fetchtrashProd'])) {
    $stmt = $conn->prepare("SELECT * FROM `products` WHERE `Status` = 0;");
    if ($stmt) {
?>

        <?php
        $stmt->execute();
        $result = $stmt->get_result();
        $i = 0;
        ob_start();
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <th scope="row"><?php echo ++$i ?></th>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['warranty']; ?></td>
                <td><img src="<?php echo 'images/' . $row['prodImg'] ?>" alt="" height='50px' width='50px'> </td>
                <td><button class="btn btn-primary restore-product" data-prodid="<?php echo $row['id']; ?>"
                 data-prodstatus="<?php echo $row['Status']; ?>" data-prodcode="<?php echo $row['prodCode']; ?>">Restore</button></td>
                <td><button class="btn btn-danger ">Delete</button></td>
            </tr>
<?php
        }
        $tbody_content = ob_get_clean();
        $response = array('success' => true, 'message' => 'category fetched successful', 'tbody' => $tbody_content);
    } else {
        $response = array('success' => false, 'message' => 'failed', 'error' => mysqli_error($conn));
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
<?php
if (isset($_POST['fetchUser'])) {
    $stmt = $conn->prepare("SELECT id, fname, lname, email, is_active FROM `arts_users` WHERE is_employee = 0 AND is_admin = 0 ORDER BY id DESC");
    if ($stmt) {

        $stmt->execute();
        $result = $stmt->get_result();
        $i = 0;
        ob_start();
        while ($row = $result->fetch_assoc()) {
?>
            <tr>
                <th scope="row"><?php echo ++$i ?></th>
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['lname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo ($row['is_active'] == 1) ? "active" : "blocked"; ?></td>
                <td><a href="userProfile.php?id=<?php echo $row['id']; ?>" class="btn btn-success">
                        Profile
                    </a></td>
                <td><button class="btn btn-danger deleteUser" data-uid="<?php echo $row['id']; ?>" data-status="<?php echo $row['is_active']; ?>">
                        <?php echo ($row['is_active'] == 1) ? "block" : "unblock"; ?></button></td>
            </tr>
<?php
        }
        $tbody_content = ob_get_clean();
        $response = array('success' => true, 'message' => 'employee fetched successful', 'tbody' => $tbody_content);
    } else {
        $response = array('success' => false, 'message' => 'failed', 'error' => mysqli_error($conn));
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>


<?php
if (isset($_POST['userHistory'])) {
    $userEmail = filter_var($_POST['userEmail'], FILTER_SANITIZE_EMAIL);
    $stmt = $conn->prepare("SELECT * FROM `orders` as o
    INNER JOIN `orderdetails` as od ON o.OrderNumber = od.order_number
    INNER JOIN products as p ON od.product_id = p.prodID
    WHERE o.userEmail = '$userEmail' ORDER BY o.OrderDate DESC;");
    if ($stmt) {
        $stmt->execute();
        $result = $stmt->get_result();
        $i = 0;
        ob_start();
        while ($cartData = $result->fetch_assoc()) {
?>
            <tr>
                <th scope="row">
                    <div class="d-flex align-items-center"><?php echo $cartData['OrderID'] ?></div>
                </th>
                <th scope="row">
                    <div class="d-flex align-items-center">
                        <img src="<?php echo 'images/' . $cartData['prodImg'] ?>" class="img-fluid me-5 " style="width: 80px; height: 80px;" alt="">
                    </div>
                </th>
                <td>
                    <p class="mb-0 mt-4"><?php echo $cartData['description']; ?></p>
                </td>
                <td>
                    <p class="mb-0 mt-4"><?php echo '$' . $cartData['price']; ?></p>
                </td>
                <td>
                    <p class="mb-0 mt-4"><?php echo $cartData['quantity']; ?></p>
                </td>
                <td>
                    <p class="mb-0 mt-4"><?php echo $cartData['payment_done'] == 0 ? 'No' : 'yes'; ?></p>
                </td>
                <td>
                    <p class="mb-0 mt-4"><?php echo $cartData['OrderDate']; ?></p>
                </td>

                <td>
                    <p class="mb-0 mt-4"><?php echo $cartData['completed_on'] ?? 'Not yet'; ?></p>
                </td>
            </tr>
<?php
        }
        $tbody_content = ob_get_clean();
        $response = array('success' => true, 'message' => 'employee fetched successful', 'tbody' => $tbody_content, 'userEmail' => $userEmail);
    } else {
        $response = array('success' => false, 'message' => 'failed', 'error' => mysqli_error($conn));
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>


<?php
// this is to fetch product
if (isset($_POST['fetchOrder'])) {
    $stmt = $conn->prepare("SELECT * FROM `orders`");
    if ($stmt) {
        ob_start();
?>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">User Email</th>
            <th scope="col">Delivery Type</th>
            <th scope="col">Payment Method</th>
            <th scope="col">Order Number</th>
            <th scope="col">Place On</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Payment Done</th>
            <th scope="col">Has Dispatched</th>
            <th scope="col">Has Completed</th>
            <th scope="col">Completed ON</th>
            <th scope="col">Action</th>
        </tr>
        <?php
        $thead_content = ob_get_clean();
        $stmt->execute();
        $result = $stmt->get_result();
        $i = 0;
        ob_start();
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <th scope="row"><?php echo ++$i ?></th>
                <td><?php echo $row['userEmail']; ?></td>
                <td><?php echo $row['DeliveryType'] == 1 ? 'Standard' : 'Premium'; ?></td>
                <td><?php echo $row['payment_method']; ?></td>
                <td><?php echo $row['OrderNumber']; ?></td>
                <td><?php echo $row['OrderDate']; ?></td>
                <td><?php echo $row['total_amount']; ?></td>
                <td><?php echo $row['payment_done'] == 0 ? 'Not Yet' : 'Yes'; ?></td>
                <td><?php echo $row['has_dispatched'] == 0 ? 'Not Yet' : 'Yes'; ?></td>
                <td><?php echo $row['has_completed'] == 0 ? 'Not Yet' : 'Yes'; ?></td>
                <td><?php echo $row['completed_on'] ?? 'Not Yet'; ?></td>
                <?php $disable = $row['has_dispatched'] == 1 ? 'disabled' : ''; ?>
                <td><button data-orderid="<?php echo $row['OrderID'] ?>" data-email="<?php echo $row['userEmail'] ?>" 
                data-paymentmethod="<?php echo $row['payment_method']; ?>" data-paymentstatus="<?php echo $row['payment_done']; ?>" class="btn btn-primary <?php echo $disable ?> dispatch"><?php echo $row['has_dispatched'] == 0 ? 'Dispatch' : 'Dispatched'; ?></button></td>
            </tr>
<?php
        }
        $tbody_content = ob_get_clean();
        $response = array('success' => true, 'message' => 'Order fetched successful', 'tbody' => $tbody_content, 'thead' => $thead_content);
    } else {
        $response = array('success' => false, 'message' => 'failed', 'error' => mysqli_error($conn));
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>

<?php
// this is to fetch category
if (isset($_POST['orderedProducts'])) {
    $stmt = $conn->prepare("SELECT * FROM `orders` as o
    INNER JOIN `orderdetails` as od ON o.OrderNumber = od.order_number
    INNER JOIN products as p ON od.product_id = p.prodID
    ORDER BY o.OrderDate DESC;");
    if ($stmt) {
        ob_start();
?>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Product</th>
            <th scope="col">User Email</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Payment Done</th>
            <th scope="col">Ordered On</th>
            <th scope="col">Completed On</th>
        </tr>
        <?php
        $thead_content = ob_get_clean();
        $stmt->execute();
        $result = $stmt->get_result();
        $i = 0;
        if (isset($_SESSION['Employee'])) {
            $imgDir = '../arts-admin-panel/images/';
        } else {
            $imgDir = 'images/';
        }
        ob_start();
        while ($cartData = $result->fetch_assoc()) {
        ?>
            <tr>
                <th scope="row">
                    <div class="d-flex align-items-center"><?php echo $cartData['OrderID'] ?></div>
                </th>
                <th scope="row">
                    <div class="d-flex align-items-center">
                        <img src="<?php echo $imgDir . $cartData['prodImg'] ?>" class="img-fluid me-5 " style="width: 80px; height: 80px;" alt="">
                    </div>
                </th>
                <td>
                    <p class="mb-0 mt-4"><?php echo $cartData['userEmail']; ?></p>
                </td>
                <td>
                    <p class="mb-0 mt-4"><?php echo $cartData['description']; ?></p>
                </td>
                <td>
                    <p class="mb-0 mt-4"><?php echo '$' . $cartData['price']; ?></p>
                </td>
                <td>
                    <p class="mb-0 mt-4"><?php echo $cartData['quantity']; ?></p>
                </td>
                <td>
                    <p class="mb-0 mt-4"><?php echo $cartData['payment_done'] == 0 ? 'No' : 'yes'; ?></p>
                </td>
                <td>
                    <p class="mb-0 mt-4"><?php echo $cartData['OrderDate']; ?></p>
                </td>

                <td>
                    <p class="mb-0 mt-4"><?php echo $cartData['completed_on'] ?? 'Not yet'; ?></p>
                </td>
            </tr>
<?php
        }
        $tbody_content = ob_get_clean();
        $response = array('success' => true, 'message' => 'category fetched successful', 'tbody' => $tbody_content, 'thead' => $thead_content);
    } else {
        $response = array('success' => false, 'message' => 'failed', 'error' => mysqli_error($conn));
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>