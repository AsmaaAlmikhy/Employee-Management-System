<?php
include 'db.php';

//تحديد الصفحة التي يجب عرضها بناءً على قيمة page 
// عرض الصفحة الافتراضية all_employees
$page = isset($_GET['page']) ? $_GET['page'] : 'all_employees';

// لعرض الرسائل
if (isset($_GET['message']) && isset($_GET['type'])) {
  // فلتره للقيم
  $message = htmlspecialchars($_GET['message']);
  $message_type = htmlspecialchars($_GET['type']);
  echo "<div id='message' class='message $message_type-message'>$message</div>";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Management System</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

  // الشريط الجانبي
  <div class="sidebar">
    <h3>Employee Management System</h3>
    <ul>
      <li><a href="index.php?page=all_employees" id="all-employees"><i class="fas fa-users"></i>All Employees</a></li>
      <li><a href="index.php?page=add_employee" id="add-employee"><i class="fas fa-user-plus"></i>Add Employee</a></li>
      <li><a href="index.php?page=past_employees" id="past-employees"><i class="fas fa-times" style="font-size: 24px;"></i>Past Employees</a></li>
      <li><a href="index.php?page=employees_bonus" id="employee-bonus"><i class="fas fa-star"></i>Employees Bonus</a></li>
      <li><a href="logout.php" id="sign-out"><i class="fas fa-sign-out-alt"></i>Sign Out</a></li>
    </ul>
  </div>

  // محتوى الصفحة
  <div class="content">
    <?php
    if ($page == 'add_employee') {
      include 'add_employee.php';
    } elseif ($page == 'edit_employee') {
      include 'edit_employee.php';
    } elseif ($page == 'past_employees') {
      include 'past_employees.php';
    } elseif ($page == 'employees_bonus') {
      include 'employees_bonus.php';
    } else {
      include 'all_employees.php';
    }
    ?>
  </div>


  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const currentPath = new URLSearchParams(window.location.search).get('page');
      const links = document.querySelectorAll('.sidebar ul li a');

      // إذا لم يكن هناك قيمة في query parameter، تعيين "all_employees" كخيار افتراضي
      const defaultPage = 'all_employees';
      const pageToHighlight = currentPath || defaultPage;

      links.forEach(link => {
        const href = new URL(link.href).searchParams.get('page');

        if (href === pageToHighlight) {
          link.classList.add('active');
        } else {
          link.classList.remove('active');
        }
      });
    });

    // لإخفاء الرسالة بعد فترة زمنية
    document.addEventListener('DOMContentLoaded', function() {
      var messageElement = document.getElementById('message');
      if (messageElement) {
        setTimeout(function() {
          messageElement.style.opacity = '0';
          setTimeout(function() {
            messageElement.style.display = 'none';
          }, 500); // تأخير إضافي لإخفاء العنصر بعد تأثير التلاشي
        }, 5000); // 5000 مللي ثانية = 5 ثواني
      }
    });
  </script>
</body>

</html>