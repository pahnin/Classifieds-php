<?php
if(isset($$hookname)){
	foreach($$hookname as $modulename){
		if($modulename){
			if(file_exists('modules/'.$modulename.'/show.php')){
				include('modules/'.$modulename.'/show.php');
			}
			else{
				echo "Missing module $modulename";
			}
		}
	}
}
?>
