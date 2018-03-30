<?php 


function prevlink($month,$year) {
	if ($month && $year) {
		$mcalc = mktime(0, 0, 0, $month, 15, $year);
	} else {
		$mcalc = time();
		$mcalc = mktime(0, 0, 0, date('n',$mcalc), 15, date('Y',$mcalc));
	}
	$output = '<h2 class="vfont">' . date_i18n( 'F Y' , $mcalc , false ) . '</h2><div class="monthselect"><a href="#" rel="' . date('n/Y', ($mcalc - 2592000)) .  '"" class="prevlink plink">' .  __('PREV', 'localize') . '</a><span> | </span>';
	$output .= '<a href="#" rel="' . date('n/Y', ($mcalc + 2592000)) .  '"" class="nxtlink plink">' .  __('NEXT', 'localize') . '</a></div>';
	return $output;
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
	$calentries[] = array (					
		'strdate' => $cstrdate,
		'ctitle' => $cctitle,
		'clink' => $cclink,
		'ccontent' => $cccontent,
		'clocation' => $cclocation,
		'cids' => $ccids,
	);	
}


function make_epoch($tday, $tmonth , $tyear , $ttime , $tgmt) {
	$thismonth = date( 'F', mktime(0, 0, 0, $tmonth, 10));
	$thisconvert = $tday . ' ' . $thismonth . ' ' . $tyear . ' ' . $ttime . ' ' . $tgmt;
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
		if ($specrec+ 2419200 <= $lastmonthday) {
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
	$calentries = array();
	$args=array(
		'post_type'=>'calendars',
		'showposts'=> 10000,
	);
	
	$my_query = new WP_Query($args);
	if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
	$postid = get_the_ID();
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
	
	$num1 = (int) $dateholder[1];
	
	$num2 = (int) $endholder[1];
	
	$startepoch = time();
	// get epoch for start date	
	if (!$key_time_value) {
		$key_time_value = '00:00:01';
	}
	$startepoch = strtotime($dateholder[0] .  ' ' .  date( 'F', mktime(0, 0, 0, $num1, 1) ) . ' ' .  $dateholder[2] .  ' ' . $key_time_value . ' GMT');
		
	$endepoch = '';	
	if ($key_end_value) {
		$endepoch = strtotime($endholder[0] .  ' ' .  date( 'F', mktime(0, 0, 0, $num2, 1) ) . ' ' .  $endholder[2] .  ' ' . $key_time_value . ' GMT');
	} 
	
	$beginningepoch = make_epoch('1', $month, $year, '00:00:01' ,'GMT');
		
	$daysinmonth = $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year %400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
	
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
		
		if (!$key_end_value) {
			if ($startepoch >= $beginningepoch && $startepoch < $closingepoch) {
				$occurance = 1;
				$firstone = $startepoch;
			}
		} else {
			$occurance = 2;
			if ($key_time_value) {
				$timetocount = make_epoch(date('j', $beginningepoch), date('m', $beginningepoch), date('Y', $beginningepoch), $key_time_value,' GMT');
			} else {
				$timetocount = make_epoch(date('j', $beginningepoch), date('m', $beginningepoch), date('Y', $beginningepoch), '11.59 pm',' GMT');
			}
			unset($datelist);
			$datelist = array();
			for($i = ($timetocount); $i < $closingepoch; $i = $i + 86400) {
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
	foreach($a as $k=>$v) {$b[$k] = strtolower($v[$subkey]);}
	asort($b);
	foreach($b as $key=>$val) {$c[] = $a[$key];}
	return $c;
}


function get_the_calendar($cmonth,$cyear) {
	global $calentries, $wp_locale;
	$settings = get_option( "ntl_theme_settings" );
	$calentries = array();
	$thenow = time();
	$output = '';
	get_the_events($cmonth,$cyear);
	$countr = 1;
	if($calentries) {		
		$calentries = subval_sort($calentries,'strdate'); 
		foreach ($calentries as $cal_the_entry) {
			if ($countr %2 == 0)	{$alter = 'alt';} else {$alter ='';}
			$caltime = get_post_meta($cal_the_entry['cids'], 'netlabs_timestartentry', true);
			$calstate = get_post_meta($cal_the_entry['cids'], 'netlabs_eventstate', true);
			$calcity = get_post_meta($cal_the_entry['cids'], 'netlabs_eventcity', true);
			$calmap = get_post_meta($cal_the_entry['cids'], 'netlabs_eventmap', true);
			$postkey = get_post($cal_the_entry['cids']);
			$content = $postkey->post_content;
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]>', $content);
			$timef = get_option('time_format');
			if ($calcity && $calstate) { $thecomma = ', ';} else { $thecomma = '';}
			$output .= 
			'<div class="calsingleentry clear ' . $alter  .'">
			<span class="cdayname">'. date('d', $cal_the_entry['strdate']) . '</span>
			<span class="cweekname smallfont">' . date_i18n( 'D' , $cal_the_entry['strdate'] , false ) . '<br/>' . date_i18n( $timef , $cal_the_entry['strdate'] , false ) . '</span>
			<span class="cvenue smallfont">' . $cal_the_entry['ctitle'] .  '</span>
			<span class="ctown smallfont">' . $calcity .  $thecomma . $calstate .'</span>
			<span class="cbuttons smallfont">
			';
			if ($content) {			
			$output .= '
			<a class="cmoreinf" href="#">' . __('More Info', 'localize') . '</a>';
			}
            if ($cal_the_entry['strdate'] >= ($thenow + 172800)){
			$output .= '<a href="#" class="creminds" title="' . $cal_the_entry['cids'] . '" rel="' . $cal_the_entry['strdate'] . '">' . __('Set a reminder ', 'localize') . '</a>';
			}
			if ($calmap) {
				$output .=  '
				<form name="nets_dirform" id="nets_dirform" action="' .  get_permalink($settings['ntl_drivedir_page'])  .  '" class="clear" method="post">
				<span class="theaddress">' . $calmap . '</span>
				<input type="hidden" name="nets_addr" value="' . $calmap . '">
				<input type="submit" class="smallfont" name="nets_mapsubmit" value ="' . __('Get Directions', 'localize') . '" id="nets_mapsubmit" title="' . __('Click for directions ', 'localize') . '"">
				</form>';
			}
			$output .= 	'
			</span><div class="clear"></div><span class="ccontent">'. $content .'</span><span class="cremind">$nbsp;</span></div>';			
			$countr++;
		}
		return $output;
	} else {
		$output = '
		<p>' .  __('No entries found ', 'localize') . '</p>';
		return $output;
	}
}


function get_for_timer($title){
	global $calentries;
	$settings = get_option( "ntl_theme_settings" );
	$calentries = array();
	$output = '';
	$time = time();
	$tmonth = date("n", $time);
	$tyear = date("Y", $time);
	$emptycounter = 0;
	$ccounter = '';
	$currententry = date('U', $time);
	$offset = get_option('gmt_offset');
	$offset2 = $offset * 60 * 60;
	$currententry = $currententry + $offset2;
	
	while ($emptycounter <= 5 && !$ccounter) { 	
		get_the_events($tmonth,$tyear);		
		if($calentries) {	
			$calentries = subval_sort($calentries,'strdate'); 
			foreach ($calentries as $cal_the_entry) {			
				if ($cal_the_entry['strdate'] >= $currententry && !$ccounter) {	
					$theimg = get_the_post_thumbnail($cal_the_entry['cids'], 'imlink');
					$output .= '<div class="timemachine">';
					$output .= '
					<div class="announce"><span>' .  $settings['ntl_calnext_label'] . '&nbsp;&nbsp;-&nbsp;&nbsp;</span>
					' . $cal_the_entry['ctitle'] .  '</div>
					<div class="timecover"><div class="time" contents="' . $offset  .'" rel="' . $cal_the_entry['strdate'] . '"></div>';
					$output .= '
					<div class="timernames">';
					$output .= '
					<span class="daynames first">' .  __('DAYS', 'localize') . '</span>
					<span class="daynames second">' .  __('HOURS', 'localize') . '</span>
					<span class="daynames third">' .  __('MINUTE', 'localize') . '</span>
					<span class="daynames fourth">' .  __('SECOND', 'localize') . '</span>
					</div></div>
					<div class="announce"><span><a href="' .  get_permalink(get_option('ntl_calpage'))  .    '" class="smallfont">' . __('View Calendar', 'localize') . '</a></span>
					</div>';
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

	if ($output){
		
		$output = '<div class="timeshow">' . $output . '</div><div class="clear"></div></div>';
		
		return $output;
		
	} else {
		
		return $output;
		
	}

}

function get_for_widget($num, $offset){
	global $calentries, $wp_locale;
	unset($calwidget);
	$settings = get_option( "ntl_theme_settings" );
	$calwidget = array();
	$woutput = '';
	$monthset = '';
	$now = time();
	$wmonth = date("n", $now);
	$wyear = date("Y", $now);
	$emptycounter = 0;
	$wcounter = 0;
	$currententry = date('U', $now);
	$continue = 0;
	$wnum = $offset + $num - 1;
	$calcounter = 0;
	$timef = get_option('time_format');
	
	while ($continue != 1) { 
		$calentries = array();
		get_the_events($wmonth,$wyear);	
		if($calentries) {
			$calentries = subval_sort($calentries,'strdate'); 
			foreach ($calentries as $cal_the_entry) {
				if ($cal_the_entry['strdate'] >= $currententry && $wcounter <= $wnum) {
					$calwidget[] = array
						(					
						'wstrdate' => $cal_the_entry['strdate'],
						'wtitle' => $cal_the_entry['ctitle'],
						'wids' => $cal_the_entry['cids'],
					);				
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
		if ($wcounter >= ($num + $offset) || $emptycounter >= 5) {
			$continue = 1;
		}
	}
	
	if ($calwidget) {
		
	$calwidget = subval_sort($calwidget,'wstrdate'); 
	$mtim = 1;
	foreach ($calwidget as $calwidg) {
		if ($mtim %2 == 0)	{$alter = 'alt';} else {$alter ='';}
		if ($calcounter >= $offset) {
			$caltime = get_post_meta($calwidg['wids'], 'netlabs_timestartentry', true);
			$calstate = get_post_meta($calwidg['wids'], 'netlabs_eventstate', true);
			$calcity = get_post_meta($calwidg['wids'], 'netlabs_eventcity', true);
			if ($calcity && $calstate) { $thecomma = ', ';} else { $thecomma = '';}
			$postkey = get_post($calwidg['wids']);
			$content = $postkey->post_content;
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]>', $content);		
			$woutput .= '
			<div class="clear ' . $alter . ' calwidg">
			<p class="contentdesc smallfont">' . $calwidg['wtitle'] .  '</p>
			<span class="cdayname vfont">'. date('d', $calwidg['wstrdate']) . '</span>
			<span class="cweekname smallfont">' . date_i18n( 'M' , $calwidg['wstrdate'] , false ) . '<br/>' . date_i18n( $timef , $calwidg['wstrdate'] , false ) . '</span>	
			<div class="widgcontent">' .  $content . '
			<div class="contentmore smallfont">
			<span>' . $calcity . $thecomma . $calstate . '</span>
			' . $calwidg['wtitle'] .  '
			</div>
			</div>
			</div>';
		}
		$mtim++;
		$calcounter++;
	}

	}
	
	if ($woutput) {
	echo $woutput;
	} else {
	echo  __('no entries found', 'localize');
	}

}


function get_the_upcommings($num){
	global $calentries, $wp_locale;
	$settings = get_option( "ntl_theme_settings" );
	unset($calwidget);
	$calwidget = array();
	$woutput = '';
	$monthset = '';
	$now = time();
	$wmonth = date("n", $now);
	$wyear = date("Y", $now);
	$emptycounter = 0;
	$wcounter = 0;
	$currententry = date('U', $now);
	$continue = 0;
	$offset = 0;
	$wnum = $offset + $num - 1;
	$calcounter = 0;
	$timef = get_option('time_format');
	
	while ($continue != 1) { 
		$calentries = array();
		get_the_events($wmonth,$wyear);	
		if($calentries) {
			$calentries = subval_sort($calentries,'strdate'); 
			foreach ($calentries as $cal_the_entry) {
				if ($cal_the_entry['strdate'] >= $currententry && $wcounter <= $wnum) {
					$calwidget[] = array
						(					
						'wstrdate' => $cal_the_entry['strdate'],
						'wtitle' => $cal_the_entry['ctitle'],
						'wids' => $cal_the_entry['cids'],
					);				
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
		if ($wcounter >= ($num + $offset) || $emptycounter >= 24) {
			$continue = 1;
		}
	}
	
	if ($calwidget) {
		
	$calwidget = subval_sort($calwidget,'wstrdate');
	$mtim = 1;
	foreach ($calwidget as $calwidg) {
		if ($mtim %2 == 0)	{$alter = 'alt';} else {$alter ='';}
		$caltime = get_post_meta($calwidg['wids'], 'netlabs_timestartentry', true);
		$calstate = get_post_meta($calwidg['wids'], 'netlabs_eventstate', true);
		$calcity = get_post_meta($calwidg['wids'], 'netlabs_eventcity', true);
		$calmap = get_post_meta($calwidg['wids'], 'netlabs_eventmap', true);
		$postkey = get_post($calwidg['wids']);
		$content = $postkey->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]>', $content);
		$timef = get_option('time_format');
		if ($calcity && $calstate) { $thecomma = ', ';} else { $thecomma = '';}
		$woutput .= 
		'<div class="calsingleentry clear ' . $alter  .'">
		<span class="cdayname">'. date('d', $calwidg['wstrdate']) . '</span>
		<span class="cweekname smallfont">' . date_i18n( 'M' , $calwidg['wstrdate'] , false ) . '<br/>' . date_i18n( $timef , $calwidg['wstrdate'] , false ) . '</span>
		<span class="cvenue smallfont">' . $calwidg['wtitle'] .  '</span>
		<span class="ctown smallfont">' . $calcity .  $thecomma . $calstate .'</span>
		<span class="cbuttons smallfont">
		';
		if ($content) {			
			$woutput .= '
			<a class="cmoreinf" href="#">' . __('More Info', 'localize') . '</a>';
		}
        if ($calwidg['wstrdate'] >= ($thenow + 172800)){
			$woutput .= '<a href="#" class="creminds" title="' . $calwidg['wids'] . '" rel="' . $calwidg['wstrdate'] . '">' . __('Set a reminder ', 'localize') . '</a>';
		}
		if ($calmap) {
			$woutput .=  '
			<form name="nets_dirform" id="nets_dirform" action="' .  get_permalink($settings['ntl_drivedir_page'])  .  '" class="clear" method="post">
			<span class="theaddress">' . $calmap . '</span>
			<input type="hidden" name="nets_addr" value="' . $calmap . '">
			<input type="submit" class="smallfont" name="nets_mapsubmit" value ="' . __('Get Directions', 'localize') . '" id="nets_mapsubmit" title="' . __('Click for directions ', 'localize') . '"">
			</form>';
		}
		$woutput .= 	'
			</span><div class="clear"></div><span class="ccontent">'. $content .'</span><span class="cremind">$nbsp;</span></div>';
		$mtim++;
		$calcounter++;
		}

	}
	
	if ($woutput) {
	echo $woutput;
	} else {
	echo  __('no entries found', 'localize');
	}

}


/******************************************************************
 * compose emailtemplate
 ******************************************************************/

function lets_make_newstemplate($messagetype, $bookingmail, $bookingname, $bookingdate, $bookinginfo){

	global $wp_locale;
	$settings = get_option( "ntl_theme_settings" );
	
	$messtime = '';
	$messmore = '';
	
	
	if ($bookingdate) {
		$idata = explode('/', $bookingdate);
		$itime = $idata[0];
		$messtime = date_i18n( 'l d F Y g:i a' , $itime , false );
		$iplus = $itime - ($idata[1] * 86400);
		$messmore = date_i18n( 'l d F Y' , $iplus , false );
	}

	$messbody = $settings['ntl_' . $messagetype];	
	$messheader = $settings['ntl_' . $messagetype . '_s'];		
	$messtime = date_i18n( 'l d F Y g:i a' , $bookingdate , false );
	$remindtime = 
		
	$messdetails = '';
	
	if ($bookingname) {	
		$messdetails .= 
		'<tr><td id="lead_content" colspan="1">
		<p style="text-align: right; padding: 30px 10px 0 10px;"><strong>' .  __('Name:', 'localize') . '</strong> </p></td>
		<td><p style="text-align: left; padding: 30px 0px 0 10px;">' .  $bookingname  . '</p></td></tr>';	
	}
	if ($messtime) {
		$messdetails .= '<tr><td id="lead_content" colspan="1">
		<p style="text-align: right; padding: 30px 10px 0 10px;"><strong>' .  __('Event date:', 'localize') . '</strong> </p></td>
		<td><p style="text-align: left; padding: 30px 0px 0 10px;">' .  $messtime  . '</p></td></tr>';		
	}
	if ($messmore && $messagetype == 'remindersignup_customer'  ) {
		$messdetails .= '<tr><td id="lead_content" colspan="1">
		<p style="text-align: right; padding: 30px 10px 0 10px;"><strong>' .  __('Reminder date:', 'localize') . '</strong> </p></td>
		<td><p style="text-align: left; padding: 30px 0px 0 10px;">' .  $messmore  . '</p></td></tr>';		
	}
	if ($bookinginfo) {	
		$messdetails .= '
		<tr><td id="lead_content" colspan="1"><p style="text-align: right; padding: 30px 10px 0 10px;">
		<strong>' .  __('Event name', 'localize') . '</strong> </p></td><td>
		<p style="text-align: left; padding: 30px 0px 0 10px;">' .  get_the_title($bookinginfo)  . '</p></td></tr>';	
	}

	if ($bookingmail) {
		if ($messagetype == 'reminders_customer') {
		$messdetails .= '
		<tr><td id="lead_content" colspan="1">
		<p style="text-align: right; padding: 30px 10px 0 10px;"><strong>' .  __('Our email address:', 'localize') . '</strong> </p></td>
		<td><p style="text-align: left; padding: 30px 0px 0 10px;">' .  get_option('admin_email') . '</p></td></tr>';
		} else {
			$messdetails .= '
			<tr><td id="lead_content" colspan="1">
			<p style="text-align: right; padding: 30px 10px 0 10px;"><strong>' .  __('Contact email:', 'localize') . '</strong> </p></td>
			<td><p style="text-align: left; padding: 30px 0px 0 10px;">' .  $bookingmail  . '</p></td></tr>';
		}		
	}
	
	if ($messagetype == 'reminders_customer'  && $settings['ntl_calendar_page']) {
		$messdetails .= '
		<tr><td valign="top" id="appointment" style="color: #666;font-size: 18px;font-weight: normal;font-family: Georgia;text-align: center;padding: 0px 0px 40px 0px;" colspan="2">
        <h2 class="secondary-heading" style="color: #000;font-size: 24px;font-weight: normal;font-style: normal;font-family: Georgia;margin: 30px 0 10px 0;">' .  __('View the calendar', 'localize') . '</h2>
        <p><a href="' . get_permalink($settings['ntl_calendar_page'])  . '" style="color: #fff; background: ' .  $settings['ntl_theme_color']  .  '; padding: 5px 10px; text-decoration: none;">' .  __('Click here', 'localize') . '</a></p>
		</td></tr>';		
	}
				
	$showdir = '';	
	$copyright =  __('Copyright (C) 2011', 'localize') . ' ' . get_bloginfo('name') . ' ' .  __('All rights reserved', 'localize');	
	$ch_path = get_template_directory_uri() . '/templates/tpl1.htm';
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $ch_path);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$ch_data = curl_exec($ch);
	curl_close($ch);

	$output = str_replace('[blogname]', get_bloginfo('name'), $ch_data);
	$output = str_replace('[themelogo]', $settings['ntl_theme_logo'],$output);
	$output = str_replace('[copyright]', $copyright,$output);
	$output = str_replace('[messbody]', $messbody,$output);
	$output = str_replace('[messheader]', $messheader,$output);
	$output = str_replace('[messdetails]', $messdetails,$output);
	$output = str_replace('[showdir]', $showdir,$output);
	
	return $output;
}


function lets_make_booking($datedata, $startdata, $startid, $signup_name, $signup_email) {

	$post_id = wp_insert_post( array(
		'post_type' => 'reminders',
		'post_status' => 'publish',
		'comment_status' => 'closed',
		'post_content' => '',
		'post_title' => $signup_name,
		'post_author' => '1'
	) );
		
	add_post_meta($post_id, 'netlabs_rememail', $signup_email, true);
	add_post_meta($post_id, 'netlabs_eventinfo', $startid, true); 
	add_post_meta($post_id, 'netlabs_eventdate', $startdata, true); 
	add_post_meta($post_id, 'netlabs_timespan', $datedata, true);
	add_post_meta($post_id, 'netlabs_remstatus', 'no', true);
	
	
	$idata = $startdata . '/' . $datedata;
	
	lets_make_bookingemail($signup_email, $idata, $signup_name, $startid,  'remindersignup_customer', 'yes' );
}


function lets_make_bookingemail($bookingmail, $bookingdate, $bookingname, $info, $mailtype, $copyadmin ){

	add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
	
	$settings = get_option( "ntl_theme_settings" );
	
	$headers = 'From: '. get_option('blogname') .' <' . get_option('admin_email') . '>';
	 
	 
	if ($mailtype == 'remindersignup_customer') {					
		$subject = $settings['ntl_' . $mailtype . '_s'];				
		$body = lets_make_newstemplate('remindersignup_customer', $bookingmail, $bookingname , $bookingdate, $info);		
		wp_mail($bookingmail, $subject, $body , $headers);		
	}
	
		
	if ($mailtype == 'newssignup_customer') {	
		$subject = $settings['ntl_newssignup_customer_s'];				
		$body = lets_make_newstemplate('newssignup_customer', $bookingmail, $bookingname ,'', '');
		wp_mail($bookingmail, $subject, $body , $headers);
		
		if ($copyadmin == 'yes') {			
			$subject = $settings['ntl_newssignup_admin_s'];					
			$body = lets_make_newstemplate('newssignup_admin', $bookingmail, $bookingname , '', '');
			$bookingmail = get_option('admin_email');		
			wp_mail($bookingmail, $subject, $body , $headers);			
		}			
	}
	
	if ($mailtype == 'reminders_customer') {	
		$subject = $settings['ntl_reminders_customer_s'];	;				
		$body = lets_make_newstemplate('reminders_customer', $bookingmail, $bookingname , $bookingdate, $info);
		wp_mail($bookingmail, $subject, $body , $headers);					
	}
}




/******************************************************************
 * check and send reminders
 ******************************************************************/


function lets_create_reminders() {

	$today  = time();
	$singleday = 86400;
	
	$args=array(
		'post_type'=>'reminders',
		'showposts'=> 10000
	);
	$my_query = new WP_Query($args);
	if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
	
		$remid = get_the_ID();
		$a_rem = get_post_meta($remid, 'netlabs_timespan', true);
		$b_rem = get_post_meta($remid, 'netlabs_eventdate', true);
		$c_rem = get_post_meta($remid, 'netlabs_remstatus', true);
		$d_rem = get_post_meta($remid, 'netlabs_rememail', true);
		$e_rem = get_post_meta($remid, 'netlabs_eventinfo', true);
		
		
		$target = $b_rem - ($singleday * $a_rem);
		
		$messmore = date( 'l d F Y' , $target);
		
		$messdone = date( 'l d F Y' , $today);

		if ($messmore == $messdone &&  $c_rem == 'no') {
			update_post_meta($remid, 'netlabs_remstatus', 'yes');
			lets_make_bookingemail($d_rem, $b_rem, $my_query->post_title, $e_rem, 'reminders_customer', 'no' );
		}
	
	endwhile;
	else : endif;
	wp_reset_query();	
}



add_action('60min_reminder_check', 'lets_create_reminders');

function lets_do_check() {
	if ( !wp_next_scheduled( '60min_reminder_check' ) ) {
		wp_schedule_event(time(), 'twicedaily', '60min_reminder_check');
	}
}
add_action('wp', 'lets_do_check');



/******************************************************************
 * create the slideshow
 ******************************************************************/

 
function lets_get_imgslide() {
	
	
	$content = '
			<div class="box_skitter box_skitter_large"><ul>			
	';	
	$args=array(
		'post_type'=>'slideshows',
		'showposts'=> 10000,
	);
	
	$my_query = new WP_Query($args);
		
	if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
		
		$a_meta = get_post_meta(get_the_ID(), 'option1', true);
		$b_meta = get_post_meta(get_the_ID(), 'option2', true);
		$c_meta = get_post_meta(get_the_ID(), 'option3', true);
		$d_meta = get_post_meta(get_the_ID(), 'option4', true);
		$e_meta = get_post_meta(get_the_ID(), 'option5', true);
		$s7 = get_post_meta(get_the_ID(),'s_type', true);
		
		if ($d_meta) {
			$s_link = $d_meta;
		} else {
			$s_link = get_permalink( $e_meta );
		}
	
	
		if ($a_meta || $b_meta || $c_meta || $d_meta) {
			$infbox = '
				<div class="label_text clear">
					<h3 class="vfont ntl_bs1">' . $a_meta . '</h3>
					<p class="smallfont ntl_bs1">' . $b_meta . '..... 
						<a href="' .  $s_link . '" class="tcolor ntl_bs1 sfont">' . $c_meta  . '</a>
					</p>
				</div> 
			';
		
		} else {				
			$infbox = '';
		}
		    
	    if ($s7 == 'image'){
			$content .= '<li>' .  get_the_post_thumbnail(get_the_ID() ,  'full')  . ' ' . $infbox . '</li>';
		}
	
	endwhile;
	else : endif;
	wp_reset_query();
	
	$content .= '</ul></div>';

	echo $content;	
}



function lets_get_slideshow() {
	
	query_posts( array( 'post_type' => 'slideshows', 'showposts' => 10000, ) );
	
	$content = '';
		
	if ( have_posts() ) : 
		
		$content .= '
			<div class="frontslide" style="margin-left: 0px;"><ul class="showslide" id="showslide">
		';
	
	
	while ( have_posts() ) : the_post(); 
		
		$a_meta = get_post_meta(get_the_ID(), 'option1', true);
		$b_meta = get_post_meta(get_the_ID(), 'option2', true);
		$c_meta = get_post_meta(get_the_ID(), 'option3', true);
		$d_meta = get_post_meta(get_the_ID(), 'option4', true);
		$e_meta = get_post_meta(get_the_ID(), 'option5', true);
		$s7 = get_post_meta(get_the_ID(),'s_type', true);
		$s8 = get_post_meta(get_the_ID(),'c_type', true);
				
				
		if ($s7 == 'content'){
						
			switch($s8) {
				
				case 't1': 
					
					if ($d_meta) { $c_link = $d_meta;} else {$c_link = get_permalink( $e_meta );}
										
					$content .= '
						<li class="clear"><div class="textcontent clear">
							<h2 class="vfont">' . $a_meta . '</h2>
							<p class="smallfont">' . $b_meta . '</p>
					';
					
					if ($e_meta) {
						$content .= '<a href="'  .  $c_link  . '" class="smallfont">more</a></div></li>';
					}							
				break;
				
				case 't2': 
										
					if ($a_meta) {
					
						if ($b_meta == 'vimeo' ) {
			
							$vidimg = getVimeoInfo($a_meta,"thumbnail_large");	
							$content .= '
								<li><div class="showvid" style="background: url(' .  $vidimg  .   ') no-repeat center;">
									<a href="#" class="vimeoplayer" rel="'.$a_meta.'">
									<img src="' .  get_template_directory_uri()  . '/images/playerv.png">
								</a></div></li>
							';
							
						} elseif ($b_meta == 'youtube' ) {
						
							$content .= '
								<li><div class="showvid" style="background: url(http://i.ytimg.com/vi/'.$a_meta.'/0.jpg) no-repeat center;">
									<a href="#" class="youtubeplayer" rel="'.$a_meta.'">
									<img src="' .  get_template_directory_uri()  . '/images/player.png">
									</a></div></li>
							';
						}
						
					} else {
						
						$a_ctc = get_post_meta($c_meta, 'option1' , true);
						$b_ctc = get_post_meta($c_meta, 'option2' , true);
						
						if ($b_ctc == 'Vimeo' ) {
			
							$vidimg = getVimeoInfo($a_ctc,"thumbnail_large");	
							$content .= '
								<li><div class="showvid" style="background: url(' .  $vidimg  .   ') no-repeat center;">
									<a href="#" class="vimeoplayer" rel="'.$a_ctc.'">
									<img src="' .  get_template_directory_uri()  . '/images/playerv.png">
								</a></div></li>
							';
							
						} elseif ($b_ctc == 'Youtube' ) {
						
							$content .= '
								<li><div class="showvid" style="background: url(http://i.ytimg.com/vi/'.$a_ctc.'/0.jpg) no-repeat center;">
									<a href="#" class="youtubeplayer" rel="'.$a_ctc.'">
									<img src="' .  get_template_directory_uri()  . '/images/player.png">
								</a></div></li>';
						}						
					}
							
				break;
				
				case 't3': 
					
					if ($d_meta) {$c_link = $d_meta;} else {$c_link = get_permalink( $e_meta );}					
					if ($c_meta) {$slinky = '<a href="' . $c_link  . '">' . $c_meta . '....</a>';} else {$slinky = '';}	
					if (!$a_meta || !$b_meta){
						$content .= '<li><div class="showimg">
									<a href="'  .  $c_link  . '" class="linkimage">
									' . get_the_post_thumbnail( get_the_ID(), 'slider' ) . '</a>';
					}	else {
						
						$content .= '<li><div class="showimg">' . get_the_post_thumbnail( get_the_ID(), 'slider' );
	
					if ($a_meta || $b_meta || $c_meta){
						$content .= '
							<span>
								<h5 class="vfont">' . $a_meta . '</h5>
								<p class="smallfont">' . $b_meta . ' ' . $slinky  . '</p>
								<a href="'  .  $c_link  . '" class="smallfont">more</a>
							</span>
						';
					}
						
					}			
	
					$content .= '</div></li>';	
							
				break;
				
				case 't4': 
					
					
					$content .= '
						<li class="clear">
							<div class="showalbm clear">
								' . get_the_post_thumbnail( $a_meta, 'albmlink' ) . '
								<h5 class="vfont">' . $c_meta . '</h5>
								<p class="smallfont">'  .  $b_meta .   '</p>';
								

					
					
					$content .= '
								<a href="'  .  get_permalink( $a_meta )  . '" class="smallfont">' . $d_meta  . '</a>
					';
					$content .= '
							</div>
						</li>
					';
							
				break;
				
				case 't5': 
					
					$postkey = get_post($a_meta);
					$contents = $postkey->post_content;
					$ptitle = $postkey->post_title;
					$contents = apply_filters('the_content', $contents);
					$contents = str_replace(']]>', ']]>', $contents);
					$contents = strip_tags($contents);
					
					if (strlen($contents) > 120) {
						$contents = substr($contents,0,strpos($contents,' ',120)); 
					} 
		
					$content .= '
						<li class="clear">
							<div class="showalbm clear">
								' . get_the_post_thumbnail( $a_meta, 'albmlink' ) . '
								<h5 class="vfont">' . get_the_title($a_meta) . '</h5>
								<p class="smallfont">'  .  $contents .   '</p>
								<a href="'  .  get_permalink( $a_meta )  . '" class="smallfont">' . $d_meta  . '</a>
							</div>
						</li>
					';	
							
				break;
													
			}			
		}
		
				
		endwhile;
		else :
		endif;
		wp_reset_query();	
	
		$content .= '
			</ul>
			<div class="vidholder"><img class="vidclose" src="' .  get_template_directory_uri() . '/images/vidclose.png"></div>
			</div>
			<a class="ntlc_prev">previous</a>
			<a class="ntlc_next">next</a>
		';

	echo $content;
}


?>