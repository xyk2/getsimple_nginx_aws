#!/usr/bin/env python
import os
import sys

os.system("s3cmd sync --delete-removed /home/user/public/data/uploads/ s3://BUCKET_NAME -v")
sys.exit()