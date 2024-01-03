<?php
session_start();
require("arts-admin-panel/config.php");
if(isset($_POST['getProducts'])) {
    if(isset($_POST['datatype']) && $_POST['datatype'] !== "All") {
        $category = $_POST['datatype'];
        $fetchProd = $conn->prepare("SELECT * FROM `products` WHERE `prodCode` = '$category' ORDER BY `id` DESC;");
    }else if(isset($_POST['searchkey'])) {
        $searchKey = $_POST['searchkey'];
        $fetchProd = $conn->prepare("SELECT * FROM `products` WHERE `description` LIKE '%$searchKey%' ORDER BY `id` DESC;");

    }else {
        $fetchProd = $conn->prepare("SELECT * FROM `products` ORDER BY `id` DESC;");
    }
    if($fetchProd->execute()) {
        $prodResult = $fetchProd->get_result();
        ob_start();
        while($data = $prodResult->fetch_assoc()) {
?>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img" style="height: 250px; ">
                                        <img src="<?php echo 'arts-admin-panel/images/'. $data['prodImg']?>" class="img-fluid w-100 rounded-top" alt="">
                                    </div>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Stationary</div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                        <h4><?php echo $data['description'];?></h4>
                                        <p><b>Warrenty:</b> <?php echo $data['warranty'];?></p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-0"><b>Price:</b><?php echo '$'.$data['price'];?> </p>
                                            <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart"
                                            data-prodid="<?php echo $data['prodID']?>">
                                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
<?php
}
$body = ob_get_clean();
$response = array('success' => true, 'message' => 'products fetch successfully', 'body' => $body);
}else {
    $response = array('success' => false, 'message' => 'failed to fetch products ', 'error' => mysqli_error($conn));
}
header('Content-Type: application/json');
echo json_encode($response);
}
?>
<?php 
if(isset($_POST['getCartProducts'])) {
    if(isset($_SESSION['user'])) {
        $userEmail = $_SESSION['email'];
        $fetchCart = $conn->prepare("SELECT * FROM `user_cart` as u INNER JOIN `products` as p ON u.productID =
        p.prodID WHERE u.userEmail = '$userEmail' AND u.is_active = 1 AND u.has_ordered = 0;");
        if($fetchCart->execute()) {
            $cartResult = $fetchCart->get_result();
            if($cartResult->num_rows > 0) {
                $total = 0;
        ob_start();
        while($cartData = $cartResult->fetch_assoc()) {
            $total += $cartData['price'] * $cartData['quantity'];
?>
<tr>
    <th scope="row">
        <div class="d-flex align-items-center">
            <img src="<?php echo 'arts-admin-panel/images/'.$cartData['prodImg'] ?>" class="img-fluid me-5 " style="width: 80px; height: 80px;" alt="">
        </div>
    </th>
    <td>
        <p class="mb-0 mt-4"><?php echo $cartData['description']; ?></p>
    </td>
    <td>
        <p class="mb-0 mt-4"><?php echo '$'. $cartData['price']; ?></p>
    </td>
    <td>
        <p class="mb-0 mt-4"><?php echo $cartData['warranty']; ?></p>
    </td>
    <td>
        <div class="input-group quantity mt-4" style="width: 100px;">
            <div class="input-group-btn">
                <button class="btn btn-sm btn-minus rounded-circle bg-light border decrease-quantity"
                data-prodid="<?php echo $cartData['prodID']?>" data-pprice="<?php echo $cartData['price']?>">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
            <input id="cart-quantity" type="text" class="form-control form-control-sm text-center border-0" value="<?php echo $cartData['quantity']?>">
            <div class="input-group-btn">
                <button class="btn btn-sm btn-plus rounded-circle bg-light border increase-quantity"
                data-prodid="<?php echo $cartData['prodID']?>">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </td>
    <td>
        <p class="mb-0 mt-4 total-price">
            <?php echo '$'. $cartData['price'] * $cartData['quantity']; ?>
        </p>
    </td>
    <td>
        <button class="btn btn-md rounded-circle bg-light border mt-4 deleteCart"
        data-prodid="<?php echo $cartData['prodID']?>" >
            <i class="fa fa-times text-danger"></i>
        </button>
    </td>
</tr>
<?php
}
$body = ob_get_clean();
$response = array('success' => true, 'message' => 'products fetch successfully', 'body' => $body, 'total' => '$'.$total);           
}else {
$response = array('success' => false, 'message' => 'there is no product in the cart please add product first', 'noproduct' => true);           
}
}else {
    $response = array('success' => false, 'message' => 'failed to fetch products ', 'error' => mysqli_error($conn));
}               

header('Content-Type: application/json');
echo json_encode($response);
}
}

?>

<?php 
if(isset($_POST['checkOutProducts'])) {
    if(isset($_SESSION['user'])) {
        $userEmail = $_SESSION['email'];
        $fetchCart = $conn->prepare("SELECT * FROM `user_cart` as u INNER JOIN `products` as p ON u.productID =
        p.prodID WHERE u.userEmail = '$userEmail' AND u.is_active = 1 AND u.has_ordered = 0;");
        if($fetchCart->execute()) {
            $cartResult = $fetchCart->get_result();
            if($cartResult->num_rows > 0) {
                $total = 0;
        ob_start();
        while($cartData = $cartResult->fetch_assoc()) {
            $total += $cartData['price'] * $cartData['quantity'];
?>
<tr>
    <th scope="row">
        <div class="d-flex align-items-center">
            <img src="<?php echo 'arts-admin-panel/images/'.$cartData['prodImg'] ?>" class="img-fluid me-5 " style="width: 80px; height: 80px;" alt="">
        </div>
    </th>
    <td>
        <p class="mb-0 mt-4"><?php echo $cartData['description']; ?></p>
    </td>
    <td>
        <p class="mb-0 mt-4"><?php echo '$'. $cartData['price']; ?></p>
    </td>
    <td>
        <p class="mb-0 mt-4"><?php echo $cartData['quantity']; ?></p>
    </td>
    <td>
        <p class="mb-0 mt-4"><?php echo $cartData['warranty']; ?></p>
    </td>
    <td>
        <p class="mb-0 mt-4"><?php echo '$'. $cartData['price'] * $cartData['quantity']; ?></p>
    </td>
</tr>
<?php
}
?>
<tr>
    <th scope="row">
    </th>
    <td class="py-5">
        <p class="mb-0 text-dark text-uppercase py-3">SubTotal</p>
    </td>
    <td class="py-5"></td>
    <td class="py-5"></td>
    <td class="py-5">
        <div class="py-3 border-bottom border-top">
            
            <p id="totalAmount" class="mb-0 text-dark"><?php echo '$' . $total ;?></p>
        </div>
    </td>
</tr>
<?php
$body = ob_get_clean();
$response = array('success' => true, 'message' => 'products fetch successfully', 'body' => $body, 'total' => '$'.$total);           
}else {
$response = array('success' => false, 'message' => 'there is no product in the cart please add product first', 'noproduct' => true);           
}
}else {
    $response = array('success' => false, 'message' => 'failed to fetch products ', 'error' => mysqli_error($conn));
}               

header('Content-Type: application/json');
echo json_encode($response);
}
}

?>

<?php 
if(isset($_POST['getOrderedProducts'])) {
    if(isset($_SESSION['user'])) {
        $userEmail = $_SESSION['email'];
        $fetchCart = $conn->prepare("SELECT * FROM `orders` as o
        INNER JOIN `orderdetails` as od ON o.OrderNumber = od.order_number
        INNER JOIN products as p ON od.product_id = p.prodID
        WHERE o.userEmail = '$userEmail' AND o.has_completed = 0 ORDER BY o.OrderDate DESC;");
        if($fetchCart->execute()) {
            $cartResult = $fetchCart->get_result();
            if($cartResult->num_rows > 0) {
                $total = 0;
                $currentOrderID  = null;
        ob_start();
        while($cartData = $cartResult->fetch_assoc()) {
            $total += $cartData['price'] * $cartData['quantity'];
?>
<tr>
    <th scope="row">
        <div class="d-flex align-items-center">
            <p><?php echo $cartData['OrderID']; ?></p>

        </div>
        <?php if($cartData['OrderID'] !== $currentOrderID) {
            $disablebtn = $cartData['has_cancel'] != 0? 'disabled':'' ?>
        <div>
                <button data-orderid="<?php echo $cartData['OrderID'];?>"
                data-orderstatus="<?php echo $cartData['has_dispatched'];?>"
                class="btn btn-danger docancel <?php echo $disablebtn?>"><?php echo $cartData['has_cancel'] != 0? 'Canceled':'Cancel' ?></button>
        </div>
        <?php }
        
        ?>
    </th>
    <th scope="row">
        <div class="d-flex align-items-center">
            <img src="<?php echo 'arts-admin-panel/images/'.$cartData['prodImg'] ?>" class="img-fluid me-5 " style="width: 80px; height: 80px;" alt="">
        </div>
    </th>
    <td>
        <p class="mb-0 mt-4"><?php echo $cartData['description']; ?></p>
    </td>
    <td>
        <p class="mb-0 mt-4"><?php echo '$'. $cartData['price']; ?></p>
    </td>
    <td>
        <p class="mb-0 mt-4"><?php echo $cartData['warranty']; ?></p>
    </td>
    <td>

            <input id="cart-quantity" type="text" class="form-control form-control-sm text-center border-0" value="<?php echo $cartData['quantity']?>">

    </td>
    <td>
        <p class="mb-0 mt-4 total-price">
            <?php echo '$'. $cartData['price'] * $cartData['quantity']; ?>
        </p>
    </td>
    <td>
    <p class="mb-0 mt-4 total-price">
            <?php echo  $cartData['payment_done'] == 0? 'Pending': 'Completed'; ?>
        </p>
        <?php if($cartData['OrderID'] !== $currentOrderID) {
            if($cartData['payment_done'] !== 1) {?>
        <div>
                <button data-orderid="<?php echo $cartData['OrderID'];?>"
                class="btn btn-danger <?php echo $disablebtn;?> doPayment">Payment</button>
        </div>
        <?php } }
        $currentOrderID = $cartData['OrderID'];
        ?>
    </td>
    <td>
    <p class="mb-0 mt-4 total-price">
            <?php echo  $cartData['has_dispatched'] == 0? 'Not Yet': 'Yes'; ?>

        </p>
    </td>
    <td>
    <p class="mb-0 mt-4 total-price">
            <?php echo  $cartData['OrderDate'] ; ?>
        </p>
    </td>
</tr>
<?php
}
$body = ob_get_clean();
$response = array('success' => true, 'message' => 'products fetch successfully', 'body' => $body, 'total' => '$'.$total);           
}else {
$response = array('success' => false, 'message' => 'You have not ordered any thing yet ', 'noproduct' => true);           
}
}else {
    $response = array('success' => false, 'message' => 'failed to fetch products ', 'error' => mysqli_error($conn));
}               

header('Content-Type: application/json');
echo json_encode($response);
}
}

?>