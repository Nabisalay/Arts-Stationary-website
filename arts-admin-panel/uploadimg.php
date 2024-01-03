<?php

if(isset($_FILES['selectedImg'])) {
    // Handle the uploaded file
    $uploadedFile = $_FILES['selectedImg'];

    // Process the file as needed

    echo 'File received successfully.';
} else {
    echo 'No file received.';
}
?>