<?php

// Remove wp_autop formatting on shortcodes
add_filter( "the_content", "the_content_autop_remover", 99);
function the_content_autop_remover($post_content)
{

 $new_content = str_replace(array(
	'<div class="one_third"></p>',
	'<div class="one_third"><br />',
    '<div class="one_third last"></p>',
	'<div class="one_third last"><br />',
    '<div class="one_half"></p>',
	'<div class="one_half"><br />',
    '<div class="one_half last"></p>',
	'<div class="one_half last"><br />',	  
    '<div class="one_fourth"></p>',
	'<div class="one_fourth"><br />',
    '<div class="one_fourth last"></p>',
	'<div class="one_fourth last"><br />',
	'<div class="one_fifth"></p>',
	'<div class="one_fifth"><br />',
    '<div class="one_fifth last"></p>',
	'<div class="one_fifth last"><br />',
	'<div class="one_sixth"></p>',
	'<div class="one_sixth"><br />',
    '<div class="one_sixth last"></p>',
	'<div class="one_sixth last"><br />',
	'<div class="two_fifth"></p>',
	'<div class="two_fifth"><br />',
    '<div class="two_fifth last"></p>',
	'<div class="two_fifth last"><br />',
	'<div class="three_fifth"></p>',
	'<div class="three_fifth"><br />',
    '<div class="three_fifth last"></p>',
	'<div class="three_fifth last"><br />',
	'<div class="four_fifth"></p>',
	'<div class="four_fifth"><br />',
    '<div class="four_fifth last"></p>',
	'<div class="four_fifth last"><br />',
    '<div class="two_third"></p>',
	'<div class="two_third"><br />',
    '<div class="two_third last"></p>',
	'<div class="two_third last"><br />',
    '<div class="three_fourth"></p>',
	'<div class="three_fourth"><br />',
    '<div class="three_fourth last"></p>',
	'<div class="three_fourth last"><br />',
	'<div class="five_sixth"></p>',
	'<div class="five_sixth"><br />',
    '<div class="five_sixth last"></p>',
	'<div class="five_sixth last"><br />',
    '{{',
    '}}',
	'<p></p>',
	'<div class="clear"></div></p>',
	'</div><br />',
	'<p><div',
	'<div class="accordion"><br />',
	'</ul><br />',
	'<div class="bxslider"><br />',
	'</th><br />',
	'</tr><br />',
	'</div></p>',
	'<h1>',
	'</h1>',
	'<h2>',
	'</h2>',
	'<h3>',
	'</h3>',
	'<h4>',
	'</h4>',
	'<h5>',
	'</h5>',
	'<h6>',
	'</h6>'
  ),
    array('<div class="one_third">',
	'<div class="one_third">',
    '<div class="one_third last">',
	'<div class="one_third last">',
    '<div class="one_half">',
	'<div class="one_half">',
    '<div class="one_half last">',
	'<div class="one_half last">',
    '<div class="one_fourth">',
	'<div class="one_fourth">',
    '<div class="one_fourth last">',
	'<div class="one_fourth last">',
	'<div class="one_fifth">',
	'<div class="one_fifth">',
    '<div class="one_fifth last">',
	'<div class="one_fifth last">',
	'<div class="one_sixth">',
	'<div class="one_sixth">',
    '<div class="one_sixth last">',
	'<div class="one_sixth last">',
	'<div class="two_fifth">',
	'<div class="two_fifth">',
    '<div class="two_fifth last">', 
	'<div class="two_fifth last">',
	'<div class="three_fifth">',
	'<div class="three_fifth">',
    '<div class="three_fifth last">', 
	'<div class="three_fifth last">',
	'<div class="four_fifth">',
	'<div class="four_fifth">',
    '<div class="four_fifth last">', 
	'<div class="four_fifth last">',
    '<div class="two_third">',
	'<div class="two_third">',
    '<div class="two_third last">', 
	'<div class="two_third last">',
    '<div class="three_fourth">',
	'<div class="three_fourth">',
    '<div class="three_fourth last">',
	'<div class="three_fourth last">',
	'<div class="five_sixth">',
	'<div class="five_sixth">',
    '<div class="five_sixth last">',
	'<div class="five_sixth last">',
    '[',
    ']',
	'',
	'<div class="clear"></div>',
	'</div>',
	'<div',
	'<div class="accordion">',
	'</ul>',
	'<div class="bxslider">',
	'</th>',
	'</tr>',
	'</div>',
	'<h1><span>',
	'</span></h1>',
	'<h2><span>',
	'</span></h2>',
	'<h3><span>',
	'</span></h3>',
	'<h4><span>',
	'</span></h4>',
	'<h5><span>',
	'</span></h5>',
	'<h6><span>',
	'</span></h6>'
       ), $post_content);
    return str_replace('<p></div>', '</div>', $new_content);
}
//Add shortcode processing to "Text" Widget @Wellness Since 1.5
add_filter('widget_text', 'do_shortcode');

//Column Shortcodes
////**************** 1/2 Columns ******************
function shortcode_one_half( $atts, $content ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'shortcode_one_half');

function shortcode_one_half_last( $atts, $content ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'shortcode_one_half_last');

//**************** 1/3 Columns ******************
function shortcode_one_third( $atts, $content ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'shortcode_one_third');

function shortcode_one_third_last( $atts, $content ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'shortcode_one_third_last');

//*************** 1/4 Columns ******************
function shortcode_one_fourth( $atts, $content ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'shortcode_one_fourth');

function shortcode_one_fourth_last( $atts, $content ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'shortcode_one_fourth_last');

//*************** 1/5 Columns ******************
function shortcode_one_fifth( $atts, $content ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'shortcode_one_fifth');

function shortcode_one_fifth_last( $atts, $content ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'shortcode_one_fifth_last');

//*************** 1/6 Columns ******************
function shortcode_one_sixth( $atts, $content ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'shortcode_one_sixth');

function shortcode_one_sixth_last( $atts, $content ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'shortcode_one_sixth_last');

//*************** 2/3 Columns ******************
function shortcode_two_third( $atts, $content ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'shortcode_two_third');

function shortcode_two_third_last( $atts, $content ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'shortcode_two_third_last');

//*************** 3/4 Columns ******************
function shortcode_three_fourth( $atts, $content ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'shortcode_three_fourth');

function shortcode_three_fourth_last( $atts, $content ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 'shortcode_three_fourth_last');

//*************** 2/5 Columns ******************
function shortcode_two_fifth( $atts, $content ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'shortcode_two_fifth');

function shortcode_two_fifth_last( $atts, $content ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'shortcode_two_fifth_last');

//*************** 3/5 Columns ******************
function shortcode_three_fifth( $atts, $content ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'shortcode_three_fifth');

function shortcode_three_fifth_last( $atts, $content ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'shortcode_three_fifth_last');

//*************** 4/5 Columns ******************
function shortcode_four_fifth( $atts, $content ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'shortcode_four_fifth');

function shortcode_four_fifth_last( $atts, $content ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_four_fifth', 'shortcode_four_fifth');

//*************** 5/6 Columns ******************
function shortcode_five_sixth( $atts, $content ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'shortcode_five_sixth');

function shortcode_five_sixth_last( $atts, $content ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_five_sixth', 'shortcode_five_sixth');

// Accordion Heading
function accordion_title($atts, $content) {

	$bw_return = '<div class="accordion">';
	$bw_return.= do_shortcode($content);
	$bw_return.= '</div>';
	
	return $bw_return;
}
add_shortcode('accordion', 'accordion_title');

// Accordion Content Tabs
function accordion_content($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => ''
	), $atts));
	
	
	$bw_return = '<h5><a href="#">'.$title.'</a></h5>';
	$bw_return.= '<div><p>';
	$bw_return.= do_shortcode($content);
	$bw_return.= '</p></div>';
	
	return $bw_return;
}
add_shortcode('accordion_content', 'accordion_content');

// Testimonial Wrapper
function testimonial_title($atts, $content) {

	$bw_return = '<div class="bxslider">';
	$bw_return.= do_shortcode($content);
	$bw_return.= '</div>';
	
	return $bw_return;
}
add_shortcode('testimonials', 'testimonial_title');

// Testimonial Content
function testimonial_content($atts, $content) {

	$bw_return.= '<div>';
	$bw_return.= do_shortcode($content);
	$bw_return.= '</div>';
	
	return $bw_return;
}
add_shortcode('testimonial', 'testimonial_content');

// Tabs Shortcode
function tabs_title($atts, $content) {

	//Maximum 10 tabs
	extract(shortcode_atts(array(
		'tab1' => '',
		'tab2' => '',
		'tab3' => '',
		'tab4' => '',
		'tab5' => '',
		'tab6' => '',
		'tab7' => '',
		'tab8' => '',
		'tab9' => '',
		'tab10' => '',
	), $atts));
	
	$tab_arr = array(
		$tab1,
		$tab2,
		$tab3,
		$tab4,
		$tab5,
		$tab6,
		$tab7,
		$tab8,
		$tab9,
		$tab10,
	);
	
	$bw_return = '<div class="tabs"><ul>';
	
	foreach($tab_arr as $key=>$tab)
	{
		//display title tabs
		if(!empty($tab))
		{
			$bw_return.= '<li><a href="#tabs-'.($key+1).'">'.$tab.'</a></li>';
		}
	}
	
	$bw_return.= '</ul>';
	$bw_return.= do_shortcode($content);
	$bw_return.= '</div>';
	
	return $bw_return;
}
add_shortcode('tabs', 'tabs_title');

//Tabs Content shortcode
function tab_content($atts, $content) {

	//Display tab paragraphs
	extract(shortcode_atts(array(
		'num' => '',
	), $atts));
	
	$bw_return = '<div id="tabs-'.$num.'">'.do_shortcode($content).'</div>';
	
	return $bw_return;
}
add_shortcode('tab', 'tab_content');

//Site tagline
function shortcode_tagline($atts, $content){
	//Get parameters
	extract(shortcode_atts(array(
	'tagtitle' => '',
	'tagbutton' => 0,
	'tagbuttonsize' => '',
	'buttonstyle' => '',
	'buttonlink' => '',
	'buttonlinktext' => '',
	'buttontarget' => '',
	), $atts));

	$bw_return = '<div class="tagline"><div class="taglinetext"><h1>'.$tagtitle.'</h1>'.$content.'</div>';
	if ($tagbutton == 1)
		{
			$bw_return.= '<div class="taglinebutton"><div class="'.$tagbuttonsize.'"><a class="'.$buttonstyle.'" href="'.$buttonlink.'" target="'.$buttontarget.'">'.$buttonlinktext.'</a></div></div>';
		}
	$bw_return.='</div>';
	
	return $bw_return;
}
add_shortcode('tagline', 'shortcode_tagline');

//Auto buttons
function shortcode_buttons($atts, $content){
	//Get parameters
	extract(shortcode_atts(array(
	'buttonsize' => '',
	'buttonstyle' => '',
	'buttonlink' => '',
	'buttontarget' => '',
	), $atts));

			$bw_return = '<div class="button-regular-'.$buttonsize.'"><a class="'.$buttonstyle.'" href="'.$buttonlink.'" target="'.$buttontarget.'">'.$content.'</a></div>';

	
	return $bw_return;
}
add_shortcode('button', 'shortcode_buttons');


//Staff bio
function shortcode_staffbio ($atts, $content){
	//Get parameters
	extract(shortcode_atts(array(
	'staffname' => '',
	'stafftitle' => '',
	'staffimage' => '',
	'stafffax' => '',
	'staffphone' => '',
	'staffemail' => '',
	), $atts));
	
	$bw_return = '<div class="staffmember">';
	//If bio has an image URL
	if ($staffimage !== '') {
		$bw_return.= '<div class="staffmemberphoto"><img src="'.$staffimage.'" /></div>';
		}
	$bw_return.='<div class ="staffmembertext"><h2>'.$staffname.'</h2><p class="staffdesc">'.$stafftitle.'</p><hr><p>'.$content.'</p><hr><ul class="staffcontact">';
	//If there is a phone, fax or email address for bio		
	if ($staffphone !== '') {
		$bw_return.= '<li class="phone">'.$staffphone.'</li>';
		}
	if ($stafffax !== '') {
		$bw_return.= '<li class="fax">'.$stafffax.'</li>';
		}
	if ($staffemail !== '') {
		$bw_return.= '<li class="email"><a href="mailto:'.$staffemail.'">'.$staffemail.'</a></li>';
		}

	$bw_return.= '</ul></div></div><div class="clear"></div>';
	
	return $bw_return;
	
}
add_shortcode('staffbio', 'shortcode_staffbio');

//Pricing table
function shortcode_pricetable ($atts, $content){
	//Get parameters
	extract(shortcode_atts(array(
		'col1' => '',
		'col2' => '',
		'col3' => '',
		'col4' => '',
		'col5' => '',
		'col6' => '',
		'col7' => '',
		'col8' => '',
		'col9' => '',
		'col10' => '',
	), $atts));
	
	$table_arr = array(
		$col1,
		$col2,
		$col3,
		$col4,
		$col5,
		$col6,
		$col7,
		$col8,
		$col9,
		$col10,
	);
	
	$bw_return = '<table cellspacing="0"><tr>';
	
	foreach($table_arr as $key=>$tab)
	{
		//display title tabs
		if(!empty($tab))
		{
			$bw_return.= '<th>'.$tab.'</th>';
		}
	}
	$bw_return .= do_shortcode($content);
	$bw_return .= '</tr></table>';
	
	return $bw_return;
	
}
add_shortcode('pricetable', 'shortcode_pricetable');

function shortcode_pricetablerows ($atts, $content){
	//Get parameters
	extract(shortcode_atts(array(
		'col1' => '',
		'col2' => '',
		'col3' => '',
		'col4' => '',
		'col5' => '',
		'col6' => '',
		'col7' => '',
		'col8' => '',
		'col9' => '',
		'col10' => '',
	), $atts));
	
	$table_arr = array(
		$col1,
		$col2,
		$col3,
		$col4,
		$col5,
		$col6,
		$col7,
		$col8,
		$col9,
		$col10,
	);
$bw_return = '<tr>';
	
	foreach($table_arr as $key=>$tab)
	{
		//display title tabs
		if(!empty($tab))
		{
			$bw_return.= '<td>'.$tab.'</td>';
		}
	}
	$bw_return .= '</tr>';
	
	return $bw_return;
	
}
add_shortcode('pricetablerow', 'shortcode_pricetablerows');

//Message Boxes
function shortcode_msgbox($atts, $content){
	//Get parameters
	extract(shortcode_atts(array(
	'msgstyle' => ''
	), $atts));

			$bw_return = '<div class="messagebox '.$msgstyle.'">'.$content.'</div>';
			
	return $bw_return;
}
add_shortcode('messagebox', 'shortcode_msgbox');

//Style the Google Map output
function shortcode_gmap($atts, $content){

		$new_content = str_replace(array('<iframe '
		), array('<iframe class="googlemap" '), $content);
	
	return $new_content;
}
add_shortcode('googlemap', 'shortcode_gmap');




?>