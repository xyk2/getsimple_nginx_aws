#!/usr/bin/env python
import os
import sys

file = open("/home/xyk/public/data/other/s3_sync/updater.txt", "r")
contents = file.read()
file.close()
if(contents == "NEW FILE/DIRECTORY"):
	os.system("s3cmd sync --delete-removed --exclude '*/_cached_1_month/*' --exclude '*/_gzip_1_month/*' /home/xyk/public/data/uploads/ s3://oldblog -v")
	os.system("s3cmd sync /home/xyk/public/data/uploads/_cached_1_month/ s3://oldblog/_cached_1_month/ --add-header 'Cache-Control: max-age:2628000'")
	os.system("s3cmd sync /home/xyk/public/data/uploads/_gzip_1_month/ s3://oldblog/_gzip_1_month/ --add-header 'Cache-Control: max-age:2628000' --add-header 'Content-Encoding: gzip'")
	file = open("/home/xyk/public/data/other/s3_sync/updater.txt", "w")
	file.write("EMPTY")
	file.close()