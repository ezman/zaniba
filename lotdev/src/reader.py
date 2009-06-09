#!/usr/bin/env python
import csv
from datetime import date
from sqlobject import dberrors
from common import *

def getMonth(m):
   if(m == "Jan"):
      return 1
   if(m == "Feb"):
      return 2
   if(m == "Mar"):
      return 3
   if(m == "Apr"):
      return 4
   if(m == "May"):
      return 5
   if(m == "Jun"):
      return 6
   if(m == "Jul"):
      return 7
   if(m == "Aug"):
      return 8
   if(m == "Sep"):
      return 9
   if(m == "Oct"):
      return 10
   if(m == "Nov"):
      return 11
   if(m == "Dec"):
      return 12
   return -1

def load():
   conn = Connection()   
   entries = csv.reader(open("/home/fasih/development/lotdev/data/results.csv"))
   for row in entries:
      print "Row len" + str(len(row))
      if(row[0] != "DrawDate"):
         draw = DrawHistory.connection_debug = False
         draw = DrawHistory.select(DrawHistory.q.DrawDate==row[0])
         print draw
         r = list(draw)
         if(len(r) == 0) :
            day = row[0][0:2]
            month = row[0][3:6]
            year = row[0][7:11]
            try :
               f = int(day)
            except ValueError:
               day = row[0][0:1]
               month = row[0][2:5]
               year = row[0][6:10]
            try :
               if(len(row) == 10):
                  DrawHistory(DrawDate=date(int(year), getMonth(month), int(day)),
                       Ball1=int(row[1]),
                       Ball2=int(row[2]),
                       Ball3=int(row[3]),
                       Ball4=int(row[4]),
                       Ball5=int(row[5]),
                       Ball6=int(row[6]),
                       BonusBall=int(row[7]),
                       BallSet=row[8],
                       Machine=row[9])
               else :
                  DrawHistory(DrawDate=date(int(year), getMonth(month), int(day)),
                       Ball1=int(row[1]),
                       Ball2=int(row[2]),
                       Ball3=int(row[3]),
                       Ball4=int(row[4]),
                       Ball5=int(row[5]),
                       Ball6=int(row[6]),
                       BonusBall=int(row[7]),
                       BallSet=None,
                       Machine=None)
            except sqlobject.dberrors.DuplicateEntryError:
               print "Exception - Entry already exists!"
         else :
            print "Entry already exists!"

if __name__ == '__main__':
   load()
   sys.exit