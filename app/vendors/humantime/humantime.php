<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class humantime{
    function getHumanTime($timestamp){
	$difference = time() - $timestamp;
	$periods = array("sec", "min", "hour", "day", "week", "month", "year", "decade");
	$lengths = array("60","60","24","7","4.35","12","10");

	if ($difference > 0) { // this was in the past
		$ending = "ago";
	} else { // this was in the future
		$difference = -$difference;
		$ending = "to go";
	}
	for($j = 0; $difference >= $lengths[$j]; $j++)
		$difference /= $lengths[$j];
	$difference = round($difference);
	if($difference != 1) $periods[$j].= "s";
	$text = "$difference $periods[$j] $ending";
	return $text;
    }
}

?>
