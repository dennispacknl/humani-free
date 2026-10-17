<?php

class ServerTimezone {
    public function UTC() {
        $timeRegion = 'Atlantic/Reykjavik';
        date_default_timezone_set($timeRegion);
        return $timeRegion;
    }
}

$timezone = new ServerTimezone();


/* Usage */

/*

$test = $timezone->UTC();
echo $test;

*/

?>
