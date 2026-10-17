<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="3;url=https://venouragroupconsulting.com/">
    <title>Check your email - Humani</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            background-color: white;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .logo {
            height: 32px;
        }

        .close-button {
            cursor: pointer;
            font-size: 24px;
            color: #666;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex: 1;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .email-icon {
            width: 120px;
            height: 120px;
            margin-bottom: 40px;
            background-color: rgb(0, 191, 118);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .email-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #2d2d2d;
        }

        .message-box {
            background-color: #f2f5f7;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            max-width: 500px;
            width: 100%;
        }

        .alert-icon {
            background-color: #ffd600;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .message-text {
            text-align: left;
            color: #2d2d2d;
            line-height: 1.5;
        }

        .resend-button {
            background-color: white;
            border: 1px solid #e6e6e6;
            border-radius: 8px;
            padding: 15px 30px;
            font-size: 16px;
            cursor: pointer;
            color: #666;
            width: 100%;
            max-width: 500px;
            transition: background-color 0.2s;
        }

        .resend-button:hover {
            background-color: #f5f5f5;
        }

        .navigation {
            display: flex;
            gap: 20px;
            padding: 10px;
            background-color: #f8f8f8;
            overflow-x: auto;
            white-space: nowrap;
        }

        .nav-item {
            color: #666;
            text-decoration: none;
            padding: 5px 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="site-logo">
            <img src="https://humani.free.nf/logotype.png" width="80">
        </div>
        <span class="close-button" onclick="window.location.href='https://venouragroupconsulting.com/';">×</span>
    </header>

    <main class="main-content">
        <div class="email-icon">
            <svg viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z"/>
            </svg>
        </div>

        <h1>CHECK YOUR EMAIL</h1>

        <div class="message-box">
            <div class="alert-icon">!</div>
            <div class="message-text">
                We’ve sent an activation link to your email address.
                <br>
                The email will arrive shortly.
            </div>
        </div>

        <!--

        <button class="resend-button">
            Resend email 0:56
        </button>
        
        -->

    </main>
</body>
</html>
