<?php
//Start the session so we can store what the security code actually is
session_start();

//Send a generated image to the browser
create_image();
exit();

function create_image()
{
    //Let's generate a totally random string using md5
    $md5_hash = md5(rand(0,99999)); 
    $md5_hash2 = md5(rand(0,99999)); 
    //We don't need a 32 character long string so we trim it down to 5 
    $security_code = substr($md5_hash, 6, rand(4,7));
    $security_code2 = substr($md5_hash2, 6, rand(4,7)); 

    //Set the session to store the security code
    $_SESSION["captcha"] = $security_code.' '.$security_code2;

    //Set the image width and height
    $width = 200;
    $height = 50; 

    //Create the image resource 
    $image = ImageCreate($width, $height);  

    //We are making three colors, white, black and gray
    $bg = ImageColorAllocate($image, 240, 245, 240);
    $one = ImageColorAllocate($image, rand(0,255), rand(0,255), rand(0,255));
    $two= ImageColorAllocate($image, rand(0,255), rand(0,255), rand(0,255));
    $three = ImageColorAllocate($image, rand(0,255), rand(0,255), rand(0,255));

    //Make the background black 
    ImageFill($image, 0, 0, $bg); 

    //Add randomly generated string in white to the image
    ImageString($image, 2, 20, 10, $security_code, $one); 
    ImageString($image, 5, 90, 20, $security_code2, $three); 

    //Throw in some lines to make it a little bit harder for any bots to break 
    ImageRectangle($image,0,0,$width,$height,$white); 
    imageline($image, rand(0,$width/5), rand(0,$height),rand(4*($width)/5,$width), rand(0,$height), $one); 
    imageline($image, rand(0,$width/5), rand(0,$height),rand(4*($width)/5,$width), rand(0,$height), $two); 
 
    //Tell the browser what kind of file is come in 
    header("Content-Type: image/jpeg"); 

    //Output the newly created image in jpeg format 
    ImageJpeg($image);
   
    //Free up resources
    ImageDestroy($image);
}
?>
