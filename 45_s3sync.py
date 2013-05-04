#!/usr/bin/env python
import os
import sys
import time

time.sleep(45)
os.system("s3cmd sync --delete-removed /home/user/public/data/uploads/ s3://BUCKET_NAME -v")
sys.exit()
