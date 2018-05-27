//  This sketch sends data via HTTP GET requests to xxx.xxx.xxx.xxx put your own webserver or IP
#include <Arduino.h>
#include <ArduinoJson.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

#define USE_SERIAL Serial
char* payload[]={}; 

//String filename = "/S/";

#define Green 16
#define Yellow 0
 
const char* ssid     = "xxxxxxx"; // your wifi
const char* password = "xxxxxxxxxxxx"; // your password

const char* host = "192.168.1.15"; // your server ip


void setup() {
  pinMode(Green, OUTPUT);
  pinMode(Yellow, OUTPUT);
  Serial.begin(115200);
  delay(10);

  // We start by connecting to a WiFi network

  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

int value = 0;

void loop() {  
  delay(300);
  ++value;

  Serial.print("connecting to ");
  Serial.println(host);
  
  // Use WiFiClient class to create TCP connections
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }
  
  HTTPClient http;
  USE_SERIAL.print("[HTTP] begin...\n");
        // configure traged server and url
        //http.begin("https://192.168.1.12/test.html", "7a 9c f4 db 40 d3 62 5a 6e 21 bc 5c cc 66 c8 3e a1 45 59 38"); //HTTPS
        http.begin("http://wwww.sandiot.xyz/appliance.txt"); //HTTP
        
        USE_SERIAL.print("[HTTP] GET...\n");
        // start connection and send HTTP header
        int httpCode = http.GET();

        // httpCode will be negative on error
        if(httpCode > 0) {
            // HTTP header has been send and Server response header has been handled
            USE_SERIAL.printf("[HTTP] GET... code: %d\n", httpCode);

            // file found at server
            if(httpCode == HTTP_CODE_OK) {
                String payload = http.getString();
                StaticJsonBuffer<200> jsonBuffer;
                // Step 2: Deserialize the JSON string
                //
                JsonObject& root = jsonBuffer.parseObject(payload);

                if (!root.success())
                  {
                  Serial.println("parseObject() failed");
                  return;
                 }
              // Step 3: Retrieve the values

              const char* app   = root["App"];
              const char* state   = root["State"];
              USE_SERIAL.println(app);
              USE_SERIAL.println(state);
              if (strcmp(app, "light1")  == 0) {
                
                if (strcmp(state, "on")  == 0) {
                  digitalWrite(Yellow,HIGH);
                  }
                  else if(strcmp(state, "off")  == 0){
                     digitalWrite(Yellow, LOW);
                    }
              }
              else if (strcmp(app, "light2")  == 0) {
               if (strcmp(state, "on")  == 0) {
                digitalWrite(Green,HIGH);
                  }
                  else if(strcmp(state, "off")  == 0){
                    digitalWrite(Green,LOW);
                     
                    }
                
              } 
              else
              {
                Serial.println("Invalid Data input");
                }
              
            }
        } else {
            USE_SERIAL.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
        }

        http.end();
        
}


