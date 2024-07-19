<?php
include 'db.php';

// استعلام لاسترجاع بيانات الموظفين
$sql = "SELECT id, name, email, age, salary FROM employees";
$result = $conn->query($sql);

// التحقق من وجود بيانات
$employees = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Employees</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>All Employees</h2>
    
    <input type="text" id="searchInput" placeholder="Search by Name or ID">

    <table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Salary</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="employeeTableBody">
            <?php if (!empty($employees)) : ?>
                <?php foreach ($employees as $employee) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($employee["id"]); ?></td>
                        <td><?php echo htmlspecialchars($employee["name"]); ?></td>
                        <td><?php echo htmlspecialchars($employee["email"]); ?></td>
                        <td><?php echo htmlspecialchars($employee["age"]); ?></td>
                        <td><?php echo htmlspecialchars($employee["salary"]); ?></td>
                        <td class="actions">
                            <a href="index.php?page=edit_employee&id=<?php echo $employee['id']; ?>" title="Edit">
                                <i class="fas fa-edit" style="color: #f8c701;"></i>
                            </a> | 
                            <a href="delete_employee.php?id=<?php echo $employee['id']; ?>" onclick="return confirm('Are you sure you want to delete this employee?')" title="Delete">
                                <i class="fas fa-trash" style="color: #e74c3c;"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">No employee record found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchInput');
            const employeeTableBody = document.getElementById('employeeTableBody');

            // Function to fetch employees based on search term
            const fetchEmployees = async (searchTerm) => {
                try {
                    const response = await fetch(`fetch_employees.php?search=${encodeURIComponent(searchTerm)}`);
                    const employees = await response.json();

                    // Clear existing table rows
                    employeeTableBody.innerHTML = '';

                    // Populate table with fetched employees
                    if (employees.length > 0) {
                        employees.forEach(employee => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${employee.id}</td>
                                <td>${employee.name}</td>
                                <td>${employee.email}</td>
                                <td>${employee.age}</td>
                                <td>${employee.salary}</td>
                                <td class='actions'>
                                    <a href='index.php?page=edit_employee&id=${employee.id}' title='Edit'><i class='fas fa-edit' style='color: #f8c701;'></i></a> | 
                                    <a href='delete_employee.php?id=${employee.id}' onclick='return confirm("Are you sure you want to delete this employee?")' title='Delete'><i class='fas fa-trash' style='color: #e74c3c;'></i></a>
                                </td>
                            `;
                            employeeTableBody.appendChild(row);
                        });
                    } else {
                        employeeTableBody.innerHTML = '<tr><td colspan="6">No employee record found</td></tr>';
                    }
                } catch (error) {
                    console.error('Error fetching employees:', error);
                }
            };

            // Event listener for search input changes
            searchInput.addEventListener('input', (event) => {
                const searchTerm = event.target.value.trim();
                fetchEmployees(searchTerm);
            });

            // Initial fetch on page load
            fetchEmployees('');
        });
    </script>
</body>
</html>
