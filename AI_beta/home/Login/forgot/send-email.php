<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "../../../../AI_beta/vendor/autoload.php"; // Adjust the path as needed if you're not using Composer

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "login");

// Check connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Check if email exists in database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Generate random 6-digit code
        $code = rand(100000, 999999);

        // Update password_reset_code in database
        $update_query = "UPDATE users SET password_reset_code = '$code' WHERE email = '$email'";
        mysqli_query($conn, $update_query);

        // Send email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'smtpserver133@gmail.com';                 // SMTP username
            $mail->Password   = 'xwab nztf utfd ggtq';                 // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption
            $mail->Port       = 587;                                    // TCP port to connect to

            // Recipients
            $mail->setFrom('smtpserver133@gmail.com', 'AI-Music');
            $mail->addAddress($email);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Password Reset Code';
            $mail->Body    = 'Your password reset code is: '. $code;

            $mail->send();
            echo 'Password reset code sent to your email.';
        } catch (Exception $e) {
            echo 'Failed to send password reset code.';
        }
    } else {
        echo 'Email not found in database.';
    }
}

mysqli_close($conn);
?>

