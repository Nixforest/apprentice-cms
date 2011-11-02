<?php
	$dir = "image/";
	if($_POST['src']!=null){
		$dir = $_POST['src'];	
	}
	$files = scandir($dir);
	echo "<ul>";
	if($dir!="image/"){
		$link = substr($dir,0,strrpos(substr($dir,0,-1),"/"));
		echo "<li id='idlifolder' class='lifolder icon_folder' onclick='accessfolder(\"$link/\")'><span class='image_icon icon_notcheck'></span><a href='#'>...</a></li>";	
	}
	foreach($files as $file){
		if($file != "."||$file !=".."){
			if(strstr($file,".")==""){
				echo "<li id='idlifolder' class='lifolder icon_folder' onclick='accessfolder(\"$dir$file/\")'><span class='image_icon icon_notcheck'></span><a href='#'>$file</a></li>";	
			}else{
				$str = strstr($file,".");
				$drc = substr($file,0,strpos($file,"."));
				if($str==".gif"||$str==".jpg"||$str==".png"){
					$size = getimagesize("$dir$file");
					$width = $size[0];
					$height = $size[1];
					$type = $size['mime'];
					$filesize = round(filesize("$dir$file")/1024,2);
					$datemodify = date("F d Y H:i:s",filemtime("$dir$file"));
					$swidth = 380;
					$sheight = 300;
					if($width>$swidth||$height>$sheight){
						if($width>$height){
							$swidth1 = $sheight*$width/$height;
							if($swidth1>$swidth){
								$sheight = $swidth*$height/$width;
							}else
							$swidth = $swidth1;
						}else{
							$sheight1 = $swidth*$height/$width;
							if($sheight1>$sheight){
								$swidth = $sheight*$width/$height;
							}else
							$height = $sheight1;
						}
					}else{
						$swidth = $width;
						$sheight = $height;	
					}
					echo "<li class='liitem icon_item' onclick='show_image(\"$dir$file\",$swidth,$sheight);show_detail(\"$file\",$width,$height,\"$type\",\"$filesize\",\"$datemodify\",\"$dir$file\",\"$drc\");'><span class='image_icon icon_notcheck'></span><a href='#'>$file</a></li>";
				}	
			}
		}
	}
	echo "</ul>";
?>