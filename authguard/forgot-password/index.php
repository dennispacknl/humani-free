<?php
// Start session
session_start();

// Database connection
$connection = new mysqli("localhost", "c2589746c_system", "oZkUfA$8%]+^Z;s=", "c2589746c_humani");

if ($connection->connect_error) {
    echo "<h3>Our system encountered an error. Please come back later.</h3>";

}

$email_err = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = trim($_POST["m_email"]);
    
        // Check if email exists in database
        $stmt = $connection->prepare("SELECT id FROM t_members WHERE m_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Generate token
            $token = bin2hex(random_bytes(32));
            $user = $result->fetch_assoc();
            
            // Store token in database
            $update_stmt = $connection->prepare("UPDATE t_members SET member_auth_token = ?, 
                                            updated_at = NOW() 
                                            WHERE m_email = ?");
            $update_stmt->bind_param("ss", $token, $email);
            
            if ($update_stmt->execute()) {
                // Create reset link
                // $reset_link = "https:///authguard/forgot-password/reset.php?token=" . $token;

                $reset_link = "https://yoursite.com/authguard/forgot-password/reset.php?token=" . $token;
                
                // Email headers
                $to = $email;

                $subject = "Password Reset Request";

                $headers = "From: Venoura Support <no-reply@yoursite.com>\r\n";
                $headers .= "Reply-To: no-reply@yoursite.com\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                                            
                // Email message
                $message = "
                <html>
                <head>
                    <title>Password Reset Request</title>
                </head>
                <body>
                    <h2>Password Reset Request</h2>
                    <p>We received a request to reset your password. Click the link below to set a new password:</p>
                    <p><a href='{$reset_link}'>{$reset_link}</a></p>
                    <p>If you didn't request this, you can safely ignore this email.</p>
                    <p>This link will expire in 24 hours.</p>
                </body>
                </html>";
                
                // Send email
                if (mail($to, $subject, $message, $headers)) {
                    $success_message = "If an account exists with this email, you will receive password reset instructions shortly.";
                } else {
                    $email_err = "Error sending email. Please try again later.";
                }
            } else {
                $email_err = "Something went wrong. Please try again later.";
            }
            $update_stmt->close();
        } else {
            // Don't reveal if email exists or not for security
            $success_message = "If an account exists with this email, you will receive password reset instructions shortly.";
        }
        $stmt->close();
}
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Fundraising Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .header {
            /* background: linear-gradient(135deg, #4a1a4a 0%, #6b2d5c 100%);*/
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .logo .monster {
            color: #fff;
        }

        .logo .years {
            font-size: 14px;
            font-weight: normal;
            display: block;
            margin-top: 5px;
            border-top: 2px solid #fff;
            padding-top: 5px;
            letter-spacing: 1px;
        }

        .container {
            max-width: 500px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .form-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
        }

        .form-header {
            text-align: left;
            margin-bottom: 30px;
        }

        .form-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-header p {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background-color: #fafafa;
        }

        input[type="email"]:focus {
            outline: none;
            border-color: #8b5a8c;
            box-shadow: 0 0 0 3px rgba(139, 90, 140, 0.1);
            background-color: #fff;
        }

        .btn-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 30px;
        }

        .back-btn {
            display: flex;
            align-items: center;
            color: #666;
            text-decoration: none;
            font-size: 14px;
            padding: 8px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #f0f0f0;
        }

        .back-btn::before {
            content: "←";
            margin-right: 8px;
            font-size: 16px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #02a95b 0%, #02a95b 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(139, 90, 140, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(166, 255, 178, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .error {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 8px;
            display: block;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .footer-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .footer-link a {
            color: #8b5a8c;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                margin: 40px auto;
                padding: 0 15px;
            }

            .form-container {
                padding: 30px 20px;
            }

            .btn-container {
                flex-direction: column;
                gap: 15px;
            }

            .submit-btn {
                width: 100%;
                order: 1;
            }

            .back-btn {
                order: 2;
                align-self: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <img src="https://yoursite.com/assets/logotech/logotype.png" width="120" height="auto">
        </div>
    </div>


    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h2>Reset Your Password</h2>
                <p>Please provide the email address you use to sign in. If we find an associated account, we will send you instructions to reset your password.</p>
            </div>

            <?php if (!empty($success_message)): ?>
                <div class="success"><?php echo $success_message; ?></div>
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="m_email" required placeholder="Enter email address"
                           value="<?php echo isset($_POST['m_email']) ? htmlspecialchars($_POST['m_email']) : ''; ?>">
                    
                    <?php if (!empty($email_err)): ?>
                        <span class="error"><?php echo $email_err; ?></span>
                    <?php endif; ?>
                </div>

                <div class="btn-container">
                    <a href="https://yoursite.com/login/" class="back-btn">Back</a>
                    <button type="submit" class="submit-btn">Send reset instructions</button>
                </div>
            </form>

            <div class="footer-link">
                <p>Remember your password? <a href="https://yoursite.com/login/">Sign In</a></p>
            </div>
        </div>
    </div>
</body>
</html>