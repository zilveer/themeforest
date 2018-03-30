<?php
/**
 * WP-Church custom widgets
 *
 */


/******************************************************************
 *
 * video widget
 *
 ******************************************************************/ 
 
 
class netlabs_video_Widget extends WP_Widget {

    function netlabs_video_Widget() {
        parent::WP_Widget(false, $name = 'Video Widget');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$netlabs_youtube  = $instance['netlabs_youtube'];
		$netlabs_vimeo  = $instance['netlabs_vimeo'];
        ?>
              <?php echo $before_widget; ?>
						<ul>						
						
						<li class="vidder">
						
						<?php if ($netlabs_youtube != '')
						{
						$object = '<object type="application/x-shockwave-flash" width="296" height="195" data="http://www.youtube.com/v/'.$netlabs_youtube.'">';
						$object .= '<param name="movie" value="http://www.youtube.com/v/'.$netlabs_youtube.'" />';
						$object .= '<param name="wmode" value="transparent" />';
						$object .= '<param name="quality" value="high" />';
						$object .= '</object>';
						} elseif ($netlabs_vimeo != '') {
						$object = '<iframe src="http://player.vimeo.com/video/'.$netlabs_vimeo.'?title=0&amp;byline=0&amp;portrait=0&amp;color=f01400" width="295" height="180" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';
						}
						echo $object;
						
						?>	
						
						<?php if ( $title )
                        echo '<p>' . $title . '</p>'; ?>											
						
						</li>

						</ul>
						
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['netlabs_youtube'] = strip_tags($new_instance['netlabs_youtube']);
	$instance['netlabs_vimeo'] = strip_tags($new_instance['netlabs_vimeo']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$netlabs_youtube = strip_tags($instance['netlabs_youtube']);
		$netlabs_vimeo = strip_tags($instance['netlabs_vimeo']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wp-church'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('netlabs_youtube'); ?>"><?php _e('Youtube code:', 'wp-church'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('netlabs_youtube'); ?>" name="<?php echo $this->get_field_name('netlabs_youtube'); ?>" type="text" value="<?php echo esc_attr($netlabs_youtube); ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('netlabs_vimeo'); ?>"><?php _e('Vimeo code:', 'wp-church'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('netlabs_vimeo'); ?>" name="<?php echo $this->get_field_name('netlabs_vimeo'); ?>" type="text" value="<?php echo esc_attr($netlabs_vimeo); ?>" /></p>
 <?php 
    }

} 

add_action('widgets_init', create_function('', 'return register_widget("netlabs_video_Widget");'));
 
 

 
if (get_option('nets_bibverse') != 'disabled') {
/******************************************************************
 *
 * verse of the day widget
 *
 ******************************************************************/
 
class votdWidget extends WP_Widget {

    function votdWidget() {
        parent::WP_Widget(false, $name = 'Verse of the day');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$votd_verse  = $instance['votd_verse'];
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
						<ul>						
						
						<li>
						
						<?php 
						$return = "";
						$linkposts = get_posts('numberposts=10000&post_type=verses');
    					foreach($linkposts as $linkentry) :
						$linkvalue = $linkentry->post_title;
						$linknumber = $linkentry->ID;
						if ($linkvalue == $votd_verse){
							$return = get_post_meta($linknumber, 'netlabs_vpassage' , true);
						}				
						endforeach;	

    					if ($return == "") {
							$url = 'http://www.esvapi.org/v2/rest/passageQuery?key=IP&passage='. urlencode($votd_verse) . '&include-footnotes=false';
  							$ch = curl_init($url); 
  							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  							$return = curl_exec($ch);
  							curl_close($ch);
							$post_id = wp_insert_post( array(
							'post_type' => 'verses',
							'post_status' => 'publish',
							'comment_status' => 'closed',
							'post_title' => $votd_verse,
							'post_author' => '1'
							) );
							add_post_meta($post_id, 'netlabs_vpassage', $returne, true); 
							}
						?>
						
						<?php 
						

						echo $return;
						
						?>												
						
						</li>

						</ul>
						
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['votd_verse'] = strip_tags($new_instance['votd_verse']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$votd_verse = strip_tags($instance['votd_verse']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wp-church'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('votd_verse'); ?>"><?php _e('Verse of the day:', 'wp-church'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('votd_verse'); ?>" name="<?php echo $this->get_field_name('votd_verse'); ?>" type="text" value="<?php echo
		esc_attr($votd_verse); ?>" /></p>
        <?php 
    }

} // class FooWidget

add_action('widgets_init', create_function('', 'return register_widget("votdWidget");'));


}


/******************************************************************
 *
 * calendar widget
 *
 ******************************************************************/
 
class netlabs_calendar_Widget extends WP_Widget {

    function netlabs_calendar_Widget() {
        parent::WP_Widget(false, $name = 'Upcomming events');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $calnum  = $instance['calnum'];
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
						<ul>						
						
						<li>
						
						<?php if ($calnum) { ?>
						<?php get_for_widget($calnum); ?>	
						<?php } else { ?>	
						<?php get_for_widget(4); ?>	
						
						<?php } ?>										
						
						</li>

						</ul>
						
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['calnum'] = strip_tags($new_instance['calnum']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
        $calnum = esc_attr($instance['calnum']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wp-church'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('calnum'); ?>"><?php _e('Number of entries to show:', 'wp-church'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('calnum'); ?>" name="<?php echo $this->get_field_name('calnum'); ?>" type="text" value="<?php echo
		esc_attr($calnum); ?>" /></p>
        <?php 
    }

} // class FooWidget

add_action('widgets_init', create_function('', 'return register_widget("netlabs_calendar_Widget");'));
 


/******************************************************************
 *
 * front page news widget
 *
 ******************************************************************/
 
class netlabs_fpnews_Widget extends WP_Widget {

    function netlabs_fpnews_Widget() {
        parent::WP_Widget(false, $name = 'Frontpage news');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
						<ul>						
						
						<?php
						global $post;
						$args = array( 'numberposts' => $number);
						$myposts = get_posts( $args );
						foreach( $myposts as $post ) :	setup_postdata($post); ?>
						<li class="fppostli">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('fppost'); ?></a>  
						<a class="postera" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<div class="meta"><?php wp_church_posted_on(); ?></div> 
						<div class="clear"></div></li>
						
						<?php endforeach; ?>

						</ul>
						
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['number'] = strip_tags($new_instance['number']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
        $number = esc_attr($instance['number']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wp-church'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'wp-church'); ?> <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label></p>
        <?php 
    }

} // class FooWidget

add_action('widgets_init', create_function('', 'return register_widget("netlabs_fpnews_Widget");'));





/******************************************************************
 *
 * image link widget
 *
 ******************************************************************/
 
class netlabs_imglink_Widget extends WP_Widget {

    function netlabs_imglink_Widget() {
        parent::WP_Widget(false, $name = 'Image Link');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $number = $instance['lnumber'];
        ?>
        <?php echo $before_widget; ?>
			<ul>										
				<li>					
					<?php
					global $post;?>
					<div class="imlk">
					<?php 
					$linkto = '';
					$isimg = '';
					$linkto = get_post_meta($number, 'netlabs_links_to' , true); 
					$isimg = get_post_meta($number, 'netlabs_ppftdimg' , true); 
					
					?>
					<?php if ($isimg == 'on') {?>
					<a href="<?php echo get_permalink($linkto); ?>"><?php echo get_the_post_thumbnail($linkto,'imlink'); ?> </a>
					<p><a href="<?php echo get_permalink($linkto); ?>"><?php echo get_the_title($number); ?></a></p>
					<?php } else {?>
					<a href="<?php echo get_permalink($linkto); ?>"><?php echo get_the_post_thumbnail($number,'imlink'); ?> </a>
					<p><a href="<?php echo get_permalink($linkto); ?>"><?php echo get_the_title($number); ?></a></p>
					<?php } ?>
					</div>                      																	
				</li>
			</ul>
						
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['lnumber'] = $new_instance['lnumber'];
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $number = $instance['lnumber'];
        ?>
           <p>
            	<label for="<?php echo $this->get_field_id('lnumber'); ?>"><?php _e('Select Imagelink:', 'wp-church'); ?></label>
            		<select class="widefat" id="<?php echo $this->get_field_id('lnumber'); ?>" name="<?php echo $this->get_field_name('lnumber'); ?>">
            		<?php $linkposts = get_posts('numberposts=10000&post_type=link');
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

} // class FooWidget

add_action('widgets_init', create_function('', 'return register_widget("netlabs_imglink_Widget");'));




/******************************************************************
 *
 * page content widget
 *
 ******************************************************************/
 
class netlabs_fpcontent_Widget extends WP_Widget {

    function netlabs_fpcontent_Widget() {
        parent::WP_Widget(false, $name = 'Frontpage content link');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
						<ul><li><div class="textwidget">
						<?php
						$my_id = $number;
						$post_id_5369 = get_post($my_id);
						$content = $post_id_5369->post_content;
						$content = apply_filters('the_content', $content);
						$content = str_replace(']]>', ']]>', $content);
						echo $content;
						?>
						<div class="clear"></div></div>
                        											
						
						</li>

						</ul>
						
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['number'] = strip_tags($new_instance['number']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
        $number = esc_attr($instance['number']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wp-church'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p>
            	<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Select Page for content:', 'wp-church'); ?></label>
            		<select class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
            		<?php $linkposts = get_posts('numberposts=10000&post_type=page');
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

} // class FooWidget

add_action('widgets_init', create_function('', 'return register_widget("netlabs_fpcontent_Widget");'));


 
/******************************************************************
 *
 * custom social widget.
 *
 ******************************************************************/
 

class netstudio_social_widget extends WP_Widget {

    function netstudio_social_widget() {
        parent::WP_Widget(false, $name = 'Netstudio Social');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        ?>
		<?php echo $before_widget; ?>
			 <?php echo $before_title . $title . $after_title; ?>
			<?php $countr = 1;
			$the_class= '';
			?>
			<ul><li>
			<?php if (get_option('nets_facebook_widgets') == 'true') { ?>
			<?php if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank" href="<?php echo get_option('nets_facebook_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/social_icons/facebook.png"></a>
			<?php $countr++; $the_class= ''; ?>
			<?php } ?>
			
			<?php if (get_option('nets_twitter_widgets') == 'true') { ?>
			<?php if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank" href="<?php echo get_option('nets_twitter_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/social_icons/twitter.png"></a>
			<?php $countr++; $the_class= ''; ?>
			<?php } ?>
			
			<?php if (get_option('nets_stumble_widgets') == 'true') { ?>
			<?php if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_stumble_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/social_icons/stumble.png"></a>
			<?php $countr++; $the_class= ''; ?>
			<?php } ?>
			
			<?php if (get_option('nets_rss_widgets') == 'true') { ?>
			<?php if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_rss_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/social_icons/rss.png"></a>
			<?php $countr++; $the_class= ''; ?>
			<?php } ?>
			
			<?php if (get_option('nets_email_widgets') == 'true') { ?>
			<?php if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_email_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/social_icons/email.png"></a>
			<?php $countr++; $the_class= ''; ?>
			<?php } ?>
			
			<?php if (get_option('nets_blogger_widgets') == 'true') { ?>
			<?php if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_blogger_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/social_icons/blogger.png"></a>
			<?php $countr++; $the_class= ''; ?>
			<?php } ?>
			
			<?php if (get_option('nets_digg_widgets') == 'true') { ?>
			<?php if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_digg_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/social_icons/digg.png"></a>
			<?php $countr++; $the_class= ''; ?>
			<?php } ?>
			
			<?php if (get_option('nets_delicious_widgets') == 'true') { ?>
			<?php if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_delicious_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/social_icons/delicious.png"></a>
			<?php $countr++; $the_class= ''; ?>
			<?php } ?>
			
			<?php if (get_option('nets_buzz_widgets') == 'true') { ?>
			<?php if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_buzz_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/social_icons/buzz.png"></a>
			<?php $countr++; $the_class= ''; ?>
			<?php } ?>
			
			<?php if (get_option('nets_technorati_widgets') == 'true') { ?>
			<?php if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_technorati_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/social_icons/technorati.png"></a>
			<?php $countr++; $the_class= ''; ?>
			<?php } ?>
			
			<?php if (get_option('nets_blinklist_widgets') == 'true') { ?>
			<?php if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_blinklist_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/social_icons/blinklist.png"></a>
			<?php $countr++; $the_class= ''; ?>
			<?php } ?>
			
			<?php if (get_option('nets_reddit_widgets') == 'true') { ?>
			<?php if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_reddit_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/social_icons/reddit.png"></a>
			<?php $countr++; $the_class= ''; ?>
			<?php } ?>
			
			<?php if (get_option('nets_designfloat_widgets') == 'true') { ?>
			<?php if ($countr == 1) { $the_class = 'first'; } ?>
			<a target="_blank"  href="<?php echo get_option('nets_designfloat_url') ?>"><img class="<?php echo $the_class; ?>" src="<?php echo get_template_directory_uri(); ?>/social_icons/designfloat.png"></a>
			<?php $countr++; $the_class= ''; ?>
			<?php } ?>
			
			</li><div class="clear"></div></ul>
			
						
		<?php echo $after_widget; ?>
		
		
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wp-church'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <?php 
    }

} 

add_action('widgets_init', create_function('', 'return register_widget("netstudio_social_widget");'));




/******************************************************************
 *
 * newsletter signup widget
 *
 ******************************************************************/ 
 
 
class netlabs_newsletter_Widget extends WP_Widget {

    function netlabs_newsletter_Widget() {
        parent::WP_Widget(false, $name = 'Newsletter Widget');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$netlabs_newsmess  = $instance['netlabs_newsmess'];
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
						<ul>												
							<li>
						
								<?php if ($netlabs_newsmess != '')
								{
									echo '<p>' . $netlabs_newsmess . '</p>';
								} 						
								?>
								<div id="valmess"></div>
								<form id="newslettersignup" post="" action="">
									<label class="netlabs_newsnamel" for="name"><?php _e( 'Name:', 'wp_church' ); ?></label><br/>
									<input class="netlabs_newsname reset" id="netlabs_newsname" name="netlabs_newsname" type="text" value="" /><br/>
									<label class="netlabs_newsmaill" for="name"><?php _e( 'Email:', 'wp_church' ); ?></label><br/>
									<input class="netlabs_newsmail reset" id="netlabs_newsmail" name="netlabs_newsmail" type="text" value="" /><br/>
									<label class="netlabs_newslocl" for="name"><?php _e( 'Location:', 'wp_church' ); ?></label>
									<input class="netlabs_newsloc" id="netlabs_newsloc" name="netlabs_newsloc" type="text" value="" />
									<img class="loadimg" src="<?php echo get_template_directory_uri(); ?>/images/loadimg.gif">
									<input class="newssubmit" type="submit" value="<?php _e( 'Submit', 'wp_church' ); ?>">
								</form>						
							</li>
						</ul>
						
              <?php echo $after_widget; ?>
        <?php
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
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wp-church'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('netlabs_newsmess'); ?>"><?php _e('Newsletter message:', 'wp-church'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('netlabs_newsmess'); ?>" name="<?php echo $this->get_field_name('netlabs_newsmess'); ?>" type="text" value="<?php echo esc_attr($netlabs_newsmess); ?>" /></p>
 <?php 
    }

} 

add_action('widgets_init', create_function('', 'return register_widget("netlabs_newsletter_Widget");'));




?>