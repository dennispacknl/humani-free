<?php

// ###########################################

// ----------
// MEMBER_SID
// ----------

function generate_member_sid() {
    $random_string = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 8)), 0, 8);
    $random_noise = mt_rand(10000, 99999);
    $sid_output = 'MBR' . '_'. $random_string . $random_noise;
    return $sid_output;
}

// Usage
// $member_sid = generate_member_sid();
// echo $member_sid;

// ###########################################


// ###########################################

// ---------
// MEMBER_ID
// ---------

function generate_member_id() {
    $id_output = '10000' . str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
    return $id_output;
}

// Example usage
// $member_id = generate_member_id();
// echo $member_id;

// ###########################################



// ###########################################

// -----------------
// MEMBER_AUTH_TOKEN
// -----------------

// $member_auth_token = hash('sha256', $member_id.$m_email);

// ###########################################


?>