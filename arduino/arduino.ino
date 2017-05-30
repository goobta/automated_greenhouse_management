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

int jobs[15][2];
int queue[15][2];

int pressurized = false;

int activeJobs = 0;
int queuedJobs = 0;

void setup() {
  Serial.begin(115200);

  for(int i = 0; i < sizeof(bedPins); i++) {
    pinMode(bedPins[i], OUTPUT);
  }
}

void parseSerial(String input) {}

void pressurizeSystem() {}

void loop() {
  if(Serial.available()) {
    if(parseSerial(Serial.readString())[0] == "water") {
        for(int i = sizeof(timingArray) - 1; i >= 0, i--) {
          timingArray[i] = timingArray[i + 1];
        }

        // Add new job to the queue
    }

    if(queuedJobs > 0) {
        if(pressurized) {
            // reorganize jobs
            // add queuedJobs to activeJobs
        }
        else {
          pressurizeSystem();
        }
    }
    if(activeJobs > 0) {
      boolean reorganizeArray = false;

      for(int i = 0; i < activeJobs; i++) {
        if(millis() >= jobs[i][1]) {
          jobs[i][0] = 0;
          activeJobs--;
        }
      }

      if(reorganizeArray) {
        //reorganize the array
      }
    }
    delay(50);
  }
}
