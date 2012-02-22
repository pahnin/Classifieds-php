<?php

$pattern = array('/\{foreach\p{Zs}/','/\:/', '/\}/');
$replace = array('foreach(','){ echo "','";}');

function Template($templateFile){
	global $pattern;
	global $replace;
	global $serverroot;
	
	$tpl=fopen($templateFile,'r');
	$tplc=fopen('tmp/'.str_replace('/','.',$templateFile),'w');
	#$tplc = fopen(str_replace($serverroot,$serverroot.'/tmp',$templateFile.'c'), 'W');
	if ($tpl && $tplc) {
		fwrite($tplc,'<?php ');
		while (($buffer = fgets($tpl, 4096)) !== false) {
			if(preg_filter($pattern,$replace,$buffer)){
				fwrite($tplc,preg_filter($pattern,$replace,$buffer));
			}
			else{
				fwrite($tplc,$buffer);
			}
		}
		if (!feof($tpl)) {
			echo "Error: unexpected fgets() fail\n";
		}
		fwrite($tplc,'?> ');
		fclose($tpl);
		fclose($tplc);
		return 'tmp/'.str_replace('/','.',$templateFile);
	}
	
}

?>
