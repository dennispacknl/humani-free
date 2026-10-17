<?php
session_start();

require '../artisan.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $connection = ConnectDB();
    
    $m_email = $_POST['m_email'];
    $m_password = $_POST['m_password'];
    
    try 
    {   
        $prepared = new PreparedStatement($connection);
                
        // Check if the user exists and is active
        $verify_member_crendentials = "SELECT m_password, m_account_state FROM t_members WHERE m_email = ?";
        $prepared->Query($verify_member_crendentials);
        $prepared->Object("s", [$m_email]);
        $record = $prepared->Statement();
                
        if ($record->num_rows > 0) 
        {
            $row = $record->fetch_assoc();
            if (password_verify($m_password, $row['m_password']))
            {
                if ($row['m_account_state'] == 'active')
                {
                    echo "<h3>Login successful.</h3>";
                    // You can start the session or set cookies here
                }
                else
                {
                    echo "<h3>Your account is not active. Please contact support.</h3>";
                }
            } 
            else 
            {
                echo "<h3>Incorrect password. Please try again.</h3>";
            }
        } 
        else 
        {
            echo "<h3>No user found with that email address. Please try again.</h3>";
        }       
    }
    catch (Exception $e) 
    {
        echo "Error: " . $e->getMessage();
    }
    
    DisconnectDB($connection);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="https://humani.free.nf/auth.css">
    <link rel="icon" href="https://humani.free.nf/favicon.png" type="image/x-icon">
</head>
<body>
    <form method="post">
        <a href="#">
            <img src="https://humani.free.nf/logotype.png" style="width: 100px; height: auto; display: block; margin: auto;">
        </a>

        <label>&#8203;</label>
        <input type="email" name="m_email" style="font-weight: bold;" placeholder="Enter email address" required><br>
        <label>&#8203;</label>
        <input type="password" name="m_password" style="font-weight: bold;" placeholder="Enter password"  required><br>
        
        <button type="submit">Login</button>

        <p style="text-align: center;">
           <a href="../authguard/forgot-password/" style="text-decoration: none; color: black; font-weight: bold;">
               Forgot your password?
           </a>
        </p>

        <p style="text-align: center;">New to Humani? 
            <a href="../signup/" style="text-decoration: none; color: black; font-weight: bold;">
                Create an account
            </a>
        </p>


    </form>
</body>
</html>