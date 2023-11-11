<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="week9.css">
    <title>Form Pengisian Data</title>
    <!-- Include Live Reload script (adjust the path based on your setup) -->
    <script src="https://unpkg.com/livereload-js/dist/livereload.js" defer></script>
</head>
<body>
    <div class="container">
        <h2>Form Pengisian Data</h2>
        <form id="dataForm" action="week9.php" method="post">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" required>

            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" required>

            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="email2">Confirm Email:</label>
            <input type="email" id="email2" name="email2" required>

            <label for="profesi">Profesi:</label>
            <input type="text" id="profesi" name="profesi" required>

            <!-- Tambahkan input untuk URL CSV -->
            <label for="csvUrl">CSV URL:</label>
            <input type="url" id="csvUrl" name="csvUrl">        
            <button type="submit" name="Submit">Submit</button>
        </form>
    </div>

    <div class="container">
        <h2>Tabel Data Pribadi</h2>
        <div id="dataTable">
        <?php
            // Fungsi untuk menampilkan data dari file CSV
            function displayCSVTable($filename) {
                $csvData = file_get_contents($filename);
                $lines = explode("\n", $csvData);

                echo '<table border="1">';
                echo '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Email2</th><th>Profesi</th></tr>';

                foreach ($lines as $line) {
                    $data = str_getcsv($line);
                    echo '<tr>';
                    foreach ($data as $value) {
                        echo '<td>' . $value . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
            }

            // Panggil fungsi untuk menampilkan tabel
            displayCSVTable("datapribadi.csv");
            ?>
        </div>
    </div>
</body>
</html>
