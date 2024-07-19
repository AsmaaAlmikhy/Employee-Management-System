<?php
$message = ''; // متغير لتخزين الرسالة

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $salary = $_POST['salary'];

    $sql = "INSERT INTO employees (name, email, age, salary) VALUES ('$name', '$email', $age, $salary)";
    if ($conn->query($sql) === TRUE) {
        $message = "<div id='message' class='message success-message'>New employee added successfully</div>";
    } else {
        $message = "<div id='message' class='message error-message'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Employee</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <h2>Add Employee</h2>
  
  <?php if (!empty($message)) { echo $message; } ?>

  <form class="employee-form" method="POST" action="index.php?page=add_employee">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required>
    
    <label for="salary">Salary:</label>
    <input type="number" id="salary" name="salary" required>
    
    <button type="submit">Add Employee</button>
  </form>

  <script>
    // لإخفاء الرسالة بعد مدة 
    document.addEventListener('DOMContentLoaded', () => {
      const messageElement = document.getElementById('message');
      if (messageElement) {
        setTimeout(() => {
          messageElement.style.display = 'none';
        }, 5000);
      }
    });
  </script>
</body>

</html>
