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
    $rollNumber = $conn->real_escape_string($_POST['Roll']);

    $stmt = $conn->prepare("DELETE FROM class WHERE Roll     = ?");

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $rollNumber);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<div class='alert alert-success'>Record deleted successfully</div>";
        } else {
            echo "<div class='alert alert-warning'>No record found with the given roll number</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>

<form action="call.php" method="post">
            <div class="form-group">
                <input type="text" placeholder="Enter Roll_NO:" name="Roll"  class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Delete Data" name="Data" class="btn btn-primary">
            </div>

        </form>    
</div>
</body>
</html>