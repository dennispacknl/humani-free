<?php

require 'artisan.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Humani - Raise Money for What Matters</title>
    <link rel="stylesheet" type="text/css" href="https://humani.free.nf/main.css">
    <link rel="icon" type="image/png" href="https://humani.free.nf/favicon.png">
</head>
<body>
    <!-- Navigation Bar -->
    <div class="navbar">
        <div class="nav-left">
            <a href="#" class="nav-item">Donate</a>
            <a href="#" class="nav-item">Fundraise</a>
        </div>
        
        <img src="https://humani.free.nf/logotype.png" style="width: 120px; height: auto;" />
        
        <div class="nav-right">
            <a href="#" class="nav-item">About</a>
            <a href="./login/" class="nav-item">Sign in</a>
            <a href="./start-campaign.php" class="cta-button">Start a Campaign</a>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Fundraising for the people and causes you care about</h1>
        <p>Get help. Give kindness. Start in just 5 minutes.</p>
        <a href="#" class="start-button">Start a Campaign</a>
    </div>

    <!-- Featured Campaigns -->
    <div class="campaigns">
        <h2 class="section-title">Featured Fundraisers</h2>
        <div class="campaign-grid">
            <!-- Campaign 1 -->
            <div class="campaign-card">
                <img src="./assets/tmp/th_cmp_01.png" alt="Medical Expenses Fundraiser" class="campaign-image">
                <div class="campaign-content">
                    <h3 class="campaign-title">Help Sarah Beat Cancer</h3>
                    <p class="campaign-description">Support Sarah's journey through cancer treatment and recovery. Every donation makes a difference.</p>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%"></div>
                    </div>
                    <div class="campaign-stats">
                        <div class="amount">$37,500 raised</div>
                        <div class="goal">of $50,000 goal</div>
                    </div>
                </div>
            </div>
            
            <!-- Campaign 2 -->
            <div class="campaign-card">
                <img src="./assets/tmp/th_cmp_02.png" alt="Community Project Fundraiser" class="campaign-image">
                <div class="campaign-content">
                    <h3 class="campaign-title">Rebuild Uganda Community School</h3>
                    <p class="campaign-description">Help us rebuild our community center that was damaged in last month's storm.</p>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 45%"></div>
                    </div>
                    <div class="campaign-stats">
                        <div class="amount">$22,500 raised</div>
                        <div class="goal">of $50,000 goal</div>
                    </div>
                </div>
            </div>
            
            <!-- Campaign 3 -->
            <div class="campaign-card">
                <img src="./assets/tmp/th_cmp_03.png" alt="Education Fundraiser" class="campaign-image">
                <div class="campaign-content">
                    <h3 class="campaign-title">School Supplies for Underserved Youth</h3>
                    <p class="campaign-description">Help provide essential school supplies to children in need for the upcoming school year.</p>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 90%"></div>
                    </div>
                    <div class="campaign-stats">
                        <div class="amount">$9,000 raised</div>
                        <div class="goal">of $10,000 goal</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-links">
            <a href="#" class="footer-link">How it works</a>
            <a href="#" class="footer-link">Why Humani</a>
            <a href="#" class="footer-link">Common questions</a>
            <a href="#" class="footer-link">Success stories</a>
            <a href="#" class="footer-link">Support</a>
        </div>
        <div class="copyright">© 2026 The Humani Team</div>
    </div>
</body>
</html>
