<?php

require_once('endpoints/user.php');

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_GET['endpoint'] ?? '';

switch ($method) {
    case 'GET':
        handle_get_request($endpoint);
        break;
    case 'POST':
        handle_post_request($endpoint);
        break;
    default:
        header('HTTP/1.1 405 Method Not Allowed');
        echo json_encode(['error' => 'Method not allowed']);
        break;
}

function handle_get_request($endpoint) {
    switch ($endpoint) {
        case 'users':
            $users = get_users();
            echo json_encode($users);
            break;


        default:
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'Endpoint not found']);
            break;
    }
}

function handle_post_request($endpoint) {
    if ($endpoint === 'users') {
        // Retrieve JSON input
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        // Check if the data is valid
        if ($data && isset($data['name']) && isset($data['perm']) && isset($data['password'])) {
            $name = $data['name'];
            $perm = $data['perm'];
            $password = $data['password'];

            // Create the user
            $user = create_user($name, $perm, $password);
            echo json_encode($user);
        } else {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['error' => 'Name, email, and password are required']);
        }
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'Endpoint not found']);
    }
}
?>
