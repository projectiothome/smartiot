# smartiot
This is a project for distributed home Automation for controlling and monitoring various devices with Android app based on IoT.
Requirements

Hardware :1. NodeMCU v1.0 also known as ESP8266-12E
          2. Sensors DHT11, RFID reader - card, number keypad 4x4
Software : Arduino IDE
          Android IDE

We used PHP-mysql for maintenance of database. Android- volley framework to build <a href="https://github.com/projectiothome/AndroidApp">android app</a>.

# Abstract
The advent of Internet of Things, made Internet to get deep rooted into every technological innovation to be smart, intelligent, and easy accessibility. Likewise are the home automation devices. Conventional home automation is based on centralised control. Such systems suffer portability, flexibility and extensibility. To overcome the drawbacks, a distributed control in home automation with IoT is proposed. The proposal is visualized by means of client server architecture using LAMP server setup on a raspberry pi, an android app and arduino, NodeMCUs as clients. MFRC522 RFID reader, keypad, DHT-11 sensor, are at the physical level. The proposal is implemented for monitoring and controlling devices with a client-server architecture in the home and also maintain data logs for future needs.

# Architectural design
![Architecture](https://github.com/projectiothome/smartiot/blob/master/images/final_architecture.png)

# Implementation Logic for each application Component
1. RFID client flow diagram\
![RFID](https://github.com/projectiothome/smartiot/blob/master/images/RFID_client.png)

2. Switching on/off client flow diagram\
![Switch](https://github.com/projectiothome/smartiot/blob/master/images/Switch_client.png)

3. Temperature-Humidity client flow digaram\
![DHT11](https://github.com/projectiothome/smartiot/blob/master/images/Temp_Humi_client.png)

4. Locker access client flow diagram\
![Locker](https://github.com/projectiothome/smartiot/blob/master/images/Keypad_client.png)

# Android App 
Android Homescreen</br>
![AndroidApp](https://github.com/projectiothome/smartiot/blob/master/images/Screenshot_1522696612.png)

RFID:
![ARFID](https://github.com/projectiothome/smartiot/blob/master/images/Screenshot_1522697259.png)

Switching on/off:
![Aswitch](https://github.com/projectiothome/smartiot/blob/master/images/Screenshot_1523233779.png)

Temperature-Humidity:
![ADHT](https://github.com/projectiothome/smartiot/blob/master/images/Screenshot_1522698689.png)

Locker access:
![AKeypad](https://github.com/projectiothome/smartiot/blob/master/images/Screenshot_1522697284.png)







