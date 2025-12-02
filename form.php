<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $department_name = htmlspecialchars($_POST['department_name']);
    $session = htmlspecialchars($_POST['session']);
    $program = $_POST['program'];
    $discipline = htmlspecialchars($_POST['discipline']);
    $registration_no = htmlspecialchars($_POST['registration_no']);
    $title = $_POST['title'];
    $gender = $_POST['gender'];
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $middle_name = htmlspecialchars($_POST['middle_name']);
    $date_of_birth = $_POST['date_of_birth'];
    $fathers_name = htmlspecialchars($_POST['fathers_name']);
    $last_degree_name = htmlspecialchars($_POST['last_degree_name']);
    $cnic_number = htmlspecialchars($_POST['cnic_number']);
    $marital_status = $_POST['marital_status'];
    $house_no = htmlspecialchars($_POST['house_no']);
    $street_address = htmlspecialchars($_POST['street_address']);
    $city = htmlspecialchars($_POST['city']);
    $tehsil = htmlspecialchars($_POST['tehsil']);
    $district = htmlspecialchars($_POST['district']);
    $postcode = htmlspecialchars($_POST['postcode']);
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $student_email = htmlspecialchars($_POST['student_email']);
    $province = $_POST['province'];
    $country = $_POST['country'];
    $disability = $_POST['disability'];
    $temp_house_no = htmlspecialchars($_POST['temp_house_no']);
    $temp_street_address = htmlspecialchars($_POST['temp_street_address']);
    $temp_city = htmlspecialchars($_POST['temp_city']);
    $temp_tehsil = htmlspecialchars($_POST['temp_tehsil']);
    $temp_district = htmlspecialchars($_POST['temp_district']);
    $temp_postcode = htmlspecialchars($_POST['temp_postcode']);
    $temp_phone_number = htmlspecialchars($_POST['temp_phone_number']);
    $temp_province = $_POST['temp_province'] ?? '';
    $temp_country = $_POST['temp_country'] ?? '';
    $emergency_full_name = htmlspecialchars($_POST['emergency_full_name']);
    $relationship = $_POST['relationship'];
    $legal_guardian = $_POST['legal_guardian'];
    $nationality = $_POST['nationality'];
    $emergency_house_no = htmlspecialchars($_POST['emergency_house_no']);
    $emergency_street_address = htmlspecialchars($_POST['emergency_street_address']);
    $emergency_city = htmlspecialchars($_POST['emergency_city']);
    $emergency_tehsil = htmlspecialchars($_POST['emergency_tehsil']);
    $emergency_district = htmlspecialchars($_POST['emergency_district']);
    $emergency_postcode = htmlspecialchars($_POST['emergency_postcode']);
    $emergency_phone_number = htmlspecialchars($_POST['emergency_phone_number']);
    $emergency_province = $_POST['emergency_province'];
    $emergency_country = $_POST['emergency_country'];

    // Handle file upload
    $photo_path = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo_path = $target_file;
        }
    }

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO students (
        department_name, session, program, discipline, registration_no, title, gender, first_name, last_name, middle_name,
        date_of_birth, fathers_name, photo_path, last_degree_name, cnic_number, marital_status, house_no, street_address,
        city, tehsil, district, postcode, phone_number, student_email, province, country, disability, temp_house_no,
        temp_street_address, temp_city, temp_tehsil, temp_district, temp_postcode, temp_phone_number, temp_province,
        temp_country, emergency_full_name, relationship, legal_guardian, nationality, emergency_house_no,
        emergency_street_address, emergency_city, emergency_tehsil, emergency_district, emergency_postcode,
        emergency_phone_number, emergency_province, emergency_country
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )");
    $stmt->execute([
        $department_name, $session, $program, $discipline, $registration_no, $title, $gender, $first_name, $last_name, $middle_name,
        $date_of_birth, $fathers_name, $photo_path, $last_degree_name, $cnic_number, $marital_status, $house_no, $street_address,
        $city, $tehsil, $district, $postcode, $phone_number, $student_email, $province, $country, $disability, $temp_house_no,
        $temp_street_address, $temp_city, $temp_tehsil, $temp_district, $temp_postcode, $temp_phone_number, $temp_province,
        $temp_country, $emergency_full_name, $relationship, $legal_guardian, $nationality, $emergency_house_no,
        $emergency_street_address, $emergency_city, $emergency_tehsil, $emergency_district, $emergency_postcode,
        $emergency_phone_number, $emergency_province, $emergency_country
    ]);

    echo "<div class='alert alert-success'>Form submitted successfully!</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Master Data Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1>Student Master Data</h1>
    <p class="text-danger">* Indicates required question</p>
    <form method="POST" enctype="multipart/form-data">
        <h3>Personal Information</h3>

        <div class="mb-3">
            <label>1. Department Name *</label>
            <input type="text" name="department_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>2. Session (e.g. 2021-2025) *</label>
            <input type="text" name="session" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>3. Program *</label>
            <select name="program" class="form-select" required>
                <option value="">Select...</option>
                <option value="BS (4 Years)">BS (4 Years)</option>
                <option value="BS (2 Y or 2.5 Y)">BS (2 Y or 2.5 Y)</option>
                <option value="MS/M.phil">MS/M.phil</option>
                <option value="Ph.D">Ph.D</option>
            </select>
        </div>

        <div class="mb-3">
            <label>4. Discipline (e.g. Information Technology) *</label>
            <input type="text" name="discipline" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>5. Registration No.</label>
            <input type="text" name="registration_no" class="form-control">
        </div>

        <div class="mb-3">
            <label>6. Title *</label>
            <select name="title" class="form-select" required>
                <option value="">Select...</option>
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
                <option value="Miss">Miss</option>
                <option value="Ms">Ms</option>
            </select>
        </div>

        <div class="mb-3">
            <label>7. Gender *</label>
            <select name="gender" class="form-select" required>
                <option value="">Select...</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Transgender">Transgender</option>
            </select>
        </div>

        <div class="mb-3">
            <label>8. First Name *</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>9. Last Name *</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>10. Middle Name</label>
            <input type="text" name="middle_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>11. Date of Birth *</label>
            <input type="date" name="date_of_birth" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>12. Father's Name</label>
            <input type="text" name="fathers_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>13. Upload Your Passport size picture (Max. 10 MB) *</label>
            <input type="file" name="photo" class="form-control" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label>14. Last Degree Name *</label>
            <input type="text" name="last_degree_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>15. CNIC Number/ID Number field *</label>
            <input type="text" name="cnic_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>16. Marital Status *</label>
            <select name="marital_status" class="form-select" required>
                <option value="">Select...</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
            </select>
        </div>

        <div class="mb-3">
            <label>17. House no *</label>
            <input type="text" name="house_no" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>18. Street Address *</label>
            <input type="text" name="street_address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>19. City *</label>
            <input type="text" name="city" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>20. Tehsil *</label>
            <input type="text" name="tehsil" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>21. District *</label>
            <input type="text" name="district" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>22. Postcode *</label>
            <input type="text" name="postcode" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>23. Phone number *</label>
            <input type="tel" name="phone_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>24. Student Personal Email *</label>
            <input type="email" name="student_email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>25. Province/State *</label>
            <select name="province" class="form-select" required>
                <option value="">Select...</option>
                <option value="Balochistan">Balochistan</option>
                <option value="Gilgit-Baltistan">Gilgit-Baltistan</option>
                <option value="Islamabad">Islamabad</option>
                <option value="Azad Jammu & Kashmir">Azad Jammu & Kashmir</option>
                <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                <option value="Punjab">Punjab</option>
                <option value="Sindh">Sindh</option>
            </select>
        </div>

        <div class="mb-3">
            <label>26. Country *</label>
            <select name="country" class="form-select" required>
                <option value="">Select...</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label>27. Disability *</label>
            <select name="disability" class="form-select" required>
                <option value="">Select...</option>
                <option value="No Disability">No Disability</option>
                <option value="Hearing loss">Hearing loss</option>
                <option value="Deafblindness">Deafblindness</option>
                <option value="Traumatic brain injury">Traumatic brain injury</option>
                <option value="Speech impairments">Speech impairments</option>
            </select>
        </div>

        <h3>Temporary Address</h3>

        <div class="mb-3">
            <label>28. House no</label>
            <input type="text" name="temp_house_no" class="form-control">
        </div>

        <div class="mb-3">
            <label>29. Street Address</label>
            <input type="text" name="temp_street_address" class="form-control">
        </div>

        <div class="mb-3">
            <label>30. City</label>
            <input type="text" name="temp_city" class="form-control">
        </div>

        <div class="mb-3">
            <label>31. Tehsil</label>
            <input type="text" name="temp_tehsil" class="form-control">
        </div>

        <div class="mb-3">
            <label>32. District</label>
            <input type="text" name="temp_district" class="form-control">
        </div>

        <div class="mb-3">
            <label>33. Postcode</label>
            <input type="text" name="temp_postcode" class="form-control">
        </div>

        <div class="mb-3">
            <label>34. Phone number</label>
            <input type="tel" name="temp_phone_number" class="form-control">
        </div>

        <div class="mb-3">
            <label>35. Province/State</label>
            <select name="temp_province" class="form-select">
                <option value="">Select...</option>
                <option value="Balochistan">Balochistan</option>
                <option value="Gilgit-Baltistan">Gilgit-Baltistan</option>
                <option value="Islamabad">Islamabad</option>
                <option value="Azad Jammu & Kashmir">Azad Jammu & Kashmir</option>
                <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                <option value="Punjab">Punjab</option>
                <option value="Sindh">Sindh</option>
            </select>
        </div>

        <div class="mb-3">
            <label>36. Country</label>
            <select name="temp_country" class="form-select">
                <option value="">Select...</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <h3>Emergency Contact Information</h3>

        <div class="mb-3">
            <label>37. Emergency Full Name *</label>
            <input type="text" name="emergency_full_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>38. Relationship *</label>
            <select name="relationship" class="form-select" required>
                <option value="">Select...</option>
                <option value="Father is">Father is</option>
                <option value="Mother is">Mother is</option>
                <option value="Guardian is">Guardian is</option>
                <option value="Brother is">Brother is</option>
                <option value="Sister is">Sister is</option>
                <option value="Spouse is">Spouse is</option>
                <option value="Daughter is">Daughter is</option>
                <option value="Son is">Son is</option>
                <option value="Friend is">Friend is</option>
            </select>
        </div>

        <div class="mb-3">
            <label>39. Legal Guardian *</label>
            <select name="legal_guardian" class="form-select" required>
                <option value="">Select...</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="mb-3">
            <label>40. Nationality *</label>
            <select name="nationality" class="form-select" required>
                <option value="">Select...</option>
                <option value="Pakistani">Pakistani</option>
                <option value="Other Nationality">Other Nationality</option>
            </select>
        </div>

        <div class="mb-3">
            <label>41. House no *</label>
            <input type="text" name="emergency_house_no" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>42. Street Address *</label>
            <input type="text" name="emergency_street_address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>43. City *</label>
            <input type="text" name="emergency_city" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>44. Tehsil *</label>
            <input type="text" name="emergency_tehsil" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>45. District *</label>
            <input type="text" name="emergency_district" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>46. Postcode</label>
            <input type="text" name="emergency_postcode" class="form-control">
        </div>

        <div class="mb-3">
            <label>47. Phone number *</label>
            <input type="tel" name="emergency_phone_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>48. Province/State *</label>
            <select name="emergency_province" class="form-select" required>
                <option value="">Select...</option>
                <option value="Balochistan">Balochistan</option>
                <option value="Gilgit-Baltistan">Gilgit-Baltistan</option>
                <option value="Islamabad">Islamabad</option>
                <option value="Azad Jammu & Kashmir">Azad Jammu & Kashmir</option>
                <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                <option value="Punjab">Punjab</option>
                <option value="Sindh">Sindh</option>
            </select>
        </div>

        <div class="mb-3">
            <label>49. Country *</label>
            <select name="emergency_country" class="form-select" required>
                <option value="">Select...</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>