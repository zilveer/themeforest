<?php
/**
 * @KingSize 2012
 **/

//Enabling Shortcodes in Widgets
 add_filter('widget_text', 'do_shortcode');

// one third div
add_shortcode('one_third', 'one_third');
function one_third( $atts, $content = null ) { 
    return '<div class="four mobile-four columns"  style="padding-left: 0px;"><p>'.do_shortcode($content).'</p></div>';  
}  


// one third div last
add_shortcode('one_third_last', 'one_third_last');
function one_third_last( $atts, $content = null ) {  
   return '<div class="four mobile-four columns" style="padding-left: 0px;"><p>'.do_shortcode($content).'</p></div>';  
}  


// one half div
add_shortcode('one_half', 'one_half');
function one_half( $atts, $content = null ) { 
    return '<div class="six mobile-two columns clearColumn" style="padding-left: 0px;"><p>'.do_shortcode($content).'</p></div>';  
}  


// one half div
add_shortcode('one_half_last', 'one_half_last');
function one_half_last( $atts, $content = null ) { 
    return '<div class="six mobile-two columns clearColumn" style="padding-left: 0px;"><p>'.do_shortcode($content).'</p></div>';  
}  


//two thirds div
add_shortcode('two_thirds', 'two_thirds');
function two_thirds( $atts, $content = null ) { 
    return '<div class="eight mobile-eight columns" style="padding-left: 0px;"><p>'.do_shortcode($content).'</p></div>';  
}  

//two thirds div last
add_shortcode('two_thirds_last', 'two_thirds_last');
function two_thirds_last( $atts, $content = null ) {  
    return '<div class="eight mobile-eight columns" style="padding-left: 0px;"><p>'.do_shortcode($content).'</p></div>';  
}  

//img_floated_left image
add_shortcode('img_floated_left', 'img_floated_left');
function img_floated_left( $atts, $content = null ) {
	extract(shortcode_atts(array(  
	 "src" => get_template_directory_uri().'/images/gallery/thumbs/3column.jpg',
	 "alt" => ''	
	), $atts));  
    return '<img class="left_aligned_image"  src="'.$src.'"  alt="'.$alt.'"/>';  
}  

//img_floated_right image
add_shortcode('img_floated_right', 'img_floated_right');
function img_floated_right( $atts, $content = null ) {
	extract(shortcode_atts(array(  
	 "src" => get_template_directory_uri().'/images/gallery/thumbs/3column.jpg',
	 "alt" => ''	
	), $atts));  
    return '<img class="right_aligned_image"  src="'.$src.'"  alt="'.$alt.'"/>';  
} 

//button
add_shortcode('button', 'button');
function button($atts, $content = null) {  
     extract(shortcode_atts(array(  
         "to" => '#',
         "target" => '',
         "color" => 'black'  
     ), $atts));  
     return '<a class="butn '.$color.'" href="'.$to.'" target="'.$target.'">'.$content.'</a>';  
 }  


// info box
add_shortcode('info_box', 'info_box');
function info_box($atts, $content = null) {  
	 $info_box = get_template_directory_uri().'/images/info_box.png';
     return '<div class="panel-info radius">
	<p>'.do_shortcode($content).'</p><div class="icon"><img src="'.$info_box.'" alt=""/></div>
	</div>';
}  

// warning box
add_shortcode('warning_box', 'warning_box');
function warning_box($atts, $content = null) {  
    return '<div class="panel-warning radius">
		<p>'.do_shortcode($content).'</p><div class="icon"><img src="'.get_template_directory_uri().'/images/warning_box.png" alt=""/></div>
	</div>';
}  

// error box
add_shortcode('error_box', 'error_box');
function error_box($atts, $content = null) {  
    return '<div class="panel-error radius">
		<p>'.do_shortcode($content).'</p><div class="icon"><img src="'.get_template_directory_uri().'/images/error_box.png" alt=""/></div>
	</div>';
} 


// download box
add_shortcode('download_box', 'download_box');
function download_box($atts, $content = null) {  
    return '<div class="panel-download radius">
		<p>'.do_shortcode($content).'</p><div class="icon"><img src="'.get_template_directory_uri().'/images/download_box.png" alt=""/></div>
	</div>';
} 


// blockquote
add_shortcode('blockquote', 'blockquote');
function blockquote( $atts, $content = null ) {  
    return '<blockquote>'.do_shortcode($content).'</blockquote>';  
} 

//tooltip_link
add_shortcode('tooltip_link', 'tooltip_link');
function tooltip_link($atts, $content = null) {  
     extract(shortcode_atts(array(  
         "title" => '',
         "to" => '#',
		 "position" => 'top'
     ), $atts));  

	
	 if($position == "bottom")
		$position_class = "tooltip_bottom";
	 else if($position == "left")
		$position_class = "tooltip_left";
	 else if($position == "right")
		$position_class = "tooltip_right";
	 else
		$position_class = "tooltip_top";

     return '<a class="'.$position_class.'"  title="'.$title.'"  href="'.$to.'">'.$content.'</a>';  
	
 }  


/*
General shortcode functions of KingSize theme V4
*/

/* contact Form shortcode*/
// [contact email="email@address.com" message="Thank you for writing us! We'll be in touch real soon."]
function shortcode_contactFrm($atts, $content = null)
{
  
  extract(shortcode_atts(array(
		'email' => false,
		'message' => false
    ), $atts));

   $email = ($email) ? $email  : '';
   $message = ($message) ? $message  : '';
	
	$output = "";
	$output =
		 '<!-- Post -->
			<div class="row">
                <div class="eight mobile-twelve columns">
					
				<form method="post" action="php/contact-send.php" id="contact_form">

				<div class="row"><label class="form_label" for="form_name">'. __("Name", "kslang").'</label>
					<input id="form_name" type="text" name="name" class="six columns text center"  value="'. __("Name", "kslang").'"/>
				</div>

				<br/>	
				<div class="row"><label class="form_label" for="form_email">'. __("E-mail", "kslang").'</label>
					<input id="form_email" type="text" name="email" class="six columns" value="'. __("E-mail", "kslang").'" />
				</div>
				
				<br/>					
				<div class="row"><label class="form_label" for="form_message">'. __("Message", "kslang").'</label>
					<textarea id="form_message" class="twelve columns" rows="12" name="message"  placeholder="Message">'. __("Message", "kslang").'</textarea>
				</div>
		
					<input id="form_submit" type="submit" name="submit" class="send-link" value="'. __("Send message", "kslang").'" />

					<input  name="input_to_email" type="hidden" value="'.$email.'" />
				
					<!-- hidden input for basic spam protection -->
					<div class="hide">
						<label for="spamCheck">Do not fill out this field</label>
						<input id="spamCheck" name="spam_check" type="text" value="" />
					</div>	
						
				</form>	
				<!-- contact form ends here-->	
		
				<!-- This div will be shown if mail was sent successfully -->		
				<div class="hide success">
					<p>'. __($message, "kslang") .'</p>
				</div>
			
				
			 </div>
			</div>
			<!-- Post ends here -->';

	return $output;
}

add_shortcode('contact', 'shortcode_contactFrm');



//toggle shortcode
add_shortcode('toggle', 'shortcode_toggle');
function shortcode_toggle($atts, $content = null) {
	$out = '';
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));

	$out .= '<div class="toggle_wrap toggle_alt"><div class="toggle_box"><a class="toggle" href="#"><p class="interactive">' .$title. '</p></a>';
	$out .= '<div class="hide"  style="display: none;"><p class="interactive">';
	$out .= do_shortcode($content);
	$out .= '</p></div></div></div>';

   return $out;
}

//toggle basic shortcode
add_shortcode('toggle_basic', 'shortcode_toggle_basic');
function shortcode_toggle_basic($atts, $content = null) {
	$out = '';
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));

	$out .= '<div class="toggle_wrap"><div class="toggle_box"><a class="toggle more underline" href="#">' .$title. '</a>';
	$out .= '<div class="hide" style="display: none;"><p>';
	$out .= do_shortcode($content);
	$out .= '</p></div></div></div>';

   return $out;
}

//basic accordion
add_shortcode('accordion_basic', 'shortcode_accordion_basic');
function shortcode_accordion_basic($atts, $content = null) {
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));

	$out .= '<div class="accordion"><div class="accordion_head"><a href="#"><p class="interactive">' .$title. '</p></a></div>';
	$out .= '<div class="accordion_content"><div class="accordion_inner"><p class="interactive">';
	$out .= do_shortcode($content);
	$out .= '</p></div></div></div>';

   return $out;
}

//accordion
add_shortcode('accordion', 'shortcode_accordion');
function shortcode_accordion($atts, $content = null) {
	$out = '';
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));

	$out .= '<div class="accordion"><div class="accordion_head"><a href="#"><p class="interactive">' .$title. '</p></a></div>';
	$out .= '<div class="accordion_content"><div class="accordion_inner"><p class="interactive">';
	$out .= do_shortcode($content);
	$out .= '</p></div></div></div>';

   return $out;
}



//accordion active
add_shortcode('accordion_active', 'shortcode_accordion_active');
function shortcode_accordion_active($atts, $content = null) {
	$out = '';
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));

	$out .= '<div class="accordion"><div class="accordion_head active_acc"><a href="#"><p class="interactive">' .$title. '</p></a></div>';
	$out .= '<div class="accordion_content"><div class="accordion_inner"><p class="interactive">';
	$out .= do_shortcode($content);
	$out .= '</p></div></div></div>';

   return $out;
}


//// Tabs Shortcode
//Example [tabs] [tab title="Title 1"]Insert your text here[/tab] [tab title="Title 2"]Insert your text here[/tab] [tab title="Title 3"]Insert your text //here[/tab] [/tabs]

function shortcode_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => '#',
		'type' => ''
	), $atts));

	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
		
	} else {
		
		

		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = str_replace("title=","",$matches[3][$i]); 
			$matches[3][$i] = str_replace("&#8221;","",$matches[3][$i]); 
			$matches[3][$i] = str_replace("&#8243;","",$matches[3][$i]); 
			$matches[3][$i] = str_replace("&#8216;","",$matches[3][$i]); 
			$matches[3][$i] = str_replace("&#8217;","",$matches[3][$i]); 
		}
		
		if($type == 'basic')
			$output = '<ul class="tabs tabs_alt">';
		else
			$output = '<ul class="tabs">';
		
	
		
		$rand_arr = array();	
		for($i = 0; $i < count($matches[0]); $i++) {
			$rand_num  = rand(); //generating randum number
			//$output .= '<li><a href="#tab'.preg_replace('/[^a-zA-Z0-9]/', '', $matches[3][$i]['title'] ).'">' . $matches[3][$i]['title'] . '</a></li>';
			$output .= '<li><a href="#tab'.$rand_num.'"><p class="interactive">' . htmlspecialchars(stripslashes($matches[3][$i])). '</p></a></li>'; //21/11/2014 Fix the tab title issue


			$rand_arr[] = $rand_num; //inserting randum number for contentID show
		}
		
		$output .= '</ul>';
		
		//start tab content section
		if($type == 'basic')
			$output .= '<div class="tab_container tab_container_alt">';
		else
			$output .= '<div class="tab_container">';

		for($i = 0; $i < count($matches[0]); $i++) {
			//$output .= '<div id="tab'.preg_replace('/[^a-zA-Z0-9]/', '', $matches[3][$i]['title']).'" class="tab_content">'.do_shortcode(trim($matches[5][$i])).'</div>';
			$output .= '<div id="tab'.$rand_arr[$i].'" class="tab_content"><p class="interactive">'.do_shortcode(trim($matches[5][$i])).'</p></div>';
		}

		$output .= '</div>';
		
		return '<div class="tabs_wrap">'.$output.'</div>';
	}
	
}
add_shortcode("tabs", "shortcode_tabs");

//tables
//define the type="" is required -- example: [table type=""] HTML table coding inserted inside here [/table]
add_shortcode('table', 'shortcode_table');
function shortcode_table($atts, $content = null) {
	$out = '';
	extract(shortcode_atts(array(
		'title'     =>  '',
        'type'      => ''
    ), $atts));

	$out .= '<table class="responsive ' .$type. '">';
	$out .= do_shortcode($content);
	$out .= '</table>';

   return $out;
}


//Google Map ShortCodes
//[googlemap width="600" height="300" src="http://maps.google.com/maps?q=Heraklion,+Greece&hl=en&ll=35.327451,25.140495&spn=0.233326,0.445976& sll=37.0625,-95.677068&sspn=57.161276,114.169922& oq=Heraklion&hnear=Heraklion,+Greece&t=h&z=12"]
function shortcode_googlemap($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '640',
      "height" => '480',
      "src" => ''
   ), $atts));
   return '<div class="twelve mobile-twelve columns flex-video"><iframe width="'.$width.'" height="'.$height.'" src="'.$src.'&output=embed" ></iframe></div>';
}
add_shortcode("googlemap", "shortcode_googlemap");



//Videos 
//[video url="http://youtu.be/wOUgRif7JRc" name="youtube-video" width="420" height="243"]
function shortcode_video($atts, $content = null) {

    extract(shortcode_atts(array(
		'name' => '',
        'url' => '',
		'html5_1' => '',
        'html5_2' => '',
        'priority' => 'flash',
        'image' => '',
        'width' => '100%',
        'height' => '315',
        'controlbar' => 'bottom',
        'autostart' => 'false',
        'icons' => 'true',
        'stretching' => 'fill',
        'align' => 'alignnone',
        'plugins' => '',
		'aspectratio' => '', //only for Youtube
        //'skin' => get_template_directory_uri().'/js/mediaplayer/fs39/fs39.xml',
        'player' => get_template_directory_uri().'/js/mediaplayer/player.swf'        
    ), $atts));
	
	
	// Remove spaces from video name
	$name = preg_replace('/[^a-zA-Z0-9]/', '', $name);

	// Video Type	
	$vimeo = strpos($url,"vimeo.com");
	$yt1 = strpos($url,"youtube.com");
	$yt2 = strpos($url,"youtu.be");
	
	ob_start(); ?>

						
			<?php if($vimeo) { ?>
			
				<div class="flex-video widescreen vimeo <?php echo $align; ?>">
										
				<?php if($autostart == "false") {
					$autostart = "0";
				} elseif($autostart == "true") {
					$autostart = "1";
				}
		
				// Vimeo Clip ID
				if(preg_match('/www.vimeo/',$url)) {							
					$vimeoid = trim($url,'http://www.vimeo.com/');
				} else {							
					$vimeoid = trim($url,'http://vimeo.com/');
				}				
		
				?>
				

				<iframe src="//player.vimeo.com/video/<?php echo $vimeoid; ?>?byline=0&amp;portrait=0&amp;autoplay=<?php echo $autostart; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				
				</div>
			<?php } else { 
			
			if($height != '315')
				$height_param = 'height: "'.$height.'",';	
			
			$aspectratio_param = '';
			if($aspectratio != '')
				$aspectratio_param = 'aspectratio: "'.$aspectratio.'",';
			?>
			<div class="flex-video widescreen vimeo youtube">	
			 <div id="video-<?php echo $name; ?>"></div>
				<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/jwplayer.js'></script>
				<script>
					jwplayer("video-<?php echo $name; ?>").setup({
						<?php if($image) { $image = wm_image_resize('', $image, $width, $height, true); ?>image: "<?php echo $image[url]; ?>",<?php } ?>
						icons: "<?php echo $icons; ?>",
						autostart: "<?php echo $autostart; ?>",
						stretching: "<?php echo $stretching; ?>",
						controlbar: "<?php echo $controlbar; ?>",
						<?php echo $height_param;?>
						width: "<?php echo $width; ?>",
						screencolor: "000000",
						<?php echo $aspectratio_param;?>
						file: "<?php echo $url; ?>",
						plugins: {<?php echo $plugins; ?>}
					});
				</script>
				</div>
			<?php } ?>
		

<?php 

	$output = ob_get_contents();
	ob_end_clean(); 
	
	return $output;
}
add_shortcode('video', 'shortcode_video');

//related post
//[related_posts limit="5"]
function shortcode_related_posts( $atts ) {
	extract(shortcode_atts(array(
	    'limit' => '5',
	), $atts));
 
	global $wpdb, $post, $table_prefix;
 
	if ($post->ID) {
		$retval = '<ul class="related_posts">';
 		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);
 
		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";
 
		$related = $wpdb->get_results($q);
 		if ( $related ) {
			foreach($related as $r) {
				$retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
			}
		} else {
			$retval .= '
	<li>No related posts found</li>';
		}
		$retval .= '</ul>';
		return $retval;
	}
	return;
}
add_shortcode('related_posts', 'shortcode_related_posts');

//one_half dropcaps
//[one_half_dropcaps]Content go here [/one_half_dropcaps]
function shortcode_one_half_dropcaps( $atts, $content = null ) {  
    return '<div class="six columns dropcaps"> <p>'.do_shortcode($content).'</p></div>';  
}  
add_shortcode('one_half_dropcaps', 'shortcode_one_half_dropcaps');


//<!-- 1/2 width div (add class="one_half") -->
//[one_half_alt_last_dropcaps]Content go here [/one_half_alt_last_dropcaps]
function shortcode_one_half_alt_last_dropcaps( $atts, $content = null ) {  
    return '<div class="six columns dropcaps_alt"><p>'.do_shortcode($content).'</p></div><div class="clearboth"></div>';  
}  
add_shortcode('one_half_alt_last_dropcaps', 'shortcode_one_half_alt_last_dropcaps');

// dropcaps
// [dropcap]Content go here [/dropcap]
function shortcode_dropcap( $atts, $content = null ) {  
    return '<div class="dropcaps"><p>'.do_shortcode($content).'</p></div>';  
}  
add_shortcode('dropcap', 'shortcode_dropcap');

//highlights
//[my_highlight color="yellow" font="#000000"]Content go here [/my_highlight]
function shortcode_highlight($atts, $content = null) {
extract(shortcode_atts(array(
    'color' => 'yellow',
    'font' => '#000000'
  ), $atts));
  return "<font style=\"BACKGROUND-COLOR: $color; color: $font\">$content</font>";
}
add_shortcode('my_highlight','shortcode_highlight');


//*************************** Blog Posts Shortcodes ***************************//
function shortcode_blog($atts, $content = null) {

	global $postParentPageID;

	extract(shortcode_atts(array(
		'cats' => '',
		'featured_images' => 'true',
		'per_page' => '5',
		'orderby' => 'date',
		'order' => 'desc',
		'title' => 'true',
		'meta_data' => 'true',
	    'content_display' => 'excerpt', //rtf/full/excerpt		
		'pagination' => 'true',
	),$atts));

	global $wp_query,$data;
	
	// Pagination	
	if (get_query_var('paged')) {
		$paged = get_query_var('paged');
	} elseif (get_query_var('page')) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	
	// Post Query	
	$args=array(
	'post_type' => 'post',
	//'post_status' => 'publish', To Fix the sticky post issue
	'cat' => $cats,
	'paged' => $paged,
	'orderby' => $orderby,
	'order' => $order,
	'ignore_sticky_posts' => 0,
	'posts_per_page' => $per_page,
	);
	$featured_query = new wp_query($args); 
	$counter = 0;
	ob_start(); ?>
	
	<?php while ($featured_query->have_posts()) : $featured_query->the_post(); $counter = $counter + 1; ?>
				<div class="post">
				   <?php
					if($title == 'true')
					{
					?>
					   <h3 class="post_title">
						 <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					   </h3>
					<?php
					}
					?>	
					<!-- Post details -->
					<?php
					if($meta_data == 'true' && ($data['wm_date_enabled'] == '1' || $data['wm_meta_comments_enabled'] == '1'))
					{
					?>
						<div class="blog_date">
							<?php 
								if( $data['wm_date_enabled'] == '1' ) { //data is enabled
							?>
							<ul class="icon-list">
								<li><i class="fa fa-calendar"></i></li>
								<li><?php the_time(get_option('date_format')); ?></li>
							</ul>
							<?php
							}
							?>
							
							<?php 
								if( $data['wm_meta_comments_enabled'] == '1' ) { //data is enabled
							?>
							<ul class="icon-list right text-right">
								<li><i class="fa fa-comments"></i></li>
								<li><a href="<?php the_permalink(); ?>#comments" class="underline"><?php comments_number(__('No comments', 'kslang'), __('1 comment', 'kslang'), __('% comments', 'kslang')); ?></a></li>
							</ul>
							<?php
							}
							?>
						</div>
					<?php
					}	
					?>

					<!-- Post thubmnail -->	
					<?php
						$postid = $featured_query->post->ID;
						if($featured_images == 'true')
						{
						//show the image in lightbox									
							$show_image_lightbox = get_post_meta($postid, 'kingsize_featured_img_lightbox', true );

						//POST featured image height
							if(get_post_meta($postid, 'kingsize_post_featured_img_height', true ))
								$post_featured_img_height = get_post_meta($postid, 'kingsize_post_featured_img_height', true );
							else
								$post_featured_img_height = null;

							 //Sidebar enabled	
								if ( $data['wm_sidebar_enabled'] == "1"   && get_post_meta($postParentPageID, 'page_sidebar_hide', true ) == "") 
									$post_featured_img_width = 680;
								else
									$post_featured_img_width = 680;//showing full width
									
							if(has_post_thumbnail()): // POST has thumbnail

								$org_img_url = wp_get_attachment_url( get_post_thumbnail_id( $postid ) );
								$attachment_id =  get_post_thumbnail_id($postid);

								$url_post_img = aq_resize( wp_get_attachment_url($attachment_id), $post_featured_img_width, $post_featured_img_height, true, true, true );

								$image = aq_resize(wp_get_attachment_url(get_post_thumbnail_id(get_the_id())),  $post_featured_img_width, $post_featured_img_height, true, false, true); 
									
								//wm_image_resize($post_featured_img_width,$post_featured_img_height, wp_get_attachment_url($attachment_id));
								
								if($show_image_lightbox=='enable')
									echo '<div class="blog_img"><a href="'.$org_img_url.'" class="image lightbox_blog" title="'.get_the_title($postid).'" alt="'.get_the_title($postid).'" rel="gallery"><img src="'.$image[0].'" title="'.get_the_title($postid).'" alt="'.get_the_title($postid).'" width="'.$image[1].'" height="'.$image[2].'"/></a></div>';
								else 
									echo '<div class="blog_img"><a href="'.get_permalink( $postid ).'" class="lightbox_not" title="'.get_the_title($postid).'" alt="'.get_the_title($postid).'"><img src="'.$image[0].'" title="'.get_the_title($postid).'" alt="'.get_the_title($postid).'" width="'.$image[1].'" height="'.$image[2].'"/></a></div>';
								
							endif;
						}
					?>
					<!-- END Post thubmnail -->							

					<!-- POST Content -->
					<div class="blog_text">
						<?php 
						///Enable the gallery with next previous of images
						if( $content_display=='excerpt') { //when content_display='excerpt'
							echo get_the_content_with_formatting($data['wm_read_more_text']);
						}		
						elseif ( $content_display=='rtf' ) {	//when content_display='gallery'							
							global $more;
							$more = 0;
							
							the_content($data['wm_read_more_text']);
						}
						elseif($content_display == '' || $content_display == 'full') { //show full content when content_display='full'
							$post_content = get_content(); 
							
							$post_content = str_replace("(more...)",$data['wm_read_more_text'],$post_content);
							$post_content = str_replace("(more&#8230;)",$data['wm_read_more_text'],$post_content);
							echo $post_content;
						}
						?>
					</div>
					<!-- POST Content END -->
											
				</div>

	  <?php endwhile; ?>

<?php	
	if($pagination == "true") { kingsize_pagination($featured_query->max_num_pages);}
	
	$output_string = ob_get_contents();
	ob_end_clean(); 
	wp_reset_postdata();
	
	return $output_string;

}
add_shortcode("blog", "shortcode_blog");



//*************************** Portfolio Posts Shortcodes ***************************//
//[portfolio cats="15,16,17" filter="true" per_page="8" orderby="date" order="desc" title="true" description="true" layout="4columns" pagination="false"]
function shortcode_portfolio($atts, $content = null) {	
	
	global $postParentPageID,$portfolio_page,$tpl_body_id,$no_of_page_columns;

	extract(shortcode_atts(array(
		'cats' => '', //comma seperated
		'filter' => 'false',
		'per_page' => '10',
		'orderby' => 'date', //menu_order/rand/date
		'order' => 'desc',
		'offset' => '0',
		'title' => 'true',
		'description' => 'true',
		'layout' => '2columns', //2columns/3columns/4columns/grid
		'pagination' => 'true'
	),$atts));
	
	global $wp_query,$data;

	$kingsize_page_porfolio_category_arr =  explode(",",$cats);
	
	// Pagination	
	if (get_query_var('paged')) {
		$paged = get_query_var('paged');
	} elseif (get_query_var('page')) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	
	//IsoTopes filter is enabled then paging will not work
	if($filter == "true")
		$per_page = 1000;
	
//order by
	if($orderby == 'random' || $orderby == 'rand')
		$orderby = 'rand';
	elseif($orderby == 'menu_order' || $orderby == 'custom_id')
		$orderby = 'menu_order';
	elseif($orderby == 'asc_order' || $orderby == 'date')
		$orderby = 'date';
	elseif($orderby == 'title')
		$orderby = 'title';

	// Post Query
	#### creating arguments #######
	if($cats != '') :
		$args_portfolio=array(
			"tax_query" => array(
				array(
					"taxonomy" => "portfolio-category",
					"field" => "id",
					"terms" => $kingsize_page_porfolio_category_arr
				)
			),
			'post_type' => array('portfolio'),
			'order' => $order,
			'orderby' => $orderby,
			'posts_per_page' => $per_page,
			'paged' => $paged,
		);		
	else :
		$args_portfolio=array(
			'post_type' => array('portfolio'),
			'order' => $order,
			'orderby' => $orderby,
			'posts_per_page' => $per_page,
			'paged' => $paged,
		);		
	endif;

	$no_of_page_columns = $layout;
	ob_start();


	 ########### FIXING # OF COLUMN AND IMAGE URL ###########
	if($no_of_page_columns=="2columns"){
		$div_layout = "six mobile-two columns mobile-fullwidth";
	}
	elseif($no_of_page_columns=="3columns"){
		$div_layout = "four columns mobile-four mobile-fullwidth";
	}
	elseif($no_of_page_columns=="4columns"){
		$div_layout = "three columns mobile-one mobile-fullwidth";
	}
	elseif($no_of_page_columns=="grid"){
		$div_layout = "six_col columns mobile-one mobile-fullwidth";
	}
	?>

	<!-- IsoTopes Filtering -->	
	<?php if($filter == "true") { // TOP Filters ?>
	<?php wp_enqueue_script('isotope'); //enque JS lib ?>	
		<nav class="primary clearfix"> 
			<ul class="media-boxes-filter"> 
				<li><a href="#" class="selected" data-filter="*">All</a></li> 
				<?php foreach($kingsize_page_porfolio_category_arr as $value):?>
					<?php 
					//Get the term name
					$term = get_term( $value, "portfolio-category" );
					?>
					<li><a href="#" data-filter=".<?php echo $term->slug;?>_slg" class=""><?php echo $term->name;?></a></li> 
				<?php endforeach; ?>
			</ul> 
		</nav>
	 <?php } ?>
	 <!-- End IsoTopes Filtering -->	

	<!-- Gallery with PrettyPhoto plugin -->
		<div class="row assorted">				

			 <?php 
				$count = 1;
				$temp = $wp_query;
				$wp_query= null;
				

				$wp_query = new WP_Query();
				$wp_query->query($args_portfolio);	

			//echo $GLOBALS['wp_query']->request;
			
			if ($wp_query->max_num_pages > 0) : 								
					
					$portfolio_page = 'portfolio';
					$tpl_body_id = "prettyphoto";
					
				while ($wp_query->have_posts()) : $wp_query->the_post();
					
					$postid = $wp_query->post->ID;

					$the_post = get_post( $postid, ARRAY_A );

					//if CUSTOM LINK has been set from write up panel for the permalink
					if(get_post_meta( $postid, 'portfolios_read_more_link', true ) != '') :
						$permalink = get_post_meta( $postid, 'portfolios_read_more_link', true );
					else :
						ob_start();
						the_permalink();
						$permalink = ob_get_contents();
						ob_end_clean();
					endif;

					//get the POST Term ID(Category slug) for filtering work
					$terms_post = wp_get_post_terms( $postid, 'portfolio-category' );
					$cls_terms_slug = '';
					foreach($terms_post as $obj_terms):
						$cls_terms_slug .= $obj_terms->slug."_slg ";
					endforeach;
				?>
			<div class="<?php echo $div_layout;?> <?php echo $cls_terms_slug; ?>">	
			 <div class="row">
				<div class="twelve columns">
				
					<?php if ( $title == "true" ) {?>
						<h3 class="post_title"><a href="<?php echo $permalink; ?>"><?php the_title(); ?></a></h3>
					<?php } else { ?><h3><!-- No Titles --></h3><?php } ?>
					
					<!-- Portfolio post-thumb gallery -->
						<div class="portfolio_thumb"><?php kingsize_thumb_box($postid); ?></div>
					<!-- END Portfolio post-thumb gallery -->

					 <!--BEGIN excerpt content -->
					 <?php if($description == 'true') { ?>
						<p><?php echo substr($wp_query->post->post_excerpt,0,240); ?></p>
					<?php } ?>	
					 <!--END excerpt content -->

					<?php
					//checking read more text has been set from the write up panel
					if(get_post_meta( $postid, 'portfolios_read_more_disable', true ) != 1) :

						if(get_post_meta( $postid, 'portfolios_read_more_text', true ) != '') :
							echo '<a href="'.$permalink.'"  class="more-link">'.get_post_meta( $postid, 'portfolios_read_more_text', true ).'</a>';
						else :
							echo '<a href="'.$permalink.'"  class="more-link">'.__("Read More", "kslang").'</a>';
						endif;
					
					endif;
					?>

				  </div>
				 </div>
				</div>
				<?php $count++; endwhile; ?>										
			<?php 
			else : 
				echo '<div class="four columns mobile-four mobile-fullwidth"><div class="row"><div class="twelve columns"><p>No portfolio yet.</p></div></div></div>';
			endif; 
		?>	
	  </div> <!-- end row assorted -->	
	<!-- End Gallery with PrettyPhoto plugin -->


	<?php	
	if($pagination == "true") { kingsize_pagination($wp_query->max_num_pages);}
	
	$output_string = ob_get_contents();
	ob_end_clean(); 
	wp_reset_postdata();
	$wp_query = null; $wp_query = $temp; 
	return $output_string;
}
add_shortcode("portfolio", "shortcode_portfolio");


/* Lists Style */
add_shortcode('unordered_list', 'shortcode_lists_style');
function shortcode_lists_style($atts, $content = null) {
	$out = '';
	extract(shortcode_atts(array(
        'type'      => 'disc' //"circle/disc"
    ), $atts));

	$out .= '<ul class="'.$type.'">';
	$out .= do_shortcode($content);
	$out .= '</ul>';

   return $out;
}
