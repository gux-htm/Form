<?php
$conn = new mysqli("localhost","root","","student_db");
$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
echo "<h1>All Students</h1><table class='table table-striped'><tr><th>ID</th><th>Name</th><th>Email</th><th>Photo</th></tr>";
while($row = $result->fetch_assoc()){
    echo "<tr><td>".$row['id']."</td><td>".$row['first_name']." ".$row['last_name']."</td><td>".$row['student_email']."</td><td><img src='".$row['photo_path']."' width='100'></td></tr>";
}
echo "</table>";
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">