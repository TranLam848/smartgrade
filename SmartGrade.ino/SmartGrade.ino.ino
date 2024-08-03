//mqtt connect
#include <WiFi.h>
#include <RTClib.h>
#include <LiquidCrystal_I2C.h>
#include "DHT.h"
#include "Stepper.h"
#include<Arduino_JSON.h>
#include <HTTPClient.h>
WiFiServer server(80);
#include <WebServer.h>
const int stepsPerRevolution = 20;
Stepper myStepper(stepsPerRevolution,2, 18, 19, 23);

String URL = "http://ptudung.000webhostapp.com/insert.php";
// Tạo ID ngẫu nhiên tại: https://www.guidgen.com/
const char * MQTT_ID = "";
int Port = 1883;

WiFiClient espClient;
HTTPClient httpClient;

String postData = "";
String payload = "";

const int DHTPIN = 13;
const int DHTTYPE = DHT22;
int motionSensor = 12;
int ledMotion = 14;
LiquidCrystal_I2C lcd(0x27, 20, 4);
DHT dht(DHTPIN, DHTTYPE);

const int ledPin = 5;

int LDR_PIN = 33;
const float gama = 0.7;
const float rl10 = 50;

RTC_DS1307 rtc;
int t = 0;
int h = 0;

int LED_LDR = 26;

const int trigPin = 32;
const int echoPin = 35;
#define SOUND_SPEED 0.034
long duration;
float distanceCm;

void setup() {
  dht.begin();
  Wire.begin(15, 4);
  lcd.init();
  lcd.backlight();
  pinMode(motionSensor, INPUT);
  pinMode(ledMotion, OUTPUT);
  pinMode(LED_LDR, OUTPUT);
  pinMode(LDR_PIN, INPUT);

  myStepper.setSpeed(60);

  Serial.begin(115200);
  WIFIConnect();
  pinMode(ledPin, OUTPUT);
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);

}
//
void WIFIConnect() {
  Serial.println("Connecting to SSID: Wokwi-GUEST");
  WiFi.begin("Wokwi-GUEST", "");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("WiFi connected");
  Serial.print(", IP address: ");
  Serial.println(WiFi.localIP());
}

//
void DHT22sensor() {
  h = dht.readHumidity();
  t = dht.readTemperature();
  lcd.setCursor(0, 0);
  lcd.print("Nhiet do: ");
  lcd.println(t);
  lcd.setCursor(0, 1);
  lcd.print(" Do am: ");
  lcd.println(h);
  Serial.print("Nhiet do: ");
  Serial.println(t);
  Serial.print("Do am: ");
  Serial.println(h);
}
int MesageHuman = 0;
void Motionsensor() {
  int motionValue = digitalRead(motionSensor);
  if (motionValue == HIGH) {
    MesageHuman = 1;
    Serial.println("Motion detected!");
    digitalWrite(ledMotion, HIGH);
    lcd.setCursor(4,0);
    lcd.print("Co nguoi !");
  } else {
    MesageHuman = 0;
    digitalWrite(ledMotion, LOW);
    lcd.setCursor(4,0);
    lcd.print("Khong co nguoi !");
  }
  delay(1000);
}
int analogValue = 0;
int ttas = 0;
void LDRsensor() {
  int nilaiLDR = analogRead(LDR_PIN);
  nilaiLDR = map(nilaiLDR, 4095, 0, 1024, 0); 
  float voltase = nilaiLDR / 1024.*5;
  float resistansi = 2000 * voltase / (1-voltase/5);
  float lux = pow(rl10*1e3*pow(10,gama)/resistansi,(1/gama));
  Serial.print("lux = ");
  Serial.println(lux);
  if (lux < 20) {
    Serial.print("Dark!");
    digitalWrite(LED_LDR,HIGH);
    ttas=0;
  } else {
    Serial.print("Light1  ");
    digitalWrite(LED_LDR,LOW);
    ttas=1;
  }

  lcd.setCursor(0, 1);
  Serial.print("Lux: ");
  Serial.print(nilaiLDR);
  Serial.print("          ");
  delay(1000);
}

void RTCsensor() {
  // DateTime time = rtc.now();
  // //Full Timestamp
  // Serial.println(String("DateTime::TIMESTAMP_FULL:\t") + time.timestamp(DateTime::TIMESTAMP_FULL));
  // //Date Only
  // Serial.println(String("DateTime::TIMESTAMP_DATE:\t") + time.timestamp(DateTime::TIMESTAMP_DATE));
  // //Full Timestamp
  // Serial.println(String("DateTime::TIMESTAMP_TIME:\t") + time.timestamp(DateTime::TIMESTAMP_TIME));
  // Serial.println("\n");
}
int tb =0;
void HCSensor() {
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  distanceCm = duration * SOUND_SPEED / 2;
  lcd.setCursor(0, 2);
  lcd.print("Distance(cm):");
  lcd.println(round(distanceCm));
  Serial.println(distanceCm);
  if (distanceCm >= 200)
  {
    tb=0;
    Serial.println(tb);
  }
  else
  {
    tb=1;
    Serial.println(tb);
  }
}

//
void loop() {
  DHT22sensor();
  Motionsensor();
  HCSensor();
  LDRsensor();

  
  String postData = "temperature=" + String(t) + "&humidity=" + String(h) +"&SR04=" +String(tb) +"&PIR=" +String(MesageHuman)+"&LDR=" +String(ttas);
  HTTPClient http;
  http.begin(URL);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  int httpCode = http.POST(postData);

  String payload = http.getString();

  Serial.print("URL : "); Serial.println(URL);
  Serial.print("Data: "); Serial.println(postData);
  Serial.print("httpCode: "); Serial.println(httpCode);
  Serial.print("payload : "); Serial.println(payload);
  Serial.println("--------------------------------------------------");
  //
  String postDataled = "";
    HTTPClient httpled;
    httpled.begin("http://ptudung.000webhostapp.com/dieukhien.php");
    httpled.addHeader("Content-Type", "application/x-www-form-urlencoded");

    int httpCodeled = httpled.POST(postDataled);

    String payloadled = httpled.getString();
  String postDatamotor = "";
    HTTPClient httpmt;
    httpmt.begin("http://ptudung.000webhostapp.com/ControlMotor.php");
    httpmt.addHeader("Content-Type", "application/x-www-form-urlencoded");

    int httpCodemt = httpmt.POST(postDatamotor);

    String payloadmt = httpmt.getString();

    Serial.print("Dataled: "); Serial.println(postDataled);
    Serial.print("httpCodeled: "); Serial.println(httpCodeled);
    Serial.print("payloadled : "); Serial.println(payloadled);
    Serial.println("--------------------------------------------------");

    JSONVar myObject = JSON.parse(payloadled);
    JSONVar myObject1 = JSON.parse(payloadmt);
    if (JSON.typeof(myObject) == "undefined") {
      Serial.println("Parsing input failed!");
      Serial.println("---------------");
      return;
    }

    if (myObject.hasOwnProperty("trangthai")) {
      Serial.print("myObject[\"trangthai\"] = ");
      Serial.println(myObject["trangthai"]);

    }
    if (strcmp(myObject["trangthai"], "1") == 0)
    {
      digitalWrite(ledPin, HIGH);
    }
    if (strcmp(myObject["trangthai"], "0") == 0)
    {
      digitalWrite(ledPin, LOW);
    }
    //điều khiển motor
    if (myObject1.hasOwnProperty("trangthaimt")) {
      Serial.print("myObject1[\"trangthaimt\"] = ");
      Serial.println(myObject1["trangthaimt"]);

    }
    if (strcmp(myObject1["trangthaimt"], "1") == 0)
    {
      myStepper.step(-100);
    }
    if (strcmp(myObject1["trangthaimt"], "0") == 0)
    {
      myStepper.step(0);
      digitalWrite(2, LOW); // Tắt nguồn động cơ bước
      digitalWrite(18, LOW);
      digitalWrite(19, LOW);
      digitalWrite(23, LOW);
      
    }
}
