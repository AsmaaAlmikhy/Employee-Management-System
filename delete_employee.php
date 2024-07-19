<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $deleted_at = date('Y-m-d H:i:s'); // الوقت الحالي

    $conn->begin_transaction();

    try {
        // نقل بيانات الموظف إلى جدول past_employees
        $sql = "INSERT INTO past_employees (id, name, email, age, salary, deleted_at)
                SELECT id, name, email, age, salary, '$deleted_at' FROM employees WHERE id = $id";
        $conn->query($sql);

        // حذف الموظف من جدول employees
        $sql = "DELETE FROM employees WHERE id = $id";
        $conn->query($sql);

        // تأكيد العملية
        $conn->commit();

        // توجيه إلى صفحة جميع الموظفين مع رسالة نجاح
        header('Location: index.php?page=all_employees&message=Employee%20deleted%20successfully&type=success');
        exit;
    } catch (Exception $e) {
        // إذا حدثت مشكلة، نقوم بإلغاء المعاملة وإظهار الخطأ
        $conn->rollback();
        header('Location: index.php?page=all_employees&message=Error%20deleting%20employee&type=error');
        exit;
    }
} else {
    echo "Employee ID not provided.";
    exit;
}

$conn->close();
?>
