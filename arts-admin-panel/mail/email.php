<?php
session_start();
require('../config.php');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST['forgetPass'])) {
    $email = filter_var($_POST['forgetEmail'], FILTER_SANITIZE_EMAIL);
    $checkEmail = $conn->prepare("SELECT * FROM `arts_users` WHERE `email` = '$email'");
    if ($checkEmail->execute()) {
        $checkEmail->store_result();
        if ($checkEmail->num_rows > 0) {


            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'salassadiq187@gmail.com';                     //SMTP username
                $mail->Password   = 'krrp haoo fhom ltee';                               //SMTP password
                $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('salassadiq187@gmail.com', 'Art Stationary');
                $mail->addAddress($email);     //Add a recipient

                // Generate a secure token
                $token = bin2hex(random_bytes(32)); // Adjust the length as needed

                // Save the token and expiration time in the database
                $tokenExpiry = time() + 3600; // Set expiration time to 1 hour
                // Save $token and $expirationTime in your database table for password resets

                // Include the token in the password reset link
                $resetLink = "http://localhost/arts-stationary-shop/reset-password.php?token=$token";

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Forget Password request';
                // Set the email body
                $mail->Body = $mail->Body = <<<EOT
                <html>
                <head>
                <style>
                body {
                    font-family: 'Arial', sans-serif;
                    font-size: 16px;
                    color: #333;
                    background-color: #f5f5f5;
                    margin: 0;
                    padding: 0;
                }
        
                .container {
                    width: 80%;
                    max-width: 600px;
                    margin: 0 auto;
                    text-align: center;
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    padding: 20px;
                    margin-top: 50px;
                }
        
                h2 {
                    color: #007bff;
                }
        
                p {
                    margin-bottom: 20px;
                }
        
                .button {
                    background-color: #007bff;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                }
        
                .button:hover {
                    background-color: #0056b3;
                }
                </style>
                </head>
                <body>
                <div class="container">
                    <h2>Forgot Password?</h2>
                    <p>No worries, we can help you reset it.</p>
                    <a href="$resetLink" class="button" style="color: white;">Reset Password</a>
                </div>
                </body>
                </html>
                EOT;
                
                //Attachments
                if ($mail->send()) {
                    $forgEmailcheck = $conn->prepare("SELECT * FROM `forgetpass_requests` WHERE `userEmail` = '$email'");
                    if ($forgEmailcheck->execute()) {
                        $forgEmailcheck->store_result();
                        if ($forgEmailcheck->num_rows < 1) {
                            $inserToken = $conn->prepare("INSERT INTO `forgetpass_requests` (userEmail, forgetpassToken, tokenExpiry)
                             VALUES ('$email', '$token', '$tokenExpiry')");
                             if($inserToken->execute()) {
                                echo "<script>alert ('forget password request has been send to your email')
                                window.location.href='../../index.php'
                                </script>";
                             }
                        }else {
                            $inserToken = $conn->prepare("UPDATE `forgetpass_requests` SET userEmail = '$email',
                            forgetpassToken = '$token', tokenExpiry = '$tokenExpiry', has_used = 0 WHERE userEmail = '$email'");
                            if($inserToken->execute()) {
                               echo "<script>alert ('forget password request has been send to your email')
                               window.location.href='../../index.php'
                               </script>";
                            }
                        }
                        
                    }
                }
                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                echo json_encode(['error' => "Email could not be sent. Error: {$mail->ErrorInfo}"]);
            }
        }else {
            echo "<script>
             alert ('please enter the email that is associated with arts the stationary shop')
             window.location.href='../../forgotpassword.php'</script>";
        }
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
    echo "<script>
    window.location.href='../../index.php'</script>";
}
?>