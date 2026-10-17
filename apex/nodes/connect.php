<?php

/* =========== Usage ===========

$connection = ConnectDB();
DisconnectDB($connection);

echo "Connection closed.";

=========== Usage =========== */

?>

<?php

function ConnectDB() {
    $connection = new mysqli("localhost", "c2589746c_system", "oZkUfA$8%]+^Z;s=", "c2589746c_humani");

    if ($connection->connect_error) {
        echo "<h3>Our system encountered an error. Please come back later.</h3>";
    }

    return $connection;
}

function DisconnectDB($connection) {
    $connection->close();
}

?>

