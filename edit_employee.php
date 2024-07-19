<?php
include 'db.php';

// التحقق من وجود معرف الموظف في الطريقة GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // استعلام لاسترجاع بيانات الموظف المحدد
    $sql = "SELECT id, name, email, age, salary FROM employees WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        echo "Employee not found.";
        exit;
    }
} else {
    echo "Employee ID not provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Edit Employee</h2>
    
    <?php
    if (isset($_GET['message'])) {
        echo $_GET['message'];
    }
    ?>

    <form class="employee-form" method="POST" action="update_employee.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($employee['id']); ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($employee['name']); ?>" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($employee['email']); ?>" required>
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($employee['age']); ?>" required>
        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary" value="<?php echo htmlspecialchars($employee['salary']); ?>" step="0.01" required>
        <button type="submit">Update Employee</button>
    </form>

    <script>
      //  لإخفاء الرسالة بعد مدة
      document.addEventListener('DOMContentLoaded', () => {
        const messageElement = document.querySelector('.message');
        if (messageElement) {
          setTimeout(() => {
            messageElement.style.display = 'none';
          }, 5000);
        }
      });
    </script>
</body>
</html>
