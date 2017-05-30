// PingreenHouse Arduino Management Code
// www.github.com/agupta231
// May 26, 2017

// User Editable Flags
const int bedPins[] = {
                        2, //Bed 1
                        3, //Bed 2
                        4, //Bed 3
                        5, //Bed 4
                        6, //Bed 5
                        7  //Bed 6
                      };

const int overflowLimit = 4294967295;
const int pressure_flag = 40;

// Variables used by the system
int jobs[20][2];
int queue[20][2];

int activeJobs = 0;
int queuedJobs = 0;

int pressurized = false;
int pressure = 0;

void setup() {
  Serial.begin(115200);

  for(int i = 0; i < sizeof(bedPins); i++) {
    pinMode(bedPins[i], OUTPUT);
  }
}

void parseSerial(String input) {
  char separator = "|";

  String valuesArray[3];
  int currentArrayIndex = 0;

  int lastIndex = 0;

  for(int i = 0; i < input.length(); i++) {
    if(input.charAt(i) == separator) {
        valuesArray[currentArrayIndex] = input.substring(lastIndex, i);

        currentArrayIndex++;
        lastIndex = i + 1;

        if(currentArrayIndex == 2) {
          break;
        }
    }
  }

  return valuesArray;
}

void pressurizeSystem(int inputPressure) {}

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

        queue[0][0] = input_array[1].toInt();
        queue[0][1] = input_array[2].toInt();

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
          pressure = pressure_flag;
        }
    }
    if(activeJobs > 0) {
      boolean reorganizeArray = false;

      for(int i = 0; i < activeJobs; i++) {
        if(millis() >= jobs[i][1]) {
          digitalWrite(jobs[i][0] - 1, LOW);

          jobs[i][0] = -1;
          activeJobs--;

          reorganizeArray = true;
        }
      }

      if(reorganizeArray) {
        for(int i = 0; i < sizeof(jobs) - 1; i++) {
          if(jobs[i][0] == -1) {
            for(int j = i + 1; j < sizeof(jobs) - 1; j++) {
              jobs[i] = jobs[j];
              jobs[j] = -1;

              break;
            }
          }
        }
      }
    }

    if(activeJobs == 0 && queuedJobs == 0 && pressurized) {
      pressure = 0;
    }

    pressurizeSystem(pressure);
    delay(50);
  }
}
