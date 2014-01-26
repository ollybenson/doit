<?php
class cell {
	var $value;
	var $colNum;
	var $dataType;
	var $error = array();
	var $defaults = array();
	
function __construct($rowType,$colNum,$value = NULL) {
	$this->colNum = $colNum;
	$this->defaults = defaultArrays($rowType.'Defaults',$colNum);
	if (isset($value)) $this->value = $value;
		else $this->error[] = sprintf('%s - Missing column %d', $row[0], $col);
	}

	
public function checkMinLen() {
	if (isset($this->defaults['minLen']) && (strlen($this->value)<$this->defaults['minLen']))
		$this->error[] = sprintf("<strong>Too short</strong>: %s (%d).",$this->value,strlen($this->value));
	}

public function checkMaxLen() {
	if (isset($this->defaults['maxLen']) && (strlen($this->value)>$this->defaults['maxLen'])) 
		$this->error[] = sprintf("<strong>Too long</strong>: %s (%d).",$this->value,strlen($this->value));
	}
		
public function checkRegex () {
	$regexArray = defaultArrays('regex');
	if (isset($this->defaults['regex']) && (strlen($this->value)!=0)) {
		$i = preg_match(sprintf("@%s@i",$regexArray[$this->defaults['regex']]),$this->value);
		if ($i==0) {
			if ($this->defaults['regex']=='alphaNumeric') $j = preg_replace('@[^\x20\x21\x23-\x7E]@','#',$this->value);
				elseif ($this->defaults['regex']=='alphaNumericLineFeeds') 
					$j = preg_replace_callback('@([^\xA\xD\x20\x21\x23-\x7E£])@',function ($m) { return " CHR(".ord($m[1]).") "; },$this->value);
				elseif ($this->defaults['regex']=='address') $j = preg_replace("@[^A-Za-z0-9 ]@","#",$this->value);
				else $j= $this->value;
			$this->error[] = sprintf("<strong>Not in the correct format</strong>: %s",$j);
			};
		};
	}

public function checkTheDate() {
	if (isset($this->defaults['min']) && $this->defaults['min']=='0' && empty($this->value)) return;
	$theTime = self::getTheTime($this->defaults['regex'],$this->value);
	self::checkDateIsValid($theTime);
	if (isset($theTime['day']) && isset($theTime['month']) && isset($t['year'])) self::checkDateTooExtreme($theTime);
	}	

private function getTheTime($type,$value) {
	$regex = array(
		'date' => '^(\d\d)-(\d\d)-(\d\d\d\d)$',
		'dateTime' => '^(\d\d)-(\d\d)-(\d\d\d\d) (\d\d):(\d\d):(\d\d)$'
		);
	$matches = array();
	preg_match_all(sprintf('@%s@',$regex[$type]),$value,$matches);
	if (count($matches[0])==1) {
		$theTime = array('day' => (int) $matches[1][0], 'month' => (int) $matches[2][0], 'year' => (int) $matches[3][0]);
		if ($type == 'dateTime') 
			$theTime = array_merge($theTime, array('hour' => (int) $matches[4][0], 'minute' => (int) $matches[5][0], 'second' => (int) $matches[6][0]));
		}
	return (isset ($theTime)) ? $theTime : NULL;
	}	

private function checkDateIsValid($theTime) {
	$errorTime = NULL;
	if (!empty($theTime)) {
		foreach ($theTime AS $key => $value) {
			if ($value===NULL) $this->error[] = sprintf('<strong>%s contains no value</strong>: %s',$key, $value);
			if (intval($value)==0 && $value!='00') $this->error[] = sprintf('<strong>%s is not a valid number</strong>: %s',$key, $value);
			};
		if ($this->defaults['regex'] == 'dateTime') 
			$return = date('d-m-Y H:i:s', mktime($theTime['hour'],$theTime['minute'],$theTime['second'],$theTime['month'],$theTime['day'],$theTime['year']));
		if ($this->defaults['regex'] == 'date') $return = date('d-m-Y', mktime(0,0,0,$theTime['month'],$theTime['day'],$theTime['year']));
		if ($return!=$this->value) $errorTime = $return;  
		}
		else $errorTime = ($this->defaults['regex']=='date') ? "DD-MM-YYYY" : "DD-MM-YYYY hh:mm:ss";
	if (!empty($errorTime)) $this->error[] = sprintf("<strong>Not a correct date</strong>: %s, <strong>should be</strong> %s.",$this->value,$errorTime);
	return;
	}
	
private function checkDateTooExtreme($theTime) {
	$tempTime = mktime(0,0,0,$theTime['month'],$theTime['day'],$theTime['year']);
	if ($tempTime-time()>31536000) $this->error[] = sprintf("<strong>Date too far in advance</strong>: %s",$this->value);
	if ($tempTime>31536000)	$this->error[] = sprintf("<strong>Date too long ago</strong>: %s",$this->value);
	}
	
public function checkOnlyIf($postcode) {
	if ($this->defaults['onlyIf']=="EmptyPostcode") {
		if (empty($postcode) && $this->value==0) $this->error[] = sprintf("Should be not be zero, as postcode is not set. (%s)",$postcode);
		if (!empty($postcode) && $this->value!=0) $this->error[] = sprintf("Should be set to zero, as postcode is set (%s).",$postcode);
		};
	}
	
	
function checkInArray() {
	$fail =0;
	$arrayToTestAgainst = defaultArrays($this->defaults['inArray']);
	if ($this->defaults['min']!=0 && empty(trim($this->value))) {
		$this->error[] = sprintf("%s should not be empty.",$this->defaults['name']);
		$fail = 1;
		}
	if ($fail==0 && !empty(trim($this->value))) {
		$temp = explode("|",$this->value);
		$uniqueId = array();
		foreach ($temp AS $value) {
			if (!empty($value)) {
				$d= in_array($value,$arrayToTestAgainst);
				if ($d==FALSE)  $this->error[] = sprintf('Contains an invalid value: "%s"',$value);
					else {
						if (!isset($uniqueId[$value])) $uniqueId[$value] = 1;
							else $this->error[] = sprintf('Contains multiple of the same value "%s".',$value);	
						};
				};
			};	
		if ($this->defaults['max']!=NULL && count($temp)>$this->defaults['max']) 
			$this->error[] = sprintf("%s contains too many values",$this->defaults['name']);
		};
	}
	
function checkValidation() {
	if (isset($this->defaults['validation'])) {
		if($this->defaults['minLen']==0 && strlen($this->value)!=0) {
			if(!filter_var($this->value, $this->defaults['validation'])) 
				$this->error[] = sprintf("%s contains an invalid value: %s.",$this->defaults['name'],$this->value);
			};
		};
	}	
	
} // end Class Cell
?>
