#!/usr/bin/python

import os

outputFileName = "test.php"
f = open(outputFileName, "w")
f.write("<?php\n")
f.close()

for path, dirs, files in os.walk('.'):
	for file in files:
		if file.find(".php") == -1:
			continue
		if file == outputFileName:
			continue
		print path, file
		fileName = os.path.join(path,file)
		read_f = open(fileName,'r')
		writeLines = []
		for line in read_f:
			if line.strip() == "":
				continue
			writeLines.append(line)
		if len(writeLines) > 0 and writeLines[0].strip() == "<?php":
			del writeLines[0]
		if len(writeLines) > 0 and writeLines[-1].strip() == "?>":
			del writeLines[-1]
		read_f.close()
		
		write_f = open(outputFileName, "a")
		write_f.write("\n\n\n\n/*--------------------------------------------------------\n")
		write_f.write("  From file: " + fileName + "\n")
		write_f.write("--------------------------------------------------------*/\n\n\n\n")
		
		for line in writeLines:
			write_f.write(line)
		write_f.close()
		# write_f = open(os.path.join(OUTPUT_DIR,file))

# f = open('/tmp/workfile', 'w')