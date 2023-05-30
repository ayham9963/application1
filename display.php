<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_registration";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM students";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
   
    echo "<h1>Registered Students</h1>";
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Gender</th>
            </tr>";


    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["ID"] . "</td>
                <td>" . $row["FullName"] . "</td>
                <td>" . $row["Email"] . "</td>
                <td>" . $row["Gender"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No student records found.";
}

$conn->close();
?>