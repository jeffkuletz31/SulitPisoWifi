#!/usr/bin/python3

import pymysql

from lib.classes import database
Database = database.Database

class Access(object):

    def __init__(self):
        pass
    def __del__(self):
        pass

    @staticmethod
    def insert(code, amount, time, dtCreated, dtExpired, type1, status1):
        # print(type(code), code)
        # print(type(amount), amount)
        # print(type(time), time)
        # print(type(dtCreated), dtCreated)
        # print(type(dtExpired), dtExpired)
        # print(type(type1), type1)
        # print(type(status1), status1)
        
        # Open database connection
        db = pymysql.connect(Database.host, Database.name, Database.password, "")
        # prepare a cursor object using cursor() method
        cursor = db.cursor()
        # execute SQL query using execute() method.
        sql = """
            INSERT INTO spw_db.access 
            (access_code, access_amount, access_time, access_dt_created, access_dt_expired, access_type_id, status_id) 
            VALUES (%s, %s, %s, %s, %s, %s, %s);
        """  
        value = (code, amount, time, dtCreated, dtExpired, type1, status1)
        cursor.execute(sql, value)
        # you must call commit() to persist your data if you don't set autocommit to True
        db.commit()

        db.close()

