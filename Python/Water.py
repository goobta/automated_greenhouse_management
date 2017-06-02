import sys
import time
import os
import glob
import RPi.GPIO as GPIO

outlet_pin = 3
pressure_prime = 10

bed_pins = [7, 11, 13, 15]

bed_number = int(sys.argv[1])
duration = int(sys.argv[2])

GPIO.setmode(GPIO.BOARD)
GPIO.setup(outlet_pin, GPIO.OUT)
GPIO.setup(bed_pins[bed_number - 1], GPIO.OUT)

open(os.path.dirname(os.path.realpath(__file__)) + "/id_files/" + str(bed_number) + ".txt", "a").close()

pressure_file = open(os.path.dirname(os.path.realpath(__file__)) + "/pressure.txt", "r+")
	
if pressure_file.readline() == "0":
	pressure_file.seak(0)
	pressure_file.write("1")
	pressure_file.truncate()

	GPIO.output(outlet_pin, True)
	time.sleep(pressure_prime)

GPIO.output(bed_pins[bed_number - 1], True)

time.sleep(duration * 60)

GPIO.output(bed_pins[bed_number - 1], False)

if(len(glob.glob(os.path.dirname(os.path.realpath(__file__)) + "/id_files/*")) == 1):
	GPIO.output(outlet_pin, False)

	with open(os.path.dirname(os.path.realpath(__file__)) + "/pressure.txt", "r+") as pressure_file:
		pressure_file.seak(0)
		pressure_file.write("0")
		pressure_file.truncate()

os.remove(os.path.dirname(os.path.realpath(__file__)) + "/id_files/" + str(bed_number) + ".txt")