<?php
/*
Plugin Name: S3 Sync
Description: Sync uploads to a S3 bucket.
Version: 0.1
Author: Xiaoyang Kao
Author URI: http://xy-kao.com/
*/

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");

# register plugin
register_plugin(
	$thisfile, //Plugin id
	'S3 Sync', 	//Plugin name
	'1.0', 		//Plugin version
	'Xiaoyang Kao',  //Plugin author
	'http://xy-kao.com/', //author website
	'Sync uploads to a S3 bucket.', //Plugin description
	'files', //page type - on which admin tab to display
	'hello_world_show'  //main function (administration)
);

# activate filter 
add_action('file-uploaded','file_upload_sync');
add_action('files-extras','file_upload_sync');

# add a link in the admin tab 'theme'
add_action('files-sidebar','createSideMenu',array($thisfile,'Sync to S3 Settings'));

# functions

function file_upload_sync() {
	if(!is_dir($_SERVER['DOCUMENT_ROOT'] . '/data/other/s3_sync/')) {
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/data/other/s3_sync/');
		$handle = fopen($_SERVER['DOCUMENT_ROOT'] . '/data/other/s3_sync/updater.txt', 'w');
		fclose($handle);
	}
	
	$my_file = $_SERVER['DOCUMENT_ROOT'] . '/data/other/s3_sync/updater.txt';
	
	$handle = fopen($my_file, 'w');
	$data = "NEW FILE/DIRECTORY";
	fwrite($handle, $data);
	fclose($handle);
}


function hello_world_show() {
	echo '<p>I like to echo "Hello World" in the footers of all themes.</p>';
}
?>

