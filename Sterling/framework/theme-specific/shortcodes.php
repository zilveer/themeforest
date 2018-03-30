<?php
/*--------------------------------------*/
/*	Remove leftover tags from shortcode parser.
/*--------------------------------------*/
add_filter( 'the_content', 'tt_shortcode_fix' );
function tt_shortcode_fix( $content ) {

	/** Find all instances of empty paragraph and line break tags */
	$array = array(
		'<p>[' 		=> '[', 
		']</p>' 	=> ']', 
		']<br />' 	=> ']'
	);
	
	/** Replace empty references with corrections */
	$content = strtr( $content, $array );
	
	return $content;
	
}

/*--------------------------------------*/
/*	Format [raw] tags for legacy support.
/*--------------------------------------*/
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
add_filter( 'the_content', 'my_formatter', 99 );
add_filter( 'widget_text', 'my_formatter', 99 );
function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}



/*--------------------------------------*/
/*	Accordions
/*--------------------------------------*/
function truethemes_accordion_wrap( $atts, $content = null ) {
   return '[raw]<dl class="accordion">[/raw]' . do_shortcode($content) . '[raw]</dl>[/raw]';
}
add_shortcode('accordion_set', 'truethemes_accordion_wrap');



function truethemes_accordion_content($atts, $content = null) {
  extract(shortcode_atts(array(
  'title' => '',
  'active' => '',
  ), $atts));
  
  if ($active == 'yes'){
  	$output = '[raw]<dt class="current">'.$title.'</dt><dd class="current">[/raw]' . do_shortcode(wpautop($content)) . '[raw]</dd>[/raw]';
  } else{
	$output = '[raw]<dt>'.$title.'</dt><dd>[/raw]' . do_shortcode(wpautop($content)) . '[raw]</dd>[/raw]';
  }
  
  return $output;
}
add_shortcode('accordion', 'truethemes_accordion_content');



/*--------------------------------------*/
/*	Buttons
/*--------------------------------------*/
function truethemes_button($atts, $content = null) {
  extract(shortcode_atts(array(
  'size' => '',
  'color' => '',
  'url' => '',
  'target' => '',
	'lightbox_content' => '',
	'lightbox_description' => '',
  ), $atts));
  
	if(!empty($lightbox_content)) {
		$output = '<a href="'.esc_url( $lightbox_content ).'" class="'.sanitize_html_class( $size ).' '.sanitize_html_class( $color ).' tt-button" data-gal="prettyPhoto" title="'.esc_attr( $lightbox_description ).'">' .do_shortcode($content). '</a>';
		
	} else {
		
  $output = '<a href="'.esc_url( $url ).'" class="'.sanitize_html_class( $size ).' '.sanitize_html_class( $color ).' tt-button" target="'.esc_attr( $target ).'">' .do_shortcode($content). '</a>';
	
	};
	
  return $output;
}
add_shortcode('button', 'truethemes_button');



/*--------------------------------------*/
/*	Blog Posts
/*--------------------------------------*/
function truethemes_blog_posts($atts, $content=null) {
extract(shortcode_atts(array(
'title'   => '',
'count'   => '3',
'character_count'   => '115',
'post_category'   => '',
), $atts));

$title = $title;
$count = $count;
$truethemes_count = 0; $truethemes_col = 0;



global $post;
$exclude = B_getExcludedCats();

if ($post_category != ''){
//mod by denzel to use WP_Query class instead of get_posts, so that WPML works.
$myposts = new WP_Query('posts_per_page='.$count.'&offset=0&category_name='.$post_category.'');
}else{
$myposts = new WP_Query('posts_per_page='.$count.'&offset=0&category='.$exclude);
}


if ($title != '') {$output .= '[raw]<span class="section_title">'.$title.'</span>[/raw]';};

if ( $myposts->have_posts() ) : while ( $myposts->have_posts() ) : $myposts->the_post();

		$permalink = get_permalink($post->ID);
	
		
		//remove <!--nextpage--> and show only first page content
		$post_content = explode('<!--nextpage-->',$post->post_content);
		$post_content = (string)$post_content[0];
		$post_content = substr(strip_tags($post_content),0,$character_count);
		$post_content = rtrim($post_content); //remove space from end of string
		$post_content = str_replace("<br>","",$post_content);

    //remove all shortcodes from post content.
		$post_content = strip_shortcodes($post_content);		
		
		
		$output .= '<div class="article_preview">';
		$output .= '<strong><a href="'.esc_url( $permalink ).'">'.get_the_title().'</a></strong>';
		$output .= '<p>'.$post_content.'...</p>';
		$output .= '</div>';
		
endwhile; endif;	
wp_reset_postdata();
return $output;
}
add_shortcode('blog_posts', 'truethemes_blog_posts');



/*--------------------------------------*/
/*	Columns
/*--------------------------------------*/
// 6
function truethemes_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'truethemes_one_sixth');


// 5
function truethemes_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'truethemes_one_fifth');


// 4
function truethemes_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'truethemes_one_fourth');


// 3
function truethemes_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'truethemes_one_third');


// 2
function truethemes_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'truethemes_one_half');


// 2/3
function truethemes_two_thirds( $atts, $content = null ) {
   return '<div class="two_thirds">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_thirds', 'truethemes_two_thirds');


// divider
function truethemes_column_break( $atts, $content = null ) {
   return '<div class="column-clear">&nbsp;</div>';
}
add_shortcode('column_break', 'truethemes_column_break');



/*--------------------------------------*/
/*	Content Boxes
/*--------------------------------------*/
function v_truethemes_contentbox($atts, $content = null) {
  extract(shortcode_atts(array(
  'style' => '',
  'title' => '',
  ), $atts));
  
	$output = '<div class="tt-contentbox"><div class="tt-contentbox-title tt-cb-title-'.sanitize_html_class( $style ).'"><span>'.$title.'</span></div><div class="tt-contentbox-content tt-content-style-'.sanitize_html_class( $style ).'">' .do_shortcode($content). '</div></div>';
  
  return $output;
}
add_shortcode('content_box', 'v_truethemes_contentbox');



/*--------------------------------------*/
/*	Dividers
/*--------------------------------------*/
function truethemes_dividers($atts, $content = null) {
  extract(shortcode_atts(array(
  'style' => '',
  ), $atts));
  
  $output = '<div class="hr '.sanitize_html_class( $style ).'">&nbsp;</div>';
  return $output;
}
add_shortcode('divider', 'truethemes_dividers');



/*--------------------------------------*/
/*	Dropcaps
/*--------------------------------------*/
function truethemes_dropcaps( $atts, $content = null ) {
   extract(shortcode_atts(array(
  'style' => '',
  'color' => '',
  ), $atts));
  
  $output = '<span class="tt-dropcap-'.sanitize_html_class( $color ).'"><span class="tt-dropcap-'.sanitize_html_class( $style ).'">' .do_shortcode($content). '</span></span>';
  return $output;
}
add_shortcode('dropcap', 'truethemes_dropcaps');



/*--------------------------------------*/
/*	Email Encoder
/*--------------------------------------*/
function v_truethemes_mailto( $atts , $content=null ) {

    for ($i = 0; $i < strlen($content); $i++) $encodedmail .= "&#" . ord($content[$i]) . ';';

  return '<a href="mailto:'.$encodedmail.'">'.$encodedmail.'</a>';

}
add_shortcode('mailto', 'v_truethemes_mailto');




/*-----------------------------------*/
// Font Awesome
/*-----------------------------------*/
function truethemes_font_awesome($atts, $content = null) {
  extract(shortcode_atts(array(  
  'icon'     => '',
  'size'     => '',
  'border'   => 'false',
  'lightbox_content' => '',
  'lightbox_description' => '',
  'pull'     => '',
  'color'    => '',
  'target'   => '',
  'url'      => ''
  ), $atts));

  
  if(!empty($lightbox_content)){
    $output = '<a href="'.$lightbox_content.'" data-gal="prettyPhoto" title="'.$lightbox_description.'"><i class="fa '.$icon;
  } elseif(!empty($url)){
    $output = '<a href="'.$url.'" target="'.$target.'"><i class="fa '.$icon;
  } else {
    $output = '<i class="fa '.$icon;
  }
  
  if('' != $size):
      $output .= ' '.$size;
  endif;
  
  if('true' == $border):
      $output .= ' fa-border';
  endif;
  
  if('' != $pull):
      $output .= ' '.$pull;
  endif; 
  
  if('' != $color):
      $output .= '" style="color:'.$color.' !important;';
    endif;


  if(!empty($lightbox_content)){
    $output .= '"></i></a>';
  } elseif(!empty($url)){
    $output .= '"></i></a>';
  } else {
    $output .= '"></i>';
  }

  
  return $output;
}
add_shortcode('tt_vector', 'truethemes_font_awesome');



/*-----------------------------------*/
// Font Awesome - Icon Box
/*-----------------------------------*/
function truethemes_font_awesome_box($atts, $content = null) {
  extract(shortcode_atts(array(  
  'icon'                 => '',
  'size'                 => 'fa-4x',
  'color'                => '',
  'lightbox_content'     => '',
  'lightbox_description' => '',
  'url'                  => '',
  'target'               => '_self',
  'description'          => ''
  ), $atts));


  if(!empty($lightbox_content)){
    $output = '<a href="'.$lightbox_content.'" data-gal="prettyPhoto" title="'.$lightbox_description.'" class="tt-icon-box">';
  } elseif(!empty($url)){
    $output = '<a href="'.$url.'" target="'.$target.'" class="tt-icon-box">';
  } else {
    $output = '<div class="tt-icon-box">';
  } 

    
  $output .= '<span class="fa-stack '.$size.'"><i class="fa fa-circle fa-stack-2x"';
        
  if('' != $color):
    $output .= ' style="color:'.$color.';"';
    endif;
  
    $output .= '></i><i class="fa '.$icon.' fa-stack-1x fa-inverse"></i></span>';
    $output .= do_shortcode(wpautop($content));


  if(!empty($lightbox_content)){
    $output .= '</a>';
  } elseif(!empty($url)){
    $output .= '</a>';
  } else {
    $output .= '</div>'; 
  }
  
  $final_content = "[raw]".$output."[/raw]";
  return $final_content;
}
add_shortcode('tt_vector_box', 'truethemes_font_awesome_box');



/*--------------------------------------*/
/*	Highlight Text
/*--------------------------------------*/
function v_truethemes_highlight($atts, $content = null) {
  extract(shortcode_atts(array(
  'style' => '',
  'color' => '',
  ), $atts));
  
	$output = '<span class="tt-highlight highlight-'.sanitize_html_class( $color ).'"><span class="highlight-'.sanitize_html_class( $style ).'">' .do_shortcode($content). '</span></span>';
  
  return $output;
}
add_shortcode('highlight', 'v_truethemes_highlight');



/*--------------------------------------*/
/*	Icons
/*--------------------------------------*/
function truethemesicons($atts, $content = null) {
  extract(shortcode_atts(array(
  'url' => '',
  'style' => '',
  'target' => '',
	'lightbox_content' => '',
	'lightbox_description' => '',
  ), $atts));
  
  if(!empty($url)){
  	$output = '<a href="'.esc_url( $url ).'" class="tt-icon-link tt-icon '.sanitize_html_class( $style ).'" target="'.esc_attr( $target ).'">' .do_shortcode($content). '</a>';
  }
	
	if(empty($url)){
  	$output = '<p class="tt-icon '.sanitize_html_class( $style ).'">' .do_shortcode($content). '</p>';
  }
	
	if(!empty($lightbox_content)){
  	$output = '<a href="'.esc_url( $lightbox_content ).'" class="tt-icon-link tt-icon '.sanitize_html_class( $style ).'" data-gal="prettyPhoto" title="'.esc_attr( $lightbox_description ).'">' .do_shortcode($content). '</a>';
  }	
  
  return $output;
}
add_shortcode('icon', 'truethemesicons');



/*--------------------------------------*/
/*	Icons - Minimal
/*--------------------------------------*/
function truethemesicons_minimal($atts, $content = null) {
  extract(shortcode_atts(array(
  'url' => '',
  'style' => '',
  'heading' => '',
  'target' => '',
	'lightbox_content' => '',
	'lightbox_description' => '',
  ), $atts));
  
  if(!empty($url)){
  	$output = '<a href="'.esc_url( $url ).'" class="tt-mono-icon mono-'.sanitize_html_class( $style ).'" target="'.esc_attr( $target ).'">' .do_shortcode($content). '</a>';
  }
	
	if(empty($url)){
  	$output = '<p class="tt-mono-icon mono-'.sanitize_html_class( $style ).'">' .do_shortcode($content). '</p>';
  }
	
	if(!empty($lightbox_content)){
  	$output = '<a href="'.esc_url( $lightbox_content ).'" class="tt-mono-icon mono-'.sanitize_html_class( $style ).'" data-gal="prettyPhoto" title="'.esc_attr( $lightbox_description ).'">' .do_shortcode($content). '</a>';
  }	
  
  return $output;
}
add_shortcode('minimal_icon', 'truethemesicons_minimal');



/*--------------------------------------*/
/*	Notification Boxes
/*--------------------------------------*/
function truethemes_notification($atts, $content = null) {
  extract(shortcode_atts(array(
  'style' => '',
  'font_size' => '13px',
  'closeable' => '',
  ), $atts));
  
  
  if ($closeable == 'true'){
  	$output = '<div class="tt-notification '.sanitize_html_class( $style ).' closeable"><div class="closeable-x"><p style="font-size:'.$font_size.';">' .do_shortcode($content). '</p></div></div>';
  } else{
	$output = '<div class="tt-notification '.$style.'"><p style="font-size:'.$font_size.';">' .do_shortcode($content). '</p></div>';
  }
  
  return $output;
}
add_shortcode('notification', 'truethemes_notification');



/*--------------------------------------*/
/*	Pricing Boxes
/*--------------------------------------*/

//styles: true-vision-pricing-style-1, true-vision-pricing-style-2

function vision_truethemes_pricing_box($atts, $content = null) {
  extract(shortcode_atts(array(
  'style' => '',
  'color' => '',
  'plan' => '',
  'currency' => '',
  'price' => '',
  'term' => '',
  'button_label' => '',
  'button_size' => '',
  'button_color' => '',
  'button_url' => '',
  'button_target' => '',
  ), $atts));
	
	if ($style == 'style-1'){
	$output = '<div class="true-vision-pricing-column true-vision-pricing-'.$style.'"><div class="true-vision-pricing-top tt-cb-title-'.$color.'">
	<h2>'.$plan.'</h2>
	<h1><sup>'.$currency.'</sup>'.$price.'</h1>
	<p>'.$term.'</p>
	</div>' 
	.do_shortcode($content). '<hr />
	<a href="'.esc_url( $button_url ).'" class="'.sanitize_html_class( $button_size ).' '.sanitize_html_class( $button_color ).' tt-button" target="'.esc_attr( $button_target ).'">' .$button_label. '</a>
	</div>';
	}
	
	if ($style == 'style-2'){
	$output = '<div class="true-vision-pricing-column true-vision-pricing-'.$style.'"><div class="true-vision-pricing-top tt-cb-title-'.$color.'">
	<h2>'.$plan.'</h2>
	</div>' 
	.do_shortcode($content). '<hr /><h1><sup>'.$currency.'</sup>'.$price.'</h1>
	<p>'.$term.'</p>
	<a href="'.esc_url( $button_url ).'" class="'.sanitize_html_class( $button_size ).' '.sanitize_html_class( $button_color ).' tt-button" target="'.esc_attr( $button_target ).'">' .$button_label. '</a>
	</div>';
	}
	
  
  return $output;
}
add_shortcode('vision_pricing_box', 'vision_truethemes_pricing_box');



/*--------------------------------------*/
/*	Tabs
/*--------------------------------------*/
function truethemes_tabs_wrap($atts, $content = null) {
  extract(shortcode_atts(array(
  'style' => '',
  ), $atts));
  
  if ($style == 'vertical'){
  	$output = '[raw]<dl class="tabs_type_1">[/raw]' .do_shortcode($content). '[raw]</dl>[/raw]';
  } else{
	$output = '[raw]<dl class="tabs_type_2">[/raw]' .do_shortcode($content). '[raw]</dl>[/raw]';  
  }
  
  return $output;
}
add_shortcode('tabset', 'truethemes_tabs_wrap');



function truethemes_tabs_content($atts, $content = null) {
  extract(shortcode_atts(array(
  'title' => '',
  'active' => '',
  ), $atts));

	if($_GET && isset($_GET['tab'])){
	/*
	Added Oct 22 2012. This makes the tabs linkable, meaning that links can be set that display a specific tab on the page regardless of the active tab on the post.
	*/
		$active = 'no';
		if($_GET['tab'] == $title){
			$active = 'yes';
		}
	}
  
  if ($active == 'yes'){
  	$output = '[raw]<dt class="current">'.$title.'</dt><dd class="current">[/raw]' . do_shortcode($content) . '[raw]</dd>[/raw]';
  } else{
	$output = '[raw]<dt>'.$title.'</dt><dd>[/raw]' . do_shortcode($content) . '[raw]</dd>[/raw]';
  }
  
  return $output;
}
add_shortcode('tab', 'truethemes_tabs_content');



/*--------------------------------------*/
/*	Testimonials
/*--------------------------------------*/
function truethemes_testimonial_wrap( $atts, $content = null ) {
   return '<div class="testimonials">' . do_shortcode($content) . '</div>';
}
add_shortcode('testimonial_set', 'truethemes_testimonial_wrap');



function truethemes_testimonial_content($atts, $content = null) {
  extract(shortcode_atts(array(
  'client' => '',
  ), $atts));
  

	$output = '[raw]<div class="testimonial"><blockquote>'.do_shortcode($content).'</blockquote><br/><strong class="client_identity">'.$client.'</strong></div>[/raw]';
  
  return $output;
}
add_shortcode('testimonial', 'truethemes_testimonial_content');



/*--------------------------------------*/
/*	Text Styles
/*--------------------------------------*/
function truethemes_text($atts, $content = null) {
  extract(shortcode_atts(array(
  'style' => ''
  ), $atts));
  
  $output = '<div class="'.$style.'"><p>' .do_shortcode($content). '</p></div>';
  return $output;
}
add_shortcode('text', 'truethemes_text');




/*--------------------------------------*/
/*	Team Members
/*--------------------------------------*/
function truethemes_members($atts, $content = null) {
 extract(shortcode_atts(array(
 'name' => '',
 'title' => '',
	'photo' => '',
	'email' => '',
	'phone' => '',
	'twitter' => '',
	'facebook' => '',
	'google' => '',
	'email_label' => '',
	'linkedin' => ''
 ), $atts));

//@since 2.1.2 convert email address to ascii
for ($i = 0; $i < strlen($email); $i++) $encodedmail .= "&#" . ord($email[$i]) . ';';

//@since 2.1.4 check for custom email label
if ($email_label != '') {
	$team_email_output = $email_label;
		}else{
			$team_email_output = $encodedmail;
		}

 $output = '<div class="member-wrap clearfix"><div class="member-contact"><p class="member-name">'.$name.'</p><p class="member-title">'.$title.'</p><ul class="member-list">';
	
	if ($email != ''){
	$output .= '<li><a href="mailto:'.$encodedmail.'" class="member-contact-email">'.$team_email_output.'</a></li>';
	}
	
	if ($phone != ''){
	$output .= '<li class="member-contact-phone">'.$phone.'</li>';
	}
	
	if ($twitter != ''){
	$output .= '<li><a href="http://www.twitter.com/'.$twitter.'" class="member-contact-twitter">@'.$twitter.'</a></li>';
	}
	
	if ($facebook != ''){
	$output .= '<li><a href="'.esc_url( $facebook ).'" class="member-contact-facebook">Facebook</a></li>';
	}
	
	if ($google != ''){
	$output .= '<li><a href="'.esc_url( $google ).'" class="member-contact-google">Google +</a></li>';
	}
	
	if ($linkedin != ''){
	$output .= '<li><a href="'.esc_url( $linkedin ).'" class="member-contact-linkedin">Linkedin</a></li>';
	}
	
	$output .= '</ul></div><div class="member-bio">'. do_shortcode($content) .'</div><div class="member-photo img-frame member-frame"><img src="'.$photo.'" /></div></div>';
	
	
 return $output;
}
add_shortcode('team_member', 'truethemes_members');





/*--------------------------------------*/
/*	Link Styles
/*--------------------------------------*/
function truethemes_pagination_links($atts, $content = null) {
  
  $output = '<div class="tour-pagination-links clearfix">' .do_shortcode($content). '</div>';
  return $output;
}
add_shortcode('pagination_links', 'truethemes_pagination_links');



function truethemes_pagination_next($atts, $content = null) {
  extract(shortcode_atts(array(
  'url' => '',
	'link_text' => ''
  ), $atts));
  
  $output = '<a href="'.esc_url( $url ).'" class="tour-pagination-next">'.$link_text.'</a>';
  return $output;
}
add_shortcode('next', 'truethemes_pagination_next');


function truethemes_pagination_previous($atts, $content = null) {
  extract(shortcode_atts(array(
  'url' => '',
	'link_text' => ''
  ), $atts));
  
  $output = '<a href="'.esc_url( $url ).'" class="tour-pagination-previous">'.$link_text.'</a>';
  return $output;
}
add_shortcode('previous', 'truethemes_pagination_previous');



/*--------------------------------------*/
/*	Homepage - Marketing Content Layout
/*--------------------------------------*/
function truethemes_home_marketing_content( $atts, $content = null ) {
   return '[raw]<section id="home-marketing-content">[/raw]' . do_shortcode($content) . '[raw]</section>[/raw]';
}
add_shortcode('home_marketing_content', 'truethemes_home_marketing_content');


function truethemes_home_marketing_icons( $atts, $content = null ) {
   return '[raw]<aside id="home-marketing-icons">[/raw]' . do_shortcode($content) . '[raw]</aside>[/raw]';
}
add_shortcode('home_marketing_icons', 'truethemes_home_marketing_icons');


function truethemes_home_marketing_blog_posts( $atts, $content = null ) {
   return '[raw]<section id="home-marketing-blogposts">[/raw]' . do_shortcode($content) . '[raw]</section>[/raw]';
}
add_shortcode('home_marketing_blog_posts', 'truethemes_home_marketing_blog_posts');


function truethemes_home_marketing_testimonials($atts, $content = null) {
  extract(shortcode_atts(array(
  'title' => '',
  ), $atts));

	$output = '[raw]<aside id="home-marketing-testimonials"><span class="section_title">'.$title.'</span>[/raw]' . do_shortcode($content) . '[raw]</aside>[/raw]';
  return $output;
}
add_shortcode('home_marketing_testimonials', 'truethemes_home_marketing_testimonials');



/*--------------------------------------*/
/*	Homepage Vertical Layout
/*--------------------------------------*/

// main callout text
function truethemes_jquery_callout( $atts, $content = null ) {
   return '<h2 class="wide">' . do_shortcode($content) . '</h2>';
} add_shortcode('home_callout_text', 'truethemes_jquery_callout');



// vertical callout items (wrapper)
function truethemes_vertical_item( $atts, $content = null ) {
   return '<div class="home-vertical-callout clearfix">' . do_shortcode($content) . '</div>';
} add_shortcode('home_vertical_item', 'truethemes_vertical_item');



// vertical content
function truethemes_vertical_content( $atts, $content = null ) {
   return '<div class="home-vertical-content">' . do_shortcode($content) . '</div>';
} add_shortcode('home_vertical_content', 'truethemes_vertical_content');




/*--------------------------------------*/
/*	Image Frame Constructor
/*--------------------------------------*/
function truethemes_image_frame_constructor($image_path,$width,$height,$size,$link_to_page,$target,$description){

//Allow plugins/themes to override this layout.
//refer to http://codex.wordpress.org/Function_Reference/add_filter for usage
$output = apply_filters('truethemes_image_frame_filter','',$image_path,$width,$height,$size,$link_to_page,$target,$description);
if ( $output != '' ){
		return $output;
}


$image_src = truethemes_crop_image($thumb=null,$image_path,$width,$height); //see above

//output the shortcode HTML
	
$output .= '<div class="img-frame '.sanitize_html_class( $size ).'">';

//if there is a link url we display it.
if(!empty($link_to_page)){

	$output.='<a href="'.esc_url( $link_to_page ).'" target="'.esc_attr( $target ).'">';

}

$output .= '<img src="' . esc_url( $image_src ) . '" alt="' . esc_attr( $description ) . '" width="' . $width . '" height="' . $height . '"/>';

//if there is a link url we display it.
if(!empty($link_to_page)){
	$output.='</a>';
}

$output.='</div>';

return $output;

}



/*--------------------------------------*/
/*	Image Frame Output
/*--------------------------------------*/

function truethemes_image_frame($atts, $content = null) {
  extract(shortcode_atts(array(
  'image_path' => '',
  'link_to_page' => '',
  'target' => '',
  'description' => '',
  'size' => '',
  ), $atts));

 $image_path = esc_url( $image_path );
 
 $output = null;
 
if ($size == 'full-banner'){
$output .= truethemes_image_frame_constructor($image_path,940,161,$size,$link_to_page,$target,$description);
}


if ($size == 'small-banner'){
$output .= truethemes_image_frame_constructor($image_path,650,169,$size,$link_to_page,$target,$description);
}


if ($size == 'full-third-portrait'){
$output .= truethemes_image_frame_constructor($image_path,280,354,$size,$link_to_page,$target,$description);
}


if ($size == 'full-fourth-portrait'){
$output .= truethemes_image_frame_constructor($image_path,183,276,$size,$link_to_page,$target,$description);
}


if ($size == 'full-half'){
$output .= truethemes_image_frame_constructor($image_path,445,273,$size,$link_to_page,$target,$description);
}
 

if ($size == 'full-third'){
$output .= truethemes_image_frame_constructor($image_path,280,179,$size,$link_to_page,$target,$description);
}

if ($size == 'full-third-short'){
$output .= truethemes_image_frame_constructor($image_path,280,124,$size,$link_to_page,$target,$description);
}


if ($size == 'full-fourth'){
$output .= truethemes_image_frame_constructor($image_path,197,133,$size,$link_to_page,$target,$description);
}


if ($size == 'small-half'){
$output .= truethemes_image_frame_constructor($image_path,300,186,$size,$link_to_page,$target,$description);
}
 

if ($size == 'small-third'){
$output .= truethemes_image_frame_constructor($image_path,183,120,$size,$link_to_page,$target,$description);
}


if ($size == 'small-fourth'){
$output .= truethemes_image_frame_constructor($image_path,125,89,$size,$link_to_page,$target,$description);
}



  return $output;
}
add_shortcode('image_frame', 'truethemes_image_frame');



/*--------------------------------------*/
/*	Lightbox Constructor
/*--------------------------------------*/
function truethemes_lightbox_constructor($image_path,$lightbox_content,$description,$size,$group,$width,$height){

//Allow plugins/themes to override this layout.
//refer to http://codex.wordpress.org/Function_Reference/add_filter for usage
$output = apply_filters('truethemes_lightbox_filter','',$image_path,$lightbox_content,$description,$size,$group,$width,$height);
if ( $output != '' ){
		return $output;
}

$image_src = truethemes_crop_image($thumb=null,$image_path,$width,$height); //see above


//determine whether single image or group.

if($group != ''){
$pretty_photo_group = "prettyPhoto[{$group}]";
}else{
$pretty_photo_group = "prettyPhoto";
}


//output the shortcode HTML
	
$output .= '<div class="img-frame '.$size.'">';

$output .= '<div class="lightbox-zoom">';

$output .= '<a title="' . esc_attr( $description ) . '" href="' . esc_url( $lightbox_content ) . '" data-gal="' . $pretty_photo_group . '" class="hover-item">';

$output .= '<img width="' . $width . '" height="' . $height . '" alt="' . esc_attr( $description ) . '" src="' . esc_url( $image_src ) . '">';

$output .= "</a>";

$output .= '</div>';

$output .='</div>';

return $output;

}



/*--------------------------------------*/
/*	Lightbox Output
/*--------------------------------------*/

function truethemes_lightbox($atts, $content = null) {
  extract(shortcode_atts(array(
  'image_path' => '',
  'lightbox_content' => '',
  'description' => '',
  'size' => '',
  'group'=>''
  ), $atts));

  $image_path = esc_url( $image_path );
 
 $output = null;
 
if ($size == 'full-banner'){
$output .= truethemes_lightbox_constructor($image_path,$lightbox_content,$description,$size,$group,940,161);
}

if ($size == 'small-banner'){
$output .= truethemes_lightbox_constructor($image_path,$lightbox_content,$description,$size,$group,650,169);
}

if ($size == 'full-third-portrait'){
$output .= truethemes_lightbox_constructor($image_path,$lightbox_content,$description,$size,$group,280,354);
}

if ($size == 'full-fourth-portrait'){
$output .= truethemes_lightbox_constructor($image_path,$lightbox_content,$description,$size,$group,183,276);
}

if ($size == 'full-half'){
$output .= truethemes_lightbox_constructor($image_path,$lightbox_content,$description,$size,$group,445,273);
}

if ($size == 'full-third'){
$output .= truethemes_lightbox_constructor($image_path,$lightbox_content,$description,$size,$group,280,179);
}

if ($size == 'full-third-short'){
$output .= truethemes_lightbox_constructor($image_path,$lightbox_content,$description,$size,$group,280,124);
}

if ($size == 'full-fourth'){
$output .= truethemes_lightbox_constructor($image_path,$lightbox_content,$description,$size,$group,197,133);
}

if ($size == 'small-half'){
$output .= truethemes_lightbox_constructor($image_path,$lightbox_content,$description,$size,$group,300,186);
}

if ($size == 'small-third'){
$output .= truethemes_lightbox_constructor($image_path,$lightbox_content,$description,$size,$group,183,120);
}

if ($size == 'small-fourth'){
$output .= truethemes_lightbox_constructor($image_path,$lightbox_content,$description,$size,$group,125,89);
}



  return $output;
}
add_shortcode('lightbox_image', 'truethemes_lightbox');




/*--------------------------------------*/
/*	Recent Blog Posts - For Hardcoding into Theme
/*--------------------------------------*/
function truethemes_hardcode_blog_posts($atts, $content=null) {
extract(shortcode_atts(array(
'count'   => '3',
'character_count'   => '115',
'post_category'   => '',
), $atts));

$count = $count;
$truethemes_count = 0; $truethemes_col = 0;



global $post;
$exclude = B_getExcludedCats();

if ($post_category != ''){
$myposts = new WP_Query('posts_per_page='.$count.'&offset=0&category_name='.$post_category.'');
}else{
$myposts = new WP_Query('posts_per_page='.$count.'&offset=0&category='.$exclude);
}


if ( $myposts->have_posts() ) : while ( $myposts->have_posts() ) : $myposts->the_post();

		$permalink = get_permalink($post->ID);
	
		
		//remove <!--nextpage--> and show only first page content
		$post_content = explode('<!--nextpage-->',$post->post_content);
		$post_content = (string)$post_content[0];
		$post_content = substr(strip_tags($post_content),0,$character_count);
		$post_content = rtrim($post_content); //remove space from end of string
		$post_content = str_replace("<br>","",$post_content);

    //remove all shortcodes from post content.
		$post_content = strip_shortcodes($post_content);		
		
		
		$output .= '<div class="article_preview">';
		$output .= '<strong><a href="'. esc_url( $permalink ) .'">'.get_the_title().'</a></strong>';
		$output .= '<p><a href="'.esc_url( $permalink ).'">'.$post_content.'...</a></p>';
		$output .= '</div>';
	
endwhile; endif;
wp_reset_postdata();

return $output;
}
add_shortcode('hardcode_blog_posts', 'truethemes_hardcode_blog_posts');