# 🗑️ Smart Waste Bin IoT
> ระบบจัดการถังขยะอัจฉริยะแบบครบวงจร ผสานการทำงานระหว่างฮาร์ดแวร์เซนเซอร์ (IoT) และ Web Application เพื่อตรวจสอบสถานะของถังขยะแต่ละจุดแบบเรียลไทม์

---

## 🌟 ฟีเจอร์หลัก (Features)
- [x] **Hardware (IoT)**: อ่านค่าระดับขยะ, กลิ่น, และแบตเตอรี่ พร้อมส่งข้อมูลผ่าน WiFi / MQTT
- [x] **Web Dashboard**: ตรวจสอบสถานะและพิกัดของถังขยะทั้งหมดผ่านระบบเครือข่าย
- [x] **Management System**: ระบบเพิ่ม ลบ แก้ไข ข้อมูลถังขยะและจุดตั้งวาง
- [x] **Database**: จัดเก็บประวัติการเก็บขยะและข้อมูลเซนเซอร์ย้อนหลัง

---

## 🛠️ เทคโนโลยีที่ใช้ (Tech Stack)

| ส่วนประกอบ (Component) | เทคโนโลยี (Technology) |
| :--- | :--- |
| **Microcontroller** | ESP32 / Arduino |
| **Server** | Raspberry Pi |
| **Web Server** | LAMP Stack (Linux, Apache, MariaDB, PHP) |
| **Database GUI** | phpMyAdmin |
| **Frontend** | HTML, CSS |

---

## 📂 โครงสร้างโปรเจกต์ (Project Structure)
* `/hardware/` : โค้ดสำหรับเซนเซอร์และ Microcontroller
* `/web/` : โค้ด Web Application (หน้า Dashboard และระบบจัดการ)
* `smart_waste.sql` : ไฟล์โครงสร้างฐานข้อมูลสำหรับ Import
* `README.md` : เอกสารอธิบายโปรเจกต์

---
### 1. ตารางข้อมูลถังขยะ (Table: `bins`)
| ชื่อฟิลด์ (Field) | ชนิดข้อมูล (Type) | Length | คีย์ (Key) | คำอธิบาย (Description) | ตัวอย่างค่า (Example) |
| :--- | :--- | :---: | :---: | :--- | :--- |
| `bin_id` | INT | 100 | PK | รหัสลำดับถังขยะ | 1 |
| `bin_code` | VARCHAR | 20 | - | รหัสระบุถังขยะ | BIN-E2D5YO |
| `latitude` | DOUBLE | - | - | ตำแหน่งละติจูด | 13.7563 |
| `longitude` | DOUBLE | - | - | ตำแหน่งลองจิจูด | 100.5018 |
| `waste_type` | VARCHAR | 20 | - | ประเภทขยะ | ทั่วไป / รีไซเคิล / อันตราย |
| `capacity` | FLOAT | - | - | ขนาดความจุของถัง (กิโลกรัม) | 20.5 |


### 2. ตารางรอบการเก็บขยะ (Table: `collections`)
| ชื่อฟิลด์ (Field) | ชนิดข้อมูล (Type) | Length | คีย์ (Key) | คำอธิบาย (Description) | ตัวอย่างค่า (Example) |
| :--- | :--- | :---: | :---: | :--- | :--- |
| `collection_id` | VARCHAR | 20 | PK | รหัสรอบเก็บขยะ | R200 |
| `collected_time`| DATETIME | - | - | วัน-เวลาที่เก็บขยะ | 2026-04-17 10:30:00 |


### 3.  (Table: `bin_status`)

| ชื่อฟิลด์ (Field) | ชนิดข้อมูล (Type) | Length | คีย์ (Key) | คำอธิบาย (Description) | ตัวอย่างค่า (Example) |
| :--- | :--- | :---: | :---: | :--- | :--- |
| `status_id` | VARCHAR | 20 | PK | รหัสรายการบันทึกสถานะ | #1 |
| | `waste_level` | FLOAT | - | - | ระดับปริมาณขยะ (%) | 100 |
| `smell_level` | FLOAT | - | - | ระดับกลิ่น / ก๊าซ (%) | 17 |
| `battery` | FLOAT | - | - | ระดับแบตเตอรี่ (%) | 99.9 |
| `recorded_time` | DATETIME | - | - | วัน-เวลาที่บันทึกข้อมูล | 2026-04-18 11:00:00 |


###4 ข้อมูลสถานะและเซนเซอร์ (เพิ่มเติม)
| ชื่อฟิลด์ (Field) | ชนิดข้อมูล (Type) | Length | คีย์ (Key) | คำอธิบาย (Description) | ตัวอย่างค่า (Example) |
| :--- | :--- | :---: | :---: | :--- | :--- |
| `waste_level` | FLOAT | - | - | ระดับปริมาณขยะ (%) | 1 |
| `smell_level` | FLOAT | - | - | ระดับกลิ่น / ก๊าซ (%) | 100 |
| `battery` | FLOAT | - | - | ระดับแบตเตอรี่ (%) | 99.9 |
| `bin_id` | INT | 100 | FK | รหัสอ้างอิงถังขยะที่ส่งข้อมูลมา | 17 |

ผู้พัฒนา (Developer)
67136776 พงศ์พัทธ์ อาสนไพบูลย์
67096835 ภัทรดนัย บุญแจ่ม
67148749 จารุวรรณ รอนยุทธ
67096986 อรดา อินสองใจ
67107015 วิภาวดี พลอยสิทธิ์
Canva:https://canva.link/u2dqwwifrerd36q

