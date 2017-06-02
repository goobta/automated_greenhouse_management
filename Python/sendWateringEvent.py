import serial
import sys
import time

ser = serial.Serial('/dev/cu.usbmodem1421', 115200)

bed_number = sys.argv[1]
duration = sys.argv[2]

log_file = open("log_file_" + str(time.strftime("%H:%M:%S")) + ".txt", "a+")

log_file.write("water|" + str(bed_number) + "|" + str(duration) + "|")

ser.write("water|" + str(bed_number) + "|" + str(duration) + "|")

log_file.close()