<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['first-name'];
    $lastname = $_POST['last-name'];
    $usernumber = $_POST['phone-number'];
    $userEmail = $_POST['email'];
    $password = $_POST['password'];
    $streetaddress = $_POST['street-address'];
    $postalcode = $_POST['postal-code'];
    $city = $_POST['city'];
    $province = $_POST['province'];

    $conn = new mysqli('localhost', 'root', '', 'User_Details');

    if ($conn->connect_error) {
        die("<script>alert('Connection Failed: " . $conn->connect_error . "'); window.location.href = 'register.html';</script>");
    }

   
    $query = "SELECT * FROM Customer_Info WHERE userEmail = ? OR usernuber = ?'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $userEmail,$usernumber);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
     
        echo "<script>alert('User already exists'); window.location.href = 'register.html';</script>"; 
    
     else 
     {

    $stmt = $conn->prepare("INSERT INTO Customer_Info (username, lastname, usernumber, userEmail, password, streetaddress, postalcode, city, province) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisssiss", $username, $lastname, $usernumber, $userEmail, $password, $streetaddress, $postalcode, $city, $province);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href = 'home.html';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'register.html';</script>";
    }
     }
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request method.'); window.location.href = 'register.html';</script>";
}
?>
