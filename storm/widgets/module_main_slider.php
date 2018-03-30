<?php
/**
 * Plugin Name: BK-Ninja: Main Slider Module
 * Plugin URI: http://bk-ninja.com
 * Description: Featured slider module
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://bk-ninja.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'bk_register_main_slider_module');

function bk_register_main_slider_module(){
	register_widget('bk_main_slider');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class bk_main_slider extends WP_Widget {
	
	/**
	 * Widget setup.
	 */
	function __construct(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'module-main-slider', 'description' => __('[Full-width module][Content module] Displays slider module in full-width or content section.', 'bkninja'));
		
		/* Create the widget. */
		parent::__construct('bk_main_slider', __('*BK: Module Slider', 'bkninja'), $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){
        global $bk_option;
        global $bk_flex_el;
        $feat_tag = '';
        if (isset($bk_option)):
            $rtl = $bk_option['bk-rtl-sw'];
            if ($bk_option['feat-tag'] != '') {$feat_tag = $bk_option['feat-tag'];}
        endif;
        $defaults = array('title' => '', 'category' => 'feat', 'entries_display' => 5, 'display' => 'video', 'ctrl_thumb' => 'show', 'autoplay' => 'on');
		$instance = wp_parse_args((array) $instance, $defaults);
		extract($args);
        $title = $instance['title'];
		$cat_id = $instance['category'];
		$entries_display = $instance['entries_display'];
        $display = $instance['display'];
        $ctrl_thumb = $instance['ctrl_thumb'];
        echo $before_widget;  
        if ( $title )
			echo $before_title . $title . $after_title;
        if ($cat_id == 'feat') {    
            if ($feat_tag != '') {
                $args = array(
    				'tag' => $feat_tag,
    				'post_status' => 'publish',
    				'ignore_sticky_posts' => 1,
    				'posts_per_page' => $entries_display,
                    );   
            } else {
                $args = array(
    				'post__in'  => get_option( 'sticky_posts' ),
    				'post_status' => 'publish',
    				'ignore_sticky_posts' => 1,
    				'posts_per_page' => $entries_display,
                    );
            }         
        } else { 
		$args = array(
				'cat' => $cat_id,
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $entries_display,
                );
        }
            $uid = uniqid('main-slider-');
            global $bk_youtube_id;
            global $bk_vimeo_id;
            global $bk_vmslide_arr ;
            global $bk_ytslide_arr ;
            global $bk_yt_frame_No;
            global $bk_vm_frame_No;
            global $wp_query;
            global $yt_uid;
        ?>


			<div class="main-slider control-<?php echo $ctrl_thumb;?>">
                <div id="<?php echo $uid;?>" class="flexslider main-slider-frame" >
    				<ul class="slides">
    					<?php $query = new WP_Query( $args ); ?>
    					<?php while($query->have_posts()): $query->the_post(); ?>	
                            <?php 
                                $post_id = get_the_ID();
                                $bk_url = get_post_meta($post_id, 'bk_media_embed_code_post', true);
                                $bk_parse_url = parse_url($bk_url);
                                $thumb_id = get_post_thumbnail_id();
                                $thumb_url = wp_get_attachment_image_src($thumb_id, 'bk1050_600', true);
                            ?>					
                                <?php if (($display == 'video') && ( get_post_format( $post_id ) == 'video') && (($bk_parse_url['host'] == 'www.youtube.com')||($bk_parse_url['host'] == 'youtube.com'))) { 
                                        $bk_youtube_id[$bk_yt_frame_No] = parse_youtube($bk_url);
                                        array_push($bk_ytslide_arr, $query->current_post);
                                    ?>
                                    <li data-thumb="<?php echo $thumb_url[0]; ?>" class="youtube-iframe" >
                                        <div class="thumb">
                                            <div class='bk-oEmbed-video'>
                                                <iframe id="player-<?php echo str_pad($bk_yt_frame_No,3,"0",STR_PAD_LEFT).$query->current_post;?>" title="YouTube video player" width="640" height="360" src="http://www.youtube.com/embed/<?php echo $bk_youtube_id[$bk_yt_frame_No];?>?enablejsapi=1"></iframe>
                                                <?php $bk_yt_frame_No++;?>
                                            </div>

                                <?php } else if (($display == 'video')&&( get_post_format( $post_id ) == 'video') && (($bk_parse_url['host'] == 'www.vimeo.com')||($bk_parse_url['host'] == 'vimeo.com'))) {
                                           $bk_vimeo_id[$bk_vm_frame_No] = parse_vimeo($bk_url);
                                           array_push($bk_vmslide_arr, $query->current_post);
                                    ?>
                                    <li data-thumb="<?php echo $thumb_url[0]; ?>" class="vimeo-iframe" >
                                        <div class="thumb">
                                            <div class='bk-oEmbed-video'>
                                                <iframe id="vmplayer-<?php echo str_pad($bk_vm_frame_No,3,"0",STR_PAD_LEFT).$query->current_post;?>" src="http://player.vimeo.com/video/<?php echo $bk_vimeo_id[$bk_vm_frame_No];?>?api=1&amp;player_id=vmplayer-<?php echo str_pad($bk_vm_frame_No,3,"0",STR_PAD_LEFT).$query->current_post; $bk_vm_frame_No++?>&amp;title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff"></iframe>
                                            </div>
 
                                <?php } else {?>
                                <li data-thumb="<?php echo $thumb_url[0]; ?>" >
                                    <div class="thumb">									
                                        <?php echo (bk_get_thumbnail($post_id, 'bk1050_600'));?>
                                        <?php } ?>										
        								<div class="post-info overlay">
                                            <div class="post-info-overlay">
                                                <h2 class="post-cat post-cat-main-slider">                                                 
                                                <?php
                                                    $category = get_the_category( $post_id );
                                                    $cat_link = get_category_link( get_cat_ID($category[0]->cat_name));
                                                    echo '<a href="'; echo $cat_link; echo '">';
                                                    echo $category[0]->cat_name;
                                                    echo '</a>';
                                                ?>                                           
                                                </h2>
                                                <div class="post-info-line"></div>								
            									<h2 class="post-title post-title-main-slider">
            										<a href="<?php the_permalink() ?>">
            											<?php
                                                            $title = the_title(FALSE);
                                                            $short_title = the_excerpt_limit($title, 10);
            												echo $short_title; 
            											?>
            										</a>
            									</h2>
                                            </div>
                                        </div>
                                    </div>
    								
    							</li>																			
    					<?php endwhile; ?>
    				</ul>
    			</div>
            
            
                <div class="main-slider-thumbs">
                    <div id="thumb-<?php echo $uid;?>" class="flexslider" >
        				<ul class="slides">
        					<?php $query = new WP_Query( $args ); ?>
        					<?php while($query->have_posts()): $query->the_post(); ?>	
                                <?php 
                                    $post_id = get_the_ID();
                                    $thumb_id = get_post_thumbnail_id();
                                    $thumb_url = wp_get_attachment_image_src($thumb_id, 'bk100_100', true);
                                ?>					
                                    <li data-thumb="<?php echo $thumb_url[0]; ?>" >
                                        <div class="thumb">									
                                            <?php echo (bk_get_thumbnail($post_id, 'bk100_100'));?>										
                                        </div>								
        							</li>																			
        					<?php endwhile; ?>
        				</ul>
        			</div>
                </div>
            </div>						
		<?php
        global $bk_slider_config;
        global $config;
        $bk_slider_config['vm_frame_No']= $bk_vm_frame_No;
        $bk_slider_config['vmslide_array']= $bk_vmslide_arr;
        $bk_slider_config['yt_frame_No']= $bk_yt_frame_No;
        $bk_slider_config['video_array']= $bk_youtube_id;
        $bk_slider_config['ytslide_arr']= $bk_ytslide_arr;
        
        $bk_flex_el['main_slider'][$uid] = $config;
 
        wp_localize_script( 'customjs', 'bk_flex_el', $bk_flex_el );
        wp_localize_script( 'customjs', 'mconfig', $bk_slider_config );

		echo $after_widget;?>
        
<?php
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
		if ($new_instance['entries_display'] <=5){
		  $new_instance['entries_display'] = 5;
		}
		$instance['category'] = $new_instance['category'];
		$instance['entries_display'] = $new_instance['entries_display'];
        $instance['display'] = $new_instance['display'];
        $instance['ctrl_thumb'] = $new_instance['ctrl_thumb'];
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array('title' => '', 'category' => 'feat', 'entries_display' => 5, 'display' => 'video', 'ctrl_thumb' => 'show');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<!-- Title: Text Input -->     
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e('Title: ', 'bkninja'); ?></strong></label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><strong><?php _e('Post Source:', 'bkninja'); ?></strong></label> 
			<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" class="widefat categories" style="width:100%;">
				<option value='feat' <?php if ('feat' == $instance['category']) echo 'selected="selected"'; ?>><?php _e( 'Featured Posts', 'bkninja' ); ?></option>
                <option value='' <?php if ('' == $instance['category']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'bkninja' ); ?></option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['category']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
        
		<p><label for="<?php echo $this->get_field_id( 'entries_display' ); ?>"><strong><?php _e('Number of entries to display (Min 5 entries)', 'bkninja'); ?></strong></label>
		<input type="text" id="<?php echo $this->get_field_id('entries_display'); ?>" name="<?php echo $this->get_field_name('entries_display'); ?>" value="<?php echo $instance['entries_display']; ?>" style="width:100%;" />
        </p>

        <p>     
            <label for="<?php echo $this->get_field_id( 'display' ); ?>"><strong><?php   _e('Video thumbnail option: ','bkninja'); ?></strong></label>    		 	
            <select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>">            
                <option value="thumbnail" <?php if ($instance['display'] == 'thumbnail') echo 'selected="selected"'; ?>><?php _e('Thumbnail', 'bkninja');?></option>               
                <option value="video" <?php if ($instance['display'] == 'video') echo 'selected="selected"'; ?>><?php _e('Video', 'bkninja');?></option>                           	
             </select>          
        </p>
        
        <p>     
            <label for="<?php echo $this->get_field_id( 'ctrl_thumb' ); ?>"><strong><?php   _e('Slider control thumbnail: ','bkninja'); ?></strong></label>    		 	
            <select id="<?php echo $this->get_field_id( 'ctrl_thumb' ); ?>" name="<?php echo $this->get_field_name( 'ctrl_thumb' ); ?>">            
                <option value="show" <?php if ($instance['ctrl_thumb'] == 'show') echo 'selected="selected"'; ?>><?php _e('Show', 'bkninja');?></option>               
                <option value="hide" <?php if ($instance['ctrl_thumb'] == 'hide') echo 'selected="selected"'; ?>><?php _e('Hide', 'bkninja');?></option>                           	
             </select>          
        </p>
	<?php }
}
?>