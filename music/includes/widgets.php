<?php
/**
 * WP-Church custom widgets
 *
 */



/******************************************************************
 * video widget
 ******************************************************************/  
 
add_action( 'widgets_init', 'ntl_videos_widgets' );
function ntl_videos_widgets() {register_widget( 'ntl_videos_Widget' );}

class ntl_videos_widget extends WP_Widget {
	
	function ntl_videos_Widget() {	
		$widget_ops = array( 'classname' => 'videos_widget', 'description' => __('Add Vimeo and Youtube videos.', 'localize') );
		$this->WP_Widget( 'ntl_videos_widget', __('Video Widget', 'localize'), $widget_ops );
	}
	


	function widget($args, $instance) {		
        extract( $args );
		$title = apply_filters('widget_title', $instance['title']);		
		$ytube  = $instance['ytube'];
		$vimeo  = $instance['vimeo'];
        
		echo $before_widget; 		
		
		if ( $title ) echo $before_title . $title . $after_title; 		
			
		if ($ytube != ''){
			$object = '<iframe width="286" height="170" src="http://www.youtube.com/embed/'.$ytube.'" frameborder="0" allowfullscreen></iframe>';
		} elseif ($vimeo != '') {
			$object = '<iframe src="http://player.vimeo.com/video/'.$vimeo.'?title=0&amp;byline=0&amp;portrait=0&amp;color=f01400" width="286" height="170" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';
		}
		
		echo $object . $after_widget;					
    }
	
	

    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['ytube'] = strip_tags($new_instance['ytube']);
		$instance['vimeo'] = strip_tags($new_instance['vimeo']);
		$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function form($instance) {				
		$ytube = strip_tags($instance['ytube']);
		$vimeo = strip_tags($instance['vimeo']);
		 $title = esc_attr($instance['title']);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (only for use with facebook widget):', 'localize'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('ytube'); ?>"><?php _e('Youtube code:', 'localize'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('ytube'); ?>" name="<?php echo $this->get_field_name('ytube'); ?>" type="text" value="<?php echo esc_attr($ytube); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo code:', 'localize'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" type="text" value="<?php echo esc_attr($vimeo); ?>" /></p>
 		<?php 
    }
}



/******************************************************************
 * Upcomming events
 ******************************************************************/

add_action( 'widgets_init', 'ntl_upcommingev_widgets' );
function ntl_upcommingev_widgets() {register_widget( 'ntl_upcommingev_Widget' );}

class ntl_upcommingev_widget extends WP_Widget {
	
	function ntl_upcommingev_Widget() {	
		$widget_ops = array( 'classname' => 'upcomingevents_widget', 'description' => __('Upcoming events', 'localize') );
		$this->WP_Widget( 'ntl_upcommingev_widget', __('Upcoming Events', 'localize'), $widget_ops );
	}
	

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);		
        $number = $instance['number'];
		
		$settings = get_option( "ntl_theme_settings" );		
		$linkname = $settings['ntl_calendar_page'];
		
		
        echo $before_widget; 
        if ( $title ) echo $before_title . $title . $after_title; 
        if (!$number) { 
        $number = 2;
        }
        $offset = 0;

        get_for_widget($number, $offset); 
		
		echo '<div class="gotocal"><a href="' .  get_permalink(get_option('ntl_calpage'))  .    '" class="smallfont">' . __('View Calendar', 'localize') . '</a></div>';		
   	 	echo $after_widget; 
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
        return $instance;
    }

    function form($instance) {				
        $title = esc_attr($instance['title']);
        $number = esc_attr($instance['number']);
        ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'localize'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'localize'); ?> <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label></p>
        <?php 
    }
} 




/******************************************************************
 * front page news widget
 ******************************************************************/

 
add_action( 'widgets_init', 'ntl_latestnews_widgets' );
function ntl_latestnews_widgets() {register_widget( 'ntl_latestnews_Widget' );}

class ntl_latestnews_widget extends WP_Widget {
	
	function ntl_latestnews_Widget() {	
		$widget_ops = array( 'classname' => 'latestnews_widget', 'description' => __('Latest news.', 'localize') );
		$this->WP_Widget( 'ntl_latestnews_widget', __('Latest News', 'localize'), $widget_ops );
	}
 

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        
        echo $before_widget;
		 if ( $title ) echo $before_title . $title . $after_title; 
         ?>
						
		<?php
		global $post;
		
		$args = array( 'numberposts' => $number);
		$myposts = get_posts( $args );
		$wcount = 1;
		foreach( $myposts as $post ) :	setup_postdata($post); ?>
		

			<?php $theimg = get_the_post_thumbnail($post->ID,'imlink');
			if ($theimg) { 
				
				if ($wcount == 1){
					echo '<div class="thumb imgblock">';
				} else {
					echo '<div class="thumb imgblock" style="margin-top: 40px;">';
				}
								
				?>
							
					<div class="imlk">
					<?php echo $theimg; ?>
					<a href="<?php the_permalink(); ?>"><span class="lastnewsspan"></span></a>	
					</div> 
					<div class="btitle smallfont"><?php if ( $title ) echo $title; ?></div>
					</div>
				<?php } ?>
				
				<?php if (!$theimg && $wcount == 1){ ?>
					
					<h6 class="vfont" style="clear: none;" style="margin-top: 40px;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
					
				<?php } else { ?>
					
					<h6 class="vfont" style="clear: none;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
					
				<?php } ?>
				
				
				<?php
				
				$text = get_the_excerpt();
				if (strlen($text) > 100) {
					$text = substr($text,0,strpos($text,' ',100)); 
				} 
				echo apply_filters('the_excerpt',$text . '...');
				?>
				<div class="clear"></div>
						
		<?php 
		
		$wcount++;
		
		endforeach; ?>

						
        <?php echo $after_widget; 
    }

    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
        return $instance;
    }

    function form($instance) {				
        $title = esc_attr($instance['title']);
        $number = esc_attr($instance['number']);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'localize'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'localize'); ?> <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label></p>
        <?php 
    }

}






/***************************************************************
 * galleries widget
 **************************************************************/



add_action( 'widgets_init', 'galleries_widgets' );
function galleries_widgets() {register_widget( 'galleries_Widget' );}

class galleries_widget extends WP_Widget {
	
	function galleries_Widget() {	
		$widget_ops = array( 'classname' => 'galleries_widget', 'description' => __('Display chosen Galleries.', 'localize') );
		$this->WP_Widget( 'galleries_widget', __('Galleries Widget', 'localize'), $widget_ops );
	}

	
	function widget( $args, $instance ) {
		extract( $args );

		$lnumber = absint( $instance['lnumber'] );
		$imgnum = absint( $instance['imgnum'] );
		$title = apply_filters('widget_title', $instance['title']);
		
		$gall_id 		= get_post($lnumber);
		$content 		= $gall_id->post_content;
		$id 			= $lnumber;
		$imgarr 		= '';
		$scrp 			= '';
		$regex_pattern 	= get_shortcode_regex();
		preg_match ('/'.$regex_pattern.'/s', $content, $regex_matches);

		$counter = 1;		
		if (!$imgnum) {
			$imgnum = 3;
		}
		
		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
				
		echo '<div class="imgblock"><div class="imlk"><div class="gallwidgouter ">';


		if (isset($regex_matches[2]) && $regex_matches[2] == 'gallery' && isset($regex_matches[3]) && $regex_matches[3]) {
			$result = str_replace('ids="', '', $regex_matches[3]);
			$result = str_replace('"', '', $result);
			$imgarr = explode(',', $result);

			$scrp = '';
		
			foreach ( $imgarr as $cro_v ) {
				if ($counter <= $imgnum) {
					$tid = wp_get_attachment_image( $cro_v, 'medium');
            		$scrp .=  '<div class="gallwidg" >' .  $tid  . '</div>'; 
            		$counter++;
            	}
			}

		} else {
		
    		$images = get_children( array( 'post_parent' => $id , 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
        	
        	foreach ( $images as $attachment_id => $attachment ) {
        		if ($counter <= $imgnum) {
            		$tid = wp_get_attachment_image( $attachment_id, 'medium');     
            		$scrp .=  '<div class="gallwidg" >' .  $tid  . '</div>'; 
            		$counter++;
            	}
        	}
		}
				
		
		echo $scrp;
		echo '</div>';
		if ( $title ){
			echo '<p class="lightblock1 paddingfix">' . $title . '</p>';
		}
		echo '<span class="imgblockover galblock galinvoke" rel="' .  $lnumber   .  '"></span></div></div>';
		echo $after_widget;					
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['lnumber'] = $new_instance['lnumber'];
		$instance['imgnum'] = $new_instance['imgnum'];
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		return $instance;
	}
	
	function form( $instance ) {
	
		$defaults = array(
		'title'=> '',
		'lnumber'=> '',
		'imgnum' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'localize') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'imgnum' ); ?>"><?php _e('Images to show:', 'localize') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'imgnum' ); ?>" name="<?php echo $this->get_field_name( 'imgnum' ); ?>" value="<?php echo $instance['imgnum']; ?>" />
		</p>
		<p>This widget will only work with 2 images or more. Portrait type photos will be cropped.</p>
		<p>
            <label for="<?php echo $this->get_field_id('lnumber'); ?>"><?php _e('Select Gallery:', 'localize'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('lnumber'); ?>" name="<?php echo $this->get_field_name('lnumber'); ?>">
            	<?php $linkposts = get_posts('numberposts=10000&post_type=galleries');
            	foreach($linkposts as $linkentry) :
				$linkvalue = $linkentry->ID;
				echo '<option';
				if ($instance['lnumber'] == $linkvalue){
				echo ' selected="selected"';
				}
				echo ' value="', $linkvalue , '">', $linkentry->post_title , '</option>';			
				endforeach;	
				?>
			</select> 
           </p>		
	<?php
	}
}




/***************************************************************
 * albums widget
 **************************************************************/



add_action( 'widgets_init', 'albums_widgets' );
function albums_widgets() {register_widget( 'albums_Widget' );}

class albums_widget extends WP_Widget {
	
	function albums_Widget() {	
		$widget_ops = array( 'classname' => 'albums_widget', 'description' => __('Display chosen album.', 'localize') );
		$this->WP_Widget( 'albums_widget', __('Albums Widget', 'localize'), $widget_ops );
	}

	
	function widget( $args, $instance ) {
		extract( $args );

		$lnumber = absint( $instance['lnumber'] );
		$title = apply_filters('widget_title', $instance['title']);

		
		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
		
		$theimg = get_the_post_thumbnail($lnumber,'albmlink');
				
		echo '<div class="albmholder">';
		
		echo $theimg;
		
		echo '</div>';
		
		echo '<div class="gotocal"><a class="smallfont" href="' . get_permalink($lnumber)  . '">' . __('View Album.', 'localize')  . '</a></div>';
		echo $after_widget;					
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['lnumber'] = $new_instance['lnumber'];
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		return $instance;
	}
	
	function form( $instance ) {
	
		$defaults = array(
		'title'=> '',
		'lnumber'=> ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'localize') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
            <label for="<?php echo $this->get_field_id('lnumber'); ?>"><?php _e('Select Album:', 'localize'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('lnumber'); ?>" name="<?php echo $this->get_field_name('lnumber'); ?>">
            	<?php $linkposts = get_posts('numberposts=10000&post_type=albums');
            	foreach($linkposts as $linkentry) :
				$linkvalue = $linkentry->ID;
				echo '<option';
				if ($instance['lnumber'] == $linkvalue){
				echo ' selected="selected"';
				}
				echo ' value="', $linkvalue , '">', $linkentry->post_title , '</option>';			
				endforeach;	
				?>
			</select> 
           </p>		
	<?php
	}
}






/***************************************************************
 * facebook widget
 **************************************************************/



add_action( 'widgets_init', 'facebook_widgets' );
function facebook_widgets() {register_widget( 'facebook_Widget' );}

class facebook_widget extends WP_Widget {
	
	function facebook_Widget() {	
		$widget_ops = array( 'classname' => 'facebook_widget', 'description' => __('Display Facebook Likebox.', 'localize') );
		$this->WP_Widget( 'facebook_widget', __('Facebook Widget', 'localize'), $widget_ops );
	}

	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title']);
		$url = $instance['url'];


		
		echo $before_widget;
		if ( $title )echo $before_title . $title . $after_title; 
				
		echo '<div class="fbcover"><div class="coverinner">';
				
		echo '<iframe src="//www.facebook.com/plugins/likebox.php?href='. $url . '&amp;width=292&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23ececec&amp;stream=false&amp;header=false&amp;height=258" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:258px;" allowTransparency="true"></iframe></div></div>';
		echo '<div class="gotocal" style="margin-top: -5px;"><a href="'. $url . '" class="smallfont"> '.__('Join us on Facebook.', 'localize').'</a></div>';	
		echo $after_widget;					
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['url'] = strip_tags(stripslashes($new_instance['url']));
		return $instance;
	}
	
	function form( $instance ) {
	
		$defaults = array(
		'title'=> '',
		'url'=> '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'localize') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e('Facebook Address:', 'localize') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" />
		</p>
	<?php
	}
}





/******************************************************************
 *
 * newsletter signup widget
 *
 ******************************************************************/ 
 
 
class netlabs_newsletter_Widget extends WP_Widget {

    function netlabs_newsletter_Widget() {
        parent::WP_Widget(false, $name = __('Newsletter Widget', 'localize'));	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$netlabs_newsmess  = $instance['netlabs_newsmess'];
        
		echo $before_widget; 
		if ( $title ) echo $before_title . $title . $after_title;

		if ($netlabs_newsmess != ''){
			echo '<p class="smallfont">' . $netlabs_newsmess . '</p>';
		} 						
		?>
		<div id="valmess"></div>
		<form id="newslettersignup" class="clear" post="" action="">
			<p>
				<label class="netlabs_newsnamel" for="name"><?php _e('Name:', 'localize'); ?></label>
				<input class="netlabs_newsname reset" id="netlabs_newsname" name="netlabs_newsname" type="text" value="" /><br/>
			</p>
			<p>
				<label class="netlabs_newsmaill" for="name"><?php _e('Email:', 'localize'); ?></label>
				<input class="netlabs_newsmail reset" id="netlabs_newsmail" name="netlabs_newsmail" type="text" value="" /><br/>
			</p>
			<label class="netlabs_newslocl" for="name"><?php _e('Location:', 'localize'); ?></label>
			<input class="netlabs_newsloc" id="netlabs_newsloc" name="netlabs_newsloc" type="text" value="" />
			<img class="loadimg" src="<?php echo get_template_directory_uri(); ?>/images/loadimg.gif">
			<input class="newssubmit smallfont" type="submit" value="Submit">
		</form>						

		<?php echo $after_widget; 
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['netlabs_newsmess'] = strip_tags($new_instance['netlabs_newsmess']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$netlabs_newsmess = strip_tags($instance['netlabs_newsmess']);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'localize'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('netlabs_newsmess'); ?>"><?php _e('Newsletter message:', 'localize'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('netlabs_newsmess'); ?>" name="<?php echo $this->get_field_name('netlabs_newsmess'); ?>" type="text" value="<?php echo esc_attr($netlabs_newsmess); ?>" /></p>
 	<?php 
    }
} 

add_action('widgets_init', create_function('', 'return register_widget("netlabs_newsletter_Widget");'));





/******************************************************************
 * image link widget
 ******************************************************************/


add_action( 'widgets_init', 'ntl_imagelink_widgets' );
function ntl_imagelink_widgets() {register_widget( 'ntl_imagelink_Widget' );}

class ntl_imagelink_widget extends WP_Widget {
	
	function ntl_imagelink_Widget() {	
		$widget_ops = array( 'classname' => 'imagelink_widget', 'description' => __('banner link to anything.', 'localize') );
		$this->WP_Widget( 'ntl_imagelink_widget', __('Bannerlink', 'localize'), $widget_ops );
	}
 
    function widget($args, $instance) {		
        extract( $args );
        $number = $instance['lnumber'];
		$title = $instance['title'];
        
        echo $before_widget; 
		
		if ( $title )echo $before_title . $title . $after_title; 
        
		global $post;?>
		<div class="imgblock">
					
		<?php 
		$a_meta = get_post_meta($number, 'option1' , true); 
		$b_meta = get_post_meta($number, 'option2' , true); 
		$c_meta = get_post_meta($number, 'option3' , true); 		
		$i_mg = get_the_post_thumbnail($number,'imlink');
		if ($b_meta){ $link = $b_meta;} else {$link = get_permalink($c_meta);}
  		?>
					
		<?php echo $i_mg; ?>
		<p class="lightblock1 calpic"><?php echo $a_meta; ?></p>

		<a href="<?php echo $link; ?>" class="imgoverlink imgoverlink1"><span class="imgblockover blockover1"></span></a>
		</div>                  																	
						
        <?php echo $after_widget; 
    }


    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['lnumber'] = $new_instance['lnumber'];
        return $instance;
    }


    function form($instance) {				
        $number = $instance['lnumber'];
		 $title = $instance['title'];
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (only for use with facebook widget):', 'localize'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <p>
        	<label for="<?php echo $this->get_field_id('lnumber'); ?>"><?php _e('Select Imagelink:', 'localize'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('lnumber'); ?>" name="<?php echo $this->get_field_name('lnumber'); ?>">
            <?php $linkposts = get_posts('numberposts=10000&post_type=bannerlinks');
            	foreach($linkposts as $linkentry) :
				$linkvalue = $linkentry->ID;
				echo '<option';
				if ($number == $linkvalue){
				echo ' selected="selected"';
				}
				echo ' value="', $linkvalue , '">', $linkentry->post_title , '</option>';				
				endforeach;	
			?>
			</select> 
		</p>
        <?php 
    }
}


/******************************************************************
 * feedback widget
 ******************************************************************/
 
class netlabs_feedb_Widget extends WP_Widget {

    function netlabs_feedb_Widget() {
        parent::WP_Widget(false, $name = 'Feedback Widget');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $number = $instance['lnumber'];
		$title = $instance['title'];
		$a_meta = get_post_meta($number, 'option1' , true); 
		$b_meta = get_post_meta($number, 'option2' , true); 
		$c_meta = get_post_meta($number, 'option3' , true); 		
		$i_mg = get_the_post_thumbnail($number,'imlink');

        
        echo $before_widget; 
		
		if ( $title )echo $before_title . $title . $after_title; 
        
		global $post;?>
					
		<div class="imlk fbs clear">
			<p><?php echo $c_meta ?></p>
			<span class="fbm smallfont" style="margin-top: 15px;"><?php echo $a_meta; ?></span>
			<?php if ($b_meta) { ?>
				<div class="feedbimg"><a href="<?php echo $b_meta; ?>"><?php echo $i_mg; ?></a></div>
			<?php } else { ?>
				<div class="feedbimg"><?php echo $i_mg; ?></div>
			<?php } ?>
		</div>                      																	
						
        <?php echo $after_widget; 
    }


    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['lnumber'] = $new_instance['lnumber'];
		$instance['title'] = $new_instance['title'];
        return $instance;
    }

    function form($instance) {				
        $number = $instance['lnumber'];
		$title = $instance['title'];
        ?>
         <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (only for use with facebook widget):', 'localize'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <p>
        	<label for="<?php echo $this->get_field_id('lnumber'); ?>"><?php _e('Select Feedback post:', 'localize'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('lnumber'); ?>" name="<?php echo $this->get_field_name('lnumber'); ?>">
            	<?php $linkposts = get_posts('numberposts=10000&post_type=feedbacks');
            	foreach($linkposts as $linkentry) :
					$linkvalue = $linkentry->ID;
					$isimg = get_post_meta($linkvalue, 'netlabs_linktype' , true); 
					echo '<option';
					if ($number == $linkvalue){
					echo ' selected="selected"';
					}
					echo ' value="', $linkvalue , '">', $linkentry->post_title , '</option>';					
				endforeach;	?>
			</select> 
		</p>
        <?php 
    }
}

add_action('widgets_init', create_function('', 'return register_widget("netlabs_feedb_Widget");'));

 
/******************************************************************
 * custom social widget.
 ******************************************************************/
 

class netstudio_social_widget extends WP_Widget {

    function netstudio_social_widget() {
        parent::WP_Widget(false, $name = 'Social icons');	
    }

    function widget($args, $instance) {
    	$settings = get_option( "ntl_theme_settings" );			
        extract( $args );
        
        echo $before_widget; 

        $countr = 1;
		$the_class= '';

		if ($settings['ntl_facebook_addr'] != '' && $settings['ntl_facebook_widg'] == 'on') { 
			if ($countr == 1 || $countr == 6 ) { $the_class = 'first'; } ?>
			<a target="_blank" href="<?php echo $settings['ntl_facebook_addr']; ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/facebook.png"></a>
			<?php $countr++; $the_class= ''; 
		} 
		
		if ($settings['ntl_twitter_addr'] != '' && $settings['ntl_twitter_widg'] == 'on') { 
			if ($countr == 1 || $countr == 6 ) { $the_class = 'first'; } ?>
			<a target="_blank" href="<?php echo $settings['ntl_twitter_addr']; ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/twitter.png"></a>
			<?php $countr++; $the_class= '';
		}
		
    	if ($settings['ntl_googleplus_addr'] != '' && $settings['ntl_googleplus_widg'] == 'on') { 
			if ($countr == 1 || $countr == 6 ) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo $settings['ntl_googleplus_addr']; ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/googleplus.png"></a>
			<?php $countr++; $the_class= ''; 
		}
			
		if ($settings['ntl_linkedin_addr'] != '' && $settings['ntl_linkedin_widg'] == 'on') {  
			if ($countr == 1 || $countr == 5 ) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo $settings['ntl_linkedin_addr']; ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/linkedin.png"></a>
			<?php $countr++; $the_class= ''; 
		}
			
		if ($settings['ntl_digg_addr'] != ''  && $settings['ntl_digg_widg'] == 'on') { 
			if ($countr == 1 || $countr == 6 ) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo $settings['ntl_digg_addr'] ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/digg.png"></a>
			<?php $countr++; $the_class= ''; 
		} 
		
		if ($settings['ntl_reddit_addr'] != '' && $settings['ntl_reddit_widg'] == 'on') { 
			if ($countr == 1 || $countr == 6 ) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo $settings['ntl_reddit_addr'] ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/reddit.png"></a>
			<?php $countr++; $the_class= '';
		} 
		
		if ($settings['ntl_rss_addr'] != ''  && $settings['ntl_rss_widg'] == 'on') { 
			if ($countr == 1 || $countr == 6 ) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo $settings['ntl_rss_addr']; ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/rss.png"></a>
			<?php $countr++; $the_class= ''; 
		} 
		
		if ($settings['ntl_stumbleupon_addr'] != ''  && $settings['ntl_stumbleupon_widg'] == 'on') { 
			if ($countr == 1 || $countr == 6 ) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo $settings['ntl_stumbleupon_addr']; ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/stumbleupon.png"></a>
			<?php $countr++; $the_class= ''; 
		} 
		
		if ($settings['ntl_delicious_addr'] != ''  && $settings['ntl_delicious_widg'] == 'on') { 
			if ($countr == 1 || $countr == 6 ) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo $settings['ntl_delicious_addr']; ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/styles/social/delicious.png"></a>
			<?php $countr++; $the_class= ''; 
		} 
				
		echo $after_widget; 
    }

    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
        return $instance;
    }

    function form($instance) {				

    }

} 

add_action('widgets_init', create_function('', 'return register_widget("netstudio_social_widget");'));



if ( !function_exists('netshttp_build_query') ) :
    function netshttp_build_query( $query_data, $numeric_prefix='', $arg_separator='&' ) {
       $arr = array();
       foreach ( $query_data as $key => $val )
         $arr[] = urlencode($numeric_prefix.$key) . '=' . urlencode($val);
       return implode($arr, $arg_separator);
    }
endif;

if ( !function_exists('nets_time_since') ) :


function nets_time_since( $original, $do_more = 0 ) {

		$yr_singular = __('year', 'localize');
		$yr_plural = __('years', 'localize');
		$mn_singular = __('month', 'localize');
		$mn_plural = __('months', 'localize');
		$wk_singular = __('week', 'localize');
		$wk_plural = __('weeks', 'localize');
		$dy_singular = __('day', 'localize');
		$dy_plural = __('days', 'localize');
		$hr_singular = __('hour', 'localize');
		$hr_plural = __('hours', 'localize');
		$mi_singular = __('minute', 'localize');
		$mi_plural = __('minutes', 'localize');

        $chunks = array(
                array(60 * 60 * 24 * 365 , $yr_singular, $yr_plural),
                array(60 * 60 * 24 * 30 , $mn_singular, $mn_plural),
                array(60 * 60 * 24 * 7, $wk_singular, $wk_plural),
                array(60 * 60 * 24 , $dy_singular, $dy_plural),
                array(60 * 60 , $hr_singular, $hr_plural),
                array(60 , $mi_singular, $mi_plural)
        );

        $today = time();
        $since = $today - $original;

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
                $seconds = $chunks[$i][0];
                $name = $chunks[$i][1];
                $namep = $chunks[$i][2];
                if (($count = floor($since / $seconds)) != 0)
                break;
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$namep}";

        if ($i + 1 < $j) {
                $seconds2 = $chunks[$i + 1][0];
                $name2 = $chunks[$i + 1][1];
                $namep2 = $chunks[$i + 1][2];

                // add second item if it's greater than 0
                if ( (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) && $do_more )
                        $print .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2p}";
        }
        return $print;
}
endif;


/**
 * ************************************************************
 * single tweet widget
 **************************************************************/



add_action( 'widgets_init', 'singletweet_widgets' );
function singletweet_widgets() {register_widget( 'singletweet_Widget' );}

class singletweet_widget extends WP_Widget {
	
	function singletweet_Widget() {	
		$widget_ops = array( 'classname' => 'singletweet_widget', 'description' => __('Display a single tweet.', 'localize') );
		$this->WP_Widget( 'singletweet_widget', __('Single Tweet Widget', 'localize'), $widget_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title  = $instance['title'];	
		
		$settings = get_option( "ntl_theme_settings" );
		
		$tweets = get_option('nets_tweetsave');
				
		$accountname = $settings['ntl_twitter_name'];
				
		$tweets_out = 0;

		foreach ( (array) $tweets as $tweet ) {
			if ( $tweets_out >= 1 )
				break;

			$text = make_clickable( esc_html( $tweet['text'] ) );

			$tweet_id = urlencode($tweet['id_str']);
			$ttime = time() - strtotime($tweet['created_at']);
			echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title; 	
			echo 	'<div class="imlk fbs clear">
					<p>' . $text . '<br/>
					<a href=" http://twitter.com/' . $accountname . '/statuses/' . $tweet_id . '" target="_blank" class="timesince">' . str_replace(' ', '&nbsp;', nets_time_since(strtotime($tweet['created_at']))) . '&nbsp;' . __('ago', 'localize') . '</a>
					- <a href="http://twitter.com/intent/retweet?tweet_id=' . $tweet_id . '" target="_blank">' . __('retweet', 'localize') . '</a>
					- <a href="http://twitter.com/intent/tweet?in_reply_to=' . $tweet_id .  '" target="_blank">' . __('reply', 'localize') . '</a>
					- <a href="http://twitter.com/intent/favorite?tweet_id=' . $tweet_id .  '" target="_blank">' . __('favorite', 'localize') . '</a></p>
					<span class="fbm" ><a href="http://www.twitter.com/' . $accountname  .  '" class="smallfont" target="_blank">' . __('Follow us on Twitter', 'localize') . '</a></span>
					<div class="feedbimg" ><img  src="' . get_template_directory_uri() . '/images/tlogo.png"></div></div>';
			echo $after_widget;
			unset($tweet_id);
			$tweets_out++;
		}
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['accountname'] = $new_instance['accountname'];	
		$instance['title'] = $new_instance['title'];		
		wp_cache_delete( 'widget-twitter-' . $this->number , 'widget' );
		wp_cache_delete( 'widget-twitter-response-code-' . $this->number, 'widget' );
		return $instance;
	}
	
	 function form($instance) {				
        $title = esc_attr($instance['title']);

        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (only for use with facebook widget):', 'localize'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		
 	<?php 
    }
}




/**
 * ************************************************************
 * multiple tweets widget
 **************************************************************/



add_action( 'widgets_init', 'multipletweet_widgets' );
function multipletweet_widgets() {register_widget( 'multipletweet_Widget' );}

class multipletweet_widget extends WP_Widget {
	
	function multipletweet_Widget() {	
		$widget_ops = array( 'classname' => 'multipletweet_widget', 'description' => __('Display a multiple tweets.', 'localize') );
		$this->WP_Widget( 'multipletweet_widget', __('Multiple Tweet Widget', 'localize'), $widget_ops );
	}

	
	function widget( $args, $instance ) {
		extract( $args );

		$show = absint( $instance['show'] );
		$title = apply_filters('widget_title', $instance['title']);
				
		$tweets = get_option('nets_tweetsave');
		
		
		$settings = get_option( "ntl_theme_settings" );		
		$accountname = $settings['ntl_twitter_name'];
				
		$tweets_out = 0;
		
		if (!$show || $show == 0 || $show >= 21) {
			$show = 5;
		}
		
		echo $before_widget;			
		if ( $title )echo $before_title . $title . $after_title; 
			
		echo '<ul>';

		foreach ( (array) $tweets as $tweet ) {
			if ( $tweets_out >= $show )
				break;

			$text = make_clickable( esc_html( $tweet['text'] ) );

			$tweet_id = urlencode($tweet['id_str']);
			echo 	'<li class="clear"><p>' . $text . '<br/>
					<a href=" http://twitter.com/' . $accountname . '/statuses/' . $tweet_id . '" target="_blank" class="timesince">' . str_replace(' ', '&nbsp;', nets_time_since(strtotime($tweet['created_at']))) . '&nbsp;' . __('ago', 'localize') . '</a>
					- <a href="http://twitter.com/intent/retweet?tweet_id=' . $tweet_id . '" target="_blank">' . __('retweet', 'localize') . '</a>
					- <a href="http://twitter.com/intent/tweet?in_reply_to=' . $tweet_id .  '" target="_blank">' . __('reply', 'localize') . '</a>
					- <a href="http://twitter.com/intent/favorite?tweet_id=' . $tweet_id .  '" target="_blank">' . __('favorite', 'localize') . '</a></p></li>';
			unset($tweet_id);
			$tweets_out++;
		}
		echo '<li class="clear"><span class="fbm" style="margin-top: 0px;"><a class="smallfont" href="http://www.twitter.com/' . $accountname  .  '" target="_blank">' . __('Follow us on Twitter', 'localize') . '</a></span><div class="feedbimg" style="margin-left: 0px; margin-top: 0px;"><img  src="' . get_template_directory_uri() . '/images/tlogo.png"></div></li></ul>';
		echo $after_widget;
					
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['show'] = $new_instance['show'];
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		
		wp_cache_delete( 'widget-twitter-' . $this->number , 'widget' );
		wp_cache_delete( 'widget-twitter-response-code-' . $this->number, 'widget' );

		return $instance;
	}
	
	function form( $instance ) {

		$defaults = array(
		'title'=> '',
		'show'=> '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'localize') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show' ); ?>"><?php _e('Number of tweets to show:', 'localize') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'show' ); ?>" name="<?php echo $this->get_field_name( 'show' ); ?>" value="<?php echo $instance['show']; ?>" />
		</p>
		
	<?php
	}
}

?>