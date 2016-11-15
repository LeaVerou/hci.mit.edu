<?php 
// Set the current year. Update this every year!
define("CUR_YEAR", "2015-2016");

$string = file_get_contents("seminar.json");
$json = json_decode($string, true);

foreach($json['series'] as $index => $series) {
	echo '<h2>' . $series['year'] . '</h2>';
	$items = array();
	foreach($series['entries'] as $k => $v) {
		$videoHtml = '';
		if (!is_null($v['video']))
			$videoHtml = '<span class="video"><a href="' . $v['video'] . '">VIDEO</a></span>';
		$items[] = '<li class="seminar" id="' . $series['year'] . '-' . $k . '">' . 
		    	'<div class="nextup"></div><div class="nextup2"></div>' .
		    	'<div class="speaker">' . $v['speaker'] . ' (' . $v['affiliation'] . ')</div>' .
		    	'<div class="title">' . $videoHtml . ' <a href="' . $v['url'] . '">' . $v['title'] . '</a></div>' .
		    	'<span class="date">' . $v['date'] . '</span>. <span class="time">' . $v['time'] . '</span>. Location: <span class="location">' . $v['location'] . '</span>' .
		    	'</li>';
	}
	
	$ulClass = "features clearingfix";
	if ($series['year'] == CUR_YEAR)
		$ulClass .= " currentSeminar";
	else
		$ulClass .= " prevSeminar";

	echo '<ul class="' . $ulClass . '">' . implode("", $items) . '</ul>';
}

?>
