<?php
class csv {
var $file;
var $lines;
var $records;
var $totalColumns;
var $totalChecked =0;
var $error = array();
var $uniqueId = array();
var $row;

function __construct($filename) {
	$this->file = $filename;
	$temp = file_get_contents($filename["tmp_name"]);
	$this->value = self::splitTheCSV($temp);
	$this->records = count($this->value);
	}
	
private function splitTheCSV($input) {
	$temp = explode(chr(34).chr(13).chr(10), $input);
	array_walk($temp,function (&$item1, $key) { $item1 = $item1."\""; });
	end($temp);
	$temp[key($temp)] = substr(current($temp),0,-1);
	return $temp;
	}
	
public function fileDetails() {
	printf("<ul><li>Upload: %s</li><li>Type: %s</li><li>Size: %d</li><li>Lines: %d</li></ul>",$this->file["name"],$this->file["type"],($this->file["size"] / 1024),$this->records);
	}

public function checkLines() {
	for($a=0;$a<$this->records;$a++) {
		if (empty($this->value[$a])) break;
		$this->Row[$a] = new row($a,$this->value[$a]);
		if(count($this->Row[$a]->error)>0) $this->error[$this->Row[$a]->id]['Row errors'] = $this->Row[$a]->error;
			else {
				$this->Row[$a]->checkCells();
				}
		if (count($this->Row[$a]->error)>0) $this->error[$this->Row[$a]->id]=$this->Row[$a]->error;
		$this->totalChecked++;
		};
	}

public function displayResult() {
	if (count($this->error)==0) printf("<p>Passed. Total checked: %d.  All clear</p>",$this->totalChecked);
	else printf(self::displayNestedArray($this->error));
	// displayArray($this);
	}
	
private function displayNestedArray($array) {
	$return = '<ul>';
	foreach ($array AS $key => $value) {
		if (is_array($value)) $return.=sprintf('<li>%s%s</li>',$key,self::displayNestedArray($value));
			else $return.=sprintf("<li>%s</li>",$value);
		};
	$return.=sprintf('</ul>');
	return $return;
	}
	

	} // end class csv
?>