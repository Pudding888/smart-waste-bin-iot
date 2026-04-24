# 🗑️ Smart Waste Bin IoT (ระบบถังขยะอัจฉริยะ)

โปรเจกต์ระบบจัดการถังขยะอัจฉริยะแบบครบวงจร ที่ผสานการทำงานระหว่างฮาร์ดแวร์เซนเซอร์ (IoT) และ Web Application เพื่อตรวจสอบสถานะของถังขยะแต่ละจุดแบบเรียลไทม์ 

## 🌟 ฟีเจอร์หลัก (Features)
* **Hardware (IoT):** อ่านค่าระดับขยะ, กลิ่น, และแบตเตอรี่ ส่งข้อมูลผ่าน WiFi
* **Web Dashboard:** ตรวจสอบสถานะและพิกัดของถังขยะทั้งหมดผ่านระบบเครือข่าย
* **Management System:** ระบบเพิ่ม ลบ แก้ไข ข้อมูลถังขยะและจุดตั้งวาง
* **Database:** จัดเก็บประวัติการเก็บขยะและข้อมูลเซนเซอร์ย้อนหลัง

## 📂 โครงสร้างโปรเจกต์ (Project Structure)
- `/hardware/` : โค้ดสำหรับเซนเซอร์และ Microcontroller (C/C++)
- `/web/` : โค้ด Web Application และ UI (PHP, CSS, HTML)
- `smart_waste.sql` : ไฟล์โครงสร้างฐานข้อมูล (Exported SQL)

## 🛠️ เทคโนโลยีที่ใช้ (Tech Stack)
* **Microcontroller:** ESP32 / Arduino
* **Server:** Raspberry Pi
* **Web Server:** LAMP Stack (Linux, Apache, MariaDB/MySQL, PHP)
* **Database Management:** phpMyAdmin

## 👤 ผู้พัฒนา (Developer)
พงศ์พัทธ์ อาสนไพบูลย์,จารุวรรณ รอนยุทธ,อรดา อินสองใจ,วิภาวดี พลอยสิทธิ์,ภัทรดนัย บุญแจ่ม
