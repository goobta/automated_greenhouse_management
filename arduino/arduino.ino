// PingreenHouse Arduino Management Code
// www.github.com/agupta231
// May 26, 2017

const int bedPins[] = {
                        2, //Bed 1
                        3, //Bed 2
                        4, //Bed 3
                        5, //Bed 4
                        6, //Bed 5
                        7  //Bed 6
                      };

int timingArray[15][2];
int pressurized = false;

void setup() {
  Serial.begin(9600);

  for(int i = 0; i < sizeof(bedPins); i++) {
    pinMode(bedPins[i], OUTPUT);
  }
}

void parseSerial(String input) {}

void pressurizeSystem() {}

void loop() {
  if(Serial.available()) {
    if(parseSerial(Serial.readString())[0] == "water") {
        for(int i = 0; i < sizeof(timingArray), i++) {
          
        }
      
        if(!pressurized) {
          pressurizeSystem();
        }
    }
    
    delay(50);  
  }
}
