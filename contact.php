<?php
session_start();

$message = '';
$formData = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $companyName = $_POST['company_name'];
    $contactName = $_POST['contact_name'];
    $email = $_POST['email'];
    $services = isset($_POST['services']) ? $_POST['services'] : [];
    $subject = $_POST['subject'];
    $userMessage = $_POST['message'];
    
    $data = "Company: $companyName\n";
    $data .= "Contact Person: $contactName\n";
    $data .= "Email: $email\n";
    $data .= "Services: " . implode(", ", $services) . "\n";
    $data .= "Subject: $subject\n";
    $data .= "Message: $userMessage\n\n";
    
    $file = 'form_submissions.txt';
    $fileSuccess = file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

    // Prepare email
    $to = "email@suryateja.pro"; // Replace with your email address
    $emailSubject = "Enquiry: $subject";
    $emailMessage = "You have received a new contact form submission:\n\n";
    $emailMessage .= $data;
    $headers = "From: noreply@suryateja.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Attempt to send email
    $mailSuccess = mail($to, $emailSubject, $emailMessage, $headers);
    
    if ($fileSuccess && $mailSuccess) {
        $_SESSION['message'] = "Thank you! Your message has been received and we will get back to you soon.";
    } elseif ($fileSuccess) {
        $_SESSION['message'] = "Your message has been received, but there was an issue sending the confirmation email. We'll still be in touch soon.";
    } else {
        $_SESSION['message'] = "Oops! There was an error processing your message. Please try again later.";
    }

    // Redirect to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Check for message in session
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Clear the message after displaying
}

include 'header.php';
?>

<main>
    <section id="contact" class="contact-section">
        <div class="container">
            <h1>Contact Me</h1>
            <?php if ($message): ?>
                <p class="form-message"><?php echo $message; ?></p>
            <?php endif; ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="contact-form">
                <div class="form-group">
                    <label for="company_name">Company Name:</label>
                    <input type="text" id="company_name" name="company_name" required>
                </div>
                <div class="form-group">
                    <label for="contact_name">Contact Person:</label>
                    <input type="text" id="contact_name" name="contact_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Services Interested In:</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="services[]" value="Digital Marketing"> Digital Marketing</label>
                        <label><input type="checkbox" name="services[]" value="CRM Consulting"> CRM Consulting</label>
                        <label><input type="checkbox" name="services[]" value="Sales Solutions"> Sales Solutions</label>
                        <label><input type="checkbox" name="services[]" value="Website Development"> Website Development</label>
                        <label><input type="checkbox" name="services[]" value="Other"> Other</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </section>
</main>

<script src="script.js"></script>
</body>
</html>

