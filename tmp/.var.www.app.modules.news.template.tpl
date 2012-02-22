<?php foreach($news as $news_post){ echo "
	<h1>".$news_post['id']." ".$news_post['title']."</h1>
	<p>".$news_post['body']."</p>
	<p>".$news_post['time']."</p>
";}
?> 