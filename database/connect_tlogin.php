<?php
$id = $_POST['id'];
$password = $_POST['password'];
$email = $_POST['email'];
$conn = new mysqli('localhost', 'root', '', 'course material archive');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die('connection failed: ' . $conn->connect_error);
} else{
    $stmt = $conn->prepare("select * from teacher where email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if ($data['password'] === $password) {
            echo "login sucsessful";
            header("Location: ../student_home.html", true, 301);
        } else {
            echo "invalid";
        }
    } else {
        echo "invalid email";
    }
    header("Location: ../teacher_home.html", true, 301);
    exit();
} 