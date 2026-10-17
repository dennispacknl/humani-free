<?php
session_start();

// Database connection
$connection = new mysqli("localhost", "c2589746c_system", "oZkUfA$8%]+^Z;s=", "c2589746c_humani");

if ($connection->connect_error) {
    die("<h3>Our system encountered an error. Please come back later.</h3>");
}

$token = isset($_GET['token']) ? $_GET['token'] : '';
$error_message = '';
$success_message = '';

// First verify if token exists and is valid
if (empty($token)) {
    // die("<h3>No reset token provided.</h3>");
    die("<h3>Our system encountered an error. Please come back later.</h3>");
}

// Check if token exists in database and is not expired (24 hours)
$stmt = $connection->prepare("SELECT id FROM t_members WHERE member_auth_token = ? AND updated_at > NOW() - INTERVAL 24 HOUR");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {  
    $stmt->close();
    $connection->close();
    // die("<h3>Invalid or expired reset token. Please request a new password reset.</h3>");
    die("<h3>Invalid or expired activation link. Please request a new password reset.</h3>");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    
    // Validate password
    if (empty($password)) {
        $error_message = "Please enter a password.";
    } elseif (strlen($password) < 6) {
        $error_message = "Password must have at least 6 characters.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Hash the new password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Update password and remove reset token
        $update_stmt = $connection->prepare("UPDATE t_members SET m_password = ?, member_auth_token = NULL, updated_at = NOW() WHERE member_auth_token = ?");
        $update_stmt->bind_param("ss", $hashed_password, $token);
        
        if ($update_stmt->execute()) {
            if ($update_stmt->affected_rows > 0) {
                $success_message = "Password has been reset successfully. You can now login with your new password.";
                // Redirect to login page after 3 seconds
                header("refresh:3;url=../../login/");
            } else {
                // $error_message = "No account found with this reset token.";
                $error_message = "Our system encountered an error. Please come back later.";
            }
        } else {
            $error_message = "Error updating password. Please try again.";
        }
        $update_stmt->close();
    }
}

$stmt->close();
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Set New Password - Fundraising Platform</title>
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

        input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background-color: #fafafa;
        }

        input[type="password"]:focus {
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
                <h2>Set New Password</h2>
                <p>Please enter and confirm your new password</p>
            </div>
       

        <?php if (!empty($error_message)): ?>
            <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <?php if (!empty($success_message)): ?>
            <div class="success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php else: ?>

            <form action="" method="POST" id="resetPasswordForm">
                <div class="form-group">

                    <label for="password">New Password</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required 
                           minlength="6"
                           placeholder="Enter new password">

                    <label for="confirm_password">Confirm Password
                    </label>

                    <input type="password" 
                           id="confirm_password" 
                           name="confirm_password" 
                           required 
                           minlength="6"
                           placeholder="Confirm new password">
                    <span id="confirmPasswordError" class="error" style="display: none;">
                    </span>

                </div>

                <div class="btn-container">
                    <a href="https://yoursite.com/login/" class="back-btn">Back</a>
                    <button type="submit" name="submit" class="submit-btn">Reset Password</button>
                </div>                
            </form>
        <?php endif; ?>


        <div class="footer-link">
            <p>Remember your password? <a href="../../login/">Sign In</a></p>
        </div>
        </div>
    </div>

    <script>
        document.getElementById('resetPasswordForm')?.addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const errorElement = document.getElementById('confirmPasswordError');
            
            if (password !== confirmPassword) {
                e.preventDefault();
                errorElement.textContent = 'Passwords do not match';
                errorElement.style.display = 'block';
            } else {
                errorElement.style.display = 'none';
            }
        });
    </script>
</body>
</html>