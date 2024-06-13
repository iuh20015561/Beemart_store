<?php
class BeeMart
{
    private $lastError;

    function ketnoi()
    {
        $conn = new mysqli("localhost", "root", "", "beemart");

        if ($conn->connect_error) {
            $this->lastError = "Không kết nối được: " . $conn->connect_error;
            return false;
        }

        $conn->set_charset("utf8");

        return $conn;
    }

    function dongKetNoi($con)
    {
        $con->close();
    }

    function getLastError()
    {
        return $this->lastError;
    }
}