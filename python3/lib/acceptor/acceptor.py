#!/usr/bin/python3
import RPi.GPIO as gpio
import time

class Acceptor(object):
    pin = 26
    amount = 0
    value = 1
    activeState = False
    trigger = None

    def __init__(self, pin=None, value=None, activeState=None, trigger=None):
        if (pin != None):
            self.pin = pin
        if (value != None):
            self.value = value
        if (activeState != None):
            self.activeState = activeState
        if (trigger != None):
            self.trigger = trigger

        gpio.setmode(gpio.BCM)
        if (self.activeState == True):
            gpio.setup(self.pin, gpio.IN, pull_up_down=gpio.PUD_DOWN)
        elif (self.activeState == False):
            gpio.setup(self.pin, gpio.IN, pull_up_down=gpio.PUD_UP)

        print("__init__ : acceptor")

    def attach(self, callback):
        self.trigger = callback

    def begin(self):
        if (self.activeState == True):
            gpio.add_event_detect(self.pin, gpio.RISING,
                                  callback=self.event, bouncetime = 10)

        elif (self.activeState == False):
            gpio.add_event_detect(self.pin, gpio.FALLING,
                                  callback=self.event, bouncetime = 10)
        

    def event(self, args):
        #invalidate pulses smaller than 10ms 
        for index in range(10):
            if (gpio.input(self.pin) != self.activeState): return
            #delay 1ms
            time.sleep(0.001)
    
        if (self.trigger != None):
            self.trigger()

        self.amount += self.value

    def stop(self):
        gpio.remove_event_detect(self.pin)

    def __del__(self):
        gpio.cleanup(self.pin)
