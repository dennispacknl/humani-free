<?php

require '../artisan.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{

    $connection = ConnectDB();
    
    $m_email = $_POST['m_email'];
    $hashed_password = password_hash($_POST['m_password'], PASSWORD_DEFAULT);

    $whois_ip = getClientIP();
    $whois_country = getCountryFromIP($whois_ip);
    
    try 
    {
        $prepared = new PreparedStatement($connection);
        
        // Check if user email exists in our database
        $email_lookup = "SELECT * FROM t_members WHERE m_email = ?";
        $prepared->Query($email_lookup);
        $prepared->Object("s", [$m_email]);
        $record = $prepared->Statement();
        
        if ($record->num_rows > 0) 
        {
        	echo "<h3>The email address provided is already in use</h3>";
        } 

        else 
        {
            $add_member = "INSERT INTO t_members (member_sid, member_id, member_auth_token, 
                           m_email, m_password,  
                           m_fname, m_lname, 
                           m_phone, m_pfp,
                           m_ip, m_ipc,  
                           m_flags, 
                           m_account_state,
                           created_at, updated_at)

            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // All 12 parameters are of type "s"
            $t_members_atom = str_repeat("s", 15);

            $prepared->Query($add_member);
            $prepared->Object($t_members_atom, [$member_sid, $member_id, $member_auth_token, 
                           $m_email, $hashed_password,  
                           $m_fname, $m_lname, 
                           $m_phone, $m_pfp, 
                           $whois_ip, $whois_country, 
                           $m_flags, 
                           $m_account_state,
                           $created_at, $updated_at]);
            $prepared->Statement();
            
            // echo "<h3>Registration successful.</h3>";
            // echo '<meta http-equiv="refresh" content="0;url=../login/">';
            $signup_success = true;


            $activation_link = 'https://yoursite.com/authguard/onboarding/index.php?token=' . urlencode($member_auth_token);            

            $email = trim($_POST['m_email']);
            $to = filter_var($email, FILTER_VALIDATE_EMAIL);

            $subject = 'Please confirm your email address';
            $fromName = 'Venoura Team';
            $fromEmail = 'no-reply@yoursite.com';

            // Mail with activation link
            $activation_message = "
            <html>
            <head>
                <title>Activate Your Crowdchain Account</title>
            </head>
            <body>
                <p>Thank you for registering at Crowdchain!</p>
                <p>Please click the link below to activate your account:</p>
                <p><a href='" . $activation_link . "'>Activate Account</a></p>
            </body>
            </html>
            ";



            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From:  ' . $fromName . ' <' . $fromEmail .'>' . " \r\n" .'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $activation_message, $headers);
                        
            // echo $post_registration_thank_you;

            echo $ph_check_mail_for_activation;
            exit();

        }
        
    }
    catch (Exception $e) {echo "Error: " . $e->getMessage();}
    
    DisconnectDB($connection);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="https://yoursite.com/auth.css">
    <link rel="icon" href="https://yoursite.com/favicon.png" type="image/x-icon">
</head>
<body>
    <form method="post">
         <a href="#">
            <img src="https://yoursite.com/logotype.png" style="width: 100px; height: auto; display: block; margin: auto;">
        </a>

        <label>&#8203;</label>
        <input type="email" name="m_email" style="font-weight: bold;" placeholder="Enter email address" required><br>
        <label>&#8203;</label>
        <input type="password" name="m_password" style="font-weight: bold;" placeholder="Enter password"  required><br>

        <button type="submit">Signup</button>

        <p style="text-align: center;">
           <a href="../authguard/forgot-password/" style="text-decoration: none; color: black; font-weight: bold;">
               Forgot your password?
           </a>
       </p>

        <p style="text-align: center;">Already have an account? 
            <a href="../login/" style="text-decoration: none; color: black; font-weight: bold;">
                Login
            </a>
        </p>

    </form>
</body>
</html>

