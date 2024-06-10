
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];

    // Validate form data (basic validation)
    if (empty($name) || empty($email) || empty($date)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare email
    $to = $email;
    $subject = "Booking Confirmation";
    $message = "
    <html>
    <head>
        <title>Booking Confirmation</title>
    </head>
    <body>
        <h1>Booking Confirmation</h1>
        <p>Dear $name,</p>
        <p>Thank you for your booking. Here are your booking details:</p>
        <ul>
            <li><strong>Name:</strong> $name</li>
            <li><strong>Email:</strong> $email</li>
            <li><strong>Booking Date:</strong> $date</li>
        </ul>
        <p>We look forward to seeing you!</p>
    </body>
    </html>
    ";

    // Set content-type for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: no-reply@tastybites.com' . "\r\n";

    // Send email
    $emailSent = mail($to, $subject, $message, $headers);
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Booking Confirmation</title>
    </head>
    <body>
        <h1>Booking Confirmation</h1>
    ";

    if ($emailSent) {
        echo "
        <p>Thank you, $name! Your booking has been confirmed. A confirmation email has been sent to $email.</p>
        <p>Here are your booking details:</p>
        <ul>
            <li><strong>Name:</strong> $name</li>
            <li><strong>Email:</strong> $email</li>
            <li><strong>Booking Date:</strong> $date</li>
        </ul>
        ";
    } else {
        echo "<p>There was an error sending your confirmation email. Please contact support.</p>";
    }

    echo "
    </body>
    </html>
    ";

}
