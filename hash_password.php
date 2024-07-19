<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    
    // تشفير كلمة المرور
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    //  لتخزين $hashed_password في قاعدة البيانات
    echo "Hashed Password: " . $hashed_password;
}
?>
