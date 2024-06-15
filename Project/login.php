<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userEmail = $_POST['userEmail'];
    $password = $_POST['password'];

    // Establish database connection
    $conn = new mysqli('localhost', 'root', '', 'User_Details');

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }


    $query = "SELECT * FROM Customer_Info WHERE UserEmail = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $userEmail, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        $_SESSION['userEmail'] = $user['UserEmail'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['usernumber'] = $user['usernumber'];
        $_SESSION['streetaddress'] = $user['streetaddress'];
        $_SESSION['postalcode'] = $user['postalcode'];
        $_SESSION['city'] = $user['city'];
        $_SESSION['province'] = $user['province'];

        header("Location: TestingOnline.php");
        exit();
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
