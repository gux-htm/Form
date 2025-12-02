<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: admin_login.php");
    exit;
}

$conn = new mysqli("localhost","root","","student_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Student Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container-fluid mt-5">
    <h1>All Students</h1>
    <a href="logout.php" class="btn btn-danger mb-3">Logout</a>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Department Name</th>
                    <th>Session</th>
                    <th>Program</th>
                    <th>Discipline</th>
                    <th>Registration No</th>
                    <th>Title</th>
                    <th>Gender</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                    <th>Date of Birth</th>
                    <th>Father's Name</th>
                    <th>Photo</th>
                    <th>Last Degree Name</th>
                    <th>CNIC Number</th>
                    <th>Marital Status</th>
                    <th>House No</th>
                    <th>Street Address</th>
                    <th>City</th>
                    <th>Tehsil</th>
                    <th>District</th>
                    <th>Postcode</th>
                    <th>Phone Number</th>
                    <th>Student Email</th>
                    <th>Province</th>
                    <th>Country</th>
                    <th>Disability</th>
                    <th>Temp House No</th>
                    <th>Temp Street Address</th>
                    <th>Temp City</th>
                    <th>Temp Tehsil</th>
                    <th>Temp District</th>
                    <th>Temp Postcode</th>
                    <th>Temp Phone Number</th>
                    <th>Temp Province</th>
                    <th>Temp Country</th>
                    <th>Emergency Full Name</th>
                    <th>Relationship</th>
                    <th>Legal Guardian</th>
                    <th>Nationality</th>
                    <th>Emergency House No</th>
                    <th>Emergency Street Address</th>
                    <th>Emergency City</th>
                    <th>Emergency Tehsil</th>
                    <th>Emergency District</th>
                    <th>Emergency Postcode</th>
                    <th>Emergency Phone Number</th>
                    <th>Emergency Province</th>
                    <th>Emergency Country</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['department_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['session']); ?></td>
                    <td><?php echo htmlspecialchars($row['program']); ?></td>
                    <td><?php echo htmlspecialchars($row['discipline']); ?></td>
                    <td><?php echo htmlspecialchars($row['registration_no']); ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                    <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['middle_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td>
                    <td><?php echo htmlspecialchars($row['fathers_name']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($row['photo_path']); ?>" width="100"></td>
                    <td><?php echo htmlspecialchars($row['last_degree_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['cnic_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['marital_status']); ?></td>
                    <td><?php echo htmlspecialchars($row['house_no']); ?></td>
                    <td><?php echo htmlspecialchars($row['street_address']); ?></td>
                    <td><?php echo htmlspecialchars($row['city']); ?></td>
                    <td><?php echo htmlspecialchars($row['tehsil']); ?></td>
                    <td><?php echo htmlspecialchars($row['district']); ?></td>
                    <td><?php echo htmlspecialchars($row['postcode']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['student_email']); ?></td>
                    <td><?php echo htmlspecialchars($row['province']); ?></td>
                    <td><?php echo htmlspecialchars($row['country']); ?></td>
                    <td><?php echo htmlspecialchars($row['disability']); ?></td>
                    <td><?php echo htmlspecialchars($row['temp_house_no']); ?></td>
                    <td><?php echo htmlspecialchars($row['temp_street_address']); ?></td>
                    <td><?php echo htmlspecialchars($row['temp_city']); ?></td>
                    <td><?php echo htmlspecialchars($row['temp_tehsil']); ?></td>
                    <td><?php echo htmlspecialchars($row['temp_district']); ?></td>
                    <td><?php echo htmlspecialchars($row['temp_postcode']); ?></td>
                    <td><?php echo htmlspecialchars($row['temp_phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['temp_province']); ?></td>
                    <td><?php echo htmlspecialchars($row['temp_country']); ?></td>
                    <td><?php echo htmlspecialchars($row['emergency_full_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['relationship']); ?></td>
                    <td><?php echo htmlspecialchars($row['legal_guardian']); ?></td>
                    <td><?php echo htmlspecialchars($row['nationality']); ?></td>
                    <td><?php echo htmlspecialchars($row['emergency_house_no']); ?></td>
                    <td><?php echo htmlspecialchars($row['emergency_street_address']); ?></td>
                    <td><?php echo htmlspecialchars($row['emergency_city']); ?></td>
                    <td><?php echo htmlspecialchars($row['emergency_tehsil']); ?></td>
                    <td><?php echo htmlspecialchars($row['emergency_district']); ?></td>
                    <td><?php echo htmlspecialchars($row['emergency_postcode']); ?></td>
                    <td><?php echo htmlspecialchars($row['emergency_phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['emergency_province']); ?></td>
                    <td><?php echo htmlspecialchars($row['emergency_country']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
