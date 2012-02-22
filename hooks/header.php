<!DOCTYPE html>
<html>
<head>
	<title><? echo $view; ?></title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.20" />
	<link rel='stylesheet' href='css/general.css' >
</head>

<body>
	<div id='header'>
		<?php
		$hookname=basename(__FILE__,'.php');
		include('loadmodules.php');
		?>
	</div>
	<div id='container'>
