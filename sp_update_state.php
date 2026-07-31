<?php
if (!isset($_GET['key']) || $_GET['key'] !== 'peptidos2026') {
    die("Unauthorized.");
}
require_once 'wp-config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

$backup_file = 'wp-content/uploads/sp_state.txt';
$fp = fopen($backup_file, 'w');

if (!$fp) {
    die("ERROR: Failed to open " . $backup_file . " for writing.");
}

$tables = array();
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

foreach ($tables as $table) {
    fwrite($fp, "DROP TABLE IF EXISTS `$table`;\n");
    $create_res = $conn->query("SHOW CREATE TABLE `$table`");
    $create_row = $create_res->fetch_row();
    fwrite($fp, $create_row[1] . ";\n\n");
    
    $data_res = $conn->query("SELECT * FROM `$table`");
    while ($row = $data_res->fetch_assoc()) {
        $fields = array();
        $values = array();
        foreach ($row as $key => $val) {
            $fields[] = "`" . $conn->real_escape_string($key) . "`";
            if (is_null($val)) {
                $values[] = "NULL";
            } else {
                $values[] = "'" . $conn->real_escape_string($val) . "'";
            }
        }
        $line = "INSERT INTO `$table` (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $values) . ");\n";
        fwrite($fp, $line);
    }
    fwrite($fp, "\n\n");
}

fclose($fp);
$conn->close();
echo "SUCCESS";
?>
