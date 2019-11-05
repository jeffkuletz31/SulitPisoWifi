#!/usr/bin/python3

import pymysql

from lib.classes import database
Database = database.Database

class AccessType(object):

    def __init__(self, id, name, desc, value):
        self.id = int(id)
        self.name = name
        self.value = int(value)


    def getId(self):
        return self.id

    def getName(self):
        return self.name
    
    def getDesc(self):
        return self.desc

    def getValue(self):
        return self.value

    def __del__(self):
        pass

    @staticmethod
    def getAll():
        # Open database connection
        db = pymysql.connect(Database.host, Database.name, Database.password, "")
        # prepare a cursor object using cursor() method
        cursor = db.cursor()
        # execute SQL query using execute() method.
        cursor.execute(
        """    
            SELECT * 
            FROM spw_db.access_type;
        """)
        # Fetch a single row using fetchall() method.
        datas = cursor.fetchall()
        # disconnect from server
        db.close()

        accessTypes = []

        for data in datas:
            accessType = AccessType(data[0], data[1], data[2], data[3])
            accessTypes.append(accessType)

        return accessTypes

