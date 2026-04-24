#include <WiFi.h>
#include <PubSubClient.h>

const char* WIFI_SSID = "Wokwi-GUEST";
const char* WIFI_PASS = "";
const char* MQTT_BROKER = "broker.emqx.io";
const int   MQTT_PORT   = 1883;
const char* TOPIC_SENSOR = "smart_waste/bins";

WiFiClient espClient;
PubSubClient mqttClient(espClient);

unsigned long lastMsg = 0;

void sendSensorData() {
  int waste_level = random(40, 100);
  int smell_level = random(20, 80);
  int battery = random(20, 100);

char payload[128];

// 2. เปลี่ยน %d เป็น %.2f ตรงส่วนของ battery
sprintf(payload, "{\"waste_level\":%d,\"smell_level\":%d,\"battery\":%d}", 
        waste_level, smell_level, battery);

  mqttClient.publish(TOPIC_SENSOR, payload);
  Serial.println("📤 SEND:");
  Serial.println(payload);
}

void connectWiFi() {
  Serial.print("Connecting WiFi");
  WiFi.begin(WIFI_SSID, WIFI_PASS);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nWiFi connected");
}

void connectMQTT() {
  while (!mqttClient.connected()) {
    String clientId = "esp32-client-" + String(random(0, 1000));
    Serial.print("Connecting MQTT...");
    if (mqttClient.connect(clientId.c_str())) {
      Serial.println("connected");
    } else {
      Serial.print("failed, rc=");
      Serial.print(mqttClient.state());
      delay(2000);
    }
  }
}

void setup() {
  Serial.begin(115200);
  randomSeed(micros());
  connectWiFi();
  mqttClient.setServer(MQTT_BROKER, MQTT_PORT);
}

void loop() {
  if (!mqttClient.connected()) {
    connectMQTT();
  }
  mqttClient.loop();

  unsigned long now = millis();
  if (now - lastMsg > 5000) {
    lastMsg = now;
    sendSensorData();
  }
}