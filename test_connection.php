<?php
require_once('config.php');

// Check if the 'clients' table exists
$sql = "DESCRIBE clients";
$result = $conn->query($sql);

if ($result) {
    echo "The 'clients' table exists!<br>";
    echo "Columns:<br>";
    while ($row = $result->fetch_assoc()) {
        echo $row['Field'] . " - " . $row['Type'] . "<br>";
    }
} else {
    echo "The 'clients' table does not exist: " . $conn->error;
}
?>