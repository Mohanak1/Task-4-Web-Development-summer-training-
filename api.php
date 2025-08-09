<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "robot_arm";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed"]));
}

header("Content-Type: application/json"); // This forces JSON response

$action = $_GET['action'] ?? '';

if ($action == 'save') {
    $m1 = $_POST['motor1'] ?? 0;
    $m2 = $_POST['motor2'] ?? 0;
    $m3 = $_POST['motor3'] ?? 0;
    $m4 = $_POST['motor4'] ?? 0;

    $stmt = $conn->prepare("INSERT INTO poses (motor1, motor2, motor3, motor4) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiii", $m1, $m2, $m3, $m4);
    $stmt->execute();

    echo json_encode(["status" => "saved"]);
}

else if ($action == 'list') {
    $res = $conn->query("SELECT * FROM poses ORDER BY id DESC");
    $rows = [];
    while ($row = $res->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
}

else if ($action == 'delete') {
    $id = $_GET['id'] ?? 0;
    $conn->query("DELETE FROM poses WHERE id=$id");
    echo json_encode(["status" => "deleted"]);
}

else {
    echo json_encode(["error" => "Invalid action"]);
}
?>
