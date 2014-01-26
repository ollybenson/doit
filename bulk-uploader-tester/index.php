<!DOCTYPE html>
<html lang="en-UK">
<head>
<title>Do-it bulk upload checker</title>
<style>
BODY {background-color: #eee;font-family: "Ariel",sans-serif;font-size: 180%;}
#page {margin: auto;width: 1024px;min-height: 400px;background-color: #fff;}
#content {margin: 5px;}
P, H1, FORM {color: #666;}
FORM {margin: 100px;margin-left:300px;vertical-align: top;padding: 1px;}
#label {float: left; margin-left:-250px;width: 240px;}
INPUT {font-size: 100%;}
</style>

</head>
<body>
<div id="page">
<div id="content">
<h1>Do-it bulk upload checker</h1>
<?php
include_once ('config.php');
function __autoload($class_name) {
    include "class." . $class_name . '.php';
}
if (isset($_FILES["file"])) {
	if ($_FILES["file"]["error"] > 0) printf("Error: %s<br>", $_FILES["file"]["error"]);
		else {
			$theCsv = new csv($_FILES["file"]);
			$theCsv->fileDetails();
			$theCsv->checkLines();
			$theCsv->displayResult();
			printf("<br><br>");
			}
	} // end of if processing file



	?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
enctype="multipart/form-data">
<p id="label">
<label for="file" style="float: right;">File to check:</label>
</p><p>
<input type="file" name="file" id="file">
</p><p>
<input type="submit" name="submit" value="Submit">
</p>
</form>
<p>
</div>
</div>
	</body>
</html> 	

<?php

// FOR DEBUGGING ONLY
function displayArray($array) {
	echo "<pre>";
	print_r($array);
	echo "</pre>";
	}
?>