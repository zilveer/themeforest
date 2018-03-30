<?php 

function get_slideshow() {
?>
	<div class="slideouter">
	<div id="coin-slider">
	
	<?php query_posts( array( 'post_type' => 'slideshows', 'showposts' => 10000, ) );
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$active = '';
	$numbers = get_the_ID();
	$active = get_post_meta($numbers, 'netlabs_activate', true);
	$linkto = '';
	$slidedesc = get_post_meta($numbers, 'netlabs_slidedesc', true);
	$thispost = '';
	$thispost = get_post_meta($numbers, 'netlabs_linkpost', true);
	if ($thispost != 'nothing'){
	$thislink = get_permalink($thispost);
	} else {
	$thislink = "#";
	}
	if ($active) {
	?>	
		<a href="<?php echo $thislink; ?>" >
			<?php echo get_the_post_thumbnail($numbers, 'slider') ?>
			<?php if ($slidedesc) { ?>
			<span>
				<?php echo html_entity_decode ($slidedesc); ?>
			</span>	
			<?php } ?>
		</a>				
						
	<?php 
	}
	endwhile;
	else :
	endif;
	wp_reset_query();?>
	
	</div>
	</div>
		
<?php 


}




function prevlink($month,$year) {
	global $post;
	if ($month) {
		$month = $month - 1; 
	} else {
		$month = date('n')-1;
		$year = date('Y');
	}
	if ($month <= 0) { $month = 12; $year = $year - 1; }
	return '<a href="#" rel="' . $month . '/' . $year . '" class="prevlink">' . __('PREV', 'wp-church') . '</a>';
}

function nextlink($month,$year) {
	global $post;
	if ($month) {
		$month = $month + 1;
	} else {
		$month = date('n')+1;
		$year = date('Y');
	}
	if ($month >= 13) {$month = 1;$year = $year + 1;}
	return '<a href="#" rel="' . $month . '/' . $year . '" class="nxtlink">' . __('NEXT', 'wp-church') . '</a>';
}

function monthname($month,$year) {
	global $post, $wp_locale;
	if ($month) {
		$output = date_i18n( 'F Y' , mktime(0, 0, 0, $month, 1, $year), false );
	} else {
		$output = date_i18n( 'F Y' , time(), false );
	}
	return $output;
}


function dateDff($start, $end) {
	$start_ts = strtotime($start);
	$end_ts = strtotime($end);
	$diff = $end_ts - $start_ts;
	return round($diff / 86400);
}


function get_first_day($day_number, $month=false, $year=false)
  {
    $month  = ($month === false) ? strftime("%m"): $month;
    $year   = ($year === false) ? strftime("%Y"): $year;
	if ($day_number == 'Sunday') {$day_number = 0; 
  	} elseif($day_number == 'Monday') {$day_number = 1;
  	} elseif($day_number == 'Tuesday') {$day_number = 2;
  	} elseif ($day_number == 'Wednesday') {$day_number = 3;
  	} elseif ($day_number == 'Thursday') {$day_number = 4;
	} elseif ($day_number == 'Friday') {$day_number = 5;
	} elseif ($day_number == 'Saturday') {$day_number = 6; } 
    $first_day = 1 + ((7+$day_number - strftime("%w", mktime(0,0,0,$month, 1, $year)))%7);
    return mktime(0,0,0,$month, $first_day, $year);
}




function calendar_add($cstrdate,$cctitle,$cclink,$cccontent,$cclocation,$ccids) {
	global $calentries;
	$calentries[] = array
			(					
				'strdate' => $cstrdate,
				'ctitle' => $cctitle,
				'clink' => $cclink,
				'ccontent' => $cccontent,
				'clocation' => $cclocation,
				'cids' => $ccids,
		);	
}

function monthconvert($monthname) {
	$monthnames = '';
	if ($monthname == '1') {$monthnames = 'Jan';}
	if ($monthname == '2') {$monthnames = 'Feb';}
	if ($monthname == '3') {$monthnames = 'Mar';}
	if ($monthname == '4') {$monthnames = 'Apr';}
	if ($monthname == '5') {$monthnames = 'May';}
	if ($monthname == '6') {$monthnames = 'Jun';}
	if ($monthname == '7') {$monthnames = 'Jul';}
	if ($monthname == '8') {$monthnames = 'Aug';}
	if ($monthname == '9') {$monthnames = 'Sept';} 
	if ($monthname == '01') {$monthnames = 'Jan';}
	if ($monthname == '02') {$monthnames = 'Feb';}
	if ($monthname == '03') {$monthnames = 'Mar';}
	if ($monthname == '04') {$monthnames = 'Apr';}
	if ($monthname == '05') {$monthnames = 'May';}
	if ($monthname == '06') {$monthnames = 'Jun';}
	if ($monthname == '07') {$monthnames = 'Jul';}
	if ($monthname == '08') {$monthnames = 'Aug';}
	if ($monthname == '09') {$monthnames = 'Sept';} 
	if ($monthname == '10') {$monthnames = 'Oct';} 
	if ($monthname == '11') {$monthnames = 'Nov';} 
	if ($monthname == '12') {$monthnames = 'Dec';}
	if ($monthname == 1) {$monthnames = 'Jan';}
	if ($monthname == 2) {$monthnames = 'Feb';}
	if ($monthname == 3) {$monthnames = 'Mar';}
	if ($monthname == 4) {$monthnames = 'Apr';}
	if ($monthname == 5) {$monthnames = 'May';}
	if ($monthname == 6) {$monthnames = 'Jun';}
	if ($monthname == 7) {$monthnames = 'Jul';}
	if ($monthname == 8) {$monthnames = 'Aug';}
	if ($monthname == 9) {$monthnames = 'Sept';} 
	if ($monthname == 01) {$monthnames = 'Jan';}
	if ($monthname == 02) {$monthnames = 'Feb';}
	if ($monthname == 03) {$monthnames = 'Mar';}
	if ($monthname == 04) {$monthnames = 'Apr';}
	if ($monthname == 05) {$monthnames = 'May';}
	if ($monthname == 06) {$monthnames = 'Jun';}
	if ($monthname == 07) {$monthnames = 'Jul';}
	if ($monthname == 08) {$monthnames = 'Aug';}
	if ($monthname == 09) {$monthnames = 'Sept';} 
	if ($monthname == 10) {$monthnames = 'Oct';} 
	if ($monthname == 11) {$monthnames = 'Nov';} 
	if ($monthname == 12) {$monthnames = 'Dec';}
	return $monthnames;   
}

function make_epoch($day, $month , $year , $time , $gmt) {
	$thismonth = monthconvert($month);	
	$thisconvert = $day . ' ' . $thismonth . ' ' . $year . ' ' . $time . ' ' . $gmt;
	$thisdatereturn = strtotime($thisconvert);
	return $thisdatereturn;	
}

function recinthappening ($intervalvalue, $dayvalue, $month, $year, $time, $daysinmonth){
	
	if (!$time){$time = '23:59:59';}	
	$first_day_tocalculate = get_first_day($dayvalue, $month, $year);
		
	$specrec = make_epoch(date('j', $first_day_tocalculate), date('m', $first_day_tocalculate), date('Y', $first_day_tocalculate), $time,'GMT');
		
	if ($intervalvalue == 'Second') {$specrec = $specrec + 604800;}
	if ($intervalvalue == 'Third') {$specrec = $specrec + 1209600;}		
	if ($intervalvalue == 'Fourth') {$specrec = $specrec + 1814400;}	
	if ($intervalvalue == 'Last') {	
		$lastmonthday = make_epoch($daysinmonth, $month,  $year, '23:59:59' ,'GMT');
	
		if ($specrec + 2419200 <= $lastmonthday) {
			$specrec = $specrec + 2419200;
		} else {
			$specrec = $specrec + 1814400;
		}	
	}
	return $specrec;	
}



function get_the_events($month,$year) {
	global $calentries;
	$output = '';
	unset($calentries);
	$datediff = 0;
	$calentries = array();
	$args=array(
		'post_type'=>'calendars',
		'showposts'=> 10000,
	);
	
	$my_query = new WP_Query($args);
	if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
	$postid = get_the_ID();
	$key_date_value = '';
	$key_end_value = '';
	$key_time_value = ' ';
	$key_place_value = ' ';
	$key_recurring_value = '';
	$key_recint_value = '';
	$key_recday_value = '';
	$occurance = '';
	$key_recint_value = get_post_meta($postid, 'netlabs_recint', true);
	$key_recday_value = get_post_meta($postid, 'netlabs_recday', true);
	$key_date_value = get_post_meta($postid, 'netlabs_datestartentry', true);
	$key_recurring_value = get_post_meta($postid, 'netlabs_recurring', true);
	$key_end_value = get_post_meta($postid, 'netlabs_dateendentry', true);
	$key_time_value = get_post_meta($postid, 'netlabs_timestartentry', true);
	$key_place_value = get_post_meta($postid, 'netlabs_thelocation', true);
	
	// create a valid date from data
	$dateholder = explode('/',$key_date_value);
	$endholder =  explode('/',$key_end_value);	
	
	$startepoch = '';
	// get epoch for start date	
	if ($key_time_value) {
		$startepoch = strtotime($dateholder[0] .  ' ' .  monthconvert($dateholder[1]) . ' ' .  $dateholder[2] .  ' ' . $key_time_value . ' GMT');
		}  else {
		$startepoch = strtotime($dateholder[0] .  ' ' .  monthconvert($dateholder[1]) . ' ' .  $dateholder[2] .  ' 00:00:01 GMT');
	}
		
	$endepoch = '';	
	if ($key_end_value && $key_time_value ) {
		$endepoch = strtotime($endholder[0] .  ' ' .  monthconvert($endholder[1]) . ' ' .  $endholder[2] .  ' ' . $key_time_value . ' GMT');
	} elseif ($key_end_value && !$key_time_value ) {	
		$endepoch = strtotime($endholder[0] .  ' ' .  monthconvert($endholder[1]) . ' ' .  $endholder[2] .  ' 00:00:01 GMT');
	}
	
	// get epoch for first day in month
	if ($key_time_value ) {
	$beginningepoch = make_epoch('1', $month, $year, $key_time_value ,'GMT');
	} else {
	$beginningepoch = make_epoch('1', $month, $year, '00:00:01','GMT');
	}
	
	
	$daysinmonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	
	// get epoch for last day in month
	$closingepoch = make_epoch($daysinmonth, $month, $year, '23:59:59','GMT');
	
	
	// special reccuring
	if ($key_recint_value != 'select interval' && $key_recday_value != 'select day') {	
		$firstone = recinthappening($key_recint_value, $key_recday_value, $month, $year, $key_time_value, $daysinmonth);
		$occurance = 1;
	
		if ($startepoch > $firstone ) {
			$occurance = 0;			
		} else {		
			if ($endepoch && ($endepoch < $firstone)) {
				$occurance = 0;
			}		
		} 

	// basic reccuring
	} elseif ($key_recurring_value != 'Never') {
	
		if ($key_recurring_value == 'Every month same date') {
			$occurance = 1;
			if ($key_time_value) {
				$firstone = make_epoch(date('j', $startepoch), $month, $year, $key_time_value,'GMT');
			} else {
				$firstone = make_epoch(date('j', $startepoch), $month, $year, '11.59 pm','GMT');
			}
			
			if ($startepoch > $firstone) {
				$occurance = 0;			
			} else {		
				if ($endepoch && ($endepoch < $firstone)) {
					$occurance = 0;
				}		
			} 
		}
		
		if ($key_recurring_value == 'Every week same day') {
			$occurance = 2;
			$interval = 604800;
			unset($datelist);
			$datelist = array();
			$the_dayname = date('l', $startepoch);
			// epoch for first occurence in month
			$first_occurence_in_month = get_first_day($the_dayname, $month, $year);
			
			if ($key_time_value) {
				$firstone = make_epoch(date('j', $first_occurence_in_month), date('m', $first_occurence_in_month), date('Y', $first_occurence_in_month), $key_time_value,' GMT');
			} else {
				$firstone = make_epoch(date('j', $first_occurence_in_month), date('m', $first_occurence_in_month), date('Y', $first_occurence_in_month), '11.59 pm',' GMT');
			}
			
			for($i = $firstone; $i < $closingepoch; $i = $i + $interval) {	
				if ($startepoch > $i ) {
					//do nothing
				} else {
					if (!$endepoch) {
						$datelist[] = $i;
					} else {
						if ($endepoch > $i) {
							$datelist[] = $i;
						}
					}
				}
			}		
		}

	// single or multiday
	} else {
		
		if (!$endepoch) {
			if ($startepoch > $beginningepoch && $startepoch < $closingepoch) {
				$occurance = 1;
				$firstone = $startepoch;
			}
		} else {
			$occurance = 2;
			unset($datelist);
			$datelist = array();
			for($i = ($beginningepoch); $i < $closingepoch; $i = $i + 86400) {
				if ($i >= $startepoch && $i <= $endepoch) {
					$datelist[] = $i;
				}
			}
		}
	} 
	
	if ($occurance == 1) {
		calendar_add($firstone,get_the_title(),get_permalink(),get_the_excerpt(),$key_place_value, $postid );
	}
	
	if ($occurance == 2) {
		foreach ($datelist as $dateentry) {
			calendar_add($dateentry,get_the_title(),get_permalink(),get_the_excerpt(),$key_place_value, $postid );
		}
	}
	
	endwhile;
	else : endif;
	wp_reset_query();	
}

function subval_sort($a,$subkey) {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
	asort($b);
	foreach($b as $key=>$val) {
		$c[] = $a[$key];
	}
	return $c;
}


function get_the_calendar($cmonth,$cyear) {
	global $calentries;
	$calentries = array();
	$output = '';
	get_the_events($cmonth,$cyear);

	if($calentries) {		
		$calentries = subval_sort($calentries,'strdate'); 
		foreach ($calentries as $cal_the_entry) {
			
			$tmonth = date_i18n( 'D' , $cal_the_entry['strdate'] , false );
			$caltime = get_post_meta($cal_the_entry['cids'], 'netlabs_timestartentry', true);
			$output .= '<div class="calsingleentry"><div class="ftd" style="margin-top: 10px;"><div class="finf"><a href="' . $cal_the_entry['clink'] .  '">more</a></div></div><div class="daydisplay"><h1>'. date('d', $cal_the_entry['strdate']) . ' <span>' . $tmonth .   '</span></h1></div>';
			$output .= '<div class="shortcalentry"><a href="' . $cal_the_entry['clink'] . '">' . $cal_the_entry['ctitle'] .  '</a>';
			if ($caltime){ 
				$output .= '<span class="intdesc"><strong>' . __('Time:', 'wp-church') . '</strong>' . $caltime . '&nbsp;&nbsp;&nbsp;';
			}
			if ($cal_the_entry['clocation']){ 
				$output .= '|&nbsp;&nbsp;&nbsp;&nbsp;<strong>' . __('Place:', 'wp-church') . '</strong>' . $cal_the_entry['clocation']  . ' ';
			}	
			$output .= '</span></div></div>';
		}	
		return $output;
	} else {
		return '<p>' . __('No entries Found', 'wp-church') . '</p>';
	}
}



function get_for_timer(){
	global $calentries;
	$calentries = array();
	$coutput = '';
	$tmonth = date("n");
	$tyear = date("Y");
	$emptycounter = 0;
	$ccounter = '';
	$currententry = date('U');
	$offset = get_option('gmt_offset');
	$offset = $offset * 60 * 60;
	$currententry = $currententry + $offset;
	
	while ($emptycounter <= 5 && !$ccounter) { 	
		get_the_events($tmonth,$tyear);		
		if($calentries) {	
			$calentries = subval_sort($calentries,'strdate'); 
			foreach ($calentries as $cal_the_entry) {			
				if ($cal_the_entry['strdate'] >= $currententry && !$ccounter) {			
					$coutput .= '<div class="time" contents="' . get_option('gmt_offset')  .'" rel="' . $cal_the_entry['strdate'] . '"></div><a class="timelink" href="' . $cal_the_entry['clink'] . '">' . __('View Event:', 'wp-church') . '</a>
					<div class="timernames" style="display: none"><a class="tnamesday" href="#">' . __('Days', 'wp-church') . '</a><a class="tnameshour" href="#">' . __('Hours', 'wp-church') . '</a><a class="tnamesmin"  href="#">' . __('Min', 'wp-church') . '</a><a class="tnamessec" href="#">' . __('Sec', 'wp-church') . '</a></div>';
					$ccounter = 1;			
				}		
			}	
		}		
		$tmonth = $tmonth + 1;
		if ($tmonth == 13) {
			$tmonth = 1;
			$tyear = $tyear + 1;
		}
		$emptycounter++;
	}
	
	if ($coutput) {
		echo $coutput;
	} else{
		echo __('No entries Found', 'wp-church');
	}
}

function get_for_widget($num){
	global $calentries;
	$woutput = '';
	$monthset = '';
	$wmonth = date("n");
	$wyear = date("Y");
	$emptycounter = 0;
	$wcounter = 0;
	$currententry = date('U') + (get_option('gmt_offset') * 3600);
	$continue = 0;
	$wnum = $num - 1;
	
	while ($continue != 1) { 
		$calentries = array();
		get_the_events($wmonth,$wyear);	
		if($calentries) {
			$calentries = subval_sort($calentries,'strdate'); 
			foreach ($calentries as $cal_the_entry) {	
				if ($cal_the_entry['strdate'] >= $currententry && $wcounter <= $wnum) {
					$caltime = get_post_meta($cal_the_entry['cids'], 'netlabs_timestartentry', true);
					$woutput .= '<div class="calsingleentryw"><a href="' . $cal_the_entry['clink'] . '"><img src="' . get_template_directory_uri() . '/images/seemore.png"></a><div class="daydisplayw"><h1>' . date_i18n( 'd' , $cal_the_entry['strdate'] , false ) . '<br/><span>' . date_i18n( 'M' , $cal_the_entry['strdate'] , false ) . '</span></h1></div>';
					$woutput .= '<div class="shortcalentryw"><a href="' . $cal_the_entry['clink'] . '">' . $cal_the_entry['ctitle'] .  '</a>';
					if ($caltime){ 
					$woutput .= '<span class="intdesc"><strong>' . __('Time:', 'wp-church') . '</strong>' . $caltime . '&nbsp;&nbsp;&nbsp;';
					}
					if ($cal_the_entry['clocation']){ 
					$woutput .= '|&nbsp;&nbsp;&nbsp;&nbsp;<strong>' . __('Place:', 'wp-church') . '</strong>' . $cal_the_entry['clocation']  . '</span>';
					}	
					$woutput .= '</div><div class="clear"></div></div>';				
					$wcounter = $wcounter + 1;			
				}		
			}	
		}
				
		$wmonth = $wmonth + 1;
		if ($wmonth == 13) {
			$wmonth = 1;
			$wyear = $wyear + 1;
		}
		$emptycounter++;
		$monthset = '';
		if ($wcounter >= $num || $emptycounter >= 5) {
			$continue = 1;
		}
	}
	
	if ($woutput) {
		echo $woutput;
	} else{
		echo 'No entries found';
	}
}

function caldescript($post_ID) {

	$key_date_value = '';
	$key_end_value = '';
	$key_time_value = '';
	$key_place_value = '';
	$key_recurring_value = '';
	$key_recint_value = '';
	$key_recday_value = '';
	$key_recint_value = get_post_meta($post_ID, 'netlabs_recint', true);
	$key_recday_value = get_post_meta($post_ID, 'netlabs_recday', true);
	$key_date_value = get_post_meta($post_ID, 'netlabs_datestartentry', true);
	$key_recurring_value = get_post_meta($post_ID, 'netlabs_recurring', true);
	$key_end_value = get_post_meta($post_ID, 'netlabs_dateendentry', true);
	$key_time_value = get_post_meta($post_ID, 'netlabs_timestartentry', true);
	$key_place_value = get_post_meta($post_ID, 'netlabs_thelocation', true);
	
	
	$dateholder = explode('/',$key_date_value);	
	
	$datestring = make_epoch($dateholder[0], $dateholder[1] , $dateholder[2] , $key_time_value , 'GMT');
	if ($key_end_value) {
	$endholder =  explode('/',$key_end_value);
	$endstring = make_epoch($endholder[0], $endholder[1] , $endholder[2] , $key_time_value , 'GMT');
	} else {
	$endstring = '';
	}
	
	$output = '<div class="calexplain">';
	if ($key_recurring_value == 'Never' && $key_recint_value == 'select interval' && $key_recday_value == 'select day'){
	
		if ($endstring) {
		
		$output .= '<p class="calsingle"><strong>' . __('Start Date:', 'wp-church') . ' </strong><span>' . date_i18n( 'd F Y' , $datestring , false ) . '</span><div class="clear"></div></p>';
		$output .= '<p class="calsingle"><strong>' . __('End Date:', 'wp-church') . ' </strong><span>' . date_i18n( 'd F Y' , $endstring , false ) . '</span><div class="clear"></div></p>';
		if ($key_time_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Time:', 'wp-church') . ' </strong><span>'. $key_time_value .'</span><div class="clear"></div></p>';
		}
		
		if ($key_place_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Place:', 'wp-church') . ' </strong><span>'. $key_place_value .'</span><div class="clear"></div></p>';
		}
		
		} else {
		
		$output .=  '<p class="calsingle"><strong>' . __('Date:', 'wp-church') . ' </strong><span>' . date_i18n( 'l d F Y' , $datestring , false ) . '</span><div class="clear"></div></p>';
		
		if ($key_time_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Time:', 'wp-church') . ' </strong><span>'. $key_time_value .'</span><div class="clear"></div></p>';
		}
		
		if ($key_place_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Place:', 'wp-church') . ' </strong><span>'. $key_place_value .'</span><div class="clear"></div></p>';
		}
		
		}
	
	}
	
	if ($key_recurring_value == 'Every week same day' && $key_recint_value == 'select interval' && $key_recday_value == 'select day'){
	
		if ($endstring) {
		$output .= '<p class="calsingle"><strong>' . __('Every ', 'wp-church') . ' '  . date_i18n( ' l ' , $datestring , false ) . '</strong><div class="clear"></div></p>';
		$output .= '<p class="calsingle"><strong>' . __('Until:', 'wp-church') . ' </strong><span>' . date_i18n( 'd F Y' , $endstring , false ) . '</span><div class="clear"></div></p>';
		if ($key_time_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Time:', 'wp-church') . ' </strong><span>'. $key_time_value .'</span><div class="clear"></div></p>';
		}
		
		if ($key_place_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Place:', 'wp-church') . ' </strong><span>'. $key_place_value .'</span><div class="clear"></div></p>';
		}
		
		} else {
		
		$output .= '<p class="calsingle"><strong>' . __('Every', 'wp-church') . ' '  . date_i18n( ' l ' , $datestring , false ) . '</strong><div class="clear"></div></p>';
		
		if ($key_time_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Time:', 'wp-church') . ' </strong><span>'. $key_time_value .'</span><div class="clear"></div></p>';
		}
		
		if ($key_place_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Place:', 'wp-church') . ' </strong><span>'. $key_place_value .'</span><div class="clear"></div></p>';
		}
		
		}
	
	}
	
if ($key_recurring_value == 'Every month same date' && $key_recint_value == 'select interval' && $key_recday_value == 'select day'){
	
		if ($endstring) {
		$output .= '<p class="calsingle"><strong>' . __('Every ', 'wp-church') . ' '  . date_i18n( 'jS' , $datestring , false ) .  __('of the month', 'wp-church') . ' </strong><div class="clear"></div></p>';
		$output .= '<p class="calsingle"><strong>' . __('Until:', 'wp-church') . ' </strong><span>' . date_i18n( 'd F Y' , $endstring , false ) . '</span><div class="clear"></div></p>';
		if ($key_time_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Time:', 'wp-church') . ' </strong><span>'. $key_time_value .'</span><div class="clear"></div></p>';
		}
		
		if ($key_place_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Place:', 'wp-church') . ' </strong><span>'. $key_place_value .'</span><div class="clear"></div></p>';
		}
		
		} else {
		
		$output .= '<p class="calsingle"><strong>' . __('Every ', 'wp-church') . ' '  . date_i18n( 'jS' , $datestring , false ) . ' ' .  __('of the month', 'wp-church') . ' </strong><div class="clear"></div></p>';
		
		if ($key_time_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Time:', 'wp-church') . ' </strong><span> '. $key_time_value .'</span><div class="clear"></div></p>';
		}
		
		if ($key_place_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Place:', 'wp-church') . ' </strong><span> '. $key_place_value .'</span><div class="clear"></div></p>';
		}
		
		}
	
	}
	
	if ($key_recurring_value == 'Never' && $key_recint_value != 'select interval' && $key_recday_value != 'select day'){
	
		if ($endstring) {
		$output .= '<p class="calsingle"><strong>' . __('Every ', 'wp-church') . ' ' . $key_recint_value . ' ' . $key_recday_value . __('of the month', 'wp-church') . ' </strong><div class="clear"></div></p>';
		$output .= '<p class="calsingle"><strong>' . __('Until:', 'wp-church') . ' </strong><span>' . date_i18n( 'd F Y' , $endstring , false ) . '</span><div class="clear"></div></p>';
		if ($key_time_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Time:', 'wp-church') . ' </strong><span>'. $key_time_value .'</span><div class="clear"></div></p>';
		}
		
		if ($key_place_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Place:', 'wp-church') . ' </strong><span>'. $key_place_value .'</span><div class="clear"></div></p>';
		}
		
		} else {
		
		$output .= '<p class="calsingle"><strong>' . __('Every ', 'wp-church') . $key_recint_value . ' ' . $key_recday_value . ' ' . __('of the month', 'wp-church') . ' </strong><div class="clear"></div></p>';
		
		if ($key_time_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Time:', 'wp-church') . ' </strong><span> '. $key_time_value .' </span><div class="clear"></div></p>';
		}
		
		if ($key_place_value) {	
			$output .= '<p class="calsingle"><strong>' . __('Place:', 'wp-church') . ' </strong><span> '. $key_place_value .' </span><div class="clear"></div></p>';
		}
		
		}
	
	}
	
	$output .= '</div>';

	echo $output;

}

function get_mpt($PID){

	$postmusic = '';
	$mp3 = '';

	
	$arrSound =& get_children('post_type=attachment&post_mime_type=audio/mpeg&post_parent=' . $PID );
	if ( empty($arrSound) ) {
		$sSoundUrl = '';
	} else {
	$arrKeys = array_keys($arrSound);
	$num_elements = count($arrKeys);
	$last_element = $arrKeys[$num_elements-1];
	$SoundUrl = $arrSound[$last_element]->guid;
	$sSoundUrl = '<div class="fmp" rel="' . $SoundUrl . '">';
	$sSoundUrl .= '</div>';	
	}
	echo $sSoundUrl;
}

function get_mpt2($PID){

	$postmusic = '';
	$mp3 = '';
	
	$arrSound =& get_children('post_type=attachment&post_mime_type=audio/mpeg&post_parent=' . $PID );
	if ( empty($arrSound) ) {
		$sSoundUrl = '';
	} else {
	$arrKeys = array_keys($arrSound);
	$num_elements = count($arrKeys);
	$last_element = $arrKeys[$num_elements-1];
	$SoundUrl = $arrSound[$last_element]->guid;
	$sSoundUrl = '<img class="micfront" src="' . get_template_directory_uri() . '/images/micfront.png" rel="' . $SoundUrl . '">';
	}
	echo $sSoundUrl;
}


?>