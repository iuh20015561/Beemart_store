<?php

// Include your database configuration file
include_once 'dbConfig.php';

// Fetch records from the baocaobanhang table
$query = $conn->query("SELECT * FROM baocaobanhang ORDER BY SpID ASC");

if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = "baocaobanhang-data_" . date('Y-m-d') . ".csv";

    // Create a file pointer
    $f = fopen('php://memory', 'w');

    // Set column headers
    $fields = array('SpID', 'maSanPham', 'thangBanHang', 'soLuongTonKho', 'soLuongDaBan', 'giaBan');
    fputcsv($f, $fields, $delimiter);

    // Output each row of the data, format line as csv and write to file pointer
    while ($row = $query->fetch_assoc()) {
        $lineData = array($row['SpID'], $row['maSanPham'], $row['thangBanHang'], $row['soLuongTonKho'], $row['soLuongDaBan'], $row['giaBan']);
        fputcsv($f, $lineData, $delimiter);
    }

    // Move back to the beginning of the file
    fseek($f, 0);

    // Set headers to download the file rather than display it
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    // Output all remaining data on a file pointer
    fpassthru($f);
}

exit;

?>
