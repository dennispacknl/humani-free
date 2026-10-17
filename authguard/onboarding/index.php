<?php

include('./thread.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database
    $query = "SELECT 1 FROM t_members WHERE member_auth_token = ?";
    if ($stmt = $connect->prepare($query)) {
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Token is valid, activate the account
            $update_query = "UPDATE t_members SET m_account_state = 'active' WHERE member_auth_token = ?";
            if ($update_stmt = $connect->prepare($update_query)) {
                $update_stmt->bind_param("s", $token);
                if ($update_stmt->execute()) {
                    
                    // echo "Your account has been activated successfully!";

                    // Successful activation


                    // =============== Curl Method : Thank_You_Page ===============


                    function getContent($url) {
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                        $content = curl_exec($ch);
                        
                        if(curl_errno($ch)) {
                            // Handle error
                            return 'Error: ' . curl_error($ch);
                        }
                        
                        curl_close($ch);
                        return $content;
                    }

                    $content = getContent('https://yoursite.com/apex/methods/UserCreation/mh_now_account_is_activated.php');
                    echo $content;
                    exit();

                    // =============== Curl Method : Thank_You_Page ===============


                    // header("Location: ../login.php");
                    // exit();

                } else {
                    echo "Error #1092. Error activating your account. Please try again.";
                }
            } 
        } else {
            // Invalid token
            echo "Invalid activation link.";
        }
        $stmt->close();
    }
} else {
    echo "Error #1075. Internal system error. Please contact support.";
}

$connect->close();
?>