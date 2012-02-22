<?php
/* 
 * Initialising Database connection in a class. 
 * Every module can use this instance to perform database operations.
 * 
 */
/*
 * Including functions files. You can add your filename.php file to 
 * load all the functions in that file.
 */

$exclude = array('.','..');
$classes=opendir('classes');
while($Class = readdir($classes)){
	if(!in_array(strtolower($Class), $exclude)) {	
		//This statement removes '.' and '..' from the directory list.
		include('classes/'.$Class);
	}
}
include('hooks.php');
?>
