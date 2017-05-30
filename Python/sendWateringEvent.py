import serial
import sys

ser = serial.Serial('/dev/cu.usbmodem1421', 115200)

bed_number = sys.argv[0]
duration = sys.argv[1]

ser.write("test")