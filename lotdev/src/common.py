import sqlobject
from Connection import *


class DrawHistory(sqlobject.SQLObject):
    class sqlmeta:
        table = "DRAW_HISTORY"

    DrawDate = sqlobject.DateCol(unique = True)
    Ball1 = sqlobject.IntCol()
    Ball2 = sqlobject.IntCol()
    Ball3 = sqlobject.IntCol()
    Ball4 = sqlobject.IntCol()
    Ball5 = sqlobject.IntCol()
    Ball6 = sqlobject.IntCol()                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
    BonusBall = sqlobject.IntCol(notNone = False)
    BallSet = sqlobject.StringCol(length=20, notNone=False)
    Machine = sqlobject.StringCol(length=20, notNone=False)

        
class DrawFrequency(sqlobject.SQLObject):
    class sqlmeta:
        table = "DRAW_FREQUENCY"

    ball = sqlobject.IntCol()
    frequency = sqlobject.IntCol()

class Property(sqlobject.SQLObject):
    class sqlmeta:
        table = "PROPERTIES"
        
    property = sqlobject.StringCol(length=32)
    property.unique = True
    value = sqlobject.StringCol(length=32)
    
    
if __name__ == '__main__':
    from Connection import *
    #from common import *
    
    conn = Connection()
    DrawHistory.createTable()
    '''DrawFrequency.createTable();
    Property.createTable();
    '''
    
    draw = DrawHistory.select(DrawHistory.q.DrawDate=="21-Mar-2009")
    if draw == '':
        print "Empty"
    else :
        print draw
        
