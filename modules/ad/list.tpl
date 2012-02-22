<?php 
echo "<a href='?v=home'>Add your ad</a><hr style='margin: 10px 0'>";
foreach($ads as $ad){
	if($ad){
	echo "<div class='item'>
	<img src='".$ad['url']."' width=100 height=100 style='float:right;clear:right'><p>".$ad['name']."</p>
	<p>Descrption: ".$ad['description']."</p>
	<p>Email: ".$ad['email']."</p>
	<p>Posted on: ".$ad['date']."</p></div>";
	}
}
?> 
