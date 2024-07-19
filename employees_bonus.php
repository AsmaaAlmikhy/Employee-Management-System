<?php
include 'db.php';

// استعلام لاسترجاع بيانات الموظفين وحساب البونص
$sql = "SELECT id, name, salary, (salary * 0.25) AS bonus FROM employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees Bonus</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h2>Employees Bonus</h2>

    <table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Bonus</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                    echo "<td>" . htmlspecialchars(number_format($row["bonus"])) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No employee records found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>

</html>
