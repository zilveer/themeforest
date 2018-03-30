<?php

function creativeclean_add_javascripts() {
  wp_enqueue_scripts('jquery');
  wp_enqueue_script( 'tabs', get_template_directory_uri('template_directory') . '/scripts/tabs.js', array('jquery', 'jquery-ui-core', 'jquery-ui-tabs'), '1.0');
  wp_enqueue_script( 'jqfancytransitions', get_template_directory_uri('template_directory').'/script/jqFancyTransitions.js', array( 'jquery' ) );
  wp_enqueue_script( 'cufon-yui', get_template_directory_uri('template_directory').'/script/cufon-yui.js', array( 'jquery' ) );
  wp_enqueue_script( 'Quicksand.font', get_template_directory_uri('template_directory').'/script/Quicksand.font.js', array( 'jquery' ) );
  wp_enqueue_script( 'twitter', get_template_directory_uri('template_directory').'/script/twitter.js', array( 'jquery' ) );
  wp_enqueue_script( 'lightbox', get_template_directory_uri('template_directory').'/script/lightbox.js', array( 'jquery' ) );
  wp_enqueue_script( 'validation', get_template_directory_uri('template_directory').'/script/jquery.validate.js', array( 'jquery' ) );
  wp_enqueue_script( 'comment-reply' ); 
}
if (!is_admin()) {
  add_action( 'wp_print_scripts', 'creativeclean_add_javascripts' ); 
}

add_action( 'init', 'my_custom_menus' );

function my_custom_menus() {
	register_nav_menus(
		array(
			'main-navigation' => __( 'Main Navigation' ),
			'footer-navigation' => __( 'Footer Navigation' )
		)
	);
}

remove_filter ('category_description', 'wptexturize');
remove_filter ('list_cats', 'wptexturize');
remove_filter ('comment_author', 'wptexturize');
remove_filter ('comment_text', 'wptexturize');
remove_filter ('the_title', 'wptexturize');
remove_filter ('the_content', 'wptexturize');
remove_filter ('the_excerpt', 'wptexturize');

function convert_smart_quotes($string) 
{ 
    $search = array("\'", 
                    '\"', 
                    ); 
 
    $replace = array("'", 
                     '"'); 
 
    return str_replace($search, $replace, $string); 
}

function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_length($length) {
	return 45;
}
add_filter('excerpt_length', 'new_excerpt_length');

add_theme_support( 'automatic-feed-links' );

/* Featured Images for Posts, Testimonial and Portfolio
=====================================================================*/

add_theme_support( 'post-thumbnails', array( 'post', 'testimonial', 'portfolio', 'team' ) );
add_image_size( 'posts-thumb1', 155, 155, true );
add_image_size( 'posts-thumb2', 48, 48, true );
add_image_size( 'testimonial-thumb1', 98, 98, true );
add_image_size( 'testimonial-thumb2', 42, 42, true );
add_image_size( 'testimonial-thumb3', 64, 64, true );
add_image_size( 'team-thumb1', 108, 108, true );
add_image_size( 'team-thumb2', 48, 48, true );
add_image_size( 'portfolio-thumb1', 565, 308, true );
add_image_size( 'portfolio-thumb2', 215, 141, true );
add_image_size( 'portfolio-thumb3', 209, 132, true );


/* Post Format Wordpress 3.1
=====================================================================*/

add_theme_support( 'post-formats', array( 'gallery' ) );
add_post_type_support( 'news', 'post-formats' );

/* Remove "role" in search widget for validation purpose
=====================================================================*/

function valid_search_form ($form) {
    return str_replace('role="search" ', '', $form);
}
add_filter('get_search_form', 'valid_search_form');


/* Comments & Pingback
=====================================================================*/

function creativeclean_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<div class="placeavatarcomment">
			<?php echo get_avatar( $comment, 48 ); ?>
		</div>
		<div class="placecomment">
			<div class="placetitlecomment">
				<h4><?php comment_author_link(); ?></h4>
				<span class="datecomment"><?php comment_date();?> <?php comment_time(); ?></span>
				<div class="clear"></div>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'creativeclean' ); ?></em>
				<br />
			<?php endif; ?>
			<?php comment_text(); ?>
		</div><!-- .comment-author .vcard -->
		<div class="clear"></div>
		<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div><!-- #comment-##  -->
	<div class="clear"></div>
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'creativeclean' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'creativeclean'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}


/* Widget
=====================================================================*/

function creativeclean_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar Pages', 'creativeclean' ),
		'id' => 'sidebar-pages',
		'description' => __( 'Sidebar pages widget area', 'creativeclean' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s boxnav">',
		'after_widget' => '<div class="clear"></div></div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="contentnav">',
	) );
	
	register_sidebar( array(
		'name' => __( 'Sidebar Blog Posts', 'creativeclean' ),
		'id' => 'sidebar-blog-posts',
		'description' => __( 'Sidebar blog posts widget area', 'creativeclean' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s boxnav">',
		'after_widget' => '<div class="clear"></div></div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="contentnav">',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Box 1', 'creativeclean' ),
		'id' => 'footer-box-1',
		'description' => __( 'Footer box 1 widget area (Please use 1 widget only)', 'creativeclean' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s boxfooter">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Box 2', 'creativeclean' ),
		'id' => 'footer-box-2',
		'description' => __( 'Footer box 2 widget area (Please use 1 widget only)', 'creativeclean' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s boxfooter">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
	

}
add_action( 'widgets_init', 'creativeclean_widgets_init' );


/* Widget: Creativeclean Text Widget */

class CC_Widget_Text extends WP_Widget {

	function CC_Widget_Text() {
		$widgets_opt = array('description'=>'Widget to show text and image.');
		parent::WP_Widget(false,$name= "Creativeclean Text Widget",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$text = apply_filters( 'widget_text', $instance['text'], $instance );
		$image = apply_filters( 'widget_image', $instance['image'], $instance );
		$pageid = apply_filters('pageid', $instance['pageid'], $instance);
		
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
			echo "<div class=\"textwidget\">";
			if ( !empty( $image ) ) {
				?>
				<img src="<?php echo $image ?>" alt="<?php echo $title ?>" class="alignleft imgframe" />
				<?php
			}
			echo $instance['filter'] ? wpautop($text) : $text;
			if ( !empty( $pageid ) ) {
				?>
				<a href="<?php echo get_page_link($pageid);?>" class="butmore">Read more</a>
				<?php
			}
			echo "</div>";
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['pageid'] = strip_tags($new_instance['pageid']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'image' => '', 'pageid' => '' ) );
		$title = strip_tags($instance['title']);
		$text = format_to_edit($instance['text']);
		$image = esc_attr($instance['image']);
		$pageid = esc_attr($instance['pageid']);
		
		$pages = get_pages();
		$listpages = array();
		foreach ($pages as $pagelist ) {
		   $listpages[$pagelist->ID] = $pagelist->post_title;
		}
		
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image URL:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo esc_attr($image); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs'); ?></label></p>
		<p><label for="<?php echo $this->get_field_name('pageid'); ?>">Link goes to:</label>
		<select  name="<?php echo $this->get_field_name('pageid'); ?>"  id="<?php echo $this->get_field_id('pageid'); ?>" class="widefat" >
			<?php foreach ($listpages as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $pageid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("CC_Widget_Text");'));



/* Widget: Creativeclean Twitter Widget */

class CC_Widget_Twitter extends WP_Widget {

	function CC_Widget_Twitter() {
		$widgets_opt = array('description'=>'Widget to show latest Twitter post.');
		parent::WP_Widget(false,$name= "Creativeclean Twitter Widget",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$username = apply_filters( 'widget_username', $instance['username'], $instance );
		$totaltwitter = apply_filters( 'widget_totaltwitter', $instance['totaltwitter'], $instance );
		$followus = apply_filters( 'widget_followus', $instance['followus'], $instance );
		
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
			if ( !empty( $username ) ) {
				?>
				<script type="text/javascript">
					getTwitters('<?php echo $args['widget_id'] ?>-twit', { 
					id: '<?php echo $username ?>', 
					count: <?php echo $totaltwitter ?>, 
					enableLinks: true, 
					ignoreReplies: true, 
					clearContents: true
				});
				</script>
				<div id="<?php echo $args['widget_id'] ?>-twit" class="texttwitter">
					<ul>
						<li>Loading Twitter</li>
					</ul>
				</div>
				<?php
			}
			if ( !empty( $followus ) ) {
				?>
				<a href="http://www.twitter.com/<?php echo $username ?>" class="butmore"><?php echo $followus ?></a>
				<?php
			}
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['totaltwitter'] = strip_tags($new_instance['totaltwitter']);
		$instance['followus'] = strip_tags($new_instance['followus']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'username' => '', 'totaltwitter' => '', 'followus' => '' ) );
		$title = strip_tags($instance['title']);
		$username = strip_tags($instance['username']);
		$followus = strip_tags($instance['followus']);
		$totaltwitter = (int)($instance['totaltwitter']);
		if ( $totaltwitter < 1 || 10 < $totaltwitter )
			$totaltwitter  = 2;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter Username:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('followus'); ?>"><?php _e('"Follow Us" Button Text:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('followus'); ?>" name="<?php echo $this->get_field_name('followus'); ?>" type="text" value="<?php echo esc_attr($followus); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('totaltwitter'); ?>">Number of Tweets:</label>
		<select  name="<?php echo $this->get_field_name('totaltwitter'); ?>"  id="<?php echo $this->get_field_id('totaltwitter'); ?>" class="widefat" >
		<?php
		for ( $i = 1; $i <= 10; ++$i )
			echo "<option value='$i' " . ( $totaltwitter == $i ? "selected='selected'" : '' ) . ">$i</option>";
		?>
		</select></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("CC_Widget_Twitter");'));


/* Widget: Creativeclean News Widget */

class CC_Widget_News extends WP_Widget {

	function CC_Widget_News() {
		$widgets_opt = array('description'=>'Widget to show latest post with featured images.');
		parent::WP_Widget(false,$name= "Creativeclean News Widget",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$totalnews = apply_filters( 'widget_totalnews', $instance['totalnews'], $instance );
		$pageid = apply_filters('pageid', $instance['pageid'], $instance);
		
		$r = new WP_Query(array('showposts' => $totalnews, 'nopaging' => 0, 'post_status' => 'publish', 'caller_get_posts' => 1));
		if ($r->have_posts()) :
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
		echo "<ul class=\"listnewswidget\">";
		while ($r->have_posts()) : $r->the_post(); ?>
					<li>
						<?php the_post_thumbnail('posts-thumb2'); ?>
						<div class="contentnewswidget">
							<h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
							<span class="datenewswidget"><?php the_time('d F Y');?></span>
						</div>
						<div class="clear"></div>
					</li>
		<?php endwhile; ?>
		</ul>
		<?php
		if ( !empty( $pageid ) ) : ?>
			<a href="<?php echo get_page_link($pageid);?>" class="butmore">Read more</a>
		<?php endif; ?>
		<?php
	
		echo $after_widget;
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['totalnews'] = strip_tags($new_instance['totalnews']);
		$instance['pageid'] = strip_tags($new_instance['pageid']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'totalnews' => '', 'pageid' => '' ) );
		$title = strip_tags($instance['title']);
		$totalnews = strip_tags($instance['totalnews']);
		$pageid = strip_tags($instance['pageid']);
		
		$pages = get_pages();
		$listpages = array();
		foreach ($pages as $pagelist ) {
		   $listpages[$pagelist->ID] = $pagelist->post_title;
		}
		
		$totalnews = (int)($instance['totalnews']);
		if ( $totalnews < 1 || 10 < $totalnews )
			$totalnews  = 3;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('totalnews'); ?>">Number of posts to show:</label>
		<select  name="<?php echo $this->get_field_name('totalnews'); ?>"  id="<?php echo $this->get_field_id('totalnews'); ?>" class="widefat" >
		<?php
		for ( $i = 1; $i <= 10; ++$i )
			echo "<option value='$i' " . ( $totalnews == $i ? "selected='selected'" : '' ) . ">$i</option>";
		?>
		</select></p>
		<p><label for="<?php echo $this->get_field_name('pageid'); ?>">Link goes to:</label>
		<select  name="<?php echo $this->get_field_name('pageid'); ?>"  id="<?php echo $this->get_field_id('pageid'); ?>" class="widefat" >
			<?php foreach ($listpages as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $pageid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("CC_Widget_News");'));



/* Widget: Creativeclean Random Testimonial */

class CC_Widget_Testimonial extends WP_Widget {

	function CC_Widget_Testimonial() {
		$widgets_opt = array('description'=>'Widget to show random testimonial.');
		parent::WP_Widget(false,$name= "Creativeclean Random Testimonial",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
		
		$loop = new WP_Query(array('post_type' => 'testimonial', 'posts_per_page' => 1, 'orderby' => 'rand' )); 
		while ( $loop->have_posts() ) : $loop->the_post(); 
			$custom = get_post_custom(isset($post->ID));
			$screenshot_url = isset($custom["screenshot_url"][0]) ? $custom["screenshot_url"][0] : false;
			$website_url_testimonial = isset($custom["website_url_testimonial"][0]) ? $custom["website_url_testimonial"][0] : false;
			$company_name = isset($custom["company_name"][0]) ? $custom["company_name"][0] : false;
			?>
			<div class="boxtestiwidget">
			<?php the_content(); ?>
			<p class="testimonialname">
				<?php the_post_thumbnail('testimonial-thumb2'); ?>
			<strong><?php echo $company_name ?></strong><br />
			<a href="<?php echo $website_url_testimonial ?>"><span><?php echo $website_url_testimonial ?></span></a>
			</p>
			</div>

		<?php endwhile;
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'image' => '' ) );
		$title = strip_tags($instance['title']);

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("CC_Widget_Testimonial");'));


/* Widget: Creativeclean Team Widget */

class CC_Widget_Team extends WP_Widget {

	function CC_Widget_Team() {
		$widgets_opt = array('description'=>'Widget to show latest team.');
		parent::WP_Widget(false,$name= "Creativeclean Team Widget",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$totalteam = apply_filters( 'widget_totalteam', $instance['totalteam'], $instance );
		$pageid = apply_filters('pageid', $instance['pageid'], $instance);
		
		$r = new WP_Query(array('post_type' => 'team', 'order' => 'ASC', 'showposts' => $totalteam, 'nopaging' => 0, 'post_status' => 'publish', 'caller_get_posts' => 1));
		if ($r->have_posts()) :
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
		echo "<ul class=\"listteamwidget\">";
		while ($r->have_posts()) : $r->the_post(); ?>
			<?php
			$custom = get_post_custom(isset($post->ID));
			$position = isset($custom["position"][0]) ? $custom["position"][0] : false;
			?>
					<li>
						<?php the_post_thumbnail('team-thumb2'); ?>
						<div class="teamnav">
							<h4><?php the_title();?></h4>
							<h5><?php echo $position ?></h5>
							<?php the_content(); ?>
						</div>
						<div class="clear"></div>
					</li>
		<?php endwhile; ?>
		</ul>
		<?php
		if ( !empty( $pageid ) ) : ?>
			<a href="<?php echo get_page_link($pageid);?>" class="butmore">Read more</a>
		<?php endif; ?>
		<?php
	
		echo $after_widget;
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['totalteam'] = strip_tags($new_instance['totalteam']);
		$instance['pageid'] = strip_tags($new_instance['pageid']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'totalteam' => '', 'pageid' => '' ) );
		$title = strip_tags($instance['title']);
		$totalteam = strip_tags($instance['totalteam']);
		$pageid = strip_tags($instance['pageid']);
		
		$pages = get_pages();
		$listpages = array();
		foreach ($pages as $pagelist ) {
		   $listpages[$pagelist->ID] = $pagelist->post_title;
		}
		
		$totalteam = (int)($instance['totalteam']);
		if ( $totalteam < 1 || 10 < $totalteam )
			$totalteam  = 3;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('totalteam'); ?>">Number of team to show:</label>
		<select  name="<?php echo $this->get_field_name('totalteam'); ?>"  id="<?php echo $this->get_field_id('totalteam'); ?>" class="widefat" >
		<?php
		for ( $i = 1; $i <= 10; ++$i )
			echo "<option value='$i' " . ( $totalteam == $i ? "selected='selected'" : '' ) . ">$i</option>";
		?>
		</select></p>
		<p><label for="<?php echo $this->get_field_name('pageid'); ?>">Link goes to:</label>
		<select  name="<?php echo $this->get_field_name('pageid'); ?>"  id="<?php echo $this->get_field_id('pageid'); ?>" class="widefat" >
			<?php foreach ($listpages as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $pageid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("CC_Widget_Team");'));


/* Widget: Creativeclean Latest Portfolio */

class CC_Widget_Portfolio extends WP_Widget {

	function CC_Widget_Portfolio() {
		$widgets_opt = array('description'=>'Widget to show latest portfolio.');
		parent::WP_Widget(false,$name= "Creativelclean Latest Portfolio",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$pageid = apply_filters('pageid', $instance['pageid'], $instance);
		$totalportfolio = apply_filters( 'widget_totalportfolio', $instance['totalportfolio'], $instance );
		
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
		
		$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => $totalportfolio ));
		?>
		<ul class="listportfolionav">
		<?php
		while ( $loop->have_posts() ) : $loop->the_post(); 
			$custom = get_post_custom(isset($post->ID));
			$screenshot_url = isset($custom["screenshot_url"][0]) ? $custom["screenshot_url"][0] : false ;
			$src = wp_get_attachment_image_src( get_post_thumbnail_id(isset($post->ID)), array( 650,480 ), false, '' );
			?>
			<li>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('portfolio-thumb3'); ?></a>
			</li>

		<?php endwhile;?>
		</ul>
		<div class="clear"></div>
		<?php
		if ( !empty( $pageid ) ) {
			?>
			<a href="<?php echo get_page_link($pageid);?>" class="butmore">Portfolio</a>
			<?php
		}
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['pageid'] = strip_tags($new_instance['pageid']);
		$instance['totalportfolio'] = strip_tags($new_instance['totalportfolio']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'totalportfolio' =>'', 'pageid' => '' ) );
		$title = strip_tags($instance['title']);
		
		$pages = get_pages();
		$pageid = esc_attr($instance['pageid']);
		$listpages = array();
		foreach ($pages as $pagelist ) {
		   $listpages[$pagelist->ID] = $pagelist->post_title;
		}
		$totalportfolio = (int)($instance['totalportfolio']);
		if ( $totalportfolio < 1 || 10 < $totalportfolio )
			$totalportfolio  = 2;

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('totalportfolio'); ?>">Number of Portfolio:</label>
		<select  name="<?php echo $this->get_field_name('totalportfolio'); ?>"  id="<?php echo $this->get_field_id('totalportfolio'); ?>" class="widefat" >
		<?php
		for ( $i = 1; $i <= 10; ++$i )
			echo "<option value='$i' " . ( $totalportfolio == $i ? "selected='selected'" : '' ) . ">$i</option>";
		?>
		</select></p>
		<p><label for="<?php echo $this->get_field_name('pageid'); ?>">Link goes to:</label>
		<select  name="<?php echo $this->get_field_name('pageid'); ?>"  id="<?php echo $this->get_field_id('pageid'); ?>" class="widefat" >
			<?php foreach ($listpages as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $pageid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("CC_Widget_Portfolio");'));



/* Custom Post: Service
=====================================================================*/
	add_action('init', 'cc_service');
 
	function cc_service() {
 
	$labels = array(
		'name' => _x('Services', 'post type general name'),
		'singular_name' => _x('Service', 'post type singular name'),
		'add_new' => _x('Add New', 'service'),
		'add_new_item' => __('Add New Service'),
		'edit_item' => __('Edit Service'),
		'new_item' => __('New Service'),
		'view_item' => __('View Service'),
		'search_items' => __('Search Service'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title','editor')
	  ); 
 
	register_post_type( 'service' , $args );
}
 
function service_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
}

add_action('save_post', 'save_service');

function save_service(){
  global $post;

}


add_action("manage_posts_custom_column",  "service_custom_columns");
add_filter("manage_edit-service_columns", "service_edit_columns");
 
function service_edit_columns($columnsservice){
  $columnsservice = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Title",
    "description" => "Service",
  );
 
  return $columnsservice;
}
function service_custom_columns($columnservice){
  global $post;
 
  switch ($columnservice) {
    case "description":
      the_excerpt();
      break;
  }
}


/* Custom Post: FAQ
=====================================================================*/
add_action('init', 'cc_faq');
 
function cc_faq() {
 
	$labels = array(
		'name' => _x('FAQ', 'post type general name'),
		'singular_name' => _x('FAQ', 'post type singular name'),
		'add_new' => _x('Add New', 'faq'),
		'add_new_item' => __('Add New FAQ'),
		'edit_item' => __('Edit FAQ'),
		'new_item' => __('New FAQ'),
		'view_item' => __('View FAQ'),
		'search_items' => __('Search FAQ'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title','editor')
	  ); 
 
	register_post_type( 'faq' , $args );
}
 
function faq_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
}

add_action('save_post', 'save_faq');

function save_faq(){
  global $post;

}


add_action("manage_posts_custom_column",  "faq_custom_columns");
add_filter("manage_edit-faq_columns", "faq_edit_columns");
 
function faq_edit_columns($columnsfaq){
  $columnsfaq = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Title",
    "description" => "FAQ",
  );
 
  return $columnsfaq;
}
function faq_custom_columns($columnfaq){
  global $post;
 
  switch ($columnfaq) {
    case "description":
    
      break;
  }
}

/* Custom Post: Testimonial
=====================================================================*/
	add_action('init', 'cc_testimonial');
 
	function cc_testimonial() {
 
	$labels = array(
		'name' => _x('Testimonial', 'post type general name'),
		'singular_name' => _x('Testimonial', 'post type singular name'),
		'add_new' => _x('Add New', 'testimonial'),
		'add_new_item' => __('Add New Testimonial'),
		'edit_item' => __('Edit Testimonial'),
		'new_item' => __('New Testimonial'),
		'view_item' => __('View Testimonial'),
		'search_items' => __('Search Testimonial'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title','editor','thumbnail')
	  ); 
 
	register_post_type( 'testimonial' , $args );
}

function testimonial_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $company_name = isset($custom["company_name"][0]) ? $custom["company_name"][0] : false;
  $website_url_testimonial = isset($custom["website_url_testimonial"][0]) ? $custom["website_url_testimonial"][0] :false;
  ?>
  <p class="cc_custom_p"><label for="txtcompany">Company Name:</label> <input type="text" name="company_name" value="<?php echo $company_name; ?>" id="txtcompany" /></p>
  <p class="cc_custom_p"><label for="txturl">Website URL:</label> <input type="text" name="website_url_testimonial" value="<?php echo $website_url_testimonial; ?>" id="txturl" /></p>
 
  <?php
}

add_action('save_post', 'save_testimonial');

function save_testimonial(){
  	global $post;
  
  	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    	if (isset($post_id)) {
    		return $post_id;
    	}
	if(isset($_POST['company_name'])) {
  		update_post_meta($post->ID, "company_name", $_POST["company_name"]);
  		update_post_meta($post->ID, "website_url_testimonial", $_POST["website_url_testimonial"]);
  	}
}


add_action("manage_posts_custom_column",  "testimonial_custom_columns");
add_filter("manage_edit-testimonial_columns", "testimonial_edit_columns");
 
function testimonial_edit_columns($columnstestimonial){
  $columnstestimonial = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Name",
    "company_name" => "Company Name",
    "website_url_testimonial" => "Website",
  );
 
  return $columnstestimonial;
}
function testimonial_custom_columns($columntestimonial){
  global $post;
 
  switch ($columntestimonial) {
    case "company_name":
      $custom = get_post_custom();
      echo $custom["company_name"][0];
      break;
    case "website_url_testimonial":
      $custom = get_post_custom();
      echo $custom["website_url_testimonial"][0];
      break;
  }
}

/* Custom Post: Team
=====================================================================*/
	add_action('init', 'cc_team');
 
	function cc_team() {
 
	$labels = array(
		'name' => _x('Team', 'post type general name'),
		'singular_name' => _x('Team', 'post type singular name'),
		'add_new' => _x('Add New', 'team'),
		'add_new_item' => __('Add New Team'),
		'edit_item' => __('Edit Team'),
		'new_item' => __('New Team'),
		'view_item' => __('View Team'),
		'search_items' => __('Search Team'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title','editor','thumbnail')
	  ); 
 
	register_post_type( 'team' , $args );
}

function team_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $position = isset($custom["position"][0]) ? $custom["position"][0] : false;
  $twitter_url = isset($custom["twitter_url"][0]) ? $custom["twitter_url"][0] : false;
  $linkedin_url = isset($custom["linkedin_url"][0]) ? $custom["linkedin_url"][0] : false;
  $facebook_url = isset($custom["facebook_url"][0]) ? $custom["facebook_url"][0] : false;
  ?>
  <p class="cc_custom_p"><label for="txtposition">Position:</label> <input type="text" name="position" value="<?php echo $position; ?>" id="txtcompany" /></p>
  <p class="cc_custom_p"><label for="txttwitter">Twitter URL:</label> <input type="text" name="twitter_url" value="<?php echo $twitter_url; ?>" id="txttwitter" /></p>
  <p class="cc_custom_p"><label for="txtlinkedin">Linkedin URL:</label> <input type="text" name="linkedin_url" value="<?php echo $linkedin_url; ?>" id="txtlinkedin" /></p>
  <p class="cc_custom_p"><label for="txtlinkedin">Facebook URL:</label> <input type="text" name="facebook_url" value="<?php echo $facebook_url; ?>" id="txtfacebook" /></p>
 
  <?php
}

add_action('save_post', 'save_team');

function save_team(){
	global $post;
  
  	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    	if (isset($post_id)) {
    		return $post_id;
    	}
	if(isset($_POST['position'])) {
		update_post_meta($post->ID, "position", $_POST["position"]);
  		update_post_meta($post->ID, "twitter_url", $_POST["twitter_url"]);
  		update_post_meta($post->ID, "linkedin_url", $_POST["linkedin_url"]);
  		update_post_meta($post->ID, "facebook_url", $_POST["facebook_url"]);
  	}
}


add_action("manage_posts_custom_column",  "team_custom_columns");
add_filter("manage_edit-team_columns", "team_edit_columns");
 
function team_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Name",
    "position" => "Position"
  );
 
  return $columns;
}
function team_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "position":
      $custom = get_post_custom();
      echo $custom["position"][0];
      break;
  }
}


/* Custom Post: Portfolio
=====================================================================*/
	add_action('init', 'cc_portfolio');
 
	function cc_portfolio() {
 
	$labels = array(
		'name' => _x('Portfolio', 'post type general name'),
		'singular_name' => _x('Portfolio', 'post type singular name'),
		'add_new' => _x('Add New', 'portfolio'),
		'add_new_item' => __('Add New Portfolio'),
		'edit_item' => __('Edit Portfolio'),
		'new_item' => __('New Portfolio'),
		'view_item' => __('View Portfolio'),
		'search_items' => __('Search Portfolio'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title','editor','thumbnail')
	  ); 
 
	register_post_type( 'portfolio' , $args );
}

function portfolio_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $website_url_portfolio = isset($custom["website_url_portfolio"][0]) ? $custom["website_url_portfolio"][0] : false;
  ?>
  <p class="cc_custom_p"><label for="txturl">Website URL:</label> <input type="text" name="website_url_portfolio" value="<?php echo $website_url_portfolio; ?>" id="txturl" /></p>
 
  <?php
}

add_action('save_post', 'save_portfolio');

function save_portfolio(){
 	global $post;
  
 	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    	if (isset($post_id)) {
    		return $post_id;
    	}
	if(isset($_POST['website_url_portfolio'])) {
 		update_post_meta($post->ID, "website_url_portfolio", $_POST["website_url_portfolio"]);
 	}
}


add_action("manage_posts_custom_column",  "portfolio_custom_columns");
add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");
 
function portfolio_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Name",
    "description" => "Portfolio",
    "website_url_portfolio" => "Website"
  );
 
  return $columns;
}
function portfolio_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "website_url_portfolio":
      $custom = get_post_custom();
      echo $custom["website_url_portfolio"][0];
      break;
  }
}

/* Admin Initialisation for Custom Post
=====================================================================*/
add_action("admin_init", "admin_init");
 
function admin_init(){
  	add_meta_box("service_meta", "Service Options", "service_meta", "service", "normal", "low");
  	add_meta_box("faq_meta", "FAQ Options", "faq_meta", "faq", "normal", "low");
  	add_meta_box("testimonial_meta", "Testimonial Options", "testimonial_meta", "testimonial", "normal", "low");
  	add_meta_box("team_meta", "Team Options", "team_meta", "team", "normal", "low");
  	add_meta_box("portfolio_meta", "Portfolio Options", "portfolio_meta", "portfolio", "normal", "low");
}


/* Shortcodes
=====================================================================*/
function ccbutton($atts, $content = null) {
	extract(shortcode_atts(array(
		"href" => 'http://',
		"position" => 'alignleft'
	), $atts));
	return '<a href="'.$href.'" class="button '.$position.'">'.do_shortcode($content).'</a><div class="clear"></div>';
}
add_shortcode("button", "ccbutton");


function ccquote($atts, $content = null) {
	extract(shortcode_atts(array(
        "position" => 'fullsize'
	), $atts));
	return '<blockquote class="'.$position.'"><p>'.do_shortcode($content).'</p></blockquote>';
}
add_shortcode('quotes', 'ccquote');

function ccdropcap($atts, $content = null) {
	extract(shortcode_atts(array(
        "size" => 'medium'
	), $atts));
	return '<p><span class="dropcap '.$size.'">'.do_shortcode($content).'</span>';
}
add_shortcode('dropcap', 'ccdropcap');

function ccsep() {
    return '<div class="separator"></div>';
}
add_shortcode('separator', 'ccsep');

function ccseptop($atts, $content = null) {
    extract(shortcode_atts(array(
		"top" => 'Top'
	), $atts));
	return '<div class="separator"><a href="#">'.do_shortcode($content).'</a></div>';
}
add_shortcode('separatortop', 'ccseptop');

function cccolumns($atts, $content = null) {
	extract(shortcode_atts(array(
		"width" => 'half',
		"last" => ''
	), $atts));
	if ($last==''):
		return '<div class="'.$width.'">'.do_shortcode($content).'</div>';
	elseif ($last=='true'):
		return '<div class="'.$width.' '.$last.'">'.do_shortcode($content).'</div><div class="clear"></div>';
	else:
		return '<div class="'.$width.'">'.do_shortcode($content).'</div>';
	endif;
}
add_shortcode("columns", "cccolumns");

/* CreativeClean Settings
=====================================================================*/
$themename = "creativeclean";
$shortname = "cc";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category"); 

$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 

array( "name" => "GENERAL",
    "desc" => "This is the general setting for your theme.",
	"type" => "section"),
array( "type" => "open"),
 
array( "name" => "Colour Scheme",
	"desc" => "Select the colour scheme for the theme",
	"id" => $shortname."_color_scheme",
	"type" => "select",
	"options" => array("Blue", "Green", "Red"),
	"std" => "Blue"),

array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; Browse images for your .ico image that you want to use as the favicon",
	"id" => $shortname."_favicon",
	"type" => "__FILE__",
	"std" => ""),

array( "name" => "Favicon",
	"desc" => "",
	"id" => $shortname."_favicon",
	"type" => "remove",
	"std" => ""),	
	
array( "name" => "Logo URL",
	"desc" => "Browse images for your logo image, size must be <strong>252x67</strong> pixel",
	"id" => $shortname."_logo",
	"type" => "__FILE__",
	"std" => ""),

array( "name" => "Logo",
	"desc" => "",
	"id" => $shortname."_logo",
	"type" => "remove",
	"std" => ""),

array( "name" => "Sidebar Position",
	"id" => $shortname."_sidebar",
	"type" => "select",
	"options" => array("Left", "Right"),
	"std" => "Right"),

array( "name" => "Slideshow Style",
	"id" => $shortname."_slideshow_style",
	"type" => "select",
	"options" => array("Slideshow 1", "Slideshow 2"),
	"std" => "Slideshow 1"),
	
array( "name" => "RTL Layout",
	"desc" => "RTL (Right to Left) Layout for Arabic and Hebrew, check to activate it.",
	"id" => $shortname."_rtl",
	"type" => "checkbox",
	"std" => "false"),

array( "name" => "Disable Cufon",
	"desc" => "Disable Cufon for title, it will replace with standard Arial font",
	"id" => $shortname."_cufon",
	"type" => "checkbox",
	"std" => "false"),
	
array( "type" => "close"),


array( "name" => "SLIDESHOW 1",
	  "desc" => "You need to setup this setting if you choose Slideshow 1. Slideshow 1 have 4 content. You can fill with text and images for content 1 & 2. You can select built-in content (Portfolio, Testimonial & News) for content 3 & 4",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Slide 1 Title",
	"desc" => "Enter the text for title and tabs",
	"id" => $shortname."_slide1_title",
	"group" => "group",
	"type" => "text",
	"std" => ""),

array( "name" => "Slide 1 Content Text",
	"desc" => "Use &lt;p&gt; ... &lt;/p&gt; to add paragraph.",
	"id" => $shortname."_slide1_content",
	"group" => "group",
	"type" => "textarea",
	"std" => ""),

array( "name" => "Slide 1 Images",
	"desc" => "Browse image used for slide 1. Size must be <strong>306 x 168</strong> pixel.",
	"id" => $shortname."_slide1_images",
	"group" => "group",
	"type" => "__FILE__",
	"std" => ""),

array( "name" => "Slide 1 Images",
	"desc" => "",
	"id" => $shortname."_slide1_images",
	"type" => "remove",
	"std" => ""),
	
array( "name" => "Slide 1 URL",
	"desc" => "",
	"id" => $shortname."_slide1_url",
	"type" => "text",
	"std" => ""),

array( "name" => "Slide 2 Title",
	"desc" => "Enter the text for title and tabs",
	"id" => $shortname."_slide2_title",
	"group" => "group",
	"type" => "text",
	"std" => ""),

array( "name" => "Slide 2 Content Text",
	"desc" => "Use &lt;p&gt; ... &lt;/p&gt; to add paragraph.",
	"id" => $shortname."_slide2_content",
	"group" => "group",
	"type" => "textarea",
	"std" => ""),

array( "name" => "Slide 2 Images",
	"desc" => "Browse image used for slide 2. Size must be <strong>306 x 168</strong> pixel.",
	"id" => $shortname."_slide2_images",
	"group" => "group",
	"type" => "__FILE__",
	"std" => ""),

array( "name" => "Slide 2 Images",
	"desc" => "",
	"id" => $shortname."_slide2_images",
	"type" => "remove",
	"std" => ""),
	
array( "name" => "Slide 2 URL",
	"desc" => "",
	"id" => $shortname."_slide2_url",
	"type" => "text",
	"std" => ""),

array( "name" => "Slide 3 Title",
	"desc" => "Enter the text for title and tabs",
	"id" => $shortname."_slide3_title",
	"group" => "group",
	"type" => "text",
	"std" => ""),

array( "name" => "Slide 3 Content",
	"desc" => "Content for Slide 3, you need to fill 'Slide 3 Content Text, Images and URL' if you choose 'Custom Text'",
	"id" => $shortname."_slide3_content",
	"group" => "group",
	"type" => "select",
	"options" => array("Testimonial", "Portfolio", "News", "Custom Text"),
	"std" => "Testimonial"),
	
array( "name" => "Slide 3 Content Text",
	"desc" => "Use &lt;p&gt; ... &lt;/p&gt; to add paragraph.",
	"id" => $shortname."_slide3_contenttext",
	"group" => "group",
	"type" => "textarea",
	"std" => ""),

array( "name" => "Slide 3 Images",
	"desc" => "Browse image used for slide 3. Size must be <strong>306 x 168</strong> pixel.",
	"id" => $shortname."_slide3_images",
	"group" => "group",
	"type" => "__FILE__",
	"std" => ""),

array( "name" => "Slide 3 Images",
	"desc" => "",
	"id" => $shortname."_slide3_images",
	"type" => "remove",
	"std" => ""),
	
array( "name" => "Slide 3 URL",
	"desc" => "",
	"id" => $shortname."_slide3_url",
	"type" => "text",
	"std" => ""),

array( "name" => "Slide 4 Title",
	"desc" => "Enter the text for title and tabs",
	"id" => $shortname."_slide4_title",
	"group" => "group",
	"type" => "text",
	"std" => ""),

array( "name" => "Slide 4 Content",
	"desc" => "Content for Slide 4, you need to fill 'Slide 4 Content Text, Images and URL' if you choose 'Custom Text'",
	"id" => $shortname."_slide4_content",
	"group" => "group",
	"type" => "select",
	"options" => array("Testimonial", "Portfolio", "News", "Custom Text"),
	"std" => "Portfolio"),
	
array( "name" => "Slide 4 Content Text",
	"desc" => "Use &lt;p&gt; ... &lt;/p&gt; to add paragraph.",
	"id" => $shortname."_slide4_contenttext",
	"group" => "group",
	"type" => "textarea",
	"std" => ""),

array( "name" => "Slide 4 Images",
	"desc" => "Browse image used for slide 4. Size must be <strong>306 x 168</strong> pixel.",
	"id" => $shortname."_slide4_images",
	"group" => "group",
	"type" => "__FILE__",
	"std" => ""),

array( "name" => "Slide 4 Images",
	"desc" => "",
	"id" => $shortname."_slide4_images",
	"type" => "remove",
	"std" => ""),
	
array( "name" => "Slide 4 URL",
	"desc" => "",
	"id" => $shortname."_slide4_url",
	"type" => "text",
	"std" => ""),


array( "type" => "close"),


array( "name" => "SLIDESHOW 2",
     "desc" => "This slideshow using <a href='http://workshop.rs/projects/jqfancytransitions/'>JqFancyTransitions</a>. There are 4 images area for the slideshow.",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Slideshow 1 Image",
	"desc" => "Browse image used for slideshow 1. Size must be <strong>1002 x 316</strong> pixel.",
	"id" => $shortname."_slideshow1",
	"group" => "group",
	"type" => "__FILE__",
	"std" => ""),

array( "name" => "Slideshow 1 Image",
	"desc" => "",
	"id" => $shortname."_slideshow1",
	"type" => "remove",
	"std" => ""),	
	
array( "name" => "Slideshow 1 Title",
	"desc" => "Enter the title for Slideshow 1.",
	"id" => $shortname."_slideshow1_title",
	"type" => "text",
	"std" => ""),

array( "name" => "Slideshow 1 URL",
	"desc" => "Enter the URL for Slideshow 1.",
	"id" => $shortname."_slideshow1_url",
	"type" => "text",
	"std" => ""),

array( "name" => "Slideshow 2 Image",
	"desc" => "Browse image used for slideshow 2. Size must be <strong>1002 x 316</strong> pixel.",
	"id" => $shortname."_slideshow2",
	"group" => "group",
	"type" => "__FILE__",
	"std" => ""),

array( "name" => "Slideshow 2 Image",
	"desc" => "",
	"id" => $shortname."_slideshow2",
	"type" => "remove",
	"std" => ""),
	
array( "name" => "Slideshow 2 Title",
	"desc" => "Enter the title for Slideshow 2.",
	"id" => $shortname."_slideshow2_title",
	"group" => "group",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Slideshow 2 URL",
	"desc" => "Enter the URL for Slideshow 2.",
	"id" => $shortname."_slideshow2_url",
	"type" => "text",
	"std" => ""),

array( "name" => "Slideshow 3 Image",
	"desc" => "Browse image used for slideshow 3. Size must be <strong>1002 x 316</strong> pixel.",
	"id" => $shortname."_slideshow3",
	"group" => "group",
	"type" => "__FILE__",
	"std" => ""),

array( "name" => "Slideshow 3 Image",
	"desc" => "",
	"id" => $shortname."_slideshow3",
	"type" => "remove",
	"std" => ""),

array( "name" => "Slideshow 3 Title",
	"desc" => "Enter the title for Slideshow 3.",
	"id" => $shortname."_slideshow3_title",
	"group" => "group",
	"type" => "text",
	"std" => ""),

array( "name" => "Slideshow 3 URL",
	"desc" => "Enter the URL for Slideshow 3.",
	"id" => $shortname."_slideshow3_url",
	"type" => "text",
	"std" => ""),

array( "name" => "Slideshow 4 Image",
	"desc" => "Browse image used for slideshow 4. Size must be <strong>1002 x 316</strong> pixel.",
	"id" => $shortname."_slideshow4",
	"group" => "group",
	"type" => "__FILE__",
	"std" => ""),

array( "name" => "Slideshow 4 Image",
	"desc" => "",
	"id" => $shortname."_slideshow4",
	"type" => "remove",
	"std" => ""),

array( "name" => "Slideshow 4 Title",
	"desc" => "Enter the title for Slideshow 4.",
	"id" => $shortname."_slideshow4_title",
	"group" => "group",
	"type" => "text",
	"std" => ""),

array( "name" => "Slideshow 4 URL",
	"desc" => "Enter the URL for Slideshow 4.",
	"id" => $shortname."_slideshow4_url",
	"type" => "text",
	"std" => ""),

array( "name" => "Disable Rounded Corner",
	"desc" => "Disable rounded corner, <strong>please disabled rounded corner if you want the images clickable</strong>",
	"id" => $shortname."_rounded",
	"type" => "checkbox",
	"std" => "false"),

array( "name" => "Strips",
	"desc" => "Number of Strips.",
	"id" => $shortname."_slideshow_strips",
	"type" => "select",
	"options" => array("10", "15", "20", "25", "30", "35", "40", "45", "50"),
	"std" => "35"),
	
array( "name" => "Strip Delay",
	"desc" => "Delay beetwen strips in ms.",
	"id" => $shortname."_slideshow_stripdelay",
	"type" => "select",
	"options" => array("10", "20", "30", "40", "50", "65", "70", "85", "90", "100"),
	"std" => "40"),

array( "name" => "Animation",
	"desc" => "",
	"id" => $shortname."_slideshow_animation",
	"type" => "select",
	"options" => array("left", "right", "alternate", "random", "fountain", "fountainAlternate"),
	"std" => "fountainAlternate"),
	
array( "name" => "Position",
	"desc" => "",
	"id" => $shortname."_slideshow_position",
	"type" => "select",
	"options" => array("top", "bottom", "alternate", "curtain", "wave"),
	"std" => "wave"),

array( "type" => "close"),

array( "name" => "HOMEPAGE",
    "desc" => "Setting for the homepage.",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Box 1 Title",
	"desc" => "",
	"id" => $shortname."_box1_title",
	"group" => "group",
	"type" => "text"),

array( "name" => "Box 1 Icon (URL)",
	"desc" => "Browse image used for Icon , size 35x35 pixel in .png format.",
	"id" => $shortname."_box1_icon",
	"group" => "group",
	"type" => "__FILE__",
	"std" => ""),

array( "name" => "Box 1 Icon",
	"desc" => "",
	"id" => $shortname."_box1_icon",
	"type" => "remove",
	"std" => ""),

array( "name" => "Box 1 Content",
	"desc" => "Use &lt;p&gt; ... &lt;/p&gt; to add paragraph.",
	"id" => $shortname."_box1_content",
	"group" => "group",
	"type" => "textarea"),

array( "name" => "Box 1 URL",
	"desc" => "",
	"id" => $shortname."_box1_url",
	"type" => "text"),

array( "name" => "Box 2 Title",
	"desc" => "",
	"id" => $shortname."_box2_title",
	"group" => "group",
	"type" => "text"),

array( "name" => "Box 2 Icon (URL)",
	"desc" => "Browse image used for Icon , size 35x35 pixel in .png format.",
	"id" => $shortname."_box2_icon",
	"group" => "group",
	"type" => "__FILE__",
	"std" => ""),

array( "name" => "Box 2 Icon",
	"desc" => "",
	"id" => $shortname."_box2_icon",
	"type" => "remove",
	"std" => ""),

array( "name" => "Box 2 Content",
	"desc" => "Use &lt;p&gt; ... &lt;/p&gt; to add paragraph.",
	"id" => $shortname."_box2_content",
	"group" => "group",
	"type" => "textarea"),

array( "name" => "Box 2 URL",
	"desc" => "",
	"id" => $shortname."_box2_url",
	"type" => "text"),

array( "name" => "Box 3 Title",
	"desc" => "",
	"id" => $shortname."_box3_title",
	"group" => "group",
	"type" => "text"),

array( "name" => "Box 3 Icon (URL)",
	"desc" => "Browse image used for Icon ,  size 35x35 pixel in .png format.",
	"id" => $shortname."_box3_icon",
	"group" => "group",
	"type" => "__FILE__",
	"std" => ""),
	
array( "name" => "Box 3 Icon",
	"desc" => "",
	"id" => $shortname."_box3_icon",
	"type" => "remove",
	"std" => ""),

array( "name" => "Box 3 Content",
	"desc" => "Use &lt;p&gt; ... &lt;/p&gt; to add paragraph.",
	"id" => $shortname."_box3_content",
	"group" => "group",
	"type" => "textarea"),

array( "name" => "Box 3 URL",
	"desc" => "",
	"id" => $shortname."_box3_url",
	"type" => "text"),


array( "type" => "close"),
array( "name" => "FOOTER",
    "desc" => "The Footer have 2 Widget area and 1 area for contact info & social networking.",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Footer Box 3 Title",
	"desc" => "",
	"id" => $shortname."_footer3_title",
	"type" => "text",
	"std" => ""),

array( "name" => "Address",
	"desc" => "Type your address.",
	"id" => $shortname."_footer_address",
	"type" => "textarea"),

array( "name" => "Phone",
	"desc" => "",
	"id" => $shortname."_footer_phone",
	"type" => "text"),
	
array( "name" => "Fax",
	"desc" => "",
	"id" => $shortname."_footer_fax",
	"type" => "text"),
	
array( "name" => "Cellphone",
	"desc" => "",
	"id" => $shortname."_footer_cellphone",
	"type" => "text"),

array( "name" => "Email",
	"desc" => "",
	"id" => $shortname."_footer_email",
	"type" => "text"),

array( "name" => "Contact Button URL",
	"desc" => "",
	"id" => $shortname."_footer_contacturl",
	"type" => "text"),

array( "name" => "Contact Button Text",
	"desc" => "",
	"id" => $shortname."_footer_contacttext",
	"type" => "text",
	"std" => "Contact Us"),

array( "name" => "Footer Facebook URL",
	"desc" => "",
	"id" => $shortname."_footer_facebook",
	"type" => "text"),

array( "name" => "Footer Linkedin URL",
	"desc" => "",
	"id" => $shortname."_footer_linkedin",
	"type" => "text"),

array( "name" => "Footer Twitter URL",
	"desc" => "",
	"id" => $shortname."_footer_twitter",
	"type" => "text"),

array( "name" => "Footer Flickr URL",
	"desc" => "",
	"id" => $shortname."_footer_flickr",
	"type" => "text"),

array( "name" => "Footer Plurk URL",
	"desc" => "",
	"id" => $shortname."_footer_plurk",
	"type" => "text"),

array( "name" => "Footer Delicious URL",
	"desc" => "",
	"id" => $shortname."_footer_delicious",
	"type" => "text"),

array( "name" => "Footer Digg URL",
	"desc" => "",
	"id" => $shortname."_footer_digg",
	"type" => "text"),

array( "name" => "Footer Youtube URL",
	"desc" => "",
	"id" => $shortname."_footer_youtube",
	"type" => "text"),

array( "name" => "Footer copyright text",
	"desc" => "Enter text used in the right side of the footer. It can be HTML",
	"id" => $shortname."_footer_text",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Google Analytics Code",
	"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""),	
 
array( "type" => "close")
 
);


function creativeclean_add_admin() {
global $themename, $shortname, $options;
if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) )  {
	if ( 'save' == isset($_REQUEST['action']) && $_REQUEST['action'] ) {
		foreach ($options as $value) {
 			if (isset($value['id'])) {
 				if (isset($_REQUEST[ $value['id'] ])) {
					update_option( $value['id'], $_REQUEST[ $value['id'] ] );
				}
			}
		}
 
		
		foreach ($options as $value) {	
		   
				if( $value['type'] == '__FILE__' )
				
				{  
					if ($_FILES[$value['id']]) {
						
						$newinput = array();
						$overrides = array('test_form' => false); 
						$file = wp_handle_upload($_FILES[$value['id']], $overrides);
        				$newinput['file'] = $file;
						if (isset($file['url']))
						update_option( $value['id'], $newinput );
						
					}	
					
				}
				elseif( $value['type'] == 'remove' ){
				if ($_POST['removeimage'.$value['id']]){ 
				   	$img = get_option($value['id']);
					$file = $img['file']; 
									
					$expl=explode('/', $file['url']);
					$count = count($expl);
					$year = $expl[$count-3];
					$mounth = $expl[$count-2];
					$filenames = $expl[$count-1];
					$filenameupload =ABSPATH."wp-content"."/uploads/"; 
					$filenameupload .=$year."/".$mounth."/".$filenames;
					
					if (($file['url']<>'') ){
		 			   //chmod($filenameupload,"777");
					   if (unlink($filenameupload))
					   	delete_option( $value['id']);	
					   else echo "error deleting image";
					}				
				}	
				}
				elseif( isset( $_REQUEST[ $value['id'] ] ) )	
						
				{			
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  );						
				}
				else {
					delete_option( $value['id']);	
				}
				
		}
		$fragment=$_POST['fragment'];
		header("Location: admin.php?page=functions.php&saved=true&fragment=$fragment");
		die;

 	} else if ( 'reset' == isset($_REQUEST['action']) && $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
			delete_option( $value['id'] ); 
		}
 		header("Location: admin.php?page=functions.php&reset=true");
		die;

	}
}
 
add_theme_page('Theme Settings', 'Theme Settings', 'administrator', basename(__FILE__), 'creativeclean_admin');
}

function creativeclean_add_init() {
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");
wp_enqueue_script('jquery'); 
wp_enqueue_script('jquery-ui-core'); 
wp_enqueue_script('jquery-ui-tabs'); 
wp_enqueue_style("tabs", $file_dir."/style/jquery-ui.css", false, "1.0", "all");
}
function creativeclean_admin() { ?>
<script type="text/javascript">
   jQuery(document).ready(function() {
    jQuery("#tabs").tabs();
  });
  </script>
<?php 
global $themename, $shortname, $options;
$i=0;
 
if ( isset($_REQUEST['saved']) ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( isset($_REQUEST['reset']) ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

?>
<div class="wrap cc_wrap">
<h2><?php echo $themename; ?> Settings</h2>
 <p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>
  <div id="tabs">
    <ul>
	<?php $x=0; foreach ($options as $value) {
		switch ( $value['type'] ) {
			case "section":
			   $x++;
			   $fragment=$_GET['fragment'];
			   ?>
			   
			   <li class="menusection <?php if ($fragment==$x): echo"ui-tabs-selected"; endif; ?>"><a href="#fragment-<?php echo $x;?>" onclick="document.getElementById('fragment-input').value= <?php echo $x ?>"><?php echo $_POST["fragment"]; ?><?php echo $value['name']; ?></a></li>
			   <?php break;
		}
		}
	?>	
				    
	</ul>
<div class="cc_opts">
<form method="post" enctype="multipart/form-data" action="">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>


 
<?php break;
 
case "title":
?>


 
<?php break;
 
case 'text':
?>

<div class="cc_input cc_text <?php if (isset($value['group'])) {echo $value['group'];} ?>">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { if (isset($value['std'])) {echo $value['std'];} } ?>" />
 <small><?php if (isset($value['desc'])) {echo $value['desc'];} ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="cc_input cc_textarea <?php if (isset($value['group'])) {echo $value['group'];} ?>">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { if (isset($value['std'])) {echo $value['std'];} } ?></textarea>
 <small><?php if (isset($value['desc'])) {echo $value['desc'];} ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="cc_input cc_select <?php if (isset($value['group'])) {echo $value['group'];} ?>">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_option( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php if (isset($value['desc'])) {echo $value['desc'];} ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="cc_input cc_checkbox <?php if (isset($value['group'])) {echo $value['group'];} ?>">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
<label for="<?php echo $value['id']; ?>" class="labelchk"><?php if (isset($value['labelchk'])) {echo $value['labelchk'];} ?></label>

	<small><?php if (isset($value['desc'])) {echo $value['desc'];} ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case '__FILE__':
?>
	 <div class="cc_input cc_upload">
	  
		<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label> 
		<span id="browser">		
		<input type="file" id="upload" name="<?php echo $value['id'] ?>" size="15" />				
		
		</span>	
		<small><?php echo $value['desc']; ?></small>
		<label for="<?php echo $value['id']; ?>">&nbsp;</label> 
		<span class="browser">
		<input type="submit" id="submit" name="submit" class="saveupload"  value="Upload"/>
		</span>
		<div class="clearfix"></div>  

	<br />
	  
		
		<label for="<?php echo $value['id']; ?>">&nbsp;</label> 
		<?php 
		$img = get_option($value['id']);$file = $img['file']; 
		if (($file['url']<>'') ){
		?>
		<div id="imgholder">
		<?php echo "<img src='{$file['url']}' />"; ?>
		</div>
		<?php } ?>
		
		<small></small>
		
		
	</div>

<?php
break;
case 'remove':

	 
	  $img = get_option($value['id']);$file = $img['file']; 
		if (($file['url']<>'') ){
?>	<div class="cc_input cc_upload">
 		<label for="<?php echo $value['id']; ?>">&nbsp;</label> 
		 <span id="browser">
		<input type="submit" id="removeimage<?php echo $value['id']; ?>" name="removeimage<?php echo $value['id']; ?>"   value="Remove <?php echo $value['name']; ?>"/>
		</span>
		<small></small>
		
		  			
</div>
<?php
}
break;
case "section":

$i++;

?>
<div class="ch_options" id="fragment-<?php echo $i;?>">
				<p class="titlesection"><?php echo $value['desc']; ?></p>


 
<?php break;
 
}
}
?>
 
<span class="savechanges"><input name="save<?php echo $i; ?>" type="submit" value="Save Changes" class="button-primary" />
			    </span><br />
	<input type="hidden" name="action" value="save" />
	<input type="hidden" name="fragment" value="<?php echo $fragment ?>" id="fragment-input" />
	</form>
 	</div>
	</ul>
  </div>
</div>

<?php
}
?>
<?php
add_action('admin_init', 'creativeclean_add_init');
add_action('admin_menu', 'creativeclean_add_admin');

/* End CreativeClean Settings
=====================================================================*/
?>