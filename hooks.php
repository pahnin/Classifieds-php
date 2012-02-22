<?php
$hooks=$db->getTableasArray("SELECT hook FROM hooks ORDER BY `order` asc");
$modules=$db->getTableasArray("SELECT hook, module FROM pages WHERE PAGE = '".$db->__($view)."' ORDER BY `order` asc");
/*
 * Pushing all modules to be loaded for a hook into an array
 * with its hook name as variable name.
 * Example: header is a hook, so $header is an array of all the module
 * names to be loaded
 * 
 */
print_r($hooks);
echo '<br><br>';
print_r($modules);
foreach($modules as $module){
	if(!isset($$module['hook'])){
		$$module['hook']= array();
		array_push($$module['hook'],$module['module']);
	}
	else{
		array_push($$module['hook'],$module['module']);
	}

}

/*
 * Loading all the hooks available in the hooks directory.
 * 
 */

foreach($hooks as $hook){
	if($hook){
	include('hooks/'.$hook['hook'].'.php');
	}
}
?>
