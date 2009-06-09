"""Usage: python get_stats.py [OPTIONS]

This lottery number statitics from the National Lottery Website

"""

__author__ = "Fasih Rehman"
__version__ = "$Rev$"
__date__ = "$Date$"
__copyright__ = "Copyright 2008 Fasih Rehman"

import os
import sys
import urllib2
from xml.etree.ElementTree import ElementTree
from elementtidy import TidyHTMLTreeBuilder
from pysqlite2 import dbapi2 as sqlite


def getHtml():

	html = f.read()
	return html

'''
The HTML being parsed looks like this, though following td sections don't have the width and color 

<td width="26" bgcolor="#CCF4FF"><img src="/images/balls/26px/ball/10.gif" alt="10" width="26" height="26" /></td>

				<td bgcolor="#CCF4FF">=
					164				</td>

'''

def parseHtml():
	XHTML = "{http://www.w3.org/1999/xhtml}"
	num_freq_dict = {}

	page = ""	
	page = urllib2.urlopen('http://www.lottery.co.uk/statistics/')
	tree = TidyHTMLTreeBuilder.parse(page)
	docRoot = tree.getroot()
	
	'''Normalise the XHTML to HTML - removes namespace'''
	XHTML = "{http://www.w3.org/1999/xhtml}"
	for elem in docRoot.getiterator():
		if elem.tag.startswith(XHTML):
			elem.tag = elem.tag[len(XHTML):]
			for n in elem.getchildren():
				n.tag = n.tag[len(XHTML):]
				for p in n.getchildren():
					p.tag = p.tag[len(XHTML):]
					for q in p.getchildren():
						q.tag = q.tag[len(XHTML):]

	for d in docRoot.getiterator():
		if d.tag == "div" and d.attrib.has_key("class") and d.attrib['class'] == 'main':
			for e in d:
				if e.tag == 'table' and e.attrib.has_key("style"):
					td = e.findall("./tr/td/table/tr/td")
					complete = 'false'
					for h in td:
						if h is not None:
							z = h.find('img')
							if z is not None:
								k = z.attrib['alt']
								continue
						
						if h.attrib.has_key("bgcolor") and not h.attrib.has_key("width"):
							if h.text is not None:
								v = h.text[2:]
								complete = 'true'

						if complete == 'true':
							print str(k) + " " + str(v)
							num_freq_dict[k] = v
							k = None
							v = None
							complete = 'false'
		return num_freq_dict

def populate_database():
	
	return


        
def getStats():
	num_freq_dict = parseHtml()
	populate_database()

	return




if __name__ == "__main__":
	from optparse import OptionParser

getStats()
