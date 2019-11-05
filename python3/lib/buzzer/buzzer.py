#!/usr/bin/python3
import RPi.GPIO as gpio
import time
from multiprocessing import Process

class Buzzer(object):
    pin = 0
    frequency = 0
    duration = 0
    pwm = None

    def __init__(self, pin, frequency, duration):
        if (pin != None):
            self.pin = pin
        if (frequency != None):
            self.frequency = frequency
        if (duration != None):
            self.duration = duration

        gpio.setmode(gpio.BCM)
        gpio.setup(self.pin, gpio.OUT)
        #self.pwm = gpio.PWM(self.pin, self.frequency)

        print("__init__ : buzzer")

    def prepare(self, args):
        # self.pwm.start(50)
        # time.sleep(self.duration)
        # self.pwm.stop()
        # time.sleep(self.duration)
        rate = 1 / self.frequency
        count = 0
        while (self.duration > count):
            gpio.output(self.pin, gpio.HIGH)
            time.sleep(rate)
            gpio.output(self.pin, gpio.LOW)
            time.sleep(rate)
            count = count + (rate * 2)

    def play(self):
        process = Process(target=self.prepare, args=(self, ))
        process.start()
        process.join()
       

    def __del__(self):
        gpio.cleanup(self.pin)
