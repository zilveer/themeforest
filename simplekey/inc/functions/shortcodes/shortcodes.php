<?php

/**
 * van Shortcodes Functions
 * @package VAN Framework
 */

 /* TABLE OF CONTENTS
 *
 1 - config
 2 - config item
 3 - quote
 4 - pricing
 5 - item
 6 - team / member
 7 - social 
 8 - appstore
 9 - android 
 10 - portfolios
 11 - portfolios taxonomy
 12 - one_half / one_half_last
 13 - one_third / one_third_last
 14 - two_third / two_third_last
 15 - one_fourth / one_fourth_last
 16 - two_fourth / two_fourth_last
 17 - three_fourth / three_fourth_last
 18 - format
 19 - dropcap
 20 - line
 21 - clear
 22 - toggle
 23 - tab / tabs
 24 - list
 25 - skills
 26 - tweets
 27 - post_list
 28 - blog
 29 - post_slider
 30 - tagclouds
 31 - comments
 32 - button
 33 - slider
 34 - headline
 35 - center
 36 - social_icon
 */


/*----------Shortcodes Functions---------------*/

/*[config][/config]*/
add_shortcode('config', 'van_config_shortcode');
function van_config_shortcode( $atts, $content) {
   $str=' <div class="config">'.van_shortcode($content).'</div>';
   return $str;
}

/*[config_item][/config_item]*/
add_shortcode('config_item', 'van_config_item_shortcode');
function van_config_item_shortcode( $atts, $content) {
   extract(shortcode_atts(array(
		'title' => '',
		'image' => '',
		'href' => '',
		'target' => '_self',
		'css_animation' =>''
	), $atts));
   $str='<div class="item config_item'.custom_css_animation($css_animation).'">'.PHP_EOL;
   if($image<>''){
     $str.='<div class="thumbnail">';
	 if($href<>''){
	   $str.='<a href="'.$href.'" target="'.$target.'">';
	 }
	 if(strstr($image,'http://')){
	   $str.='<img src="'.$image.'" alt="'.$title.'" />';
	 }else{
	   $str.='<img src="'.wp_get_attachment_url($image).'" alt="'.$title.'" />';
	 }
	 if($href<>''){
	   $str.='</a>';
	 }
	 $str.='</div>'.PHP_EOL;
   }
   if($title<>''){
	 if($href<>''){
	   $str.='<a href="'.$href.'" target="'.$target.'"><h2>'.$title.'</h2></a>';
	 }else{
       $str.='<h2>'.$title.'</h2>'.PHP_EOL;
	 }
   }
   $str.='<p>'.van_shortcode($content).'</p>'.PHP_EOL;
   $str.='</div>'.PHP_EOL;
   return $str;
}

/*[quote][/quote]*/
add_shortcode('quote', 'van_quote_shortcode');
function van_quote_shortcode( $atts, $content) {
   extract(shortcode_atts(array(
		'via' => '',
		'avatar' => '',
		'css_animation' =>''
	), $atts));
   $str='<div class="quotes'.custom_css_animation($css_animation).'">'.PHP_EOL;
   $str.='<blockquote class="quote-type">'.PHP_EOL;
   if($avatar<>''){
     if(strstr($avatar,'http://')){
	   $str.='<img src="'.$avatar.'" alt="'.$via.'" />';
	 }else{
	   $str.='<img src="'.wp_get_attachment_url($avatar).'" alt="'.$via.'" />';
	 }
   }
   $str.='<p class="content">'.van_shortcode($content).'</p>'.PHP_EOL;
   if($via<>''){
     $str.='<em class="source">'.$via.'</em>'.PHP_EOL;
   }
   $str.='<div class="clearfix"></div>'.PHP_EOL;
   $str.='</blockquote>'.PHP_EOL;
   $str.='</div>'.PHP_EOL;
   return $str;
}

/*[pricing][/pricing]*/
add_shortcode('pricing', 'van_pricing_shortcode');
function van_pricing_shortcode( $atts, $content) {
   extract(shortcode_atts(array(
        'currency'=>'$',
		'price' => '',
		'cycle' =>'',
		'name' => '',
		'plan' => '1',
		'link'=>'',
		'linktext'=>'More',
		'target'=>'_self',
		'css_animation' =>''
	), $atts));	
   
   if($plan=='')$plan='1';
   
   $str='<div class="pricetable'.custom_css_animation($css_animation).'" id="pricing-'.$name.'">
           <div class="plan plan'.$plan.'">
                   <figure>
                     <figcaption>'.$name.'</figcaption>
                     <div class="price">'.$currency.'<span>'.$price.'</span>'.$cycle.'</div>
                   </figure>
                   <ul>'.van_shortcode($content).'</ul>
                   <footer><a href="'.$link.'" target="'.$target.'" class="built-in-btn">'.$linktext.'</a></footer></div></div>';
   return $str;
}

/*[item][/item]*/
add_shortcode('item', 'van_item_shortcode');
function van_item_shortcode( $atts, $content) {
   $str='<li>'.van_shortcode($content).'</li>'.PHP_EOL;
   return $str;
}

/*[team][/team]*/
add_shortcode('team', 'van_team_shortcode');
function van_team_shortcode( $atts, $content) {
   $str='<div class="team">'.van_shortcode($content).'</div>'.PHP_EOL;
   return $str;
}

/*[member][/member]*/
add_shortcode('member', 'van_member_shortcode');
function van_member_shortcode( $atts, $content = "" ) {
   extract(shortcode_atts(array(
        'avatar'=>get_template_directory_uri().'/images/default_avatar.jpg',
		'name' => '',
		'job' => '',
		'facebook' => '',
		'twitter' => '',
		'dribbble'=> '',
		'flickr' => '',
		'googleplus' => '',
		'linkedin' => '',
		'behance' => '',
		'soundcloud' => '',
		'hearthis' => '',
		'instagram' => '',
		'pinterest' => '',		
		'hover'=>1,
		'css_animation' =>''
   ), $atts));		
	
   $str='<div class="member'.custom_css_animation($css_animation).'">';
   $str.='<div class="avatar">';
   if($hover==1 || $hover=="on"){
       $str.='<div class="overlay">';
	   $str.='<div class="social">';
	   if($facebook<>''){
	   $str.='<a href="'.esc_attr($facebook).'" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a>';
	   }
	   if($twitter<>''){
	   $str.='<a href="'.esc_attr($twitter).'" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a>';
	   }
	   if($dribbble<>'') {
	   $str.='<a href="'.esc_attr($dribbble).'" class="dribbble" target="_blank"><i class="fa fa-dribbble"></i></a>';
	   }
	   if($flickr<>'') {
	   $str.='<a href="'.esc_attr($flickr).'" class="flickr" target="_blank"><i class="fa fa-flickr"></i></a>';
	   }
	   if($googleplus<>''){
	   $str.='<a href="'.esc_attr($googleplus).'" class="gplus" target="_blank"><i class="fa fa-google-plus"></i></a>';
	   }
	   if($linkedin<>''){
	   $str.='<a href="'.esc_attr($linkedin).'" class="linkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>';
	   }
	   if($behance<>''){
	   $str.='<a href="'.esc_attr($behance).'" class="behance" target="_blank"><i class="fa fa-behance"></i></a>';
	   }
	   if($pinterest<>''){
	   $str.='<a href="'.esc_attr($pinterest).'" class="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>';
	   }
	   if($soundcloud<>''){
	   $str.='<a href="'.esc_attr($soundcloud).'" class="soundcloud" target="_blank"><i class="fa fa-soundcloud"></i></a>';
	   }
	   if($hearthis<>''){
	   $str.='<a href="'.esc_attr($hearthis).'" class="hearthis" target="_blank"><i class="ic ic-hearthis"></i></a>';
	   }
	   if($instagram<>''){
	   $str.='<a href="'.esc_attr($instagram).'" class="instagram" target="_blank"><i class="fa fa-instagram"></i></a>';
	   }	  
       $str.='</div>';
	   $str.='</div>';
   }
   if($avatar==''){
   $str.='<img src="'.get_template_directory_uri().'/images/default_avatar.jpg" />';
   }else{
     if(strstr($avatar,'http://')){
	   $str.='<img src="'.$avatar.'" alt="'.$name.'" />';
	 }else{
	   $str.='<img src="'.wp_get_attachment_url($avatar).'" alt="'.$name.'" />';
	 }
   }
   $str.='</div><hgroup>';
   $str.='<h2>'.esc_attr($name).'</h2>';
   $str.='<span>'.esc_attr($job).'</span>';
   $str.='</hgroup><p class="intro">'.van_shortcode($content).'</p>';
   $str.='</div>';
   return $str;
}


/*[social]*/
add_shortcode('social', 'van_social_shortcode');
function van_social_shortcode() {
   $str=van_social();
   return $str;
}

/*[appstore]*/
add_shortcode('appstore', 'van_appstore_shortcode');
function van_appstore_shortcode( $atts, $content) {
	extract(shortcode_atts(array(
		'href'=>'',
	), $atts));	
   $str='<a href="'.esc_attr($href).'" class="appstore"></a>';
   return $str;
}

/*[android]*/
add_shortcode('android', 'van_android_shortcode');
function van_android_shortcode( $atts, $content) {
	extract(shortcode_atts(array(
		'href'=>'',
	), $atts));	
   $str='<a href="'.esc_attr($href).'" class="andriod"></a>';
   return $str;
}

/*[portfolios]*/
add_shortcode('portfolios', 'van_portfolios_shortcode');
function van_portfolios_shortcode( $atts, $content) {
	extract(shortcode_atts(array(
		'number'=>9,
		'category'=>'',
		'lightbox'=>0,
		'intro'=>1,
		'ajax'=>1,
		'col'=>3,
		'open'=>'ajax',
		'orderby'=>'date',
		'filter'=>'1',
		'inverse'=>0,
		'css_animation'=>''
	), $atts));	
	
   if($open=="ajax"){
	  $ajax=1;
	  $lightbox=0;
   }else{
	  $ajax=0;
	  $lightbox=1;
   }
   
   if($intro==1 || $intro=="Yes"){
	   $intro=1;
   }elseif($intro==0 || $intro=="No"){
	   $intro=0;
   }
   
   if($inverse==1 || $inverse=="Yes" || $inverse==''){
	   $inverse=1;
   }elseif($inverse==0 || $inverse=="No"){
	   $inverse=0;
   }
   
   $str='';
   $id=van_random_string(10);
   if($filter=='Yes' || $filter==''|| $filter=='1'){
	   $str=van_category_filter($id,$inverse,'',$category,'portfolios',$css_animation,false);
   }
   $str.=van_portfolios($id,$category,$number,$lightbox,$ajax,$intro,$col,$orderby,$css_animation,false);
   return $str;
}

/*[portfolios filter]*/
add_shortcode('portfolios_filter', 'van_portfolios_filter_shortcode');
function van_portfolios_filter_shortcode( $atts, $content) {
	extract(shortcode_atts(array(
		'inverse'=>0,
		'exclude'=>'',
		'category'=>'',
		'css_animation'=>'',
	), $atts));	
   $str=van_category_filter($inverse,$exclude,$category,'portfolios',$css_animation,false);
   return $str;
}

/*[Blog grid]*/
add_shortcode('blog_grid', 'van_blog_grid_shortcode');
function van_blog_grid_shortcode( $atts, $content) {
	extract(shortcode_atts(array(
		'number'=>9,
		'category'=>'',
		'intro'=>1,
		'ajax'=>1,
		'col'=>3,
		'open'=>'ajax',
		'orderby'=>'date',
		'filter'=>'No',
		'inverse'=>0,
		'css_animation'=>''
	), $atts));	
	
   if($open=="ajax"){
	  $ajax=1;
   }else{
	  $ajax=0;
   }
   
   if($intro==1 || $intro=="Yes"){
	   $intro=1;
   }elseif($intro==0 || $intro=="No"){
	   $intro=0;
   }
   
   if($inverse==1 || $inverse=="Yes"){
	   $inverse=1;
   }elseif($inverse==0 || $inverse=="No"){
	   $inverse=0;
   }
   
   $str='';
   if($filter=='Yes'){
	   $str=van_category_filter($inverse,'',$category,'category',$css_animation,false);
   }
   $str.=van_blog_grid($category,$number,$ajax,$intro,$col,$orderby,$css_animation,false);
   return $str;
}

/*[category filter]*/
add_shortcode('category_filter', 'van_category_filter_shortcode');
function van_category_filter_shortcode( $atts, $content) {
	extract(shortcode_atts(array(
		'inverse'=>0,
		'exclude'=>'',
		'category'=>'',
	), $atts));	
   $str=van_category_filter($inverse,$exclude,$category,'category',false);
   return $str;
}

/*[one_half][/one_half]*/
add_shortcode('one_half', 'van_one_half_shortcode');
function van_one_half_shortcode($atts, $content) {
   $str='<div class="column one_half">'.van_shortcode($content).'</div>';
   return $str;
}
/*[one_half_last][/one_half_last]*/
add_shortcode('one_half_last', 'van_one_half_last_shortcode');
function van_one_half_last_shortcode($atts, $content) {
   $str='<div class="column one_half last">'.van_shortcode($content).'</div>
         <div class="clearfix"></div>';
   return $str;
}

/*[one_third][/one_third]*/
add_shortcode('one_third', 'van_one_third_shortcode');
function van_one_third_shortcode($atts, $content) {
   $str='<div class="column one_third">'.van_shortcode($content).'</div>';
   return $str;
}
/*[one_third_last][/one_third_last]*/
add_shortcode('one_third_last', 'van_one_third_last_shortcode');
function van_one_third_last_shortcode($atts, $content) {
   $str='<div class="column one_third last">'.van_shortcode($content).'</div>
         <div class="clearfix"></div>';
   return $str;
}

/*[two_third][/two_third]*/
add_shortcode('two_third', 'van_two_third_shortcode');
function van_two_third_shortcode($atts, $content) {
   $str='<div class="column two_third">'.van_shortcode($content).'</div>';
   return $str;
}
/*[two_third_last][/two_third_last]*/
add_shortcode('two_third_last', 'van_two_third_last_shortcode');
function van_two_third_last_shortcode($atts, $content) {
   $str='<div class="column two_third last">'.van_shortcode($content).'</div>
        <div class="clearfix"></div>';
   return $str;
}

/*[one_fourth][/one_fourth]*/
add_shortcode('one_fourth', 'van_one_fourth_shortcode');
function van_one_fourth_shortcode($atts, $content) {
   $str='<div class="column one_fourth">'.van_shortcode($content).'</div>';
   return $str;
}
/*[one_fourth_last][/one_fourth_last]*/
add_shortcode('one_fourth_last', 'van_one_fourth_last_shortcode');
function van_one_fourth_last_shortcode($atts, $content) {
   $str='<div class="column one_fourth last">'.van_shortcode($content).'</div>
         <div class="clearfix"></div>';
   return $str;
}

/*[two_fourth][/two_fourth]*/
add_shortcode('two_fourth', 'van_two_fourth_shortcode');
function van_two_fourth_shortcode($atts, $content) {
   $str='<div class="column two_fourth">'.van_shortcode($content).'</div>';
   return $str;
}
/*[two_fourth_last][/two_fourth_last]*/
add_shortcode('two_fourth_last', 'van_two_fourth_last_shortcode');
function van_two_fourth_last_shortcode($atts, $content) {
   $str='<div class="column two_fourth last">'.van_shortcode($content).'</div>
         <div class="clearfix"></div>';
   return $str;
}

/*[three_fourth][/three_fourth]*/
add_shortcode('three_fourth', 'van_three_fourth_shortcode');
function van_three_fourth_shortcode($atts, $content) {
   $str='<div class="column three_fourth">'.van_shortcode($content).'</div>';
   return $str;
}
/*[three_fourth_last][/three_fourth_last]*/
add_shortcode('three_fourth_last', 'van_three_fourth_last_shortcode');
function van_three_fourth_last_shortcode($atts, $content) {
   $str='<div class="column three_fourth last">'.van_shortcode($content).'</div>
         <div class="clearfix"></div>';
   return $str;
}

/*[format][format]*/
add_shortcode('format', 'van_format_shortcode');
function van_format_shortcode($atts, $content) {
   $str='<div class="format">'.do_shortcode($content).'</div>';
   return $str;
}

/*[dropcap][/dropcap]*/
add_shortcode('dropcap', 'van_dropcap_shortcode');
function van_dropcap_shortcode($atts, $content) {
   $str='<div class="dropcap">'.van_shortcode($content).'</div>';
   return $str;
}

/*[line]*/
add_shortcode('line', 'van_line_shortcode');
function van_line_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'color'=>'#000'
	), $atts));
   $str='<div class="line" style="border-color:'.$color.';"></div>';
   return $str;
}

/*[clear]*/
add_shortcode('clear', 'van_clear_shortcode');
function van_clear_shortcode($atts, $content) {
   $str='<div class="clearfix"></div>';
   return $str;
}

/*[toggle title=''][/toggle]*/
add_shortcode('toggle', 'van_toggle_shortcode');
function van_toggle_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'title'=>'',
		'status'=>'off'
	), $atts));
   if($status=='off'){
      $class=' off';
	  $title_class=' class="off"';
   }else{
      $class='';
	  $title_class=' class="on"';
   }
   $str='<div class="toggle"">
           <div class="toggle_title"><span'.$title_class.'></span>'.$title.'</div>
           <div class="toggle_content'.$class.'">'.van_shortcode($content).'</div>
         </div>';
   return do_shortcode($str);
}

/*[tab title=""][/tab]*/
add_shortcode('tab', 'van_tab_shortcode');
function van_tab_shortcode( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    global $tab_item_array;
    $tab_item_array[] = array('title' => $title, 'content' => trim(van_shortcode($content)));
    return $tab_item_array;
}

/*[tabs][/tabs]*/
add_shortcode('tabs', 'van_tabs_shortcode');
function van_tabs_shortcode( $atts, $content = null ) {
    global $tab_item_array;
    $tab_item_array = array(); 

    $tabs_nav = '<div class="clearfix"></div>';
    $tabs_nav .= '<div class="tab_box">';
    $tabs_nav .= '<div class="tab_items"><ul>';
	$tabs_content ='<div class="tab_content">';
    do_shortcode($content);
    foreach ($tab_item_array as $tab => $tab_attr_array) {
	  $tabs_nav .= '<li><a href="javascript:void(0)">'.$tab_attr_array['title'].'</a></li>';
	  $tabs_content .= '<div class="tab">'.$tab_attr_array['content'].'</div>';
    }
    $tabs_nav .= '</ul></div>';
	$tabs_content .='</div>';
    $str = $tabs_nav . $tabs_content;
    $str .= '</div>';
    $str .= '<div class="clearfix"></div>';
    return $str;
}

/*[list style=""][/list]*/
add_shortcode('list', 'van_list_shortcode');
function van_list_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'style'=>'',
	), $atts));
   
   switch($style){
      case 'correct':
	   $class=' class="van_widget correct"';
	  break;
	  
	  case 'error':
	   $class=' class="van_widget error"';
	  break;
	  
	  case 'download':
	   $class=' class="van_widget download"';
	  break;
	  
	  case 'star':
	   $class=' class="van_widget star"';
	  break;
   }
   
   $str='<div'.$class.'>'.$content.'</div>';
   return $str;
}

/*[skills][/skills]*/
add_shortcode('skills', 'van_skills_shortcode');
function van_skills_shortcode($atts, $content) {
   $str='<div class="skills"><ul>'.van_shortcode($content).'</ul></div>';
   return $str;
}
/*[skill]*/
add_shortcode('skill', 'van_skill_shortcode');
function van_skill_shortcode($atts, $content) {
   extract(shortcode_atts(array(
		'title'=>'',
		'percent'=>'100%',
		'color'=>'#f39e3a',
		'hide_percent'=>0,
		'text'=>''
   ), $atts));
   
   $display_text='';
   
   if($hide_percent==1){
      $display_text='';
   }else{
      if($text==''){
	    $display_text=$percent;
	  }else{
	    $display_text=$text;
	  }
   }

   $str='<li><span style="background:'.$color.';width:'.$percent.';">'.$title.'</span><em>'.$display_text.'</em></li>';
   return $str;
}

/*[tweets]*/
add_shortcode('tweets', 'van_tweets_shortcode');
function van_tweets_shortcode($atts, $content) {
extract(shortcode_atts(array(
		'user'=>'ThemeVan',
		'number'=>'5'
   ), $atts));
   $str='<p>Twitter\'s decision to discontinue their unauthenticated v1.0 API means that this widget will stop working at some time in 2013 -- Twitter wants your only option for on-page widgets to be their own Embedded Timelines.</p>';
   return $str;
}

/*[post_list]*/
add_shortcode('post_list', 'van_post_list_shortcode');
function van_post_list_shortcode($atts, $content) {
extract(shortcode_atts(array(
		'category'=>'',
		'number'=>'5',
		'thumbnail'=>1
   ), $atts));
   
   if($thumbnail==1 || $thumbnail=="Yes"){
	   $thumbnail=1;
   }else{
	   $thumbnail=0;
   }
   
   $str=van_post_list($number,$thumbnail,$category);
   return $str;
}

/*[blog]*/
add_shortcode('blog','van_blog_shortcode');
function van_blog_shortcode($atts, $content) {
extract(shortcode_atts(array(
		'category'=>'',
		'number'=>'5',
		'thumbnail'=>0,
		'gridview'=>0,
		'css_animation'=>''
   ), $atts));
   
   if($thumbnail==1 || $thumbnail=="Yes" || $thumbnail==''){
	   $thumbnail=1;
   }else{
	   $thumbnail=0;
   }
   
   if($gridview==1 || $gridview=="Yes" || $gridview==''){
	   $gridview=1;
   }else{
	   $gridview=0;
   }
   
   $str=van_blog($number,$thumbnail,$gridview,$category,$css_animation);
   return $str;
}

/*[post_slider]*/
add_shortcode('post_slider', 'van_post_slider_shortcode');
function van_post_slider_shortcode($atts, $content) {
   $str=van_post_slider();
   return $str;
}

/*[tagclouds]*/
add_shortcode('tagclouds', 'van_tagclouds_shortcode');
function van_tagclouds_shortcode($atts, $content) {
extract(shortcode_atts(array(
		'category'=>'',
		'number'=>'20',
		'label'=>''
   ), $atts));
   $str=van_category_tags($category,$number,$label);
   return $str;
}

/*[comments]*/
add_shortcode('comments', 'van_comments_shortcode');
function van_comments_shortcode($atts, $content) {
extract(shortcode_atts(array(
		'number'=>'5'
   ), $atts));
   $str=van_comments($number);
   return $str;
}

/*[button]*/
add_shortcode('button', 'van_button_function');
function van_button_function($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'href' => '',
		'align' => 'left',
		'bg_color' => '#000',
		'text_color' => '#fff',
		'border_color' => 'none',
		'size' => 'small',
		'target' => '_self',
		'text' =>'Button',
		'color' => '',
		'anchor' => 0,
		'lightbox' => 0
	), $atts));
	
	if(!empty($color) && $bg_color=='')
	{
		switch(strtolower($color))
		{
			case 'black':
				$bg_color = '#000000';
				$text_color = '#ffffff';
			break;
			case 'grey':
				$bg_color = '#666666';
				$text_color = '#ffffff';
			break;
			case 'white':
				$bg_color = '#f5f5f5';
				$text_color = '#444444';
			break;
			case 'blue':
				$bg_color = '#004a80';
				$text_color = '#ffffff';
			break;
			case 'yellow':
				$bg_color = '#f9b601';
				$text_color = '#ffffff';
			break;
			case 'red':
				$bg_color = '#9e0b0f';
				$text_color = '#ffffff';
			break;
			case 'orange':
				$bg_color = '#fe7201';
				$text_color = '#ffffff';
			break;
			case 'green':
				$bg_color = '#7aad34';
				$text_color = '#ffffff';
			break;
			case 'pink':
				$bg_color = '#d2027d';
				$text_color = '#ffffff';
			break;
			case 'purple':
				$bg_color = '#582280';
				$text_color = '#ffffff';
			break;
		}
	}
	
	if(!empty($size))
	{
		switch(strtolower($size))
		{
			case 'small':
				$btn_size = 'van_small_btn';
			break;
			case 'large':
				$btn_size = 'van_large_btn';
			break;
			case 'large-x':
				$btn_size = 'van_largex_btn';
			break;
		}
	}
	
	$center='';
	if($align=='center'){
	  $align='none';
	  $center='margin:auto;';
	}
	$class='';
	if($anchor==1){
	  $class=' anchor';
	}
	$lightbox_class='';
	if($lightbox==1){
	  $lightbox_class=' lightbox';
	}
	
	$str = '<a href="'.$href.'" class="'.$btn_size.$class.$lightbox_class.'" style="float:'.$align.';'.$center.'background:'.$bg_color.';color:'.$text_color.';border:1px solid '.$border_color.'" target="'.$target.'">'.__($text).'</a>';
	return $str;
}

/*[slider]*/
add_shortcode('slider', 'van_slider_shortcode');
function van_slider_shortcode($atts, $content) {
   $str='<div class="flexslider sk_flexslider">
            <ul class="slides maxHeight">'.van_shortcode($content).'</ul>
	     </div>';
   return $str;
}
/*[slide]*/
add_shortcode('slide', 'van_slide_shortcode');
function van_slide_shortcode($atts, $content) {
   //extract short code attr
   extract(shortcode_atts(array(
		'src' => '',
		'alt' => '',
		'youtube' =>'',
		'vimeo' =>'',
		'href' => '',
		'target'=>'_self',
		'height'=>'450px'
	), $atts));
	
   if($src<>''){	
       if($href==''){
         $str='<li><img src="'.$src.'" alt="'.$alt.'" /></li>';
	   }else{
	     $str='<li><a href="'.$href.'" title="'.$alt.'" target="'.$target.'"><img src="'.$src.'" alt="'.$alt.'" /></a></li>';
	   }
   }else{
	   if($youtube<>''){
		 $youtube_arr=explode('v=',$youtube);
		 $str='<li><iframe width="100%" height="'.$height.'" src="http://www.youtube.com/embed/'.$youtube_arr[1].'" frameborder="0" allowfullscreen></iframe></li>';
	   }
	   if($vimeo<>''){
		 $vimeo_arr=explode('vimeo.com/',$vimeo);
		 $str='<li><iframe src="http://player.vimeo.com/video/'.$vimeo_arr[1].'" width="100%" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></li>';
	   }
   }
   return $str;
}

/*[headline]*/
add_shortcode('headline', 'van_headline_shortcode');
function van_headline_shortcode($atts, $content) {
	 //extract short code attr
   extract(shortcode_atts(array(
		'title' => '<strong>HeadLine</strong> Example',
		'desc' => 'You can expatiate on the section further',
		'top'=>'',
		'bottom'=>'',
		'css_animation' =>''
		
	), $atts));
	$space='';
    if($top<>'' || $bottom<>''){
	  $space=' style="margin:'.$top.' auto '.$bottom.'"';
	}
   $str='<hgroup class="title"'.$space.custom_css_animation($css_animation).'>
              <h2>'.$title.'</h2>
              <p>'.$desc.'</p>           
	     </hgroup>';
   return $str;
}

/*[center]*/
add_shortcode('center', 'van_center_shortcode');
function van_center_shortcode($atts, $content) {
	 //extract short code attr
   extract(shortcode_atts(array(
		'width' => '100%',
		'top'=>'0',
		'bottom'=>'0'
	), $atts));
   $style=' style="width:'.$width.';margin:'.$top.' auto '.$bottom.'"';
   $str='<div'.$style.' class="centerWrapper">'.van_shortcode($content).'</div>';
   return $str;
}

/*[social_icon]*/
add_shortcode('social_icon', 'van_social_icon_shortcode');
function van_social_icon_shortcode($atts, $content) {
	 //extract short code attr
   extract(shortcode_atts(array(
		'facebook'=>'',
		'twitter'=>'',
		'dribbble'=>'',
		'flickr'=>'',
		'googleplus'=>'',
		'linkedin'=>'',
		'soundcloud'=>'',
		'hearthis'=>'',
		'blogger'=>'',
		'tumblr'=>'',
		'deviantart'=>'',
		'behance'=>'',
		'pinterest'=>'',
		'youtube'=>'',
		'vimeo'=>'',
		'myspace'=>'',
		'myemail'=>'',
		'yahooim'=>'',
		'aim'=>'',
		'instagram'=>'',
		'meetup'=>'',
		'fivehundreds'=>'',
		'xing'=>'',
		'klout'=>'',
		'vk'=>'',
		'yelp'=>'',
		'rss'=>''
	), $atts));
   $str='<div class="social-icons-new">';
	   if($facebook<>''){
	   $str.='<a href="'.esc_attr($facebook).'" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a>';
	   }
	   if($twitter<>''){
	   $str.='<a href="'.esc_attr($twitter).'" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a>';
	   }
	   if($dribbble<>'') {
	   $str.='<a href="'.esc_attr($dribbble).'" class="dribbble" target="_blank"><i class="fa fa-dribbble"></i></a>';
	   }
	   if($flickr<>'') {
	   $str.='<a href="'.esc_attr($flickr).'" class="flickr" target="_blank"><i class="fa fa-flickr"></i></a>';
	   }
	   if($googleplus<>''){
	   $str.='<a href="'.esc_attr($googleplus).'" class="gplus" target="_blank"><i class="fa fa-google-plus"></i></a>';
	   }
	   if($linkedin<>''){
	   $str.='<a href="'.esc_attr($linkedin).'" class="linkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>';
	   }
	   if($soundcloud<>''){
	   $str.='<a href="'.esc_attr($soundcloud).'" class="soundcloud" target="_blank"><i class="fa fa-soundcloud"></i></a>';
	   }
	   if($hearthis<>''){
	   $str.='<a href="'.esc_attr($hearthis).'" class="hearthis" target="_blank"><i class="mf mf-hearthis"></i></a>';
	   }
	   if($blogger<>''){
	   $str.='<a href="'.esc_attr($blogger).'" class="blogger" target="_blank"><i class="mf mf-blogger"></i></a>';
	   }
	   if($tumblr<>''){
	   $str.='<a href="'.esc_attr($tumblr).'" class="tumblr" target="_blank"><i class="fa fa-tumblr"></i></a>';
	   }
	   if($deviantart<>''){
	   $str.='<a href="'.esc_attr($deviantart).'" class="deviantart" target="_blank"><i class="fa fa-deviantart"></i></a>';
	   }
	   if($behance<>''){
	   $str.='<a href="'.esc_attr($behance).'" class="behance" target="_blank"><i class="fa fa-behance"></i></a>';
	   }
	   if($pinterest<>''){
	   $str.='<a href="'.esc_attr($pinterest).'" class="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>';
	   }
	   if($youtube<>''){
	   $str.='<a href="'.esc_attr($youtube).'" class="youtube" target="_blank"><i class="fa fa-youtube"></i></a>';
	   }
	   if($vimeo<>''){
	   $str.='<a href="'.esc_attr($vimeo).'" class="vimeo" target="_blank"><i class="fa fa-vimeo-square"></i></a>';
	   }
	   if($myspace<>''){
	   $str.='<a href="'.esc_attr($myspace).'" class="old myspace" target="_blank"></a>';
	   }
	   if($myemail<>''){
	   $str.='<a href="'.esc_attr($myemail).'" class="myemail" target="_blank"><i class="fa fa-envelope"></i></a>';
	   }
	   if($yahooim<>''){
	   $str.='<a href="'.esc_attr($yahooim).'" class="yahooim" target="_blank"><i class="fa fa-yahoo"></i></a>';
	   }
	   if($aim<>''){
	   $str.='<a href="'.esc_attr($aim).'" class="old aim" target="_blank"></a>';
	   }
	   if($instagram<>''){
	   $str.='<a href="'.esc_attr($instagram).'" class="instagram" target="_blank"><i class="fa fa-instagram"></i></a>';
	   }
	   if($fivehundreds<>''){
	   $str.='<a href="'.esc_attr($fivehundreds).'" class="icon_500px" target="_blank"><i class="fa fa-500px"></i></a>';
	   }
	   if($meetup<>''){
	   $str.='<a href="'.esc_attr($meetup).'" class="old meetup" target="_blank"></a>';
	   }
	   if($xing<>''){
	   $str.='<a href="'.esc_attr($xing).'" class="xing" target="_blank"><i class="fa fa-xing"></i></a>';
	   }
	   if($klout<>''){
	   $str.='<a href="'.esc_attr($klout).'" class="old klout" target="_blank"></a>';
	   }
	   if($vk<>''){
	   $str.='<a href="'.esc_attr($vk).'" class="vk" target="_blank"><i class="fa fa-vk"></i></a>';
	   }
	   if($yelp<>''){
	   $str.='<a href="'.esc_attr($yelp).'" class="yelp" target="_blank"><i class="fa fa-yelp"></i></a>';
	   }
	   if($rss<>''){
	   $str.='<a href="'.esc_attr($rss).'" class="feed" target="_blank"><i class="fa fa-rss"></i></a>';
	   }
   $str.='</div>';
   return $str;
}
?>