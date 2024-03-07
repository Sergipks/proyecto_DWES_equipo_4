<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    if (isset($firstName) && isset($lastName) && isset($email) && filter_var($email, FILTER_SANITIZE_EMAIL) && 
            filter_var($email, FILTER_VALIDATE_EMAIL) && isset($subject) && isset($message)) {
        
        header("location: ../views/contact.php?correcto=true");
        exit();
    }
    
    header("location: ../views/contact.php?correcto=false");
    exit();
}
header("location: ../index.php");
exit();
?>