<?php
include 'db.php';
$result = $conn->query("SELECT * FROM bins WHERE latitude IS NOT NULL");
?>

<!DOCTYPE html>
<html>
<head>
<title>Map</title>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<style>
body{
margin:0;
font-family:Arial;
background:#f4f6f9;
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

.content{
margin-left:240px;
padding:20px;
}

#map{
height:600px;
border-radius:12px;
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
<h2>แผนที่ถังขยะ</h2>
<div id="map"></div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

var map = L.map('map').setView([13.736717,100.523186],15);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
attribution:'© OpenStreetMap'
}).addTo(map);

function getColor(type){
if(type === "อันตราย") return "red";
if(type === "เปียก") return "orange";
if(type === "รีไซเคิล") return "blue";
return "green";
}

<?php while($row = $result->fetch_assoc()){ ?>

var icon = L.icon({
iconUrl:"https://maps.google.com/mapfiles/ms/icons/"+getColor("<?php echo $row['waste_type'];?>")+"-dot.png",
iconSize:[32,32]
});

L.marker([
<?php echo $row['latitude'];?>,
<?php echo $row['longitude'];?>
],{icon:icon}).addTo(map)
.bindPopup("<b><?php echo $row['location'];?></b><br><?php echo $row['waste_type'];?>");

<?php } ?>

</script>

</body>
</html>
