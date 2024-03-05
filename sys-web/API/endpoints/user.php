<?php
$ip = "localhost";
$username = "fruitysy_resi";
$password = "Felix_1500";
$dbname = "fruitysy_resi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}





function get_users() {
    global $conn;
    $sql = "SELECT id, username, perm, admin FROM users";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($result->num_rows > 0) {
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    } else {
        return [];
    }
}

function create_user($name, $email, $password) {
    global $conn;

    // Hash the password for security (you should use a stronger hash in production)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        $user_id = $conn->insert_id;
        return ['id' => $user_id, 'name' => $name, 'email' => $email];
    } else {
        return ['error' => $conn->error];
    }
}

?>