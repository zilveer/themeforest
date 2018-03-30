<?php
ob_start();


$thm_options = get_option('webnus_options');


/*
 * Header Style
*/

if($thm_options['webnus_container_width'])
{
	$w_value = trim ($thm_options['webnus_container_width']);
	if($w_value){
		if(substr($w_value,-2,2)!="px"){$w_value.='px';};
		echo "#wrap .container {max-width:{$w_value};}\n\n";
	}
}

if($thm_options['webnus_header_padding_top'])
{
	$w_value = trim ($thm_options['webnus_header_padding_top']);
	if($w_value){
		if(substr($w_value,-2,2)!="px"){$w_value.='px';};
		echo "#header {padding-top:{$w_value};}\n\n";
	}
}

if($thm_options['webnus_header_padding_bottom'])
{
	$w_value = trim ($thm_options['webnus_header_padding_bottom']);
	if($w_value){
		if(substr($w_value,-2,2)!="px"){$w_value.='px';};
		echo "#header {padding-bottom:{$w_value};}\n\n";
	}
}

/*
 * Custom Fonts For P,H Tags
*/
$w_custom_font1_src = $w_custom_font2_src = $w_custom_font3_src ='';

//custom-font-1 font-face

  if(isset($thm_options['webnus_custom_font1_eot']) && $thm_options['webnus_custom_font1_eot']!='')
    $w_custom_font1_src[] = "url('{$thm_options['webnus_custom_font1_eot']}?#iefix') format('embedded-opentype')";
  if(isset($thm_options['webnus_custom_font1_woff']) && $thm_options['webnus_custom_font1_woff']!='')   
    $w_custom_font1_src[] = "url('{$thm_options['webnus_custom_font1_woff']}') format('woff')";
  if(isset($thm_options['webnus_custom_font1_ttf']) && $thm_options['webnus_custom_font1_ttf']!='')
    $w_custom_font1_src[] = "url('{$thm_options['webnus_custom_font1_ttf']}') format('truetype')";

if($w_custom_font1_src !='')
{
  $w_custom_font1_src= implode(",\n",$w_custom_font1_src);
  echo "@font-face {
  font-family: 'custom-font-1';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font1_src};\n}\n";
}

//custom-font-2 font-face

  if(isset($thm_options['webnus_custom_font2_eot']) && $thm_options['webnus_custom_font2_eot']!='')
    $w_custom_font2_src[] = "url('{$thm_options['webnus_custom_font2_eot']}?#iefix') format('embedded-opentype')";
  if(isset($thm_options['webnus_custom_font2_woff']) && $thm_options['webnus_custom_font2_woff']!='')   
    $w_custom_font2_src[] = "url('{$thm_options['webnus_custom_font2_woff']}') format('woff')";
  if(isset($thm_options['webnus_custom_font2_ttf']) && $thm_options['webnus_custom_font2_ttf']!='')
    $w_custom_font2_src[] = "url('{$thm_options['webnus_custom_font2_ttf']}') format('truetype')";

if($w_custom_font2_src !='')
{
  $w_custom_font2_src= implode(",\n",$w_custom_font2_src);
  echo "@font-face {
  font-family: 'custom-font-2';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font2_src};\n}\n";
}

//custom-font-3 font-face

  if(isset($thm_options['webnus_custom_font3_eot']) && $thm_options['webnus_custom_font3_eot']!='')
    $w_custom_font3_src[] = "url('{$thm_options['webnus_custom_font3_eot']}?#iefix') format('embedded-opentype')";
  if(isset($thm_options['webnus_custom_font3_woff']) && $thm_options['webnus_custom_font3_woff']!='')   
    $w_custom_font3_src[] = "url('{$thm_options['webnus_custom_font3_woff']}') format('woff')";
  if(isset($thm_options['webnus_custom_font3_ttf']) && $thm_options['webnus_custom_font3_ttf']!='')
    $w_custom_font3_src[] = "url('{$thm_options['webnus_custom_font3_ttf']}') format('truetype')";

if($w_custom_font3_src !='')
{
  $w_custom_font3_src= implode(",\n",$w_custom_font3_src);
  echo "@font-face {
  font-family: 'custom-font-3';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font3_src};\n}\n";
}


// p-font select

if(isset($thm_options['webnus_p_font']) && $thm_options['webnus_p_font']!='')
{
	if ($thm_options['webnus_p_font'] == 'typekit-font-1')
	  $thm_options['webnus_p_font'] = $thm_options['webnus_typekit_font1'];
	if ($thm_options['webnus_p_font'] == 'typekit-font-2')
	  $thm_options['webnus_p_font'] = $thm_options['webnus_typekit_font2'];
	if ($thm_options['webnus_p_font'] == 'typekit-font-3')
	  $thm_options['webnus_p_font'] = $thm_options['webnus_typekit_font3'];
	echo "#wrap p { font-family: {$thm_options['webnus_p_font']};}\n";
}


// heading-font select

if(isset($thm_options['webnus_heading_font']) && $thm_options['webnus_heading_font']!='')
{
	if ($thm_options['webnus_heading_font'] == 'typekit-font-1')
	  $thm_options['webnus_heading_font'] = $thm_options['webnus_typekit_font1'];
	if ($thm_options['webnus_heading_font'] == 'typekit-font-2')
	  $thm_options['webnus_heading_font'] = $thm_options['webnus_typekit_font2'];
	if ($thm_options['webnus_heading_font'] == 'typekit-font-3')
	  $thm_options['webnus_heading_font'] = $thm_options['webnus_typekit_font3'];
	echo "#wrap h1, #wrap h2, #wrap h3, #wrap h4, #wrap h5, #wrap h6 { font-family: {$thm_options['webnus_heading_font']};}\n";
}


// body-font select

if(isset($thm_options['webnus_body_font']) && $thm_options['webnus_body_font']!='')
{
	if ($thm_options['webnus_body_font'] == 'typekit-font-1')
	  $thm_options['webnus_body_font'] = $thm_options['webnus_typekit_font1'];
	if ($thm_options['webnus_body_font'] == 'typekit-font-2')
	  $thm_options['webnus_body_font'] = $thm_options['webnus_typekit_font2'];
	if ($thm_options['webnus_body_font'] == 'typekit-font-3')
	  $thm_options['webnus_body_font'] = $thm_options['webnus_typekit_font3'];
	echo "#wrap body { font-family: {$thm_options['webnus_body_font']};}\n";
}


// menu-font select

if(isset($thm_options['webnus_menu_font']) && $thm_options['webnus_menu_font']!='')
{
	if ($thm_options['webnus_menu_font'] == 'typekit-font-1')
	  $thm_options['webnus_menu_font'] = $thm_options['webnus_typekit_font1'];
	if ($thm_options['webnus_menu_font'] == 'typekit-font-2')
	  $thm_options['webnus_menu_font'] = $thm_options['webnus_typekit_font2'];
	if ($thm_options['webnus_menu_font'] == 'typekit-font-3')
	  $thm_options['webnus_menu_font'] = $thm_options['webnus_typekit_font3'];
	echo "#wrap #nav a { font-family: {$thm_options['webnus_menu_font']};}\n";
}



/* header menu font size */

$webnus_topnav_font_size = $webnus_options->webnus_topnav_font_size(); 
if( !empty($webnus_topnav_font_size) ){
	echo "#wrap ul#nav * { font-size:{$webnus_topnav_font_size}; }\n";
}
$webnus_topnav_letter_spacing = $webnus_options->webnus_topnav_letter_spacing(); 
if( !empty($webnus_topnav_letter_spacing) ){
	echo "#wrap ul#nav * { letter-spacing:{$webnus_topnav_letter_spacing}; }\n";
}
$webnus_topnav_line_height = $webnus_options->webnus_topnav_line_height(); 
if( !empty($webnus_topnav_line_height) ){	
	echo "#wrap ul#nav * { line-height:{$webnus_topnav_line_height}; }\n";	
}



/*  P */

$webnus_p_font_size = $webnus_options->webnus_p_font_size(); 
if( !empty($webnus_p_font_size) )
{
	echo "#wrap p { font-size:{$webnus_p_font_size}; }\n";
}
$webnus_p_letter_spacing = $webnus_options->webnus_p_letter_spacing(); 
if( !empty($webnus_p_letter_spacing) ){
	echo "#wrap p { letter-spacing:{$webnus_p_letter_spacing}; }\n";
}
$webnus_p_line_height = $webnus_options->webnus_p_line_height(); 
if( !empty($webnus_p_line_height) ){
	echo "#wrap p { line-height:{$webnus_p_line_height}; }\n";
}

$webnus_p_font_color = $webnus_options->webnus_p_font_color(); 
if( !empty($webnus_p_font_color) ){
	echo "#wrap p { color:{$webnus_p_font_color}; }\n";
}


/*  H1 */

$webnus_h1_font_size = $webnus_options->webnus_h1_font_size(); 
if( !empty($webnus_h1_font_size) ){
	echo "#wrap h1 { font-size:{$webnus_h1_font_size}; }\n";
}
$webnus_h1_letter_spacing = $webnus_options->webnus_h1_letter_spacing(); 
if( !empty($webnus_h1_letter_spacing) ){
	echo "#wrap h1 { letter-spacing:{$webnus_h1_letter_spacing}; }\n";
}
$webnus_h1_line_height = $webnus_options->webnus_h1_line_height(); 
if( !empty($webnus_h1_line_height) ){
	echo "#wrap h1 { line-height:{$webnus_h1_line_height}; }\n";
}

$webnus_h1_font_color = $webnus_options->webnus_h1_font_color(); 
if( !empty($webnus_h1_font_color) ){	
	echo "#wrap h1 { color:{$webnus_h1_font_color}; }\n";	
}



/*  H2 */

$webnus_h2_font_size = $webnus_options->webnus_h2_font_size(); 
if( !empty($webnus_h2_font_size) ){	
	echo "#wrap h2 { font-size:{$webnus_h2_font_size}; }\n";	
}
$webnus_h2_letter_spacing = $webnus_options->webnus_h2_letter_spacing(); 
if( !empty($webnus_h2_letter_spacing) ){	
	echo "#wrap h2 { letter-spacing:{$webnus_h2_letter_spacing}; }\n";	
}
$webnus_h2_line_height = $webnus_options->webnus_h2_line_height(); 
if( !empty($webnus_h2_line_height) ){
	echo "#wrap h2 { line-height:{$webnus_h2_line_height}; }\n";
}

$webnus_h2_font_color = $webnus_options->webnus_h2_font_color(); 
if( !empty($webnus_h2_font_color) ){
	echo "#wrap h2 { color:{$webnus_h2_font_color}; }\n";	
}


/*  H3 */

$webnus_h3_font_size = $webnus_options->webnus_h3_font_size(); 
if( !empty($webnus_h3_font_size) ){
	echo "#wrap h3 { font-size:{$webnus_h3_font_size}; }\n";
}
$webnus_h3_letter_spacing = $webnus_options->webnus_h3_letter_spacing(); 
if( !empty($webnus_h3_letter_spacing) ){	
	echo "#wrap h3 { letter-spacing:{$webnus_h3_letter_spacing}; }\n";
}
$webnus_h3_line_height = $webnus_options->webnus_h3_line_height(); 
if( !empty($webnus_h3_line_height) ){	
	echo "#wrap h3 { line-height:{$webnus_h3_line_height}; }\n";	
}

$webnus_h3_font_color = $webnus_options->webnus_h3_font_color(); 
if( !empty($webnus_h3_font_color) ){
	echo "#wrap h3 { color:{$webnus_h3_font_color}; }\n";
}



/*  H4 */

$webnus_h4_font_size = $webnus_options->webnus_h4_font_size(); 
if( !empty($webnus_h4_font_size) ){
	echo "#wrap h4 { font-size:{$webnus_h4_font_size}; }\n";	
}
$webnus_h4_letter_spacing = $webnus_options->webnus_h4_letter_spacing(); 
if( !empty($webnus_h4_letter_spacing) ){
	echo "#wrap h4 { letter-spacing:{$webnus_h4_letter_spacing}; }\n";
	
}
$webnus_h4_line_height = $webnus_options->webnus_h4_line_height(); 
if( !empty($webnus_h4_line_height) ){
	echo "#wrap h4 { line-height:{$webnus_h4_line_height}; }\n";
}

$webnus_h4_font_color = $webnus_options->webnus_h4_font_color(); 
if( !empty($webnus_h4_font_color) ){
	echo "#wrap h4 { color:{$webnus_h4_font_color}; }\n";
}



/*  H5 */

$webnus_h5_font_size = $webnus_options->webnus_h5_font_size(); 
if( !empty($webnus_h5_font_size) ){	
	echo "#wrap h5 { font-size:{$webnus_h5_font_size}; }\n";	
}
$webnus_h5_letter_spacing = $webnus_options->webnus_h5_letter_spacing(); 
if( !empty($webnus_h5_letter_spacing) ){	
	echo "#wrap h5 { letter-spacing:{$webnus_h5_letter_spacing}; }\n";	
}
$webnus_h5_line_height = $webnus_options->webnus_h5_line_height(); 
if( !empty($webnus_h5_line_height) ){	
	echo "#wrap h5 { line-height:{$webnus_h5_line_height}; }\n";	
}

$webnus_h5_font_color = $webnus_options->webnus_h5_font_color(); 
if( !empty($webnus_h5_font_color) ){
	
	echo "#wrap h5 { color:{$webnus_h5_font_color}; }\n";	
}



/*  H6 */

$webnus_h6_font_size = $webnus_options->webnus_h6_font_size(); 
if( !empty($webnus_h6_font_size) ){
	echo "#wrap h6 { font-size:{$webnus_h6_font_size}; }\n";
}
$webnus_h6_letter_spacing = $webnus_options->webnus_h6_letter_spacing(); 
if( !empty($webnus_h6_letter_spacing) ){
	echo "#wrap h6 { letter-spacing:{$webnus_h6_letter_spacing}; }\n";
}
$webnus_h6_line_height = $webnus_options->webnus_h6_line_height(); 
if( !empty($webnus_h6_line_height) ){
	echo "#wrap h6 { line-height:{$webnus_h6_line_height}; }\n";
}

$webnus_h6_font_color = $webnus_options->webnus_h6_font_color(); 
if( !empty($webnus_h6_font_color) ){
	echo "#wrap h6 { color:{$webnus_h6_font_color}; }\n";
}




/*
 * Color Skin Style Generator
 */

 /* Link Color */
 if($thm_options['webnus_link_color'])
 	echo "a {color:{$thm_options['webnus_link_color']};}\n\n";
 if($thm_options['webnus_hover_link_color'])
 	echo "a:hover {color:{$thm_options['webnus_hover_link_color']};}\n\n";	
 if($thm_options['webnus_visited_link_color'])
 	echo "a:visited {color:{$thm_options['webnus_visited_link_color']};}\n\n";	
 
 
 
 /* == Menu Colors ------------------ */
 
if($thm_options['webnus_menu_link_color'])	
	echo "#wrap #nav a { color:{$thm_options['webnus_menu_link_color']};}\n\n";

if($thm_options['webnus_menu_hover_link_color'])
	echo "#wrap #nav a:hover, #wrap  #nav li:hover > a{color:{$thm_options['webnus_menu_hover_link_color']};}\n\n";

if($thm_options['webnus_menu_selected_link_color'])
	echo "#wrap #nav li.current > a, #wrap #nav li.current ul li a:hover, #wrap #nav li.active > a {color:{$thm_options['webnus_menu_selected_link_color']};}\n\n";
	
if($thm_options['webnus_menu_selected_border_color'])
	echo "#wrap #nav > li.current:after {background:{$thm_options['webnus_menu_selected_border_color']};}\n\n";

if($thm_options['webnus_resoponsive_menu_icon_color'])
	echo "#wrap #header.sm-rgt-mn #menu-icon span.mn-ext1, #wrap #header.sm-rgt-mn #menu-icon span.mn-ext2, #wrap #header.sm-rgt-mn #menu-icon span.mn-ext3 {background:{$thm_options['webnus_resoponsive_menu_icon_color']};}\n\n";



/* == Icon Box Colors---------------------- */


if(isset($thm_options['webnus_iconbox_base_color']) && $thm_options['webnus_iconbox_base_color']!='')
{
	echo "#wrap .icon-box  i, #wrap  .icon-box1  i, #wrap .icon-box2 i, #wrap  .icon-box3  i, #wrap  .icon-box4 i, #wrap  .icon-box5 i , #wrap  .icon-box7  i, #wrap .icon-box8 i, #wrap .icon-box9 i, #wrap .icon-box9 h5, #wrap .icon-box9 h4, #wrap .icon-box10 i { color:{$thm_options['webnus_iconbox_base_color']};}\n\n";
}

/* learn more link color */

if(isset($thm_options['webnus_learnmore_link_color']) && $thm_options['webnus_learnmore_link_color']!='')
{
	echo "#wrap a.magicmore { color:{$thm_options['webnus_learnmore_link_color']};}\n";
}
/* learn more hover link color */

if(isset($thm_options['webnus_learnmore_hover_link_color']) && $thm_options['webnus_learnmore_hover_link_color']!='')
{
	echo "#wrap a.magicmore:hover { color:{$thm_options['webnus_learnmore_hover_link_color']};}\n";
}




/* == Portfolio Colors---------------------- */


/* portfolio filter links color + border color */
if(isset($thm_options['webnus_portfolio_filter_links_color']) && $thm_options['webnus_portfolio_filter_links_color']!='')
{
	echo "#wrap nav.primary .portfolioFilters a { color:{$thm_options['webnus_portfolio_filter_links_color']};}\n";
}
if(isset($thm_options['webnus_portfolio_filter_links_border_color']) && $thm_options['webnus_portfolio_filter_links_border_color']!='')
{
	echo "#wrap nav.primary .portfolioFilters a { border-color:{$thm_options['webnus_portfolio_filter_links_border_color']};}\n";
}
/* portfolio filter links hover color + border color */

if(isset($thm_options['webnus_portfolio_filter_links_hover_color']) && $thm_options['webnus_portfolio_filter_links_hover_color']!='')
{
	echo "#wrap nav.primary .portfolioFilters a:hover {  color:{$thm_options['webnus_portfolio_filter_links_hover_color']};}\n";
}
if(isset($thm_options['webnus_portfolio_filter_links_hover_border_color']) && $thm_options['webnus_portfolio_filter_links_hover_border_color']!='')
{
	echo "#wrap nav.primary .portfolioFilters a:hover {  border-color:{$thm_options['webnus_portfolio_filter_links_hover_border_color']};}\n";
}

/* portfolio filter links color selected + border color */
if(isset($thm_options['webnus_portfolio_filter_selected_links_color']) && $thm_options['webnus_portfolio_filter_selected_links_color']!='')
{
	echo "#wrap nav.primary .portfolioFilters a.selected, #wrap nav.primary ul li a:active {  color:{$thm_options['webnus_portfolio_filter_selected_links_color']}; }\n";
}

if(isset($thm_options['webnus_portfolio_filter_selected_links_border_color']) && $thm_options['webnus_portfolio_filter_selected_links_border_color']!='')
{
	echo "#wrap nav.primary .portfolioFilters a.selected, #wrap nav.primary ul li a:active {  border-color:{$thm_options['webnus_portfolio_filter_selected_links_border_color']}; }\n";
}



/* portfolio item zoom link color */

if(isset($thm_options['webnus_portfolio_item_zoom_link_color']) && $thm_options['webnus_portfolio_item_zoom_link_color']!='')
{
	echo ".zoomex2 a { color:{$thm_options['webnus_portfolio_item_zoom_link_color']};}\n";
}
/* portfolio item zoom link border color */
if(isset($thm_options['webnus_portfolio_item_zoom_link_border_color']) && $thm_options['webnus_portfolio_item_zoom_link_border_color']!='')
{
	echo ".zoomex2 a i { border-color:{$thm_options['webnus_portfolio_item_zoom_link_border_color']};}\n";
}


/* portfolio item zoom link hover color + border color */
if(isset($thm_options['webnus_portfolio_item_zoom_link_hover_color']) && $thm_options['webnus_portfolio_item_zoom_link_hover_color']!='')
{
	echo "#wrap .zoomex2 a:hover i { color:{$thm_options['webnus_portfolio_item_zoom_link_hover_color']};  }\n";
}
if(isset($thm_options['webnus_portfolio_item_zoom_link_hover_border_color']) && $thm_options['webnus_portfolio_item_zoom_link_hover_border_color']!='')
{
	echo "#wrap .zoomex2 a:hover i { border-color:{$thm_options['webnus_portfolio_item_zoom_link_hover_border_color']};  }\n";
}




/* contact form */

if(isset($thm_options['webnus_contactform_button_color']) && $thm_options['webnus_contactform_button_color']!='')
{
	echo "#wrap #footer .footer-in .contact-inf button {background:{$thm_options['webnus_contactform_button_color']};}\n";
}

if(isset($thm_options['webnus_contactform_button_hover_color']) && $thm_options['webnus_contactform_button_hover_color']!='')
{
	echo "#wrap #footer .footer-in .contact-inf button:hover {background:{$thm_options['webnus_contactform_button_hover_color']};}\n";
}




/* scroll to top */

if(isset($thm_options['webnus_scroll_to_top_hover_background_color']) && $thm_options['webnus_scroll_to_top_hover_background_color']!='')
{
	echo "#wrap #scroll-top a:hover {background-color:{$thm_options['webnus_scroll_to_top_hover_background_color']};}\n";
}






/* == Our Process Icon Colors------------------------------ */

/* our process icon color + border color += background color */
if(isset($thm_options['webnus_ourprocess_icon_color']) && $thm_options['webnus_ourprocess_icon_color']!='')
{
	echo "#wrap .our-process-item i { color:{$thm_options['webnus_ourprocess_icon_color']};}\n";
}

if(isset($thm_options['webnus_ourprocess_border_color']) && $thm_options['webnus_ourprocess_border_color']!='')
{
	echo "#wrap .our-process-item i { border-color:{$thm_options['webnus_ourprocess_border_color']};}\n";
}

if(isset($thm_options['webnus_ourprocess_background_color']) && $thm_options['webnus_ourprocess_background_color']!='')
{
	echo "#wrap .our-process-item i { background-color:{$thm_options['webnus_ourprocess_background_color']};} \n";
}

/* our process icon hover color + border color += background color */

if(isset($thm_options['webnus_ourprocess_hover_icon_color']) && $thm_options['webnus_ourprocess_hover_icon_color']!='')
{
	echo "#wrap .our-process-item:hover i { color:{$thm_options['webnus_ourprocess_hover_icon_color']};  } \n";
}
if(isset($thm_options['webnus_ourprocess_hover_border_color']) && $thm_options['webnus_ourprocess_hover_border_color']!='')
{
	echo "#wrap .our-process-item:hover i { border-color:{$thm_options['webnus_ourprocess_hover_border_color']};  } \n";
}
if(isset($thm_options['webnus_ourprocess_hover_background_color']) && $thm_options['webnus_ourprocess_hover_background_color']!='')
{
	echo "#wrap .our-process-item:hover i { background-color:{$thm_options['webnus_ourprocess_hover_background_color']};  } \n";
}







/*
 * Blog Loop And Single Blog Styles
 * 
 */
/* All Posts Title Font-family */
$webnus_blog_title_font_family = $webnus_options->webnus_blog_title_font_family(); 
if( !empty($webnus_blog_title_font_family) )
{
	echo ".blog-post h4, .blog-post h1, .blog-post h3, .blog-line h4, .blog-single-post h1 { font-family:$webnus_blog_title_font_family;}\n";
}

/* Blog Loop Title font-size */
$webnus_blog_loop_title_font_size = $webnus_options->webnus_blog_loop_title_font_size(); 
if( !empty($webnus_blog_loop_title_font_size) )
{
	echo ".blog-post h3 { font-size:{$webnus_blog_loop_title_font_size};}\n";
}

/* Blog Loop Title line-height */
$webnus_blog_loop_title_line_height = $webnus_options->webnus_blog_loop_title_line_height(); 
if( !empty($webnus_blog_loop_title_line_height) )
{
	echo ".blog-post h3 { line-height:{$webnus_blog_loop_title_line_height};}\n";
}

/* Blog Loop Title font-wight */
$webnus_blog_loop_title_font_weight = $webnus_options->webnus_blog_loop_title_font_weight(); 
if( !empty($webnus_blog_loop_title_font_weight) )
{
	echo ".blog-post h3 { font-weight:{$webnus_blog_loop_title_font_weight};}\n";
}

/* Blog Loop Title letter-spacing */
$webnus_blog_loop_title_letter_spacing = $webnus_options->webnus_blog_loop_title_letter_spacing(); 
if( !empty($webnus_blog_loop_title_letter_spacing) )
{
	echo ".blog-post h3 { letter-spacing:{$webnus_blog_loop_title_letter_spacing};}\n";
}

/* Blog Loop Title color */
$webnus_blog_loop_title_color = $webnus_options->webnus_blog_loop_title_color(); 
if( !empty($webnus_blog_loop_title_color) )
{
	echo ".blog-post h3, .blog-post h3 a { color:$webnus_blog_loop_title_color;}\n";
}


/* Blog Loop Title hover color */
$webnus_blog_loop_title_hover_color = $webnus_options->webnus_blog_loop_title_hover_color(); 
if( !empty($webnus_blog_loop_title_hover_color) )
{
	echo ".blog-post h3 a:hover { color:$webnus_blog_loop_title_hover_color;}\n";
}

/***** Blog Single Title Font Options *****/

/* Single post Title font-size */

$webnus_blog_single_post_title_font_size = $webnus_options->webnus_blog_single_post_title_font_size(); 
if( !empty($webnus_blog_single_post_title_font_size) )
{
	echo ".blog-single-post h1 { font-size:{$webnus_blog_single_post_title_font_size};}\n";
}


/* Single post Title line-height */

$webnus_blog_single_title_line_height = $webnus_options->webnus_blog_single_title_line_height(); 
if( !empty($webnus_blog_single_title_line_height) )
{
	echo ".blog-single-post h1 { line-height:{$webnus_blog_single_title_line_height};}\n";
}


/* Single post Title font-wight */

$webnus_blog_single_title_font_weight = $webnus_options->webnus_blog_single_title_font_weight(); 
if( !empty($webnus_blog_single_title_font_weight) )
{
	echo ".blog-single-post h1 { font-weight:{$webnus_blog_single_title_font_weight};}\n";
}

/* Single post Title letter-spacing */

$webnus_blog_single_title_letter_spacing = $webnus_options->webnus_blog_single_title_letter_spacing(); 
if( !empty($webnus_blog_single_title_letter_spacing) )
{
	echo ".blog-single-post h1 { letter-spacing:{$webnus_blog_single_title_letter_spacing};}\n";
}


/* Single post Title color */

$webnus_blog_single_title_color = $webnus_options->webnus_blog_single_title_color(); 
if( !empty($webnus_blog_single_title_color) )
{
	echo ".blog-single-post h1 { color:$webnus_blog_single_title_color;}\n";
}


/* Topbar background color */

$topbar_background = $webnus_options->webnus_topbar_background_color();

if(!empty($topbar_background))
	echo ".top-bar { background-color:$topbar_background; }\n";


/* footer background color */
$footer_background = $webnus_options->webnus_footer_background_color();

if(!empty($footer_background))
	echo "#footer { background-color:$footer_background; }\n";


$footer_bottom_background = $webnus_options->webnus_footer_bottom_background_color();

if(!empty($footer_bottom_background))
	echo ".footbot { background-color:$footer_bottom_background; }\n";





if( $thm_options['webnus_custom_color_skin_enable'] ) { ?>

	/* == TextColors
	---------------- */
	.colorskin-custom #nav a:hover, .colorskin-custom #nav li:hover > a, .colorskin-custom #nav li.current > a, .colorskin-custom #nav li.active > a, .colorskin-custom .wedding-team-orchid .team-cap h4, .colorskin-custom .team-slider .team-cap h4, .colorskin-custom .latestposts-orchid h3.latest-b2-title a:hover, .colorskin-custom .wpcf7 .wpcf7-form h6, .colorskin-custom .guestbook-comments li:after, .colorskin-custom .latestposts-jasmine .blog-line p.blog-cat a, .colorskin-custom .blog-post a, .colorskin-custom .title-jasmine span, .colorskin-custom .infobox-overlay i, .colorskin-custom .wedding-team-jasmine .team-cap h4, .colorskin-custom #wrap .minimal-light .esg-filter-wrapper .esg-filterbutton:hover span, .colorskin-custom #wrap .minimal-light .esg-filter-wrapper .esg-filterbutton.selected span, .colorskin-custom #wrap .minimal-light .esg-navigationbutton:hover, .colorskin-custom #wrap .minimal-light .esg-navigationbutton:hover i, .colorskin-custom #wrap .minimal-light .esg-navigationbutton.selected, .colorskin-custom .latestposts-jasmine .blog-line p.blog-cat a, .colorskin-custom .blog-post a, .colorskin-custom .latestposts-jasmine .blog-line:hover .img-hover:before, .colorskin-custom .latestposts-jasmine .blog-line p.blog-cat a, .colorskin-custom .blog-post a, .colorskin-custom .latestposts-jasmine .blog-line:hover h4 a, .colorskin-custom .vertical-toggle-header-enabled #header.vertical-w #nav > li > a:hover, .colorskin-custom .vertical-toggle-header-enabled #header.vertical-w #nav > li.active > a, .colorskin-custom .wpcf7 .wpcf7-form h6 span, .colorskin-custom .guestbook-comments li:before, .colorskin-custom .wp-pagenavi a:hover, .colorskin-custom .wp-pagenavi span.current, .colorskin-custom .transparent-header-w #header.sticky #nav > li > a, .colorskin-custom #nav > li:hover > a, .colorskin-custom .wedding-team-rose .team-cap h4, .colorskin-custom .latestposts-rose .latest-title a:hover, .colorskin-custom .wpb_accordion .wpb_accordion_wrapper .ui-state-active a, .colorskin-custom .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a:hover, .colorskin-custom .max-quote h2:before, .colorskin-custom .max-quote h2:after, .colorskin-custom .title-violet *, .colorskin-custom .latestposts-violet h3.latest-b2-title a, .colorskin-custom .duplex-hd #nav > li > a:hover, .colorskin-custom #header.sticky.duplex-hd #nav > li > a:hover, .colorskin-custom .nav-wrap1.col-md-9 #nav > li > a:hover, .colorskin-custom #header.sticky .nav-wrap1.col-md-9 #nav > li > a:hover, .colorskin-custom .pin-box h4 a:hover, .colorskin-custom .tline-box h4 a:hover, .colorskin-custom .blox.dark .icon-box8 i, .colorskin-custom .icon-box9 i, .colorskin-custom .icon-box9 h5, .colorskin-custom .icon-box9 h4, .colorskin-custom .icon-box9 a.magicmore, .colorskin-custom .icon-box10 i
	{color: <?php echo $thm_options['webnus_custom_color_skin']; ?>}


	/* == Backgrounds
	----------------- */
	.colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext1, .colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext2, .colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext3,
	.colorskin-custom #scroll-top a:hover, .colorskin-custom .ts-orchid.testimonials-slider-w.flexslider .flex-control-paging li a.flex-active, .colorskin-custom .postmetadata h6.blog-views span, .colorskin-custom .side-list li:hover img, .colorskin-custom .ts-violet.testimonials-slider-w.flexslider .flex-direction-nav a:hover, .colorskin-custom .blox.dark .ts-violet.testimonials-slider-w.flexslider .flex-direction-nav a:hover, .colorskin-custom #footer .side-list li:hover img, .colorskin-custom .toggle-top-area .side-list li:hover img, .colorskin-custom .sidebar-line, .colorskin-custom .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .colorskin-custom .pin-ecxt2 .col1-3 span, .colorskin-custom .comments-number-x span, .colorskin-custom .icon-box1:hover i, .colorskin-custom .icon-box4:hover i, .colorskin-custom .icon-box6 i, .colorskin-custom .icon-box7 a.magicmore, .colorskin-custom .icon-box4:hover i
	{background-color: <?php echo $thm_options['webnus_custom_color_skin']; ?>}


	/* == BorderColors
	------------------ */
	.colorskin-custom .wedding-team-orchid img:hover, .colorskin-custom .ts-orchid.testimonials-slider-w.flexslider .testimonial-brand img, .colorskin-custom .orchid-gift-img:hover, .colorskin-custom #wrap .minimal-light .esg-filterbutton.selected, .colorskin-custom .latestposts-orchid .latest-b2 .au-avatar img, .colorskin-custom .orchid-st-mg img:hover, .colorskin-custom .widget h4.subtitle:after, .colorskin-custom #wrap .minimal-light .esg-filter-wrapper .esg-filterbutton:hover span, .colorskin-custom #wrap .minimal-light .esg-filter-wrapper .esg-filterbutton.selected span, .colorskin-custom #wrap .minimal-light .esg-navigationbutton.selected, .colorskin-custom .wp-pagenavi a:hover, .colorskin-custom .wp-pagenavi span.current, .colorskin-custom h6.h-sub-content, .colorskin-custom .wedding-team-violet img:hover, .colorskin-custom .icon-box4:hover i
	{border-color:<?php echo $thm_options['webnus_custom_color_skin']; ?>}


<?php } 





/*
 * Custom CSS
*/
	echo strip_tags($webnus_options->webnus_custom_css());








$out = $GLOBALS['webnus_dyncss'] = '';
$out = ob_get_contents();
$out = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out);
$GLOBALS['webnus_dyncss'] = str_replace(array("\r\n", "\r", "\n", "\t", '    '), '', $out);
ob_end_clean();



?>