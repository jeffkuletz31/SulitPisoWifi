#!/usr/bin/python3

import time

class Helper(object):
    
    def __init__(self):
        pass

    def __del__(self):
        pass

    @staticmethod
    def datetimeToString(value):
        return value.strftime('%Y-%m-%d %H:%M:%S')

    def timeToString(value):
        return time.strftime('%H:%M:%S', value)

    def intToDatetime(time):
        return 1 #time.strftime('%Y%m%d %H%M%S')