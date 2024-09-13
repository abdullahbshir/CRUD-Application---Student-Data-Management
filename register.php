<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<?php
$host = 'localhost';
$username = 'root';
$password = ''; 
$database = 'stu_data';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rollNumber = ($_POST['RollNumber']);
    $fullName = ($_POST['FullName']);
    $class = ($_POST['class']);
    $city =($_POST['city']);
    $zipCode =($_POST['zip_code']);

    $stmt = $conn->prepare("INSERT INTO class (Roll, Full_Name, class, city, zip_code) VALUES (?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssss", $rollNumber, $fullName, $class, $city, $zipCode);

    if ($stmt->execute()) {
        echo "";
    } else {
        echo "<div class='alert alert-danger'>Error</div>";
    }

    $conn->close();
}
?>

<form action="register.php" method="post">
    <div class="form-group mb-3">
        <input type="text" class="form-control" name="RollNumber" placeholder="Roll Number" required>
    </div>
    <div class="form-group mb-3">
        <input type="text" class="form-control" name="FullName" placeholder="Full Name" required>
    </div>
    <div class="form-group mb-3">
        <input type="text" class="form-control" name="class" placeholder="Class" required>
    </div>
    <div class="form-group mb-3">
        <input type="text" class="form-control" name="city" placeholder="City" required>
    </div>
    <div class="form-group mb-3">
        <input type="text" class="form-control" name="zip_code" placeholder="Zip Code" required>
    </div>
    <div class="form-btn">
        <input type="submit" class="btn btn-primary" value="Register" name="submit">
    </div>
</form>
</div>
</body>
</html>
