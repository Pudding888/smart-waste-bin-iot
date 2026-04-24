<?php
include 'db.php';

$total = $conn->query("SELECT COUNT(*) as t FROM bins")->fetch_assoc()['t'];
$general = $conn->query("SELECT COUNT(*) as t FROM bins WHERE waste_type='ทั่วไป'")->fetch_assoc()['t'];
$recycle = $conn->query("SELECT COUNT(*) as t FROM bins WHERE waste_type='รีไซเคิล'")->fetch_assoc()['t'];
$wet = $conn->query("SELECT COUNT(*) as t FROM bins WHERE waste_type='เปียก'")->fetch_assoc()['t'];
$danger = $conn->query("SELECT COUNT(*) as t FROM bins WHERE waste_type='อันตราย'")->fetch_assoc()['t'];
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
body{
background:linear-gradient(120deg,#e0f2fe,#f8fafc);
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
border-radius:14px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
transition:0.3s;
}

.card:hover{
transform:translateY(-6px);
}

.bg-total{background:linear-gradient(45deg,#22c55e,#4ade80);color:white;}
.bg-general{background:linear-gradient(45deg,#10b981,#34d399);color:white;}
.bg-recycle{background:linear-gradient(45deg,#3b82f6,#60a5fa);color:white;}
.bg-wet{background:linear-gradient(45deg,#f59e0b,#fbbf24);color:white;}
.bg-danger{background:linear-gradient(45deg,#ef4444,#f87171);color:white;}
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

<h2 class="mb-4">Smart Waste Dashboard</h2>

<!-- 🎨 CARDS -->
<div class="row mb-4">

<div class="col-md-2" data-aos="zoom-in">
<div class="card p-3 bg-total">
<h6>ทั้งหมด</h6>
<h2 class="counter"><?php echo $total;?></h2>
</div>
</div>

<div class="col-md-2" data-aos="zoom-in">
<div class="card p-3 bg-general">
<h6>ทั่วไป</h6>
<h2 class="counter"><?php echo $general;?></h2>
</div>
</div>

<div class="col-md-2" data-aos="zoom-in">
<div class="card p-3 bg-recycle">
<h6>รีไซเคิล</h6>
<h2 class="counter"><?php echo $recycle;?></h2>
</div>
</div>

<div class="col-md-2" data-aos="zoom-in">
<div class="card p-3 bg-wet">
<h6>เปียก</h6>
<h2 class="counter"><?php echo $wet;?></h2>
</div>
</div>

<div class="col-md-2" data-aos="zoom-in">
<div class="card p-3 bg-danger">
<h6>อันตราย</h6>
<h2 class="counter"><?php echo $danger;?></h2>
</div>
</div>

</div>

<div class="row">

<!-- 📊 CHART -->
<div class="col-md-7" data-aos="fade-right">
<div class="card p-4">
<h5>สถิติประเภทขยะ</h5>
<canvas id="chart"></canvas>
</div>
</div>

<!-- 🧾 RIGHT SIDE -->
<div class="col-md-5" data-aos="fade-left">
<div class="card p-4">

<h5>กิจกรรมล่าสุด</h5>

<?php
$log = $conn->query("SELECT * FROM bins ORDER BY recorded_time DESC LIMIT 5");

while($row = $log->fetch_assoc()){
echo "<p>📍 ".$row['location']." - ".$row['waste_type']."</p>";
}
?>

<hr>

<h6>ถังล่าสุด</h6>

<table class="table">
<tr>
<th>ID</th>
<th>Location</th>
<th>Type</th>
</tr>

<?php
$recent = $conn->query("SELECT * FROM bins ORDER BY bin_id DESC LIMIT 5");

while($row = $recent->fetch_assoc()){
?>

<tr>
<td><?php echo $row['bin_id'];?></td>
<td><?php echo $row['location'];?></td>
<td><?php echo $row['waste_type'];?></td>
</tr>

<?php } ?>

</table>

</div>
</div>

</div>

</div>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init();</script>

<!-- 🔥 COUNTER -->
<script>
document.querySelectorAll('.counter').forEach(el=>{
let target = +el.innerText;
let count = 0;

let interval = setInterval(()=>{
count++;
el.innerText = count;

if(count >= target) clearInterval(interval);

},20);
});
</script>

<!-- 📊 CHART -->
<script>
new Chart(document.getElementById('chart'),{
type:'bar',
data:{
labels:["ทั่วไป","รีไซเคิล","เปียก","อันตราย"],
datasets:[{
data:[
<?php echo $general;?>,
<?php echo $recycle;?>,
<?php echo $wet;?>,
<?php echo $danger;?>
],
backgroundColor:["#10b981","#3b82f6","#f59e0b","#ef4444"]
}]
}
});
</script>

</body>
</html>
