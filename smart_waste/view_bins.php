<?php
$conn = new mysqli("localhost", "root", "", "smart_waste");

$sql = "SELECT * FROM bins";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Smart Waste Bins</title>
</head>
<body>

<h2>รายการถังขยะ</h2>

<table border="1">
<tr>
<th>ID</th>
<th>Location</th>
<th>Waste Type</th>
<th>Capacity</th>
</tr>

<?php
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$row["bin_id"]."</td>";
    echo "<td>".$row["location"]."</td>";
    echo "<td>".$row["waste_type"]."</td>";
    echo "<td>".$row["capacity"]."</td>";
    echo "</tr>";
}
?>

</table>

</body>
</html>
