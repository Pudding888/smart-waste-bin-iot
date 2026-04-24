<?php
include 'db.php';

$result = $conn->query("
SELECT b.*, 
       s.status_id,
       s.waste_level, 
       s.smell_level, 
       s.battery,
       s.recorded_time
FROM bins b
LEFT JOIN bin_status s 
ON b.bin_id = s.bin_id
AND s.status_id = (
    SELECT MAX(status_id)
    FROM bin_status
    WHERE bin_id = b.bin_id
)
ORDER BY b.bin_id DESC
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Bins</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:#f4f6f9;
font-family:Arial;
}

.sidebar{
width:220px;
height:100vh;
position:fixed;
background:#1f2937;
color:white;
padding:20px;
}

.sidebar a{
display:block;
color:white;
margin:10px 0;
text-decoration:none;
}

.sidebar a:hover{
color:#38bdf8;
}

.content{
margin-left:240px;
padding:30px;
}

.card{
border:none;
border-radius:12px;
box-shadow:0 8px 20px rgba(0,0,0,0.08);
}

.table tr:hover{
background:#eef2ff;
}
</style>

</head>

<body>

<div class="sidebar">
<h4>Smart Waste</h4>
<a href="index.php">Dashboard</a>
<a href="bins.php">Bins</a>
<a href="map.php">Map</a>
<a href="add_bin.php">Add Bin</a>
</div>

<div class="content">

<h2 class="mb-3">ข้อมูลถังขยะ</h2>

<input type="text" id="search" class="form-control mb-3" placeholder="🔍 ค้นหา...">

<div class="card p-4">

<table class="table table-striped">

<thead>
<tr>
<th>ID</th>
<th>Code</th>
<th>Location</th>
<th>Type</th>
<th>Capacity</th>
<th>Status ID</th> <!-- 🔥 เพิ่ม -->
<th>Battery</th>
<th>Waste Level</th>
<th>Smell</th>
<th>Status</th>
<th>Last Collected</th>
<th>Recorded</th>
<th>รหัสรอบเก็บ</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['bin_id']; ?></td>
<td><?php echo $row['bin_code']; ?></td>
<td><?php echo $row['location']; ?></td>
<td><?php echo $row['waste_type']; ?></td>

<td>
<span class="badge bg-info">
<?php echo $row['capacity'] ?? 0; ?> kg
</span>
</td>



<!-- 🔥 Status ID -->
<td>
<span class="badge bg-secondary">
#<?php echo $row['status_id'] ?? '-'; ?>
</span>
</td>

<!-- 🔋 Battery -->
<td>
<?php
// 1. ดึงค่ามาและบังคับให้เป็น float
$b = (float)($row['battery'] ?? 0); 

// 2. ปรับการแสดงผลเลขทศนิยม 2 ตำแหน่งในข้อความ
$display_b = number_format($b, 2);

if($b < 20.00){
    echo "<span class='badge bg-danger'>ต่ำ {$display_b}%</span>";
}elseif($b < 50.00){
    echo "<span class='badge bg-warning text-dark'>กลาง {$display_b}%</span>";
}else{
    echo "<span class='badge bg-success'>ปกติ {$display_b}%</span>";
}
?>
</td>

<!-- 🗑 Waste -->
<td>
<div class="progress">
<div class="progress-bar bg-danger" style="width:<?php echo $row['waste_level'] ?? 0;?>%">
<?php echo $row['waste_level'] ?? 0;?>%
</div>
</div>
</td>

<!-- 👃 Smell -->
<td>
<?php
$s = $row['smell_level'] ?? 0;

if($s <= 30){
echo "<span class='badge bg-success'>ต่ำ {$s}%</span>";
}elseif($s <= 70){
echo "<span class='badge bg-warning text-dark'>กลาง {$s}%</span>";
}else{
echo "<span class='badge bg-danger'>สูง {$s}%</span>";
}
?>
</td>

<!-- ⚠️ Status -->
<td>
<?php
if(($row['waste_level'] ?? 0) >= 80){
echo "<span class='badge bg-danger'>เต็ม</span>";
}elseif(($row['battery'] ?? 0) <= 20){
echo "<span class='badge bg-warning text-dark'>แบตต่ำ</span>";
}else{
echo "<span class='badge bg-success'>ปกติ</span>";
}
?>
</td>

<td><?php echo $row['last_collected']; ?></td>
<td><?php echo $row['recorded_time']; ?></td>

<td>
<span class="badge bg-dark">
<?php echo $row['collection_round']; ?>
</span>
</td>

<td>
<a href="delete_bin.php?id=<?php echo $row['bin_id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('ลบถังนี้ใช่ไหม?')">
ลบ
</a>


</tr>

<?php } ?>

</tbody>
</table>

</div>

</div>

<script>
document.getElementById("search").addEventListener("keyup", function(){
let value = this.value.toLowerCase();

document.querySelectorAll("tbody tr").forEach(row=>{
row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
});
});
</script>

</body>
</html>
