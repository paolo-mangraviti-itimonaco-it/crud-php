/*
  Basato sullo sketch :
  by Tom Igoe

  Find the full UNO R4 WiFi Network documentation here:
  https://docs.arduino.cc/tutorials/uno-r4-wifi/wifi-examples#wi-fi-web-client
 */


#include "WiFiS3.h"

#define SECRET_SSID "---"
#define SECRET_PASS "---"

char ssid[] = SECRET_SSID;        // your network SSID (name)
char pass[] = SECRET_PASS;    // your network password (use for WPA, or use as key for WEP)
int keyIndex = 0;            // your network key index number (needed only for WEP)

int status = WL_IDLE_STATUS;
// if you don't want to use DNS (and reduce your sketch size)
// use the numeric IP instead of the name for the server:
IPAddress server(192,168,76,199);  // numeric IP for Google (no DNS)
//char server[] = "";    // name address for Google (using DNS)

// Initialize the Ethernet client library
// with the IP address and port of the server
// that you want to connect to (port 80 is default for HTTP):
WiFiClient client;

/* -------------------------------------------------------------------------- */
void setup() {
/* -------------------------------------------------------------------------- */  
  //Initialize serial and wait for port to open:
  Serial.begin(9600);
  
  // attempt to connect to WiFi network:
  while (status != WL_CONNECTED) {
    Serial.print("Attempting to connect to SSID: ");
    Serial.println(ssid);
    // Connect to WPA/WPA2 network. Change this line if using open or WEP network:
    status = WiFi.begin(ssid, pass);
     
    // wait 10 seconds for connection:
    delay(10000);
  }
 
}


/* -------------------------------------------------------------------------- */
void loop() {

    if (client.connect(server, 80)) {
      Serial.println("connected to server");
      // Make a HTTP request:
      client.println("GET /crud/ws-002.php?lat=8&lon=12&v=250&iddispositivo=650 HTTP/1.1");
      client.println("Host: SK Arduino uno R4");
      client.println("Connection: close\r\n");
      client.println();
      while (client.available()) {
        char c = client.read(); Serial.print(c);
      }
      client.stop();
    }
    else
      Serial.println("not connected to server");
    
    delay(20000);
  }
  
