<?php 
/**
 * Widgets Overview
 *
 * Tabbed Widget: Popular & Recent Posts
 * Tabbed Widget: Upcoming Gigs & Latest Releases
 * 
 * Single Widgets: Popular Posts, Recent Posts, Upcoming Gigs, Latest Releases
 *
 */



/**
 * Popular & Recent Post widget
 *
 */
class Radykal_Widget_Popular_Recent_Posts extends WP_Widget {

	function Radykal_Widget_Popular_Recent_Posts() {
		
		$widget_ops = array(
		    'classname' => 'widget-popular-recent-posts', 
			'description' => __( "A tabbed widget with the most popular and recent posts.", 'stylico') 
		);
		
		parent::__construct('radykal-popular-recent-posts', __('Tabbed - Popular &amp; Recent Posts', 'stylico'), $widget_ops);
		
	}

	function widget($args, $instance) {
		
		extract($args);

		$popular_post_title = empty($instance['popular_post_title']) ? __('Popular Posts', 'stylico') : $instance['popular_post_title'];
		$recent_post_title = empty($instance['recent_post_title']) ? __('Recent Posts', 'stylico') : $instance['recent_post_title'];
		if ( ! $number = absint( $instance['number'] ) )
 			$number = 10;	
?>
		<?php echo $before_widget; ?>
        <div class="tabbed-widget">
            
            <!-- Tab Nav -->
            <ul class="tabbed-widget-nav clearfix">
                <li><a href="#radykal-popular-posts" class="tabbed-widget-nav-first"><?php echo $popular_post_title; ?></a></li>
                <li><a href="#radykal-recent-posts" class="tabbed-widget-nav-last"><?php echo $recent_post_title; ?></a></li>
            </ul>
            
            <!-- Tab Content First -->
            <div id="radykal-popular-posts" class="tabbed-widget-content">
                <ul>
                    <?php 
                        $popular_posts = new WP_Query(array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'orderby' => 'comment_count', 'order' => 'DESC'));
                        if ($popular_posts->have_posts()) : while ($popular_posts->have_posts()) : $popular_posts->the_post();
                    ?>
                    <li class="radykal-widget-popular-recent-post clearfix <?php if(!$popular_posts->current_post) echo 'no-top-margin'?>">
                        <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'thumbnail' ); ?>
                            <?php endif; ?>
                            <div>
                                <p class="radykal-widget-popular-recent-post-title"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></p>
                                <span class="radykal-widget-popular-recent-post-date"><?php the_time('jS M Y'); ?></span>
                                <span>-</span>
                                <span class="radykal-widget-popular-recent-post-comments"><?php comments_number(); ?></span>
                            </div>
                            
                        </a>
                    </li>
                    <?php endwhile; wp_reset_postdata(); endif;?>
                </ul>
            </div>
            
            <!-- Tab Content Last -->
            <div id="radykal-recent-posts" class="tabbed-widget-content">
                <ul>
                    <?php 
                    
                        $recent_posts = new WP_Query(array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true));
                        if ($recent_posts->have_posts()) : while ($recent_posts->have_posts()) : $recent_posts->the_post(); 
                    ?>
                    <li class="radykal-widget-popular-recent-post clearfix <?php if(!$recent_posts->current_post) echo 'no-top-margin'?>">
                        <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'thumbnail' ); ?>
                            <?php endif; ?>
                            <div>
                                <p class="radykal-widget-popular-recent-post-title"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></p>
                                <span class="radykal-widget-popular-recent-post-date"><?php the_time('jS M Y'); ?></span>
                                <span>-</span>
                                <span class="radykal-widget-popular-recent-post-comments"><?php comments_number(); ?></span>
                            </div>
                            
                        </a>
                    </li>
                    <?php endwhile; wp_reset_postdata(); endif;?>
                </ul>
            </div>
            
        </div>
		<?php echo $after_widget; ?>
<?php
	
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['popular_post_title'] = strip_tags($new_instance['popular_post_title']);
		$instance['recent_post_title'] = strip_tags($new_instance['recent_post_title']);
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	function form( $instance ) {
		$popular_post_title = isset($instance['popular_post_title']) ? esc_attr($instance['popular_post_title']) : '';
		$recent_post_title = isset($instance['recent_post_title']) ? esc_attr($instance['recent_post_title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
		<p><label for="<?php echo $this->get_field_id('popular_post_title'); ?>"><?php _e('Popular Posts Title:', 'stylico'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('popular_post_title'); ?>" name="<?php echo $this->get_field_name('popular_post_title'); ?>" type="text" value="<?php echo $popular_post_title; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('recent_post_title'); ?>"><?php _e('Recent Posts Title:', 'stylico'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('recent_post_title'); ?>" name="<?php echo $this->get_field_name('recent_post_title'); ?>" type="text" value="<?php echo $recent_post_title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'stylico'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}




/**
 * Next Gigs & New Releases widget
 *
 */
class Radykal_Widget_Gigs_Releases extends WP_Widget {

	function Radykal_Widget_Gigs_Releases() {
		
		$widget_ops = array(
		    'classname' => 'widget-gigs-releases', 
			'description' => __( "A tabbed widget with the upcoming Gigs and latest Releases.", 'stylico') 
		);
		
		parent::__construct('radykal-widget-gigs-releases', __('Tabbed - Next Gigs &amp; New Releases', 'stylico'), $widget_ops);
		
	}

	function widget($args, $instance) {
		
		extract($args);

		$upcoming_gigs_title = empty($instance['upcoming_gigs_title']) ? __('Upcoming Gigs', 'stylico') : $instance['upcoming_gigs_title'];
		$latest_releases_title = empty($instance['latest_releases_title']) ? __('Latest Releases', 'stylico') : $instance['latest_releases_title'];
		if ( ! $number = absint( $instance['number'] ) )
 			$number = 5;	
?>
		<?php echo $before_widget; ?>
        <div class="tabbed-widget">
            
            <!-- Tab Nav -->
            <ul class="tabbed-widget-nav clearfix">
                <li><a href="#radykal-upcoming-gigs" class="tabbed-widget-nav-first"><?php echo $upcoming_gigs_title; ?></a></li>
                <li><a href="#radykal-latest-releases" class="tabbed-widget-nav-last"><?php echo $latest_releases_title; ?></a></li>
            </ul>
            
            <!-- Tab Content First -->
            <div id="radykal-upcoming-gigs" class="tabbed-widget-content">
                <ul class="gigs-list">
                    <?php
					    add_filter( 'posts_where', 'show_upcoming_gigs' );
						$gigs_query = new WP_Query( 'posts_per_page='.$number.'&post_type=gig&orderby=meta_value&meta_key=gig_date&order=ASC' );
						remove_filter( 'posts_where', 'show_upcoming_gigs' );
						
                        if ($gigs_query->have_posts()) : while ($gigs_query->have_posts()) : $gigs_query->the_post();
						
						//get custom fields
						$custom_fields = get_post_custom( get_the_ID() );
						$gig_date = new DateTime( $custom_fields["gig_date"][0]);
                    ?>
                    <li class="clearfix <?php if(!$gigs_query->current_post) echo 'no-top-margin'?>">
                        <div class="gig-date"><div class="gig-day"><?php echo $gig_date->format('d'); ?></div ><div class="gig-month"><?php echo $gig_date->format('M'); ?></div ></div>
                        <div class="gig-content">
                            <h4 class="gig-venue"><?php the_title(); ?></h4>
                            <span class="gig-text"><?php the_content(); ?></span>
                        </div>
                    </li>
                    <?php endwhile; endif; wp_reset_query(); ?>
                </ul>
            </div>
            
            <!-- Tab Content Last -->
            <div id="radykal-latest-releases" class="tabbed-widget-content">
                <ul class="record-list">
                    <?php 
                        $releases_query = new WP_Query('posts_per_page='.$number.'&post_type=release');
                        if ($releases_query->have_posts()) : while ($releases_query->have_posts()) : $releases_query->the_post(); 
                    ?>
                    <li class="clearfix record <?php if(!$releases_query->current_post) echo 'no-top-margin'?>">
						<?php if ( has_post_thumbnail() ) : $image_attributes = wp_get_attachment_image_src ( get_post_thumbnail_id ( get_the_ID() ), 'large');  ?>
                        <a href="<?php echo $image_attributes[0]; ?>" title="<?php the_title(); ?>" rel="prettyphoto"><?php the_post_thumbnail( 'thumbnail' ); ?></a>           
                        <?php endif; ?>
                        <div class="record-text"><?php the_content(); ?></div>
                    </li>
                    <?php endwhile; endif; wp_reset_query();?>
                </ul>
            </div>
            
        </div>
		<?php echo $after_widget; ?>
<?php
	
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['upcoming_gigs_title'] = strip_tags($new_instance['upcoming_gigs_title']);
		$instance['latest_releases_title'] = strip_tags($new_instance['latest_releases_title']);
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	function form( $instance ) {
		$upcoming_gigs_title = isset($instance['upcoming_gigs_title']) ? esc_attr($instance['upcoming_gigs_title']) : '';
		$latest_releases_title = isset($instance['latest_releases_title']) ? esc_attr($instance['latest_releases_title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
		<p><label for="<?php echo $this->get_field_id('upcoming_gigs_title'); ?>"><?php _e('Upcoming Gigs Title:', 'stylico'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('upcoming_gigs_title'); ?>" name="<?php echo $this->get_field_name('upcoming_gigs_title'); ?>" type="text" value="<?php echo $upcoming_gigs_title; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('latest_releases_title'); ?>"><?php _e('Latest Releases Title:', 'stylico'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('latest_releases_title'); ?>" name="<?php echo $this->get_field_name('latest_releases_title'); ?>" type="text" value="<?php echo $latest_releases_title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of items to show:', 'stylico'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}



/**
 * Popular Posts
 *
 */
class Radykal_Widget_Popular_Posts extends WP_Widget {

	function Radykal_Widget_Popular_Posts() {
		
		$widget_ops = array(
		    'classname' => 'radykal-widget-popular-posts', 
			'description' => __( "A widget with the most popular posts.", 'stylico') 
		);
		
		parent::__construct('radykal-popular-posts', __('Radykal - Popular Posts', 'stylico'), $widget_ops);
		
	}

	function widget($args, $instance) {
		
		extract($args);

		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		if ( ! $number = absint( $instance['number'] ) )
 			$number = 10;
			
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
?>
            
        <div id="radykal-popular-posts">
            <ul>
                <?php 
                    $popular_posts = new WP_Query(array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'orderby' => 'comment_count', 'order' => 'DESC'));
                    if ($popular_posts->have_posts()) : while ($popular_posts->have_posts()) : $popular_posts->the_post();
                ?>
                <li class="radykal-widget-popular-recent-post clearfix <?php if(!$popular_posts->current_post) echo 'no-top-margin'?>">
                    <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'thumbnail' ); ?>
                        <?php endif; ?>
                        <div>
                            <p class="radykal-widget-popular-recent-post-title"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></p>
                            <span class="radykal-widget-popular-recent-post-date"><?php the_time('jS M Y'); ?></span>
                            <span>-</span>
                            <span class="radykal-widget-popular-recent-post-comments"><?php comments_number(); ?></span>
                        </div>
                        
                    </a>
                </li>
                <?php endwhile; wp_reset_postdata(); endif;?>
            </ul>
        </div>
            
		<?php echo $after_widget; ?>
<?php
	
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stylico'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
        
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'stylico'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}



/**
 * Recent Posts
 *
 */
class Radykal_Widget_Recent_Posts extends WP_Widget {

	function Radykal_Widget_Recent_Posts() {
		
		$widget_ops = array(
		    'classname' => 'radykal-widget-recent-posts', 
			'description' => __( "A widget with the most recent posts.", 'stylico') 
		);
		
		parent::__construct('radykal-recent-posts', __('Radykal - Recent Posts', 'stylico'), $widget_ops);
		
	}

	function widget($args, $instance) {
		
		extract($args);

		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		if ( ! $number = absint( $instance['number'] ) )
 			$number = 10;
			
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }	
?>      
        <div id="radykal-recent-posts">
            <ul>
                <?php 
                    $recent_posts = new WP_Query(array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true));
                    if ($recent_posts->have_posts()) : while ($recent_posts->have_posts()) : $recent_posts->the_post(); 
                ?>
                <li class="radykal-widget-popular-recent-post clearfix <?php if(!$recent_posts->current_post) echo 'no-top-margin'?>">
                    <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'thumbnail' ); ?>
                        <?php endif; ?>
                        <div>
                            <p class="radykal-widget-popular-recent-post-title"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></p>
                            <span class="radykal-widget-popular-recent-post-date"><?php the_time('jS M Y'); ?></span>
                            <span>-</span>
                            <span class="radykal-widget-popular-recent-post-comments"><?php comments_number(); ?></span>
                        </div>
                        
                    </a>
                </li>
                <?php endwhile; wp_reset_postdata(); endif;?>
            </ul>
        </div>
            
		<?php echo $after_widget; ?>
<?php
	
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
        
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stylico'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'stylico'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}


/**
 * Next Gigs widget
 *
 */
class Radykal_Widget_Upcoming_Gigs extends WP_Widget {

	function Radykal_Widget_Upcoming_Gigs() {
		
		$widget_ops = array(
		    'classname' => 'radykal-widget-upcoming-gigs', 
			'description' => __( "A widget with the upcoming Gigs.", 'stylico') 
		);
		
		parent::__construct('radykal-widget-upcoming-gigs-releases', __('Radykal - Upcoming Gigs', 'stylico'), $widget_ops);
		
	}

	function widget($args, $instance) {
		
		extract($args);

		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		if ( ! $number = absint( $instance['number'] ) )
 			$number = 10;
			
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
?>
        <div id="radykal-upcoming-gigs">
            <ul class="gigs-list">
                <?php
                    add_filter( 'posts_where', 'show_upcoming_gigs' );
                    $gigs_query = new WP_Query( 'posts_per_page='.$number.'&post_type=gig&orderby=meta_value&meta_key=gig_date&order=ASC' );
                    remove_filter( 'posts_where', 'show_upcoming_gigs' );
                    
                    if ($gigs_query->have_posts()) : while ($gigs_query->have_posts()) : $gigs_query->the_post();
                    
                    //get custom fields
                    $custom_fields = get_post_custom( get_the_ID() );
                    $gig_date = new DateTime( $custom_fields["gig_date"][0]);
                ?>
                <li class="clearfix <?php if(!$gigs_query->current_post) echo 'no-top-margin'?>">
                    <div class="gig-date"><div class="gig-day"><?php echo $gig_date->format('d'); ?></div ><div class="gig-month"><?php echo $gig_date->format('M'); ?></div ></div>
                    <div class="gig-content">
                        <h4 class="gig-venue"><?php the_title(); ?></h4>
                        <span class="gig-text"><?php the_content(); ?></span>
                    </div>
                </li>
                <?php endwhile; endif; wp_reset_query(); ?>
            </ul>
        </div>

		<?php echo $after_widget; ?>
<?php
	
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stylico'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of gigs to show:', 'stylico'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}



/**
 * Latest Releases widget
 *
 */
class Radykal_Widget_Recent_Releases extends WP_Widget {

	function Radykal_Widget_Recent_Releases() {
		
		$widget_ops = array(
		    'classname' => 'widget-recent-releases', 
			'description' => __( "A widget with the latest Releases.", 'stylico') 
		);
		
		parent::__construct('radykal-widget-recent-releases', __('Radykal - Recent Releases', 'stylico'), $widget_ops);
		
	}

	function widget($args, $instance) {
		
		extract($args);

		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		if ( ! $number = absint( $instance['number'] ) )
 			$number = 10;
			
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }	
?>
        <div id="radykal-latest-releases">
            <ul class="record-list">
                <?php 
                    $releases_query = new WP_Query('posts_per_page='.$number.'&post_type=release');
                    if ($releases_query->have_posts()) : while ($releases_query->have_posts()) : $releases_query->the_post(); 
                ?>
                <li class="clearfix record <?php if(!$releases_query->current_post) echo 'no-top-margin'?>">
                    <?php if ( has_post_thumbnail() ) : $image_attributes = wp_get_attachment_image_src ( get_post_thumbnail_id ( get_the_ID() ), 'large');  ?>
                    <a href="<?php echo $image_attributes[0]; ?>" title="<?php the_title(); ?>" rel="prettyphoto"><?php the_post_thumbnail( 'thumbnail' ); ?></a>           
                    <?php endif; ?>
                    <div class="record-text"><?php the_content(); ?></div>
                </li>
                <?php endwhile; endif; wp_reset_query();?>
            </ul>
        </div>
            
		<?php echo $after_widget; ?>
<?php
	
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stylico'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of items to show:', 'stylico'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}


add_action( 'widgets_init', 'radykal_widgets_init' );

function radykal_widgets_init() {

	register_widget('Radykal_Widget_Popular_Recent_Posts');
	
	register_widget('Radykal_Widget_Gigs_Releases');
	
	register_widget('Radykal_Widget_Popular_Posts');
	
	register_widget('Radykal_Widget_Recent_Posts');
	
	register_widget('Radykal_Widget_Upcoming_Gigs');
	
	register_widget('Radykal_Widget_Recent_Releases');
	
}

?>