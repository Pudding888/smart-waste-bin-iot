<?php
include 'db.php';

$id = $_GET['id'];

// 🔥 ลบ status ก่อน
$conn->query("DELETE FROM bin_status WHERE bin_id = $id");

// 🔥 แล้วค่อยลบ bin
$conn->query("DELETE FROM bins WHERE bin_id = $id");

header("Location: bins.php");
?>
