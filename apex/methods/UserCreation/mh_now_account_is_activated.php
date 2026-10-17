<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmed - Humani</title>
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

        .check-icon {
            width: 120px;
            height: 120px;
            margin-bottom: 40px;
            background: linear-gradient(135deg, #37d396 0%, #4ff486 100%);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #2d2d2d;
        }

        .subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 40px;
        }

        .continue-button {
            background-color: #37d396;
            border: none;
            border-radius: 100px;
            padding: 15px 30px;
            font-size: 16px;
            cursor: pointer;
            color: white;
            width: 100%;
            max-width: 500px;
            transition: background-color 0.2s;
        }

        .continue-button:hover {
            background-color: #2fb982;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="site-logo">
            <img src="https://apexherd.com/assets/logotech/logo.png" width="80">
        </div>
        <span class="close-button" onclick="window.location.href='yoursite.com/login/';">×</span>
    </header>
    <main class="main-content">
        <div class="check-icon">
            <svg viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
            </svg>
        </div>

        <h1>EMAIL CONFIRMED</h1>
        <p class="subtitle">Welcome to Crowdchain. You're all set to log in.</p>

        <button class="continue-button" onclick="location.href='https://apexherd.com/login/'">
            Continue
        </button>
    </main>
</body>
</html>
