import sys, os
from sqlobject import *

class Connection :

    def __init__(self):
        self.isInitialised = False
        db_filename = '/home/fasih/development/lotdev/data/lottery.db'
        '''
        if os.path.exists(db_filename):
            os.unlink(db_filename)
        '''
        connection_string = 'sqlite:' + db_filename
        connection = connectionForURI(connection_string)
        sqlhub.processConnection = connection
        self.isInitialised = True
        
    def isInitialised(self):
        return self.isInitialised
        
if __name__ == '__main__':
    conn = Connection()