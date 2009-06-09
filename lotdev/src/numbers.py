#!/usr/bin/env python
from BitVector import BitVector

class Numbers():
   numbers = dict()
   
   def __init__(self):
      n = BitVector( bitstring='0000000000000000000000000000000000000000000000001')
      self.numbers[1] = n
      for x in range(2,50):
         n << 1
         self.numbers[x] = BitVector( bitstring=str(n) )
         
   def getVector(self, i):
      return self.numbers[i]

   def printall(self):
      for x in self.numbers.keys():
         print  x, "=>", self.numbers[x]
         
         

         
         
if __name__ == '__main__':
   n = Numbers()
   n.printall()
   print n.getVector(12)
   
