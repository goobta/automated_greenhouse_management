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

const int outletPin = 10;

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

  for (int i = 0; i < sizeof(bedPins); i++) {
    pinMode(bedPins[i], OUTPUT);
  }
}

void parseSerial(String input, String valuesArray[]) {
  char separator = '|';

  int currentArrayIndex = 0;
  int lastIndex = 0;

  for (int i = 0; i < input.length(); i++) {
    if (input.charAt(i) == separator) {
      valuesArray[currentArrayIndex] = input.substring(lastIndex, i);

      currentArrayIndex++;
      lastIndex = i + 1;

      if (currentArrayIndex == 3) {
        break;
      }
    }
  }
}


void pressurizeSystem(int inputPressure) {}

int determineEndTime(int duration) {
  unsigned long startTime = millis();

  Serial.println(startTime);
  Serial.println(duration);

  if (startTime + duration > overflowLimit) {
    Serial.println(duration - (overflowLimit - startTime));
    return duration - (overflowLimit - startTime);
  }
  else {
    Serial.println(startTime + duration);
    return startTime + duration;
  }
}

void loop() {
  if (Serial.available() > 0) {
    String inputString = Serial.readString();
    String input_array[] = {"vape", "", ""};

    parseSerial(inputString, input_array);

    if (input_array[0] == "water") {
      for (int i = queuedJobs; i > 0; i--) {
        queue[i][0] = queue[i - 1][0];
        queue[i][1] = queue[i - 1][1];
      }

      queue[0][0] = input_array[1].toInt();
      queue[0][1] = input_array[2].toInt();

      queuedJobs++;
    }
    else if (input_array[0] == "pressure") {
      pressurized = true;

      delay(50);
    }
  }

  if (queuedJobs > 0) {
    if (pressurized) {
      for (int i = 0; i < queuedJobs; i++) {
        jobs[activeJobs + i][0] = queue[i][0];
        jobs[activeJobs + i][1] = determineEndTime(queue[i][1]);

        digitalWrite(bedPins[queue[i][0] - 1], HIGH);
        queue[i][0] = -1;
      }
      activeJobs += queuedJobs;
      queuedJobs = 0;
    }
    else {
      pressure = pressure_flag;
    }
  }
  if (activeJobs > 0) {
    boolean reorganizeArray = false;

    for (int i = 0; i < activeJobs; i++) {
      if (millis() >= jobs[i][1]) {
        digitalWrite(bedPins[jobs[i][0] - 1], LOW);

        jobs[i][0] = -1;
        activeJobs--;

        reorganizeArray = true;
      }
    }

    if (reorganizeArray) {
      for (int i = 0; i < sizeof(jobs) / sizeof(jobs[0]) - 1; i++) {
        if (jobs[i][0] == -1) {
          for (int j = i; j < sizeof(jobs) / sizeof(jobs[0]) - 1; j++) {
            jobs[j][0] = jobs[j + 1][0];
            jobs[j][1] = jobs[j + 1][1];
          }

          jobs[sizeof(jobs) / sizeof(jobs[0]) - 1][0] = -1;
          jobs[sizeof(jobs) / sizeof(jobs[0]) - 1][1] = 0;
        }
      }
    }
  }

  if (activeJobs == 0 && queuedJobs == 0 && pressurized) {
    pressure = 0;
  }

  pressurizeSystem(pressure);
  delay(50);
}
