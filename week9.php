<?php

// Fungsi untuk mendownload data dari URL CSV
function downloadCSV($url) {
    $csvData = file_get_contents($url);
    return $csvData;
}

// Fungsi untuk memproses data CSV dan mengembalikan array data
function processCSV($csvData) {
    $lines = explode("\n", $csvData);
    $data = [];

    // Gunakan flag untuk menandai baris pertama
    $isFirstLine = true;

    foreach ($lines as $line) {
        // Skip baris pertama jika ini adalah nama kolom
        if ($isFirstLine) {
            $isFirstLine = false;
            continue;
        }

        $data[] = str_getcsv($line);
    }

    return $data;
}

// Fungsi untuk menambahkan data baru ke file CSV
function addNewData($id, $fname, $lname, $email, $email2, $profesi, $csvData) {
    $data = processCSV($csvData);

    // Tambahkan data baru ke array
    $newData = [$id, $fname, $lname, $email, $email2, $profesi];
    $data[] = $newData;

    return $data;
}

// Fungsi untuk menulis data kembali ke file CSV
function writeCSV($filename, $data) {
    $csvContent = '';

    foreach ($data as $row) {
        $csvContent .= implode(',', $row) . "\n";
    }

    file_put_contents($filename, $csvContent);
}

// Proses form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $email2 = $_POST["email2"];
    $profesi = $_POST["profesi"];
    $csvUrl = $_POST["csvUrl"];

    // Mendownload data dari URL CSV
    $csvData = downloadCSV($csvUrl);

    // Menambahkan data baru ke file CSV
    $updatedData = addNewData($id, $fname, $lname, $email, $email2, $profesi, $csvData);

    // Menyimpan kembali data yang telah diupdate ke file CSV
    writeCSV("datapribadi.csv", $updatedData);

}

// Redirect kembali ke halaman form
header("Location: index.php");
exit();

?>
