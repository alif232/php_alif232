<?php

// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db = "testdb";

$con = new mysqli($host, $user, $pass, $db);
if ($con->connect_error) {
    die("Koneksi gagal: " . $con->connect_error);
}

// Search
$search = "";
$where = "";
if (isset($_GET['search']) && $_GET['search'] != "") {
    $search = $con->real_escape_string($_GET['search']);
    $where = "WHERE h.hobi LIKE '%$search%'";
}

// Query
$sql = "SELECT h.hobi, COUNT(DISTINCT p.id) As jumlah
        FROM hobi h
        JOIN person p ON p.id = h.person_id
        $where
        GROUP BY h.hobi
        ORDER BY jumlah DESC";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Hobi</title>
        <style>
            form {
                text-align: center;
                margin-bottom: 20px;
            }
            table { 
                border-collapse: collapse; 
                width: 50%; 
                margin: 20px auto; 
            }
            th, td { 
                border: 1px solid #000; 
                padding: 8px; 
                text-align: center; 
            }
            th {
                background: #f2f2f2;
            }
            form {
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <br><br>
        <form method="get">
            <label>Cari Hobi: </label>
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
            <a href="laporan.php">Reset</a>
        </form>

        <table>
            <tr>
                <th>Hobi</th>
                <th>Jumlah Person</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['hobi']}</td>
                            <td>{$row['jumlah']}</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Tidak ada data</td></tr>";
            }
            ?>
        </table>
    </body>
</html>