#!/usr/bin/python3
 
from lib.lcd_i2c import lcd_i2c

class Lcd(object):
    
    lcd1 = None

    def __init__(self):
        # install smbus to scan i2c
        # sudo apt-get install python-smbus
        self.lcd1 = lcd_i2c.Lcd(0x27)

    def setLines(self, line0, line1, line2, line3):
        line0 = self.pad(line0, 20)
        line1 = self.pad(line1, 20)
        line2 = self.pad(line2, 20)
        line3 = self.pad(line3, 20)
        self.lcd1.lcd_display_string(line0, 1)
        self.lcd1.lcd_display_string(line1, 2)
        self.lcd1.lcd_display_string(line2, 3)
        self.lcd1.lcd_display_string(line3, 4)
    
    def setLine(self, line, data):
        data = self.pad(data, 20)
        self.lcd1.lcd_display_string(data, line)
    
    def pad(self, data, length):
        while (len(data) < length):
            data = data + " "
        return data

    def __del__(self):
        pass


