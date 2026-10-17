<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thank You</title>
    <meta http-equiv="refresh" content="3;url=login.html" />
    <link rel="stylesheet" href="styles.css" />
    <style>
        .thank-you-wrapper {
            min-height: calc(100vh - 160px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .thank-you-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            max-width: 700px;
            width: 100%;
            padding: 50px 30px;
            text-align: center;
        }

        .thank-you-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background-color: #e8f8ef;
            color: #02a95c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: bold;
        }

        .thank-you-card h1 {
            font-size: 36px;
            margin-bottom: 16px;
            color: #333;
        }

        .thank-you-card p {
            font-size: 18px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .redirect-note {
            font-size: 14px;
            color: #999;
            margin-bottom: 24px;
        }
    </style>
</head>
<body>
    <main class="thank-you-wrapper">
        <div class="thank-you-card">
            <div class="thank-you-icon">✓</div>
            <h1>Thank You</h1>
            <p>Thanks for having registered, you are now being redirected to login.</p>
            <div class="redirect-note">Redirecting in 3 seconds...</div>
            <a href="login.html" class="start-button">Go to Login Now</a>
        </div>
    </main>
</body>
</html>
