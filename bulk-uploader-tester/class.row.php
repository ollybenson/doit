<?php
class row {
	var $rowNum;
	var $id;
	var $value = array();
	var $error = array();
	var $cell;
	var $cols;
	var $totalExpectedCols;
	
function __construct($rowNum,$lineValue) {
	$this->rowNum = $rowNum;
	$this->rowType = ($rowNum==0) ? 'firstLine' : 'row';
	$this->totalExpectedCols = defaultArrays($this->rowType.'Defaults','TOTAL');
	$this->value = self::checkRightNumberOfSpeachMarks($lineValue);
	self::checkRightNumberOfColumns();
	if($this->rowType=='row') self::checkRowCorrectCombinations();
	$this->id = $this->value[0];
	}

private function checkRightNumberOfSpeachMarks($lineValue) {	
	$t = substr_count($lineValue,'"');
	if ( $t & 1 ) $this->error[] = sprintf("<strong>Uneven number of speech marks</strong>");
	if ( $t!= ((int)$this->totalExpectedCols*2)) 
		$this->error[] = sprintf("<strong>Wrong number of speech marks - %d instead of %d</strong>",$t,(int)$this->totalExpectedCols*2);
	$token = str_split($lineValue);
	return explode('","',substr($lineValue,1));
	}

private function checkRightNumberOfColumns() {	
	$this->cols = count($this->value); 
	if ($this->cols!=$this->totalExpectedCols) 
		$this->error[] = sprintf("<strong>Contains wrong number of columns</strong>: %d instead of %d",$this->cols,$this->totalExpectedCols);

	}

private function checkRowCorrectCombinations() {
	global $uniqueId;
	if (isset($uniqueId[$this->value[0]])) $this->error[] = sprintf("<strong>%s - unique ID already exists</strong>",$this->value[0]);
		else $uniqueId[$this->value[0]]=1;
	if (empty($this->value[8]) && empty($this->value[35])) 
		$this->error[] = sprintf("<strong>Neither postcode or boundary wide area are set</strong>");
	if (isset($this->value[34]) && isset($this->value[35]) && $this->value[34]=="True" && $this->value[35]!=0) 
		$this->error[] = sprintf("<strong>Location on map set as true, but location is Boundary Wide</strong>");
	}

	
public function checkCells() {
	for($col=0;$col<$this->cols;$col++) {
		$this->Cell[$col] = new cell($this->rowType,$col,(string) $this->value[($col)]);
		if (isset($this->Cell[$col]->defaults['minLen'])) $this->Cell[$col]->checkMinLen();
		if (isset($this->Cell[$col]->defaults['maxLen'])) $this->Cell[$col]->checkMaxLen();
		if (isset($this->Cell[$col]->defaults['regex'])) {
			$this->Cell[$col]->checkRegex();
			if ($this->Cell[$col]->defaults['regex']=='date' || $this->Cell[$col]->defaults['regex']=='dateTime') $this->Cell[$col]->checkTheDate();
			};
		if (isset($this->Cell[$col]->defaults['onlyIf'])) $this->Cell[$col]->checkOnlyIf($this->value[8]);
		if (isset($this->Cell[$col]->defaults['inArray'])) $this->Cell[$col]->checkInArray();
		if (isset($this->Cell[$col]->defaults['validation'])) $this->Cell[$col]->checkValidation();
		if (count($this->Cell[$col]->error)>0) $this->error[sprintf('Column %d - %s',$this->Cell[$col]->colNum,$this->Cell[$col]->defaults['name'])] = $this->Cell[$col]->error;
		};
	}

} // end of RowClass
?>