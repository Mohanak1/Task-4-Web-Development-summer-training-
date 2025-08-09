<?php
$conn = new mysqli("localhost", "root", "", "robot_arm");
$conn->query("UPDATE arm_positions SET status = 0");
echo "Status reset.";
$conn->close();
?>
