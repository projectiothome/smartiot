
#include <ESP8266WiFi.h>

//byte mac[] = { 0x54, 0x34, 0x41, 0x30, 0x30, 0x31 }; 

WiFiClient client;
const char* ssid     = "XXXXX"; // your wifi name
const char* password = "XXXXXXXXXX"; // your wifi password

char server[] = "192.168.1.15"; // IP Adres (or name) of server to dump data to
int  interval = 5000;


#include <Keypad.h>
String pass = "5236";
String inputCode = "";
bool acceptKey = true;
int N=1; 
String url;

const byte ROWS = 4; //four rows
const byte COLS = 4; //four columns
//define the cymbols on the buttons of the keypads
char hexaKeys[ROWS][COLS] = {
  {'1','2','3','A'},
  {'4','5','6','B'},
  {'7','8','9','C'},
  {'*','0','#','D'}
};
byte rowPins[ROWS] = {13, 12, 14, 2}; //connect to the row pinouts of the keypad
byte colPins[COLS] = {0, 4, 5, 16}; //connect to the column pinouts of the keypad

//initialize an instance of class NewKeypad
Keypad customKeypad = Keypad( makeKeymap(hexaKeys), rowPins, colPins, ROWS, COLS); 

void setup(){
  Serial.begin(9600);
   Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  
  /* Explicitly set the ESP8266 to be a WiFi-client, otherwise, it by default,
     would try to act as both a client and an access-point and could cause
     network-issues with your other WiFi-devices on your WiFi-network. */
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  resetLocker();
}
  
void loop(){
  
  char customKey = customKeypad.getKey();
  if (customKey != NO_KEY ){
    if(customKey == '*'){
      inputCode = "";
    }
    else if(customKey == '#'){
      
     url = "/keyypad.php?";
     checkPinCode();
      Serial.print("connecting to ");
      Serial.println(server);
      //delay(5000);
      const int httpPort = 80;
      if (!client.connect(server, httpPort)) {
        Serial.println("connection failed");
        return;
      }
      Serial.println(url);
     client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + server + "\r\n" + 
               "Connection: close\r\n\r\n");
               unsigned long timeout = millis();
               while (client.available() == 0) {
                if (millis() - timeout > 5000) {
                  Serial.println(">>> Client Timeout !");
                  client.stop();
                  return;
                  }
               }
               while(client.available()){
                String line = client.readStringUntil('\r');// Read all the lines of the reply from server and print them to Serial
                Serial.print(line);
                }
    }
    else{
      inputCode += customKey;
      Serial.print("*");
    }
  }
  
}
void checkPinCode(){
  if(N<4){
  if(inputCode==pass){
    Serial.println("Password Authenticated");
    url += "log=UAGranted";
    
    acceptKey = false;
    inputCode = "";
  }
  else{
    Serial.println("Authentication failed");
    url += "log=UAFailed";
    N=N++;
    inputCode = "";
    }
   }
   else{
    Serial.println("check input");
   }
  }
 void resetLocker() 
{
  Serial.print("knock...");
  Serial.print("PIN:");
  inputCode = "";
}
