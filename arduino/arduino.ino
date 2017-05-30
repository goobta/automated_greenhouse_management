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

int jobs[20][2];
int queue[20][2];

int pressurized = false;

int activeJobs = 0;
int queuedJobs = 0;

const int overflowLimit = 4294967295;

void setup() {
  Serial.begin(115200);

  for(int i = 0; i < sizeof(bedPins); i++) {
    pinMode(bedPins[i], OUTPUT);
  }
}

void parseSerial(String input) {}

void pressurizeSystem() {}

void pressurizeSystem() {}

void determineEndTime(int startTime, int duration) {
  if(startTime + duration > overflowLimit) {
    return duration - (overflowLimit - startTime);
  }
  else {
    return startTime + duration;
  }
}

void loop() {
  if(Serial.available()) {
    input_array = parseSerial(Serial.readString();)

    if(input_array[0] == "water") {
        for(int i = queuedJobs; i > 0; i--) {
          queue[i] = queue[i - 1];
        }

        queue[0][0] = input_array[1];
        queue[0][1] = input_array[2];

        queuedJobs++;
    }

    if(queuedJobs > 0) {
        if(pressurized) {
          for(int i = 0; i < queuedJobs; i++) {
            jobs[activeJobs + i][0] = queue[i][0];
            jobs[activeJobs + i][1] = determineEndTime(millis(), queue[i][1]);

            digitalWrite(bedPins[queue[i][0] - 1], HIGH);
            queue[i][0] = -1;

            activeJobs++;
            queuedJobs--;
          }
        }
        else {
          pressurizeSystem();
        }
    }
    if(activeJobs > 0) {
      boolean reorganizeArray = false;

      for(int i = 0; i < activeJobs; i++) {
        if(millis() >= jobs[i][1]) {
          jobs[i][0] = -1;
          activeJobs--;
        }
      }

      if(reorganizeArray) {
        //reorganize the array
      }
    }

    if(activeJobs == 0 && queuedJobs == 0 && pressurized) {
      depressurizeSystem();
    }

    delay(50);
  }
}
