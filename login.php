<?php
// Establish a database connection 
$conn = new mysqli('localhost', 'root', '', 'details');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    // $password = crypt($_POST["password"], PASSWORD_DEFAULT);  //functoin used for hashing
$password=$_POST['password'];
    $sql = "SELECT * FROM login WHERE Username='$username'";
    $result = $conn->query($sql);
    $userData = $result->fetch_assoc();

    if ($userData['Email'] === 'ishan@gmail.com') {
        if ($password === $userData["Password"] & $username === $userData["Username"]) {
            echo  "Admin Login Succesfull....";
            // $role == 'admin';
            session_start();
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['Username'] = $username;
            echo '<meta http-equiv="refresh" content="1;url=admin_page.php">';
        }
    }
}

if ($username != $userData["Username"]) {
    echo "Incoorect Username....";
}
if ($password != $userData["Password"]) {
    echo "Incoorect Password....";
}
if ($username != $userData["Username"] | $password != $userData["Password"]) {
    echo "<br>";
    echo "Login Failled";
}
if ($password === $userData["Password"] & $username === $userData["Username"] && $userData['Role'] == 'user') {
    echo 'User Login Succesfull....';
    session_start();
    $_SESSION['Username'] = $username;
    $_SESSION['user_logged_in'] = true;
    echo '<meta http-equiv="refresh" content="1;url=user.php">';
}
if ($password === $userData["Password"] & $username === $userData["Username"] && $userData['Role'] == 'engineer') {
    echo 'Engineer Login Succesfull....';
    session_start();
    $_SESSION['Username'] = $username;
    $_SESSION['engineer_logged_in'] = true;
    echo '<meta http-equiv="refresh" content="1;url=engineer.php">';
}
if ($password === $userData["Password"] & $username === $userData["Username"] && $userData['Role'] == 'null') {
    echo 'Your role has not been assigned yet .....!!!!!<br>';
    echo 'please wait for assigning the role.';
}
$conn->close();
