GetSimple with nginx and Amazon AWS
=========

All configuration files for running GetSimple 3.2.1 on nginx with AWS integration. Includes cron scripts for syncing /data/uploads/ with a S3 bucket, and CloudFront image linking.

  - Syncs /data/uploads with a S3 bucket
  - Adds "CloudFront CDN" link option for embedded images
  - Configuration files for NGINX with fancy URL rewrites


General Installation Procedure
-
Tested on Ubuntu 12.04 LTS.

* Install NGINX
* Edit configuration
* Install php5-fpm
* Install php5-curl
* Install php5-gd
* Edit configuration
* Install vnstat
* Install s3cmd
* Disable apache-warning in `gsconfig.php`
* Replace lines 169-171 of `/admin/filebrowser.php` with:
		```php
		$thumbnailLink = '<span>&nbsp;&ndash;&nbsp;&nbsp;</span><a href="javascript:void(0)" onclick="submitLink('.$CKEditorFuncNum.',\''.'http://***********.cloudfront.net/'.$subDir.$upload['name'].'\')">'.'CloudFront CDN'.'</a>';
		```
* Install `s3_upload_sync` plugin to plugins folder
* Crontab - `plugins/s3_upload_sync/sync.py`, 15s, 30s, 45s
* For file upload MD5 hashing in filenames (admin/upload.php line 48):
	```php
	$md5 = md5_file($_FILES["file"]["tmp_name"][$i]); // EDITED to include MD5 hash
	$md5 = substr($md5, 0, 5); // EDITED to include MD5 hash
	$file_loc = $path .  $md5 . '_' . clean_img_name(to7bit($_FILES["file"]["name"][$i])); // EDITED to include MD5 hash
	$base = $md5 . '_' .clean_img_name(to7bit($_FILES["file"]["name"][$i])); // EDITED to include MD5 hash
			
	//prevent overwriting
	while ( file_exists($file_loc) ) {
		$file_loc = $path . $count.'-'. $md5 . '_' .clean_img_name(to7bit($_FILES["file"]["name"][$i])); // EDITED to include MD5 hash
		$base = $count.'-'. $md5 . '_'. clean_img_name(to7bit($_FILES["file"]["name"][$i])); // EDITED to include MD5 hash
		$count++;
	}```

Warning
-
Keep in mind that the CloudFront integration changes the core files, so whenever you update to a newer version of GS, look for the same lines in `/admin/filebrowser.php` and replace. 

Credit
-

Nginx configuration is based on [marrco's](http://get-simple.info/forums/showthread.php?tid=1269&pid=24930#pid24930) from the GetSimple forum. 
    