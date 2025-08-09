<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "robot_arm");
if ($conn->connect_error) die(json_encode(["error" => "DB error"]));

$res = $conn->query("SELECT * FROM arm_positions ORDER BY id DESC LIMIT 1");
echo json_encode($res->fetch_assoc());

$conn->close();
?>
