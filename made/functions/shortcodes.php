<?php //SHORTCODES

//columns
function oswc_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'oswc_one_third');

function oswc_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_third_last', 'oswc_one_third_last');

function oswc_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'oswc_two_third');

function oswc_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_third_last', 'oswc_two_third_last');

function oswc_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'oswc_one_half');

function oswc_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_half_last', 'oswc_one_half_last');

function oswc_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'oswc_one_fourth');

function oswc_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fourth_last', 'oswc_one_fourth_last');

function oswc_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'oswc_three_fourth');

function oswc_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fourth_last', 'oswc_three_fourth_last');

function oswc_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'oswc_one_fifth');

function oswc_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fifth_last', 'oswc_one_fifth_last');

function oswc_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'oswc_two_fifth');

function oswc_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_fifth_last', 'oswc_two_fifth_last');

function oswc_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'oswc_three_fifth');

function oswc_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fifth_last', 'oswc_three_fifth_last');

function oswc_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'oswc_four_fifth');

function oswc_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('four_fifth_last', 'oswc_four_fifth_last');

function oswc_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'oswc_one_sixth');

function oswc_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_sixth_last', 'oswc_one_sixth_last');

function oswc_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'oswc_five_sixth');

function oswc_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('five_sixth_last', 'oswc_five_sixth_last');

//buttons
function oswc_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'link'	=> '#',
    'target'	=> '',
    'variation'	=> '',
    'size'	=> '',
    'align'	=> '',
    ), $atts));

	$style = ($variation) ? ' '.$variation : '';
	$align = ($align) ? ' align'.$align : '';
	$size = ($size == 'large') ? ' large_button' : '';
	$target = ($target == 'blank') ? ' target="_blank"' : '';

	$out = '<a' .$target. ' class="button_link' .$style.$size.$align. '" href="' .$link. '"><span>' .do_shortcode($content). '</span></a>';

    return $out;
}
add_shortcode('button', 'oswc_button');

//dropcap
function oswc_dropcap($atts, $content = null) {
	return '<div class="dropcap prociono">'.do_shortcode($content).'</div>';
}
add_shortcode('dropcap', 'oswc_dropcap');

//divider
function oswc_divider($atts, $content = null) {
	return '<div class="divider">&nbsp;</div>';
}
add_shortcode('divider', 'oswc_divider');

//fancy list
function oswc_fancylist($atts, $content = null) {
	return '<div class="fancylist">'.do_shortcode($content).'</div>';
}
add_shortcode('fancylist', 'oswc_fancylist');

//arrow list
function oswc_arrowlist($atts, $content = null) {
	return '<div class="arrowlist">'.do_shortcode($content).'</div>';
}
add_shortcode('arrowlist', 'oswc_arrowlist');

//check list
function oswc_checklist($atts, $content = null) {
	return '<div class="checklist">'.do_shortcode($content).'</div>';
}
add_shortcode('checklist', 'oswc_checklist');

//star list
function oswc_starlist($atts, $content = null) {
	return '<div class="starlist">'.do_shortcode($content).'</div>';
}
add_shortcode('starlist', 'oswc_starlist');

//plus list
function oswc_pluslist($atts, $content = null) {
	return '<div class="pluslist">'.do_shortcode($content).'</div>';
}
add_shortcode('pluslist', 'oswc_pluslist');

//heart list
function oswc_heartlist($atts, $content = null) {
	return '<div class="heartlist">'.do_shortcode($content).'</div>';
}
add_shortcode('heartlist', 'oswc_heartlist');

//info list
function oswc_infolist($atts, $content = null) {
	return '<div class="infolist">'.do_shortcode($content).'</div>';
}
add_shortcode('infolist', 'oswc_infolist');

//signoff
function oswc_signoff1() {
	//get theme options
	global $oswc_misc;
	
	//set theme options
	$oswc_signoff_text = $oswc_misc['signoff_text1'];
	
    return '<div class="signoff-wrapper"><div class="signoff">'.do_shortcode($oswc_signoff_text).'</div></div>';
}
add_shortcode('signoff1', 'oswc_signoff1');
function oswc_signoff2() {
	//get theme options
	global $oswc_misc;
	
	//set theme options
	$oswc_signoff_text = $oswc_misc['signoff_text2'];
	
    return '<div class="signoff-wrapper"><div class="signoff">'.do_shortcode($oswc_signoff_text).'</div></div>';
}
add_shortcode('signoff2', 'oswc_signoff2');
function oswc_signoff3() {
	//get theme options
	global $oswc_misc;
	
	//set theme options
	$oswc_signoff_text = $oswc_misc['signoff_text3'];
	
    return '<div class="signoff-wrapper"><div class="signoff">'.do_shortcode($oswc_signoff_text).'</div></div>';
}
add_shortcode('signoff3', 'oswc_signoff3');

//quote
function oswc_quote($atts, $content = null) {
	return '<div class="quote-wrapper"><div class="quote">'.do_shortcode($content).'</div></div>';
}
add_shortcode('quote', 'oswc_quote');

//pullquotes
function oswc_pullquote_left($atts, $content = null) {
	return '<div class="pullquote-wrapper left"><div class="pullquote prociono">'.do_shortcode($content).'</div></div>';
}
add_shortcode('pullquote_left', 'oswc_pullquote_left');
function oswc_pullquote_right($atts, $content = null) {
	return '<div class="pullquote-wrapper right"><div class="pullquote prociono">'.do_shortcode($content).'</div></div>';
}
add_shortcode('pullquote_right', 'oswc_pullquote_right');

//fancy boxes
function oswc_box_light($atts, $content = null) {
	return '<div class="box-wrapper light"><div class="box light">'.do_shortcode($content).'</div></div>';
}
add_shortcode('box_light', 'oswc_box_light');
function oswc_box_dark($atts, $content = null) {
	return '<div class="box-wrapper dark"><div class="box dark">'.do_shortcode($content).'</div></div>';
}
add_shortcode('box_dark', 'oswc_box_dark');
function oswc_box_info($atts, $content = null) {
	return '<div class="box-wrapper info"><div class="box info">'.do_shortcode($content).'</div></div>';
}
add_shortcode('box_info', 'oswc_box_info');
function oswc_box_alert($atts, $content = null) {
	return '<div class="box-wrapper alert"><div class="box alert">'.do_shortcode($content).'</div></div>';
}
add_shortcode('box_alert', 'oswc_box_alert');
function oswc_box_help($atts, $content = null) {
	return '<div class="box-wrapper help"><div class="box help">'.do_shortcode($content).'</div></div>';
}
add_shortcode('box_help', 'oswc_box_help');
function oswc_box_success($atts, $content = null) {
	return '<div class="box-wrapper success"><div class="box success">'.do_shortcode($content).'</div></div>';
}
add_shortcode('box_success', 'oswc_box_success');
function oswc_box_error($atts, $content = null) {
	return '<div class="box-wrapper error"><div class="box error">'.do_shortcode($content).'</div></div>';
}
add_shortcode('box_error', 'oswc_box_error');
function oswc_box_tip($atts, $content = null) {
	return '<div class="box-wrapper tip"><div class="box tip">'.do_shortcode($content).'</div></div>';
}
add_shortcode('box_tip', 'oswc_box_tip');
function oswc_box_download($atts, $content = null) {
	return '<div class="box-wrapper download"><div class="box download">'.do_shortcode($content).'</div></div>';
}
add_shortcode('box_download', 'oswc_box_download');
function oswc_box_warning($atts, $content = null) {
	return '<div class="box-wrapper warning"><div class="box warning">'.do_shortcode($content).'</div></div>';
}
add_shortcode('box_warning', 'oswc_box_warning');

//jquery toggle
function oswc_toggle_simple($atts, $content = null) {
	extract(shortcode_atts(array(
    'title'	=> '',
	'width' => ''
    ), $atts));
	return '<h3 class="toggle">'.$title.'</h3><div class="toggle-content" style="width:'.$width.'%;">'.do_shortcode($content).'</div>';
}
add_shortcode('toggle_simple', 'oswc_toggle_simple');
function oswc_toggle_box($atts, $content = null) {
	extract(shortcode_atts(array(
    'title'	=> '',
	'width' => ''
    ), $atts));
	return '<div class="toggle-box-wrapper"><div class="toggle-box"><h3 class="toggle">'.$title.'</h3><div class="toggle-content" style="width:'.$width.'%;">'.do_shortcode($content).'</div></div></div>';
}
add_shortcode('toggle_box', 'oswc_toggle_box');

//jquery tabs
function oswc_tab_group( $atts, $content ){
	$GLOBALS['tab_count'] = 0;	
	do_shortcode( $content );
	$tabcount=0;
	if( is_array( $GLOBALS['tabs'] ) ){		
		foreach( $GLOBALS['tabs'] as $tab ){
			$tabcount++;
			if($tabcount==1) {
				$tabs[] = '<li><a class="first" href="#'.$tabcount.'">'.$tab['title'].'</a></li>';
			} else {
				$tabs[] = '<li><a href="#'.$tabcount.'">'.$tab['title'].'</a></li>';
			}
			$panes[] = '<div id="'.$tabcount.'" class="tabdiv"><h3>'.$tab['title'].'</h3>'.do_shortcode($tab['content']).'</div>';
		}
		$return = '<!-- the tabs --><div class="tabs-shortcode"><ul class="tabnav">'.implode( "\n", $tabs ).'</ul><div class="tabdiv-wrapper">'.implode( "\n", $panes ).'</div></div>';
	}
	return $return;
}
add_shortcode( 'tabgroup', 'oswc_tab_group' );

function oswc_tab( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => ''
	), $atts));
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );
	
	$GLOBALS['tab_count']++;
}
add_shortcode( 'tab', 'oswc_tab' );

//jquery slider
function oswc_slider( $atts, $content ){
	do_shortcode( $content );
	if( is_array( $GLOBALS['panes'] ) ){		
		foreach( $GLOBALS['panes'] as $pane ){
			$panes[] = '<li>'.do_shortcode($pane).'</li>';
		}
		$return = '<div id="shortcode-slider-wrapper"><a href="#" class="shortcode-slider-prev">&nbsp;</a><div id="shortcode-slider"><ul>'.implode( "\n", $panes ).'</ul></div><a href="#" class="shortcode-slider-next">&nbsp;</a></div><br class="clearer" />';
	}
	return $return;
}
add_shortcode( 'slider', 'oswc_slider' );

function oswc_pane( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => ''
	), $atts));
	
	$x = $GLOBALS['pane_count'];
	$GLOBALS['panes'][$x] = do_shortcode($content);
	
	$GLOBALS['pane_count']++;
}
add_shortcode( 'pane', 'oswc_pane' );

//responsive videos
function oswc_video_embed( $atts, $content = null ) {
   return '<div class="article-image video"><div class="video-wrapper"><div class="video-container">' . do_shortcode($content) . '</div></div></div><div class="clearboth"></div>';
}
add_shortcode('video', 'oswc_video_embed');

?>