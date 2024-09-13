<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
    padding: 80px;
    margin: 0;
    box-sizing: border-box;
    background-color: #f8f9fa; /* Light gray background for better contrast */
}

.container {
    max-width: 500px;
    margin: 0 auto;
    padding: 40px;
    background-color: #fff; /* White background for the container */
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 8px; /* Soft shadow for the container */
    border-radius: 8px; /* Rounded corners for the container */
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
}

.form-btn {
    text-align: right;
}

.update {
    display: none; /* Initially hide the update div */
    margin-top: 20px;
}

.update .form-group {
    margin-bottom: 20px;
}

.update .form-btn {
    text-align: right;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    padding: 10px 20px;
    font-size: 16px;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.alert {
    margin-top: 20px;
}

    </style>
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

    $row = null; // Initialize row to null

    if (isset($_POST['Data'])) {
        $rollNumber = $_POST['Roll'];

        $sql = "SELECT * FROM class WHERE roll = '$rollNumber'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Fetch the result into $row
        } else {
            echo "No data found for roll: $rollNumber";
        }
    }


    
    if (isset($_POST['update'])) {
        $newRoll = $_POST['New_Roll'];
        $newFullName = $_POST['New_name'];
        $newClass = $_POST['New_Class'];
        $newCity = $_POST['New_City'];
        $newZipCode = $_POST['New_zip_code'];

        $updateQuery = "UPDATE class SET
            full_name = '$newFullName',
            class = '$newClass',
            city = '$newCity',
            zip_code = '$newZipCode'
            WHERE roll = '$newRoll'";

        if ($conn->query($updateQuery) === TRUE) {
            echo "Data updated successfully";
        } else {
            echo "Error updating data:";
        }
    }



    $conn->close();
    ?>

    <form action="" method="post">
        <div class="form-group">
            <input type="text" placeholder="Enter Roll_NO:" name="Roll" class="">
        </div>
        <div class="form-btn">
            <input type="submit" value="call Data" name="Data" class="btn btn-primary">
        </div><br>
    </form>

    <?php
    if ($row) {
        echo '<style>.update { display: block; }</style>';
    }
    ?>

    <form action="read.php" method="post">
        <div class="update">
            <div class="data">
                <div class="form-group">
                <label for="new_roll">Roll Number:</label>
<input type="text" id="new_roll" value="<?php echo isset($row['roll']) ? $row['roll'] : ''; ?>" placeholder="Enter Roll_NO:" name="New_Roll" class="">
                </div>
               <div class="form-group">
    <label for="new_name">Full Name:</label>
    <input type="text" id="new_name" value="<?php echo isset($row['full_name']) ? $row['full_name'] : ''; ?>" placeholder="Enter Full_Name:" name="New_name" class="">
</div>

<div class="form-group">
    <label for="new_class">Class:</label>
    <input type="text" id="new_class" value="<?php echo isset($row['class']) ? $row['class'] : ''; ?>" placeholder="Enter Class:" name="New_Class" class="">
</div>

<div class="form-group">
    <label for="new_city">City:</label>
    <input type="text" id="new_city" value="<?php echo isset($row['city']) ? $row['city'] : ''; ?>" placeholder="Enter City:" name="New_City" class="">
</div>

<div class="form-group">
    <label for="new_zip_code">Zip Code:</label>
    <input type="text" id="new_zip_code" value="<?php echo isset($row['zip_code']) ? $row['zip_code'] : ''; ?>" placeholder="Enter Zip Code:" name="New_zip_code" class="">
</div>

            </div>
            <div class="form-btn">
                <input type="submit" value="update Data" name="update" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>
</body>
</html>
