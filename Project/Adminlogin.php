<?php
session_start();
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "User_Details";      

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$email = $_POST['adminname'];
$password = $_POST['password'];
$sql = "SELECT * FROM admin WHERE admin_name = '$email' AND admin_password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: admin.html");
    exit();
} else {
    echo "Invalid email or password.";
}
$conn->close();
?>
