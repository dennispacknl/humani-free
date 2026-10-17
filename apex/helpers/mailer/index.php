<?php

    echo "Mailman is testing your server's mailing system<br><br><br>";

    $to = "bob@marley.com";
    $subject = "Hello World";
    $message = "Hello word is a sample mail";

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: Mailman<stevejobs@appletech.com>' . "\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "Mail sent";
    } else {
        echo "Error sending email.";
    }
?>
