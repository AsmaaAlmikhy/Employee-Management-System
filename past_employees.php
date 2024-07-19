<?php
include 'db.php';

// استعلام لاسترجاع بيانات الموظفين السابقين
$sql = "SELECT id, name, email, age, salary, deleted_at FROM past_employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Employees</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h2>Past Employees</h2>

    <table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Salary</th>
                <th>Deleted At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["age"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["salary"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["deleted_at"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No past employee record found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

</body>
</html>
