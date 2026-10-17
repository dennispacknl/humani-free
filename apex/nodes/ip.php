<?php

// Function to get client IP address
function getClientIP() {
    $ip = '';

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

// Function to get country from IP using geoiplookup.io API
function getCountryFromIP($ip) {
    $url = 'https://json.geoiplookup.io/' . $ip;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response) {
        $data = json_decode($response, true);
        return isset($data['country_name']) ? $data['country_name'] : 'Unknown';
    }

    return 'Unknown';
}


// Usage

