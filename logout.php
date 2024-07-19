<?php
session_start(); // بدء الجلسة أو استئناف الجلسة الحالية

// حذف جميع بيانات الجلسة
session_unset();

// إنهاء الجلسة
session_destroy();

// إعادة توجيه المستخدم إلى صفحة تسجيل الدخول أو الصفحة الرئيسية
header("Location: login.php");
exit;
?>
