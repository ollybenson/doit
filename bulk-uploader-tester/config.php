<?php
function defaultArrays($arrayName,$key = NULL) {
$a = array();
$a['regex'] = array(
	'address' => '^[A-Za-z0-9 ]*$',
	'postcode' => '^((([A-PR-UWYZ][0-9])|([A-PR-UWYZ][0-9][0-9])|([A-PR-UWYZ][A-HK-Y][0-9])|([A-PR-UWYZ][A-HK-Y][0-9][0-9])|([A-PR-UWYZ][0-9][A-HJKSTUW])|([A-PR-UWYZ][A-HK-Y][0-9][ABEHMNPRVWXY]))) || ^((GIR)[ ]?(0AA))$|^(([A-PR-UWYZ][0-9])[ ]?([0-9][ABD-HJLNPQ-UW-Z]{0,2}))$|^(([A-PR-UWYZ][0-9][0-9])[ ]?([0-9][ABD-HJLNPQ-UW-Z]{0,2}))$|^(([A-PR-UWYZ][A-HK-Y0-9][0-9])[ ]?([0-9][ABD-HJLNPQ-UW-Z]{0,2}))$|^(([A-PR-UWYZ][A-HK-Y0-9][0-9][0-9])[ ]?([0-9][ABD-HJLNPQ-UW-Z]{0,2}))$|^(([A-PR-UWYZ][0-9][A-HJKS-UW0-9])[ ]?([0-9][ABD-HJLNPQ-UW-Z]{0,2}))$|^(([A-PR-UWYZ][A-HK-Y0-9][0-9][ABEHMNPRVWXY0-9])[ ]?([0-9][ABD-HJLNPQ-UW-Z]{0,2}))$',
	'alphaNumeric' => '^[\x20\x21\x20-\x7E£]*$',
	'alphaNumericLineFeeds' => '^[\xA\xD\x20\x21\x20-\x7E£]*$',
	'date' => '^\d\d-\d\d-\d\d\d\d$',
	'dateTime' => '^\d\d-\d\d-\d\d\d\d \d\d:\d\d:\d\d$',
	'trueFalse' => '^(True|False)$',
	'availabilityGrid' => '^11(0|1)\|12(0|1)\|13(0|1)\|21(0|1)\|22(0|1)\|23(0|1)\|31(0|1)\|32(0|1)\|33(0|1)\|41(0|1)\|42(0|1)\|43(0|1)\|51(0|1)\|52(0|1)\|53(0|1)\|61(0|1)\|62(0|1)\|63(0|1)\|71(0|1)\|72(0|1)\|73(0|1)\|?$',
	'vbaseVersion' => '3\.0\.0\.0');
	
$a['causesInterests'] = array(
	"Older People",
	"Emergency Services and Safety",
	"Environment and Conservation",
	"Gay, Lesbian, Bi and Transgender",
	"Homelessness and Housing",
	"Health and Social Care",
	"Law and Legal Support",
	"Museums and Libraries",
	"Offenders and Ex-Offenders",
	"Race, Ethnicity and Refugees",
	"Faith-based",
	"Sport and Recreation",
	"Women",
	"Animals",
	"Art and Culture",
	"Children",
	"Disability",
	"Disaster Relief",
	"Domestic Violence",
	"Drugs and Addictions",
	"Employment",
	"Families",
	"Heritage",
	"Human and Civil Rights",
	"International Aid",
	"Mental Health",
	"Music",
	"Politics",
	"Youth",
	"Education and Literacy");

$a['activities'] = array(
	"Architecture, Building and Construction",
	"Arts, Entertainment and Music",
	"Befriending, Buddying and Mentoring",
	"Technology and the Internet",
	"Group Volunteering",
	"Finance and accountancy",
	"Gardening and Conservation",
	"Legal and the Law",
	"Marketing, Media and Communications",
	"Events and Stewarding",
	"Manual Work and DIY",
	"Sports and Coaching",
	"Teaching, Training and Leading",
	"Trusteeship and Committees",
	"Advice, Information and Support",
	"Administration",
	"Caring",
	"Catering",
	"Counselling",
	"Driving",
	"Fundraising",
	"Hostel Work",
	"Languages",
	"Retail and Charity Shops",
	"Campaigning and Lobbying",
	"Business, Management and Research",
	"First Aid",
	"General and Helping",
	"Local Events",
	"Officials",
	"Youth Work");

$a['commitmentType'] = array(
	"Full Time",
	"Part Time",
	"Short Term");

$a['suitabilities'] = array(
	"Under 16s",
	"Under 18s",
	"Young people (16-25)",
	"Families",
	"Doing with a friend",
	"Sensory impairments",
	"Physical impairments",
	"Cognitive impairments",
	"Employee Volunteering",
	"Groups - Small (2-10)",
	"Groups - Medium (10-25)",
	"Groups - Large (25-40)",
	"Groups - Very Large (40+)");

$a['boundaryWide'] = array(172,174,188,189,190,191,196,197,199,200,203,205,210,214,215,216,218,223,225,226,228,230,239,242,243,245,246,248,249,252,253,254,257,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,276,277,278,279,280,281,282,283,284,285,286,287,288,289,290,291,292,293,294,295,296,297,298,299,300,301,302,303,304,305,306,307,308,309,310,311,312,313,314,315,316,317,318,319,320,321,322,323,324,325,326,327,328,329,330,331,332,333,334,335,336,337,338,339,340,341,342,343,344,345,346,347,348,349,350,351,352,353,354,355,356,357,358,359,360,361,362,363,364,365,366,367,368,369,370,371,372,373,374,375,376,377,378,379,380,381,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437,438,439,440,441,442,443,444,445,446,447,448,449,450,451,452,453,454,455,456,457,458,459,460,461,462,463,464,465,466,467,468,469,470,471,472,473,474,475,476,477,478,479,480,481,482,483,484,485,486,487,488,489,490,491,492,493,494,495,496,497,498,499,500,501,502,503,504,505,506,507,508,509,510,511,512,513,514,515,516,517,518,519,520,521,522,523,524,525,526,527,528,529,530,531,532,533,534,535,536,537,538,539,540,541,542,543,544,545,546,547,548,549,550,551,552,553,554,555,556,557,558,559,560,561,562,563,564,565,566,567,568,569,570,571,572,573,574,575,576,577,578,579,580,581,582,583,584,585,586,587,588,589,590,591,592,593,594,595,596,597,598,599,600,601,602,603,604,605,606,607,608,609,610,611,612,613,614,615,616,617,618,619,620,621,622,623,624,625,626,627,628,629,630,631,632,633,634,635,636,637,638,639,640,641,642,643,644,645,646,647,648,649,650,651,652,653,654,655,656,657,658,659,660,661,662,663,664,665,666,667,668,669,670,671,672,673,674,675,676,677,678);

$a['firstLineDefaults'] = array (
	0 => array('name' => 'Name', 'minLen' => 5, 'maxLen' => 255, 'regex' => 'alphaNumeric', 'description' => 'Name of posting organisation'),
	1 => array('name' => 'Address Line 1', 'maxLen' => 100, 'regex' => 'alphaNumeric'),		
	2 => array('name' => 'Address Line 2', 'maxLen' => 100, 'regex' => 'alphaNumeric'),		
	3 => array('name' => 'Town', 'maxLen' => 100, 'regex' => 'alphaNumeric'),		
	4 => array('name' => 'County', 'maxLen' => 100, 'regex' => 'alphaNumeric'),		
	5 => array('name' => 'Postcode', 'maxLen' => 15, 'regex' => 'postcode'),
	6 => array('name' => 'Telephone', 'maxLen' => 150, 'regex' => 'alphaNumeric'),
	7 => array('name' => 'Fax', 'maxLen' => 150, 'regex' => 'alphaNumeric'),
	8 => array('name' => 'Email', 'minLen' => 5, 'maxLen' => 200, 'validation' => FILTER_VALIDATE_EMAIL),
	9 => array('name' => 'Website', 'minLen' => 0,'maxLen' => 255, 'validation' => FILTER_VALIDATE_URL),
	10 => array('name' => 'VbaseVersion', 'minLen' => 5, 'maxLen' => 14, 'regex' => 'vbaseVersion'),		
	11 => array('name' => 'Address Line 3', 'maxLen' => 100, 'regex' => 'alphaNumeric'));		



$a['rowDefaults'] = array(
	0 => array('name' => 'ID','minLen' => 1, 'maxLen' => 82, 'regex' => 'alphaNumeric'),
	1 => array('name' => 'Organisation name','minLen' => 1, 'maxLen' => 70, 'regex' => 'alphaNumeric'),
	2 => array('name' => 'Opportunity name','minLen' => 1, 'maxLen' => 70, 'regex' => 'alphaNumeric'),
	3 => array('name' => 'Public Contact Details - BLANK','minLen' => 0, 'maxLen' => 0),
	4 => array('name' => 'Address Line 1','minLen' => 0, 'maxLen' => 100, 'regex' => 'alphaNumeric'),
	5 => array('name' => 'Address Line 2','minLen' => 0, 'maxLen' => 100, 'regex' => 'alphaNumeric'),
	6 => array('name' => 'Town','minLen' => 0, 'maxLen' => 60, 'regex' => 'alphaNumeric'),
	7 => array('name' => 'County','minLen' => 0, 'maxLen' => 60, 'regex' => 'alphaNumeric'),
	8 => array('name' => 'Postcode','minLen' => 0, 'maxLen' => 8, 'regex' => 'postcode'),
	9 => array('name' => 'Tel number','minLen' => 0, 'maxLen' => 20, 'regex' => 'alphaNumeric'),
	10 => array('name' => 'Fax number','minLen' => 0, 'maxLen' => 20, 'regex' => 'alphaNumeric'),
	11 => array('name' => 'Email','minLen' => 0, 'maxLen' => 255, 'validation' => FILTER_VALIDATE_EMAIL),
	12 => array('name' => 'Not used - BLANK','minLen' => 0, 'maxLen' => 0),
	13 => array('name' => 'Description','minLen' => 75, 'maxLen' => 2000, 'regex' => 'alphaNumericLineFeeds'),
	14 => array('name' => 'Requirements and Benefits','minLen' => 0, 'maxLen' => 2000, 'regex' => 'alphaNumericLineFeeds'),
	15 => array('name' => 'Directions','minLen' => 0, 'maxLen' => 2000, 'regex' => 'alphaNumericLineFeeds'),
	16 => array('name' => 'Modified','minLen' => 19, 'regex' => 'dateTime'),
	17 => array('name' => 'Cause/Interest','min' => 0, 'max' => 5, 'inArray' => 'causesInterests'),
	18 => array('name' => 'Activities','min' => 0, 'max' => 5, 'inArray' => 'activities'),
	19 => array('name' => 'Availability Grid', 'regex' => 'availabilityGrid'),
	20 => array('name' => 'Website','minLen' => 0, 'maxLen' => 250, 'validation' => FILTER_VALIDATE_URL),
	21 => array('name' => 'Organisation Description','minLen' => 75, 'maxLen' => 2000, 'regex' => 'alphaNumericLineFeeds'),
	22 => array('name' => 'Application contact', 'minLen' => 1, 'regex' => 'trueFalse'),
	23 => array('name' => 'Advertising Start Date','minLen' => 10,'regex' => 'date'),
	24 => array('name' => 'Advertising End Date','minLen' => 10,'regex' => 'date'),
	25 => array('name' => 'One off', 'minLen' => 1,'regex' => 'trueFalse'),
	26 => array('name' => 'Virtual', 'minLen' => 1,'regex' => 'trueFalse'),
	27 => array('name' => 'Residential', 'regex' => 'trueFalse'),
	28 => array('name' => 'Commitment Type','min' => 0, 'max' => 5, 'inArray' => 'commitmentType'),
	29 => array('name' => 'Suitabilities','min' => 0, 'max' => 5, 'inArray' => 'suitabilities'),
	30 => array('name' => 'Start Date','min' => 0,'regex' => 'date'),
	31 => array('name' => 'End Date','min' => 0,'regex' => 'date'),
	32 => array('name' => 'Short description','minLen' => 75, 'maxLen' => 255, 'regex' => 'alphaNumericLineFeeds'),
	33 => array('name' => 'Address Line 3','minLen' => 0, 'maxLen' => 100, 'regex' => 'alphaNumeric'),
	34 => array('name' => 'Show on Maps','minLen' => 1, 'regex' => 'trueFalse'),
	35 => array('name' => 'Boundary Wide','min' => 0, 'max' => 1, 'inArray' => 'boundaryWide', 'onlyIf' => 'EmptyPostcode'),
	36 => array('name' => 'First Name','minLen' => 0, 'maxLen' => 255, 'regex' => 'alphaNumeric'),
	37 => array('name' => 'Last Name','minLen' => 0, 'maxLen' => 255, 'regex' => 'alphaNumeric'));

	$temp = $a[$arrayName];
	if(isset($key)) {
		if ($key=='TOTAL') return count($temp);
			else return $temp[$key];
		}
		else return $temp;	
	};
?>
