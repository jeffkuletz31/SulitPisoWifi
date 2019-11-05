#!/usr/bin/python3
from lib.lcd_i2c import lcd
from lib.buzzer import buzzer
from lib.acceptor import acceptor
from lib.button import button

from lib.helper import helper

#database
#sudo pip3 install pymysql
from lib.classes import amount
from lib.classes import status
from lib.classes import accesstype
from lib.classes import access


import datetime, time, subprocess

import RPi.GPIO as gpio


import random, string

def generate(value):
    letters = string.ascii_lowercase
    return ''.join(random.choice(letters) for i in range(value))

# sudo apt-get install python3-pip
lcd1 = lcd.Lcd()
buzzer1 = buzzer.Buzzer(13, 1900, 0.05)
acceptor1 = acceptor.Acceptor(26, 1, False)
button1 = button.Button( 19, False)

amount1 = amount.Amount()

externalIp = subprocess.check_output(["hostname", "-I"]).split()[0]
internalIp = subprocess.check_output(["hostname", "-I"]).split()[1]

flag = False
step = 0

accessTypes1 = []
statuses1 = []

def acceptorTrigger():
    global step, flag
    step = 1
    buzzer1.play()

def buttonTrigger():
    global step, flag
    if (acceptor1.amount > 0):
        flag = False
        step = 2
    else:
        step = 0




def main():
    global step, flag
    button1.attach(buttonTrigger)
    button1.begin()
    acceptor1.attach(acceptorTrigger)
    acceptor1.begin()

    buzzer1.play()
    buzzer1.play()

    lcd1.setLines(
        "       ARTS         ",
        "    Philippines     ",
        "                    ",
        "     artsph.net     ")
    time.sleep(1)

    lcd1.setLines(
        "model : SPW001",
        "rate  : " + helper.Helper.timeToString(time.gmtime(int(amount1.getRate()))),
        "min   : " + str(amount1.getMinimum()) + ".00",
        "limit : " + str(amount1.getLimit()) + ".00")
    time.sleep(1)
    
    lcd1.setLines(
        "eIp : " + str(externalIp, 'utf-8'),
        "iIp : " + str(internalIp, 'utf-8'),
        " ",
        " ")
    time.sleep(1)

    while True:
            statuses1 = status.Status.getAll()
            accessTypes1 = accesstype.AccessType.getAll()
            
            THeading = "   SulitPisoWifi    "
            TSsid = "SulitPisoWifi"

            TDatetime = helper.Helper.datetimeToString(time)
            TAmount = acceptor1.amount
            TTime = acceptor1.amount * int(amount1.getRate())
            TCode = generate(6).upper()

            lcd1.setLine(1, THeading)
            lcd1.setLine(2, TDatetime)

            if (step == 0):
                lcd1.setLine(3, " ")
                lcd1.setLine(4, "Please insert coins.")
            elif (step == 1):
                lcd1.setLine(3 ,"amount : " + str(TAmount) + ".00")
                lcd1.setLine(4 ,"time   : " + helper.Helper.timeToString(time.gmtime(TTime)))
            elif (step == 2):
                if (flag == True): continue
                lcd1.setLine(3 , "ssid : " + TSsid)
                lcd1.setLine(4 ,"code : " + TCode)
                flag = True
                acceptor1.amount = 0

                #save access
                accessDtCreated = helper.Helper.datetimeToString(datetime.datetime.now())
                accessDtExpired = helper.Helper.datetimeToString(datetime.datetime.now() + datetime.timedelta(days=1))
                access.Access.insert(TCode, TAmount, TTime, accessDtCreated, accessDtExpired, accessTypes1[0].getId(),  statuses1[0].getId())

            time.sleep(1)


try:
    main()
except KeyboardInterrupt:
    pass
except Exception as exception:
    print(exception)
finally:
    gpio.cleanup()
