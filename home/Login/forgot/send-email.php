<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "../../../vendor/autoload.php"; // Adjust the path as needed if you're not using Composer

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
            $mail->Username   = 'abc@example.com';                 // SMTP username
            $mail->Password   = 'passkey';                 // SMTP password
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
            echo '<script>alert("Password reset code sent to your email."); window.location.href = "send-email.php";</script>';
        } catch (Exception $e) {
            echo '<script>alert("Failed to send password reset code.")</script>';
        }
    } else {
        echo '<script>alert("Email not found in database."); window.location.href = "forgot.php";</script>';
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>BeatsBuddy</title>
    
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.0.2/tailwind.min.css"
    />
    <link rel="stylesheet" href="send-email.css" />
  </head>
  <body>
    <ul class="background">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>

    <div id="content">
      <div class="main_container">
        <form id="loginForm" method="post" action="send-email.php">
          <h1>Verify OTP</h1>
          <div class="form-group">
            <label for="email">Enter OTP Sent to your mail</label>
            <input type="number" id="number" name="number" required placeholder="123456" autocomplete="off" autofocus />
            <!-- <label for="password">Password</label>
            <input type="password" id="password" required placeholder="Password" autocomplete="off" /> -->
            <button type="submit" class="submitbtn">SUBMIT</button>
          </div>
        </form>
        <p id="loginMessage"></p>
      </div>
    </div>
    <script src="forgot.js"></script>
  </body>
</html>