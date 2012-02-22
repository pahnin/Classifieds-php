<?
if($view=='home'){
	include(__DIR__.'/template.tpl');
}
else if($view=='register'){
	if($_POST['submit']=='register'&& !empty($_POST['description'])&& !empty($_POST['title'])){
		if(isset($_FILES['ad_pic']) && !empty($_FILES['ad_pic']['name'])) {
			if(!$db->exist('mod_ad','name',$_POST['title'])){
				if(!strpos($_FILES['ad_pic']['type'],'image/')) {
					$filename=$_FILES['ad_pic']['name'];
					$tmp_name=$_FILES['ad_pic']['tmp_name'];
					
					list($width, $height) = getimagesize($tmp_name);
					
					$thumb = imagecreatetruecolor('300','300');
					$source = imagecreatefromjpeg($tmp_name);
					
					imagecopyresized($thumb, $source, 0, 0, 0, 0, '300','300', $width, $height);
					imagejpeg($thumb,$serverroot.'/tmp/'.$_POST['title'].'_img.jpg');
					chmod($serverroot.'/tmp/'.$_POST['title'].'_img.jpg',0777);
					$code=rand(1,9999);
					$sql="INSERT INTO p1.mod_ad (name,id,email,description,url,date,active,activation_code) VALUES ('".$_POST['title']."', NULL,'".$_POST['email']."','".$_POST['description']."','tmp/".$_POST['title']."_img.jpg', NOW(),'0',".$code.")";
					if($db->Insert($sql)){
						// send email
						echo "Registration successful<br>Activate by clicking this <a href='http://localhost/p1/index.php?v=activate&title=".$_POST['title']."&code=".$code."' target='__blank'>link</a><br>Register another item <a href='?v=home'>back</a>";
						
						// redirect to list
						#header('Location: index.php?v=list');
					}
					else{
						die();
					}
				}
				else{
					echo "Please upload an image file <a href='?v=home'>back</a>";
				}
			}
			else{
				echo "Choose a different title <a href='?v=home'>back</a>";
			}
		}
		
		else{
			echo "Missing something <a href='?v=home'>back</a>";
		}
		
	}
	else{
		echo "404";
	}
}
else if($view=='list'){
	$ads=$db->getTableasArray('select * from mod_ad where active = 1 order by id');
	include(__DIR__.'/list.tpl');	
	}
else if($view=='activate'){
	if($db->update('mod_ad','name',$_GET['title'],'activation_code',$_GET['code'],'active',1)){
		echo "Your ad activated <a href='?v=list'>View it here</a>";
	}
	else{
		echo "Activation failed please check your link";
	}
}
	
?>
