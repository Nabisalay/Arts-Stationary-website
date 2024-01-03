<?php
session_start();
if(isset($_POST['logoutUser'])) {
    session_unset();
    session_destroy();
    $response = array('success' => true, 'message' => "Your account has been logout successfully");
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>