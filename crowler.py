from HTMLParser import HTMLParser
import math

# the list of courses
courses = []
# the tmp course
course = None

class Parser(HTMLParser):

	def handle_starttag(self, tag, attrs):
		# select tr.ob_gR or tr.ob_gRA or tr.ob_gRS
		if tag == 'tr' and len(attrs) == 1 and attrs[0][0] == 'class' and ( attrs[0][1] == 'ob_gRA' or  attrs[0][1] == 'ob_gRS' or attrs[0][1] == 'ob_gR'):
			global courses, course
			# tmp course loaded
			if course != None and len(course) > 0:
				courses.append(course)
			# clear the tmp course
			course = []

	def handle_data(self, data):
		global course
		# trim the whitespace
		val = data.strip()

		# tmp course create and aleady has data not more than 5 element
		if course != None and len(val) > 0 and len(course) < 5:
			course.append(val)

def getOldVal(grade):
	if grade == 'A+':
		return 4.0
	elif grade == 'A':
		return 3.75
	elif grade == 'A-':
		return 3.5
	elif grade == 'B+':
		return 3.25
	elif grade == 'B':
		return 3.0
	elif grade == 'C+':
		return 2.75
	elif grade == 'C':
		return 2.5
	elif grade == 'D':
		return 2.25
	elif grade == 'E':
		return 2.0
	else :
		return 0.0

def getNewVal(grade):
	if grade == 'A+' or grade == 'A' or grade == 'A-':
		return 4.0
	elif grade == 'B+' or grade == 'B':
		return 3.5
	elif grade == 'C+':
		return 3.0
	elif grade == 'C':
		return 2.75
	elif grade == 'D':
		return 2.5
	elif grade == 'E':
		return 2.0
	elif grade == 'F':
		return 1.0
	else :
		return 0.0

def process():
	global courses, course

	totalCH = 0
	
	totalOldCP = 0
	totalNewCP = 0
	
	lastCode = ''

	for course in courses:
		if len(course) == 5 and lastCode != course[0]:
			# print course
			totalCH = totalCH + int(course[2])
			totalOldCP = totalOldCP + (int(course[2]) * getOldVal(course[3].strip()))
			totalNewCP = totalNewCP + (int(course[2]) * getNewVal(course[3].strip()))
			lastCode = course[0]

	print 'Old GPA: ',math.floor((totalOldCP / totalCH) * 100) / 100
	print 'New GPA: ',math.floor((totalNewCP / totalCH) * 100) / 100

def main():
	parser = Parser()

	f = open("My Grades.htm")
	if f.mode == 'r':
		contents = f.read()
		parser.feed(contents.replace('&','x'))
	else :
		print 'unable to read'

	courses.append(course)

	process()

if __name__ == '__main__':
	main()
	