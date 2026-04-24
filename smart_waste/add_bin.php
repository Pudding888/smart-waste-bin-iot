<?php
include 'db.php';

// 🔥 ฟังก์ชันสุ่มรหัส
function generateCode($prefix = '', $length = 6){
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $code = $prefix;
    for($i=0; $i<$length; $i++){
        $code .= $chars[rand(0, strlen($chars)-1)];
    }
    return $code;
}

if(isset($_POST['save'])){
    do {
        $code = generateCode('BIN-');
        $check = $conn->query("SELECT bin_id FROM bins WHERE bin_code='$code'");
    } while($check->num_rows > 0);

    $round = generateCode('ROUND-');
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $capacity = !empty($_POST['capacity']) ? floatval($_POST['capacity']) : 0;

    // 📍 สุ่มพิกัดให้อยู่ในเขตประเทศไทย (ประมาณกรุงเทพฯ และปริมณฑล)
// Latitude (ไทยประมาณ 13.0 - 14.0)
$lat = rand(13500, 13900) / 1000; 

// Longitude (ไทยประมาณ 100.0 - 101.0)
$lng = rand(100400, 100600) / 1000;

    $battery = floatval($_POST['battery']);
    $waste = intval($_POST['waste_level']);
    $smell = intval($_POST['smell_level']);
    $collect = !empty($_POST['last_collected']) ? $_POST['last_collected'] : NULL;

    $conn->query("INSERT INTO bins
    (bin_code, location, waste_type, capacity, collection_round, latitude, longitude, last_collected)
    VALUES
    ('$code', '$location', '$type', '$capacity', '$round', '$lat', '$lng', '$collect')");

    $bin_id = $conn->insert_id;

    $conn->query("INSERT INTO bin_status
    (bin_id, waste_level, smell_level, battery, recorded_time)
    VALUES
    ('$bin_id', '$waste', '$smell', '$battery', NOW())");

    header("Location: bins.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Add Bin - Smart Waste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(120deg,#e0f2fe,#f8fafc); font-family: Arial; min-height: 100vh; }
        .sidebar { width: 220px; height: 100vh; position: fixed; background: #1f2937; color: white; padding: 20px; }
        .sidebar a { display: block; color: white; margin: 10px 0; text-decoration: none; }
        .sidebar a:hover { color: #38bdf8; }
        .content { margin-left: 240px; padding: 30px; }
        .card { border: none; border-radius: 14px; box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
        .form-label { font-weight: bold; color: #4b5563; }
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>เพิ่มถังขยะใหม่</h2>
        <span id="mqtt-status" class="badge bg-secondary">กำลังเชื่อมต่อ MQTT...</span>
    </div>

    <div class="card p-4">
        <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">ชื่อสถานที่</label>
                    <input class="form-control" name="location" placeholder="เช่น สวนสาธารณะ" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">ประเภทขยะ</label>
                    <select class="form-control" name="type">
                        <option value="ทั่วไป">ขยะทั่วไป</option>
                        <option value="รีไซเคิล">ขยะรีไซเคิล</option>
                        <option value="เปียก">ขยะเปียก</option>
                        <option value="อันตราย">ขยะอันตราย</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">ความจุถัง (กิโลกรัม)</label>
                    <input type="number" step="0.1" class="form-control" name="capacity">
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label">เก็บขยะล่าสุดเมื่อ</label>
                    <input type="datetime-local" class="form-control" name="last_collected">
                </div>
            </div>

            <hr>
            <h5 class="text-primary mb-3">ข้อมูลจาก Wokwi (Real-time)</h5>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">ระดับขยะ (%)</label>
                    <input type="number" class="form-control" name="waste_level" id="waste_level" required readonly style="background-color: #f0fdf4;">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">ระดับกลิ่น (%)</label>
                    <input type="number" class="form-control" name="smell_level" id="smell_level" required readonly style="background-color: #f0fdf4;">
                </div>
               <div class="col-md-4 mb-3">
    <label class="form-label">แบตเตอรี่ (%)</label>
    <input type="number" step="0.01" class="form-control" name="battery" id="battery" required readonly style="background-color: #f0fdf4;">
</div>
            </div>

            <button type="submit" name="save" class="btn btn-primary btn-lg w-100 mt-2">บันทึก</button>
        </form>
    </div>
</div>

<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
<<script>
    // ใช้พอร์ต 8083 สำหรับ WebSocket
    const brokerUrl = 'ws://broker.emqx.io:8083/mqtt';
    const topicName = 'smart_waste/bins';
    const statusBadge = document.getElementById('mqtt-status');

    // สร้าง Client
    const client = mqtt.connect(brokerUrl, { 
        clientId: 'test_client_' + Math.random().toString(16).substr(2, 8),
        keepalive: 60
    });

    client.on('connect', () => {
        console.log("✅ เชื่อมต่อ Broker สำเร็จ!");
        statusBadge.innerText = "🟢 ออนไลน์: กำลังรอข้อมูล...";
        statusBadge.className = "badge bg-success";
        client.subscribe(topicName, (err) => {
            if (!err) console.log("📡 Subscribe สำเร็จที่ Topic:", topicName);
        });
    });

    client.on('message', (topic, message) => {
    const payload = message.toString();
    console.log("📥 Received:", payload);
    
    try {
        const data = JSON.parse(payload);
        
        // รับแค่ 3 ค่านี้พอ
        if (data.waste_level !== undefined) document.getElementById('waste_level').value = data.waste_level;
        if (data.smell_level !== undefined) document.getElementById('smell_level').value = data.smell_level;
        if (data.battery !== undefined) document.getElementById('battery').value = data.battery;

    } catch (e) {
        console.error("JSON Error:", e);
    }
});

    client.on('error', (err) => {
        console.error("❌ MQTT Error:", err);
        statusBadge.innerText = "🔴 เชื่อมต่อไม่ได้";
    });
</script>
</body>
</html>