<html>
<body><?php

if (isset($_FILES["file"])) {

if ($_FILES["file"]["error"] > 0) printf("Error: %s<br>", $_FILES["file"]["error"]);
  else {
	printf("<ul><li>Upload: %s</li><li>Type: %s</li><li>Size: %d</li></ul>",$_FILES["file"]["name"],$_FILES["file"]["type"],($_FILES["file"]["size"] / 1024));
	$content = file_get_contents($_FILES["file"]["tmp_name"]);
	$search = array(chr(9),chr(11),chr(133),chr(146),chr(147),chr(148),chr(149),chr(150),chr(163),chr(183),chr(226),'  ');
	$replace = array(' ',chr(13).chr(10),'...','\'','"','"','-','-','&#163;','-','-',' ');	
	$output = str_replace($search,$replace,$content);
	$output = preg_replace("@[^\xA\xD\x20-\x7E]@","",$output);
	$filename = sprintf('%s-%s',date('YmdHis'),$_FILES["file"]["name"]);
	$t = file_put_contents ($filename,$output);
	
	printf('Download the amended file here: <a href="%s">%1$s</a><br><br>',$filename);
	
	}
  }
	?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
enctype="multipart/form-data">
<label for="file">File to check:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>
	</body>
</html> 	 
