<?php
include 'db.php';

$searchTerm = $_GET['search'] ?? '';

$sql = "SELECT id, name, email, age, salary FROM employees";

//  شرط للبحث
if (!empty($searchTerm)) {
    $searchTerm = $conn->real_escape_string($searchTerm);
    $sql .= " WHERE name LIKE '%$searchTerm%' OR id = '$searchTerm'";
}

$result = $conn->query($sql);

$employees = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

// إرجاع البيانات كـ JSON
header('Content-Type: application/json');
echo json_encode($employees);

$conn->close();
?>
