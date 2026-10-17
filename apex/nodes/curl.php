<?php

class Curl {
    public function Open($url) {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $content = curl_exec($ch);
        
        if(curl_errno($ch)) {
            return 'Error: ' . curl_error($ch);
        }
        
        curl_close($ch);
        return $content;
    }
}

$curl = new Curl();

$ph_check_mail_for_activation = $curl->Open('https://yoursite.com/apex/methods/UserCreation/mh_check_mail_for_activation.php');


/*

or

$ph_check_mail_for_activation = $curl->Open('https://yoursite.com/apex/states/mh_check_mail_for_activation.php');

*/

?>
