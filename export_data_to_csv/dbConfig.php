<?php
    $conn = new mysqli('localhost', 'root', '', 'beemart');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>