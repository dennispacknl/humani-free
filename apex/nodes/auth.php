<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    echo "<meta http-equiv='refresh' content='0; url=https://yoursite.com/login/'/>";
    exit();
}
?>
