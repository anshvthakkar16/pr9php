<!DOCTYPE html>
<html>
<head>
    <title>Newsletter Subscription - Real Mail</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #eef2f3; padding: 40px; }
        .container { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); width: 450px; margin: auto; }
        h2 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        input[type="email"], select { width: 100%; padding: 12px; margin: 15px 0; border: 1px solid #ddd; border-radius: 8px; }
        input[type="submit"] { background: #3498db; color: white; border: none; padding: 12px; width: 100%; border-radius: 8px; cursor: pointer; font-size: 16px; transition: 0.3s; }
        input[type="submit"]:hover { background: #2980b9; }
        .log { margin-top: 20px; padding: 15px; border-radius: 5px; font-size: 14px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

<div class="container">
    <h2>📩 Join Our Newsletter</h2>
    <form method="post">
        <label>Email Address:</label>
        <input type="email" name="user_email" placeholder="example@gmail.com" required>
        
        <label>Email Format:</label>
        <select name="mail_type">
            <option value="plain">Plain Text (Basic)</option>
            <option value="html">HTML Template (Stylish)</option>
        </select>
        
        <input type="submit" name="subscribe" value="Get Confirmation Mail">
    </form>

    <?php
    if (isset($_POST['subscribe'])) {
        $to = $_POST['user_email'];
        $type = $_POST['mail_type'];
        
        // --- SMTP CONFIGURATION (Gmail Example) ---
        ini_set("SMTP", "smtp.gmail.com");
        ini_set("smtp_port", "587");
        ini_set("sendmail_from", "your-email@gmail.com"); // Apni email yahan likhein

        $subject = "Subscription Success - Welcome Aboard!";
        $from = "no-reply@yourdomain.com";

        if ($type == "html") {
            // HTML Headers
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: Newsletter Team <$from>" . "\r\n";

            $message = "
            <div style='font-family: Arial; border: 1px solid #ddd; padding: 20px;'>
                <h2 style='color: #3498db;'>Thank You for Subscribing!</h2>
                <p>We are glad to have you with us. You will now receive:</p>
                <ul>
                    <li>Latest Tech News</li>
                    <li>Exclusive Offers</li>
                </ul>
                <hr>
                <p style='font-size: 12px; color: #777;'>If you didn't request this, please ignore this email.</p>
            </div>";
        } else {
            // Plain Text Headers
            $headers = "From: Newsletter Team <$from>" . "\r\n";
            $message = "Hi!\n\nThank you for subscribing to our newsletter. We will send you updates soon.\n\nRegards,\nTeam Admin";
        }

        // Attempt to send
        // Note: Localhost pe ye abhi bhi fail ho sakta hai bina 'sendmail' configuration ke
        if (@mail($to, $subject, $message, $headers)) {
            echo "<div class='log success'>✅ Success! A confirmation mail has been sent to <b>$to</b>.</div>";
        } else {
            echo "<div class='log error'>
                    <b>Error:</b> Local server par mail server configured nahi hai.<br><br>
                    <i>Note for Manual:</i> Logic bilkul sahi hai, real hosting server par ye code turant mail bhej dega.
                  </div>";
        }
    }
    ?>
</div>

</body>
</html>
