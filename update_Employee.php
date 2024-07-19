<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $salary = $_POST['salary'];

    $sql = "UPDATE employees SET name='$name', email='$email', age=$age, salary=$salary WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $message = "Employee updated successfully";
        $message_type = "success";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
        $message_type = "error";
    }

    $conn->close();
    // إعادة توجيه مع الرسالة في الرابط
    header("Location: index.php?page=all_employees&message=" . urlencode($message) . "&type=" . urlencode($message_type));
    exit;
}
?>
