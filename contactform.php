<?php
require("arts-admin-panel/config.php");

if(isset($_POST['contactForm'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO `contactTable` (`personName`, `personEmail`, `personMessage`) VALUES (?, ?, ?);");
    if($stmt) {
        $stmt->bind_param('sss', $name, $email, $message);
        if($stmt->execute()) {
            $response = ['success' => true];
        }else {
            $response = ['success' => false];
        }
    }else {
        $response = ['success' => false, 'message' => 'couldn\'t prepare the statement'];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>