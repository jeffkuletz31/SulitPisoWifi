#!/usr/bin/python3

import pymysql

from lib.classes import database
Database = database.Database

class Amount(object):
    
    rate = 180
    minimum = 1
    limit = 10000

    def __init__(self):
        pass
        
    def getRate(self):
        # Open Database connection
        db = pymysql.connect(Database.host, Database.name, Database.password, "")
        # prepare a cursor object using cursor() method
        cursor = db.cursor()
        # execute SQL query using execute() method.
        cursor.execute(
        """    
            SELECT spw_db.preference.preference_value 
            FROM spw_db.preference 
            WHERE spw_db.preference.preference_class = 'amount' and preference.preference_property = 'rate';
        """)
        # Fetch a single row using fetchone() method.
        data = cursor.fetchone()
        # disconnect from server
        db.close()
        return data[0]

    def getMinimum(self):
        # Open Database connection
        db = pymysql.connect(Database.host, Database.name, Database.password, "")
        # prepare a cursor object using cursor() method
        cursor = db.cursor()
        # execute SQL query using execute() method.
        cursor.execute(
            """
            SELECT spw_db.preference.preference_value 
            FROM spw_db.preference 
            WHERE spw_db.preference.preference_class = 'amount' and preference.preference_property = 'minimum';
            """)
        # Fetch a single row using fetchone() method.
        data = cursor.fetchone()
        # disconnect from server
        db.close()
        # return needed data
        return data[0]

    def getLimit(self):
        # Open Database connection
        db = pymysql.connect(Database.host, Database.name, Database.password, "")
        # prepare a cursor object using cursor() method
        cursor = db.cursor()
        # execute SQL query using execute() method.
        cursor.execute(
            """
            SELECT spw_db.preference.preference_value 
            FROM spw_db.preference 
            WHERE spw_db.preference.preference_class = 'amount' and preference.preference_property = 'limit';
            """)
        # Fetch a single row using fetchone() method.
        data = cursor.fetchone()
        # disconnect from server
        db.close()
        # return needed data
        return data[0]

    def __del__(self):
        pass


