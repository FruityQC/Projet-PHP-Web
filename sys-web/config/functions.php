<?php

//Settings

include('template.php');
date_default_timezone_set('America/New_York'); // Set to your desired time zone
$logFileName = "http://localhost/sys-web/config/logs.log";
$conn = include('database.php');

$maintenance = IsMaintenance();

if ($maintenance) {
    //session_start();
    if (!IsAdmin()) {
        Logout();
        header('Location: http://localhost/sys-web/');
        exit();
    }
}

function IsMaintenance() {
    global $conn;

    $sql = "SELECT maintenance FROM settings WHERE id = 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row['maintenance'] == 1) {
        return true;
    } else {
        return false;
    }

}

function SetMaintenance(bool $value) {
    global $conn;

    $sql = "UPDATE settings SET maintenance='$value' WHERE settings.id = 1";

    $result = mysqli_query($conn, $sql);


    if (!$result) {
        header("Location: ../home.php?msg=Erreur Fatal");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}



// Settings END ################################################################################################

function IsInactive() {
    $maxInactiveTime = 60 * 60;
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $maxInactiveTime) {
        session_unset(); 
        session_destroy(); 
        header('Location: ../index.php?error=Session expirée, veuillez vous reconnecter.');
        exit();
    }
}

function CheckReset() {
    global $conn;

    $sql = "SELECT reset FROM users WHERE id = " . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row['reset'] == 1) {
            header('Location: https://resi.fruitysys.com/reset.php');
            exit();
        }
    }
}

function currentPage() {
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
    return $url;  
}

// Display functions ################################################################################################

function display_users(){
    global $conn;
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function display_rooms(){
    global $conn;
    $sql = "SELECT * FROM rooms ORDER BY displayid ASC";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function GetNotes($room) {
    global $conn;
    $sql = "SELECT * FROM notes WHERE roomid='$room' ORDER BY noteid DESC";
    $result = mysqli_query($conn, $sql);

    return $result;
}

// Get everything from room
function GetRoom($id) { 
    global $conn;
    $sql = "SELECT * FROM rooms WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return $row;
}


function GetHumanDate($date) {
    $dateString = $date;
    $timestamp = strtotime($dateString);

    if ($timestamp !== false) {
        $monthNames = [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ];

        $dayNames = [
            'dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'
        ];

        $day = strftime('%w', $timestamp);
        $month = strftime('%m', $timestamp) - 1; // Adjust for 0-based array

        $humanDate = strftime("%d {$monthNames[$month]} %Y", $timestamp);

    } else {
        return "Format de date invalide";
    }

    return $humanDate;
}

// Display functions END #############################################################################################

// LOGGING START ####################################################################################################

function LogAction($log) {
    // Put logs in a file
    global $logFileName;
    $file = fopen("$logFileName", "a");
    fwrite($file, "[" . date("Y-m-d H:i:s") . "] " . $log . PHP_EOL);
    fclose($file);
}

function GetLog() {
    global $logFileName;

    // Read the log file into an array
    $logLines = file($logFileName);
    
    // Reverse the order of the array elements
    $logLinesReversed = array_reverse($logLines);
    
    // Output the reversed log content with HTML line breaks
    foreach ($logLinesReversed as $line) {
        echo htmlspecialchars($line) . '<br>';
    }
    
}

function ResetLogs() {
    global $logFileName;
    $file = fopen("$logFileName", "w");
    fwrite($file, "");
    fclose($file);
}

function GetIP(){
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $clientIP = $_SERVER['HTTP_CLIENT_IP'];
    } else {
        $clientIP = $_SERVER['REMOTE_ADDR'];
    }
    
    return $clientIP;    
}


function GetImage($noteid) {
    global $conn;
    $sql = "SELECT image FROM notes WHERE noteid='$noteid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $image = "" . $row['image'];
    return $image;
}


function generateRandomString($length = 6) {
    $characters = 'abcdefghijklmnopqrstuvwxyz'; // You can include uppercase and numbers if needed
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
// LOGGING END ######################################################################################################



// Session functions #################################################################################################

function LoggedInOnly(){
    session_start();

    IsInactive();
    $_SESSION['last_activity'] = time();

    if (!isset($_SESSION['id']) && !isset($_SESSION['username'])){
        header('Location: ../index.php');
        exit();
    }
}

function AdminOnly(){
    if ($_SESSION['admin'] != 1){
        header('Location: ../index.php');
        exit();
    }
}

function IsAdmin(){
    if (isset($_SESSION['admin'])) {
        if ($_SESSION['admin'] == 1){
            return true;
        } else {
            return false;
        }
    } else {
        return "SESSION ERROR";
    }
}

function Logout($msg = "Test"){
    if ($msg != null) {
        header("Location: https://resi.fruitysys.com/config/logout.php?error=$msg");
    } else {
        header("Location: https://resi.fruitysys.com/config/logout.php");
    }
}

// Session functions END #############################################################################################

?>