<?php 

// **********************************************************************// 
// ! Register all 8theme Widgets
// **********************************************************************// 
add_action( 'widgets_init', 'etheme_register_general_widgets' );
function etheme_register_general_widgets() {
    register_widget('Etheme_Twitter_Widget');
    register_widget('Etheme_Recent_Posts_Widget');
    register_widget('Etheme_Recent_Comments_Widget');
    register_widget('Etheme_Flickr_Widget');
    register_widget('Etheme_StatickBlock_Widget');
    register_widget('Etheme_QRCode_Widget');
    register_widget('Etheme_Search_Widget');
    register_widget('Etheme_Brands_Widget');
    register_widget('null_instagram_widget');
    register_widget('Etheme_Socials_Widget');
    //register_widget('Etheme_Subcategories_Widget');
}

// **********************************************************************// 
// ! Brands Filter Widget
// **********************************************************************// 
class Etheme_Brands_Widget extends WP_Widget {

    function Etheme_Brands_Widget() {
        $widget_ops = array('classname' => 'etheme_widget_brands', 'description' => __( "Products Filter by brands", ETHEME_DOMAIN) );
        parent::__construct('etheme-brands', '8theme - '.__('Brands Filter', ETHEME_DOMAIN), $widget_ops);
        $this->alt_option_name = 'etheme_widget_brans';
    }

    function widget($args, $instance) {
        extract($args);

        $title = $instance['title'];
        echo $before_widget;
        if(!$title == '' ){
	        echo $before_title;
	        echo $title;
	        echo $after_title;
        }
        $current_term = get_queried_object();
		$args = array( 'hide_empty' => false);
		$terms = get_terms('brand', $args);
		$count = count($terms); $i=0;
		if ($count > 0) {
			?>
			<ul>
				<?php
				    foreach ($terms as $term) {
				        $i++;
				        $curr = false;
				        $thumbnail_id 	= absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) );
				        if(isset($current_term->term_id) && $current_term->term_id == $term->term_id) {
					        $curr = true;
				        }
				        ?>
				        	<li>
				        		<a href="<?php echo get_term_link( $term ); ?>" title="<?php echo sprintf(__('View all products from %s', ETHEME_DOMAIN), $term->name); ?>"><?php if($curr) echo '<strong>'; ?><?php echo $term->name; ?><?php if($curr) echo '</strong>'; ?></a>
				        	</li>
						<?php
				    }
				?>
			</ul>
			<?php
        }
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];

        return $instance;
    }

    function form( $instance ) {
        $title = isset($instance['title']) ? $instance['title'] : '';

?>
        <?php etheme_widget_input_text(__('Title', ETHEME_DOMAIN), $this->get_field_id('title'),$this->get_field_name('title'), $title); ?>

<?php
    }
}
// **********************************************************************// 
// ! Mega Search Widget
// **********************************************************************// 
class Etheme_Search_Widget extends WP_Widget {

    function Etheme_Search_Widget() {
        $widget_ops = array('classname' => 'etheme_widget_search', 'description' => __( "AJAX Search form for Products, Posts, Portfolio and Pages", ETHEME_DOMAIN) );
        parent::__construct('etheme-search', '8theme - '.__('Search From', ETHEME_DOMAIN), $widget_ops);
        $this->alt_option_name = 'etheme_widget_search';
    }

    function widget($args, $instance) {
        extract($args);

        $count = (int) $instance['count'];
        $images = (bool) $instance['images'];
        $post_type = $instance['post_type'];

        echo $before_widget;
        echo etheme_search(array(
			'images' => $images,
			'count' => $count,
            'widget' => 1,
            'post_type' => $post_type,
        ));
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['count'] = (int) $new_instance['count'];

        $instance['images'] = (bool) $new_instance['images'];

        $instance['post_type'] = esc_attr($new_instance['post_type']);

        return $instance;
    }

    function form( $instance ) {
        $images = isset($instance['images']) ? (bool) $instance['images'] : false;

        $count = isset($instance['count']) ? $instance['count'] : '';

?>

        <?php $post_type = array('product' => 'products','etheme_portfolio' => 'portfolios', 'post' => 'posts', 'page' => 'pages', 'testimonial' => 'testimonial', 'any' => 'all' ); ?>

        <p><label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Search type:', ETHEME_DOMAIN); ?></label>
            <select name="<?php echo $this->get_field_name('post_type'); ?>" id="<?php echo $this->get_field_id('post_type'); ?>">
                <option>--Select--</option>
=
                <?php foreach ($post_type as $kay => $value) : ?>
                    <option value="<?php echo $kay; ?>"<?php selected( $instance['post_type'], $kay ); ?>><?php echo $value;?></option>
                <?php endforeach; ?>

            </select>
        </p>

        <?php $count = (empty($count)) ? 3:$count; ?>
        
        <?php etheme_widget_input_checkbox(__('Display images', ETHEME_DOMAIN), $this->get_field_id('images'), $this->get_field_name('images'),checked($images, true, false), 1); ?>
        
        <?php etheme_widget_input_text(__('Number of items', ETHEME_DOMAIN), $this->get_field_id('count'),$this->get_field_name('count'), $count); ?>

<?php
    }
}

// **********************************************************************// 
// ! QR code Widget
// **********************************************************************// 
class Etheme_QRCode_Widget extends WP_Widget {

    function Etheme_QRCode_Widget() {
        $widget_ops = array('classname' => 'etheme_widget_qr_code', 'description' => __( "You can add a QR code image in sidebar to allow your users get quick access from their devices", ETHEME_DOMAIN) );
        parent::__construct('etheme-qr-code', '8theme - '.__('QR Code', ETHEME_DOMAIN), $widget_ops);
        $this->alt_option_name = 'etheme_widget_qr_code';
    }

    function widget($args, $instance) {
        extract($args);

        $title = $instance['title'];
        $info = $instance['info'];
        $text = $instance['text'];
        $size = (int) $instance['size'];
        $lightbox = (bool) $instance['lightbox'];
        $currlink = (bool) $instance['currlink'];

        echo $before_widget;
        if ( $title ) echo $before_title . $title . $after_title;
        echo generate_qr_code($info, 'Open', $size, '', $currlink, $lightbox );
        if($text != '') 
            echo $text;
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['info'] = strip_tags($new_instance['info']);
        $instance['text'] = ($new_instance['text']);
        $instance['size'] = (int) $new_instance['size'];
        $instance['lightbox'] = (bool) $new_instance['lightbox'];
        $instance['currlink'] = (bool) $new_instance['currlink'];



        return $instance;
    }

    function form( $instance ) {
        $block_id = 0;
        if(!empty($instance['block_id']))
            $block_id = esc_attr($instance['block_id']);

        $info = isset($instance['info']) ? $instance['info'] : '';
        $text = isset($instance['text']) ? $instance['text'] : '';
        $title = isset($instance['title']) ? $instance['title'] : '';
        $size = isset($instance['size']) ? (int) $instance['size'] : 256;
        $lightbox = isset($instance['lightbox']) ? (bool) $instance['lightbox'] : false;
        $currlink = isset($instance['currlink']) ? (bool) $instance['currlink'] : false;

?>
        <?php etheme_widget_input_text(__('Widget title:', ETHEME_DOMAIN), $this->get_field_id('title'),$this->get_field_name('title'), $title); ?>

        <?php etheme_widget_textarea(__('Information to encode:', ETHEME_DOMAIN), $this->get_field_id('info'),$this->get_field_name('info'), $info); ?>

        <?php etheme_widget_input_text(__('Image size:', ETHEME_DOMAIN), $this->get_field_id('size'), $this->get_field_name('size'), $size); ?>

        <?php etheme_widget_input_checkbox(__('Show in lightbox', ETHEME_DOMAIN), $this->get_field_id('lightbox'), $this->get_field_name('lightbox'),checked($lightbox, true, false), 1); ?>

        <?php etheme_widget_input_checkbox(__('Encode link to the current page', ETHEME_DOMAIN), $this->get_field_id('currlink'), $this->get_field_name('currlink'),checked($currlink, true, false), 1); ?>

        <?php etheme_widget_textarea(__('Additional information in widget', ETHEME_DOMAIN), $this->get_field_id('text'),$this->get_field_name('text'), $text); ?>

<?php
    }
}


// **********************************************************************// 
// ! Recent posts Widget
// **********************************************************************// 
class Etheme_StatickBlock_Widget extends WP_Widget {

    function Etheme_StatickBlock_Widget() {
        $widget_ops = array('classname' => 'etheme_widget_satick_block', 'description' => __( "Insert static block, that you created", ETHEME_DOMAIN) );
        parent::__construct('etheme-static-block', '8theme - '.__('Statick Block', ETHEME_DOMAIN), $widget_ops);
        $this->alt_option_name = 'etheme_widget_satick_block';
    }

    function widget($args, $instance) {
        extract($args);

        $block_id = $instance['block_id'];
        
        et_show_block($block_id);

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['block_id'] = $new_instance['block_id'];

        return $instance;
    }

    function form( $instance ) {
        $block_id = 0;
        if(!empty($instance['block_id']))
            $block_id = esc_attr($instance['block_id']);

?>
        <p><label for="<?php echo $this->get_field_id('block_id'); ?>"><?php _e('Block name:', ETHEME_DOMAIN); ?></label>
            <?php $sb = et_get_static_blocks(); ?>
            <select name="<?php echo $this->get_field_name('block_id'); ?>" id="<?php echo $this->get_field_id('block_id'); ?>">
                <option>--Select--</option>
                <?php if (count($sb > 0)): ?>
                    <?php foreach ($sb as $key): ?>
                        <option value="<?php echo $key['value']; ?>" <?php selected( $block_id, $key['value'] ); ?>><?php echo $key['label'] ?></option>
                    <?php endforeach ?>
                <?php endif ?>
            </select>
        </p>
<?php
    }
}



// **********************************************************************// 
// ! Recent posts Widget
// **********************************************************************// 
class Etheme_Recent_Posts_Widget extends WP_Widget {

    function Etheme_Recent_Posts_Widget() {
        $widget_ops = array('classname' => 'etheme_widget_recent_entries', 'description' => __( "The most recent posts on your blog (Etheme Edit)", ETHEME_DOMAIN) );
        parent::__construct('etheme-recent-posts', '8theme - '.__('Recent Posts', ETHEME_DOMAIN), $widget_ops);
        $this->alt_option_name = 'etheme_widget_recent_entries';

        add_action( 'save_post', array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('etheme_widget_recent_entries', 'widget');

        if ( !is_array($cache) )
                $cache = array();

        if ( isset($args['widget_id']) && isset($cache[$args['widget_id']]) ) {
                echo $cache[$args['widget_id']];
                return;
        }

        ob_start();
        extract($args);

        $box_id = rand(1000,10000);

        $title = apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
        if ( !$number = (int) $instance['number'] )
                $number = 10;
        else if ( $number < 1 )
                $number = 1;
        else if ( $number > 15 )
                $number = 15;


        $slider = (!empty($instance['slider'])) ? (int) $instance['slider'] : false;

        $r = new WP_Query(array('posts_per_page' => $number, 'post_type' => 'post', 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
        if ($r->have_posts()) : ?>
        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
            <?php if($slider): ?>
                <div class="owl-carousel blogCarousel slider-<?php echo $box_id; ?>">
            <?php endif; ?>
			<ul class="blog-post-list slide-item">
                <?php $i=0;  while ($r->have_posts()) : $r->the_post(); $i++; ?>
	                <?php
	                    if ( get_the_title() ) $title = get_the_title(); else $title = get_the_ID();
	                    $title = trunc($title, 10);
	                ?>
					<li>
						<div class="media">
							<a class="pull-left" href="#">
								<time class="date-event"><span class="number"><?php the_time('d'); ?></span> <?php the_time('M'); ?></time>
							</a>
							<div class="media-body">
								<h4 class="media-heading"><a href="<?php the_permalink() ?>"><?php echo $title; ?></a></h4>
								<?php _e('by', ETHEME_DOMAIN) ?> <strong><?php the_author(); ?></strong> 
							</div>
						</div>
                    </li>
                <?php if($i%2 == 0 && $i != $r->post_count): ?>
                        </ul>
                        <ul class="blog-post-list slide-item">
                <?php endif; ?>
                <?php endwhile; ?>
            </ul>
            <?php if($slider): ?>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        jQuery(".slider-<?php echo $box_id; ?>").owlCarousel({
                            items:1,
                            navigation: true,
                            lazyLoad: true,
                            rewindNav: false,
                            addClassActive: true,
                            itemsCustom: [1600, 1]
                        });
                    });
                </script>
            <?php endif; ?>
        <?php echo $after_widget; ?>
<?php
                wp_reset_query();  // Restore global post data stomped by the_post().
        endif;
        
        if(isset($args['widget_id'])) {
	        $cache[$args['widget_id']] = ob_get_flush();
	        wp_cache_add('etheme_widget_recent_entries', $cache, 'widget');
        }
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['slider'] = (int) $new_instance['slider'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['etheme_widget_recent_entries']) )
                delete_option('etheme_widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('etheme_widget_recent_entries', 'widget');
    }

    function form( $instance ) {
        $title = esc_attr($instance['title']);
        if ( !$number = (int) $instance['number'] )
                $number = 5;

        $slider = (int) $instance['slider'];
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', ETHEME_DOMAIN); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', ETHEME_DOMAIN); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
        <small><?php _e('(at most 15)', ETHEME_DOMAIN); ?></small></p>

        <?php etheme_widget_input_checkbox(__('Enable slider', ETHEME_DOMAIN), $this->get_field_id('slider'), $this->get_field_name('slider'),checked($slider, true, false), 1); ?>

<?php
    }
}

// **********************************************************************// 
// ! Twitter Widget
// **********************************************************************// 

class Etheme_Twitter_Widget extends WP_Widget {
    function Etheme_Twitter_Widget() {
        $widget_ops = array( 'classname' => 'etheme_twitter', 'description' => __('Display most recent Twitter feed', ETHEME_DOMAIN) );
        $control_ops = array( 'id_base' => 'etheme-twitter' );
        parent::__construct( 'etheme-twitter', '8theme - '.__('Twitter Feed', ETHEME_DOMAIN), $widget_ops, $control_ops );
    }
    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title'] );
        echo $before_widget;
        if ( $title ) echo $before_title . $title . $after_title;
        $attr = array( 'usernames' => $instance['usernames'], 'limit' => $instance['limit'], 'interval' => $instance['interval'] );
        $attr['interval'] = $attr['interval'] * 10;
        //echo etheme_get_twitter( $attr );
        echo etheme_print_tweets($instance['consumer_key'],$instance['consumer_secret'],$instance['user_token'],$instance['user_secret'],$attr['usernames'], $attr['limit'], 50);
        echo $after_widget;
    }
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['usernames'] = strip_tags( $new_instance['usernames'] );
        $instance['consumer_key'] = strip_tags( $new_instance['consumer_key'] );
        $instance['consumer_secret'] = strip_tags( $new_instance['consumer_secret'] );
        $instance['user_token'] = strip_tags( $new_instance['user_token'] );
        $instance['user_secret'] = strip_tags( $new_instance['user_secret'] );
        $instance['limit'] = strip_tags( $new_instance['limit'] );
        $instance['interval'] = strip_tags( $new_instance['interval'] );
        return $instance;
    }
    function form( $instance ) {
        $defaults = array( 'title' => '', 'usernames' => '8theme', 'limit' => '2', 'interval' => '5' );
        $instance = wp_parse_args( (array) $instance, $defaults );
        etheme_widget_input_text( __('Title:', ETHEME_DOMAIN), $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $instance['title'] );
        etheme_widget_input_text( __('Username:', ETHEME_DOMAIN), $this->get_field_id( 'usernames' ), $this->get_field_name( 'usernames' ), $instance['usernames'] );
        etheme_widget_input_text( __('Customer Key:', ETHEME_DOMAIN), $this->get_field_id( 'consumer_key' ), $this->get_field_name( 'consumer_key' ), $instance['consumer_key'] );
        etheme_widget_input_text( __('Customer Secret:', ETHEME_DOMAIN), $this->get_field_id( 'consumer_secret' ), $this->get_field_name( 'consumer_secret' ), $instance['consumer_secret'] );
        etheme_widget_input_text( __('Access Token:', ETHEME_DOMAIN), $this->get_field_id( 'user_token' ), $this->get_field_name( 'user_token' ), $instance['user_token'] );
        etheme_widget_input_text( __('Access Token Secret:', ETHEME_DOMAIN), $this->get_field_id( 'user_secret' ), $this->get_field_name( 'user_secret' ), $instance['user_secret'] );
        etheme_widget_input_text( __('Number of tweets:', ETHEME_DOMAIN), $this->get_field_id( 'limit' ), $this->get_field_name( 'limit' ), $instance['limit'] );
    }
}

// **********************************************************************// 
// ! Flickr Photos
// **********************************************************************// 
class Etheme_Flickr_Widget extends WP_Widget {
    
    function __construct()
    {
        $widget_ops = array('classname' => 'flickr', 'description' => 'Photos from flickr.');
        $control_ops = array('id_base' => 'etheme_flickr-widget');
        parent::__construct('etheme_flickr-widget', '8theme Flickr Photos', $widget_ops, $control_ops);
    }
    
    function widget($args, $instance)
    {
        extract($args);

        $title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Flickr', ETHEME_DOMAIN) : $instance['title'], $instance, $this->id_base);
        $screen_name = @$instance['screen_name'];
        $number = @$instance['number'];
        $show_button = @$instance['show_button'];
        
        if(!$screen_name || $screen_name == '') {
            $screen_name = '95572727@N00';
        }
        
        echo $before_widget;
        if($title) {
            echo $before_title.'<span class="footer_title">'.$title.'</span>'.$after_title;
        }
        
        if($screen_name && $number) {
			echo '<script type="text/javascript" src="//www.flickr.com/badge_code_v2.gne?count='.$number.'&display=latest&size=s&layout=x&source=user&user='.$screen_name.'"></script>';
        }
        
        echo $after_widget;
    }
    
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['screen_name'] = $new_instance['screen_name'];
        $instance['number'] = $new_instance['number'];
        
        return $instance;
    }

    function form($instance)
    {
        $defaults = array('title' => 'Photos from Flickr', 'screen_name' => '', 'number' => 6, 'show_button' => 1);
        $instance = wp_parse_args((array) $instance, $defaults); ?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('screen_name'); ?>">Flickr ID</label>
            <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('screen_name'); ?>" name="<?php echo $this->get_field_name('screen_name'); ?>" value="<?php echo $instance['screen_name']; ?>" />
            <br/>
            <p class="help">To find your flickID visit <a href="http://idgettr.com/" target="_blank">idGettr</a>.</p>
        </p>


        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>">Number of photos to show:</label>
            <input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
        </p>
        
        
    <?php
    }
}

// **********************************************************************// 
// ! Recent comments Widget
// **********************************************************************// 

class Etheme_Recent_Comments_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'etheme_widget_recent_comments', 'description' => __( 'The most recent comments (Etheme edit)', ETHEME_DOMAIN ) );
        parent::__construct('etheme-recent-comments', '8theme - '.__('Recent Comments', ETHEME_DOMAIN), $widget_ops);
        $this->alt_option_name = 'etheme_widget_recent_comments';

        if ( is_active_widget(false, false, $this->id_base) )
            add_action( 'wp_head', array(&$this, 'recent_comments_style') );

        add_action( 'comment_post', array(&$this, 'flush_widget_cache') );
        add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache') );
    }

    function recent_comments_style() {
        if ( ! current_theme_supports( 'widgets' ) // Temp hack #14876
            || ! apply_filters( 'show_recent_comments_widget_style', true, $this->id_base ) )
            return;
        ?>
    <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
<?php
    }

    function flush_widget_cache() {
        wp_cache_delete('etheme_widget_recent_comments', 'widget');
    }

    function widget( $args, $instance ) {
        global $comments, $comment;

        $cache = wp_cache_get('etheme_widget_recent_comments', 'widget');

        if ( ! is_array( $cache ) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        extract($args, EXTR_SKIP);
        $output = '';
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 5;

        $comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) );
        $output .= $before_widget;
        if ( $title != '')
            $output .= $before_title . $title . $after_title;

        $output .= '<ul id="recentcomments">';
        if ( $comments ) {
            foreach ( (array) $comments as $comment) {
                //$output .=  '<li class="recentcomments"><div class="comment-date">' . get_comment_date('d') . ' <span>' . get_comment_date('M') . '</span>' . '</div>' . sprintf(_x('<span class="comment_author">%1$s</span> <br> %2$s', 'widgets'), get_comment_author_link(), '<span class="comment_link"><a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . get_the_title($comment->comment_post_ID) . '</a></span>') . '<div class="clear"></div></li>';

                $output .=  '<li class="recentcomments">';
                    $output .=  '<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '" class="post-title">' . get_the_title($comment->comment_post_ID) . '</a><br>';
                    $output .=  get_the_time('d M Y', $comment->comment_post_ID);
                    $output .=  ' @ '.get_the_time(get_option('time_format'), $comment->comment_post_ID);
                    $output .=  ' '.__('by', ETHEME_DOMAIN).' <span class="comment_author">'.get_comment_author_link().'</span>';
                $output .=  '</li>';
            }
        }
        $output .= '</ul>';
        $output .= $after_widget;

        echo $output;
        $cache[$args['widget_id']] = $output;
        wp_cache_set('widget_recent_comments', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = absint( $new_instance['number'] );
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['etheme_widget_recent_comments']) )
            delete_option('etheme_widget_recent_comments');

        return $instance;
    }

    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', ETHEME_DOMAIN); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show:', ETHEME_DOMAIN); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
    }
}

/* Forms
-------------------------------------------------------------- */
function etheme_widget_label( $label, $id ) {
    echo "<label for='{$id}'>{$label}</label>";
}
function etheme_widget_input_checkbox( $label, $id, $name, $checked, $value = 1 ) {
    echo "\n\t\t\t<p>";
    echo "<label for='{$id}'>";
    echo "<input type='checkbox' id='{$id}' value='{$value}' name='{$name}' {$checked} /> ";
    echo "{$label}</label>";
    echo '</p>';
}
function etheme_widget_textarea( $label, $id, $name, $value ) {
    echo "\n\t\t\t<p>";
    etheme_widget_label( $label, $id );
    echo "<textarea id='{$id}' name='{$name}' rows='3' cols='10' class='widefat'>" . strip_tags( $value ) . "</textarea>";
    echo '</p>';
}
function etheme_widget_input_text( $label, $id, $name, $value ) {
    echo "\n\t\t\t<p>";
    etheme_widget_label( $label, $id );
    echo "<input type='text' id='{$id}' name='{$name}' value='" . strip_tags( $value ) . "' class='widefat' />";
    echo '</p>';
}


class null_instagram_widget extends WP_Widget {

    function null_instagram_widget() {
        $widget_ops = array('classname' => 'null-instagram-feed', 'description' => __('Displays your latest Instagram photos', ETHEME_DOMAIN) );
        parent::__construct('null-instagram-feed', __('Instagram', ETHEME_DOMAIN), $widget_ops);
    }

    function widget($args, $instance) {

        extract($args, EXTR_SKIP);

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $username = empty($instance['username']) ? '' : $instance['username'];
        $limit = empty($instance['number']) ? 9 : $instance['number'];
        $size = empty($instance['size']) ? 'thumbnail' : $instance['size'];
        $target = empty($instance['target']) ? '_self' : $instance['target'];
        $link = empty($instance['link']) ? '' : $instance['link'];
        $slider = empty($instance['slider']) ? false : true;
        $spacing = empty($instance['spacing']) ? false : true;

        echo $before_widget;
        if(!empty($title)) { echo $before_title . $title . $after_title; };

        do_action( 'wpiw_before_widget', $instance );

        if ($username != '') {

            $media_array = $this->scrape_instagram($username, $limit);

            if ( is_wp_error($media_array) ) {

                echo $media_array->get_error_message();

            } else {

                // filter for images only?
                if ( $images_only = apply_filters( 'wpiw_images_only', FALSE ) )
                    $media_array = array_filter( $media_array, array( $this, 'images_only' ) );

                // filters for custom classes
                $liclass = esc_attr( apply_filters( 'wpiw_item_class', '' ) );
                $aclass = esc_attr( apply_filters( 'wpiw_a_class', '' ) );
                $imgclass = esc_attr( apply_filters( 'wpiw_img_class', '' ) );

                ?><ul class="instagram-pics instagram-size-<?php echo esc_attr( $instance['size'] ); ?> <?php if($spacing) echo 'instagram-no-space'; ?> <?php if($slider) echo 'instagram-slider'; ?>"><?php
                foreach ( $media_array as $item ) {
                    // copy the else line into a new file (parts/wp-instagram-widget.php) within your theme and customise accordingly
                    if ( locate_template( 'parts/wp-instagram-widget.php' ) != '' ) {
                        include( locate_template( 'parts/wp-instagram-widget.php' ) );
                    } else {
                        echo '<li class="'. $liclass .'"><a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'"  class="'. $aclass .'"><img src="'. esc_url( $item['thumbnail'] ) .'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'"  class="'. $imgclass .'"/></a></li>';
                    }
                }
                ?></ul><?php

                if($slider) {
                    $large_items = 6;
                    switch ($instance['size']) {
                        case 'thumbnail':
                            $large_items = 8;
                        break;
                        case 'small':
                            $large_items = 6;
                        break;
                        case 'large':
                            $large_items = 4;
                        break;
                    }
                    $items = '[[0, 2], [479,2], [619,3], [768,' . ($large_items - 2) . '],  [1200, ' . ($large_items - 1) . '], [1600, ' . $large_items . ']]';
                    ?>
                        <script type="text/javascript">
                            jQuery(".instagram-slider").owlCarousel({
                                items:4, 
                                lazyLoad : false,
                                navigation: true,
                                navigationText:false,
                                rewindNav: false,
                                itemsCustom: <?php echo $items; ?>
                            });
                        </script>
                    <?php
                }
            }
        }

        if ($link != '') {
            ?><p class="clear"><a href="//instagram.com/<?php echo trim($username); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>"><?php echo $link; ?></a></p><?php
        }

        do_action( 'wpiw_after_widget', $instance );

        echo $after_widget;
    }

    function form($instance) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => __('Instagram', ETHEME_DOMAIN), 'username' => '', 'link' => __('Follow Us', ETHEME_DOMAIN), 'number' => 9, 'size' => 'thumbnail', 'target' => '_self') );
        $title = esc_attr($instance['title']);
        $username = esc_attr($instance['username']);
        $number = absint($instance['number']);
        $size = esc_attr($instance['size']);
        $target = esc_attr($instance['target']);
        $link = esc_attr($instance['link']);
        $slider = esc_attr($instance['slider']);
        $spacing = esc_attr($instance['spacing']);

        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', ETHEME_DOMAIN); ?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username', ETHEME_DOMAIN); ?>: <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of photos', ETHEME_DOMAIN); ?>: <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Photo size', ETHEME_DOMAIN); ?>:</label>
            <select id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" class="widefat">
                <option value="thumbnail" <?php selected('thumbnail', $size) ?>><?php _e('Thumbnail', ETHEME_DOMAIN); ?></option>
                <option value="small" <?php selected('small', $size) ?>><?php _e('Small', ETHEME_DOMAIN); ?></option>
                <option value="large" <?php selected('large', $size) ?>><?php _e('Large', ETHEME_DOMAIN); ?></option>
            </select>
        </p>
        <p><label for="<?php echo $this->get_field_id('target'); ?>"><?php _e('Open links in', ETHEME_DOMAIN); ?>:</label>
            <select id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" class="widefat">
                <option value="_self" <?php selected('_self', $target) ?>><?php _e('Current window (_self)', ETHEME_DOMAIN); ?></option>
                <option value="_blank" <?php selected('_blank', $target) ?>><?php _e('New window (_blank)', ETHEME_DOMAIN); ?></option>
            </select>
        </p>
        <p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link text', ETHEME_DOMAIN); ?>: <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" /></label></p>
        <p>
            <input type="checkbox" <?php checked( true, $slider, true); ?> id="<?php echo $this->get_field_id('slider'); ?>" name="<?php echo $this->get_field_name('slider'); ?>">
            <label for="<?php echo $this->get_field_id('slider'); ?>"><?php _e('Carousel', ETHEME_DOMAIN); ?></label>
        </p>
        <p>
            <input type="checkbox" <?php checked( true, $spacing, true); ?> id="<?php echo $this->get_field_id('spacing'); ?>" name="<?php echo $this->get_field_name('spacing'); ?>">
            <label for="<?php echo $this->get_field_id('spacing'); ?>"><?php _e('Without spacing', ETHEME_DOMAIN); ?></label>
        </p>
        <?php

    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['username'] = trim(strip_tags($new_instance['username']));
        $instance['number'] = !absint($new_instance['number']) ? 9 : $new_instance['number'];
        $instance['size'] = (($new_instance['size'] == 'thumbnail' || $new_instance['size'] == 'large' || $new_instance['size'] == 'small') ? $new_instance['size'] : 'thumbnail');
        $instance['target'] = (($new_instance['target'] == '_self' || $new_instance['target'] == '_blank') ? $new_instance['target'] : '_self');
        $instance['link'] = strip_tags($new_instance['link']);
        $instance['slider'] = ($new_instance['slider'] != '') ? true : false;
        $instance['spacing'] = ($new_instance['spacing'] != '') ? true : false;
        return $instance;
    }

    // based on https://gist.github.com/cosmocatalano/4544576
    function scrape_instagram( $username, $slice = 9 ) {
        $username = strtolower( $username );
        if ( false === ( $instagram = get_transient( 'instagram-media-new-'.sanitize_title_with_dashes( $username ) ) ) ) {
            $remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );
            if ( is_wp_error( $remote ) )
                return new WP_Error( 'site_down', __( 'Unable to communicate with Instagram.', 'wpiw' ) );
            if ( 200 != wp_remote_retrieve_response_code( $remote ) )
                return new WP_Error( 'invalid_response', __( 'Instagram did not return a 200.', 'wpiw' ) );
            $shards = explode( 'window._sharedData = ', $remote['body'] );
            $insta_json = explode( ';</script>', $shards[1] );
            $insta_array = json_decode( $insta_json[0], TRUE );
            if ( !$insta_array )
                return new WP_Error( 'bad_json', __( 'Instagram has returned invalid data.', 'wpiw' ) );
            // old style
            if ( isset( $insta_array['entry_data']['UserProfile'][0]['userMedia'] ) ) {
                $images = $insta_array['entry_data']['UserProfile'][0]['userMedia'];
                $type = 'old';
            // new style
            } else if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
                $images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
                $type = 'new';
            } else {
                return new WP_Error( 'bad_json_2', __( 'Instagram has returned invalid data.', 'wpiw' ) );
            }
            if ( !is_array( $images ) )
                return new WP_Error( 'bad_array', __( 'Instagram has returned invalid data.', 'wpiw' ) );
            $instagram = array();
            switch ( $type ) {
                case 'old':
                    foreach ( $images as $image ) {
                        if ( $image['user']['username'] == $username ) {
                            $image['link']                        = preg_replace( "/^http:/i", "", $image['link'] );
                            $image['images']['thumbnail']          = preg_replace( "/^http:/i", "", $image['images']['thumbnail'] );
                            $image['images']['standard_resolution'] = preg_replace( "/^http:/i", "", $image['images']['standard_resolution'] );
                            $image['images']['low_resolution']    = preg_replace( "/^http:/i", "", $image['images']['low_resolution'] );
                            $instagram[] = array(
                                'description'   => $image['caption']['text'],
                                'link'          => $image['link'],
                                'time'          => $image['created_time'],
                                'comments'      => $image['comments']['count'],
                                'likes'         => $image['likes']['count'],
                                'thumbnail'     => $image['images']['thumbnail'],
                                'large'         => $image['images']['standard_resolution'],
                                'small'         => $image['images']['low_resolution'],
                                'type'          => $image['type']
                            );
                        }
                    }
                break;
                default:
                    foreach ( $images as $image ) {
                        $image['display_src'] = preg_replace( "/^http:/i", "", $image['display_src'] );
                        if ( $image['is_video']  == true ) {
                            $type = 'video';
                        } else {
                            $type = 'image';
                        }
                        $instagram[] = array(
                            'description'   => __( 'Instagram Image', 'wpiw' ),
                            'link'          => '//instagram.com/p/' . $image['code'],
                            'time'          => $image['date'],
                            'comments'      => $image['comments']['count'],
                            'likes'         => $image['likes']['count'],
                            'thumbnail'     => $image['display_src'],
                            'type'          => $type
                        );
                    }
                break;
            }
            // do not set an empty transient - should help catch private or empty accounts
            if ( ! empty( $instagram ) ) {
                $instagram = base64_encode( serialize( $instagram ) );
                set_transient( 'instagram-media-new-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
            }
        }
        if ( ! empty( $instagram ) ) {
            $instagram = unserialize( base64_decode( $instagram ) );
            return array_slice( $instagram, 0, $slice );
        } else {
            return new WP_Error( 'no_images', __( 'Instagram did not return any images.', 'wpiw' ) );
        }
    }

    function images_only($media_item) {

        if ($media_item['type'] == 'image')
            return true;

        return false;
    }
}


// **********************************************************************// 
// ! Recent socials Widget
// **********************************************************************// 
class Etheme_Socials_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'etheme_widget_socials', 'description' => __( "Social links widget", ET_DOMAIN) );
        parent::__construct('etheme-socials', '8theme - '.__('Social links', ET_DOMAIN), $widget_ops);
        $this->alt_option_name = 'etheme_widget_socials';
    }

    function widget($args, $instance) {
        extract($args);


        $title = apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
        if ( !$number = (int) $instance['number'] )
                $number = 10;
        else if ( $number < 1 )
                $number = 1;
        else if ( $number > 15 )
                $number = 15;


        $slider = (!empty($instance['slider'])) ? (int) $instance['slider'] : false;
        $image = (!empty($instance['image'])) ? (int) $instance['image'] : false;
        $size = (!empty($instance['size'])) ? $instance['size'] : '';
        $target = (!empty($instance['target'])) ? $instance['target'] : '';

        $facebook = (!empty($instance['facebook'])) ? $instance['facebook'] : '';
        $twitter = (!empty($instance['twitter'])) ? $instance['twitter'] : '';
        $instagram = (!empty($instance['instagram'])) ? $instance['instagram'] : '';
        $google = (!empty($instance['google'])) ? $instance['google'] : '';
        $pinterest = (!empty($instance['pinterest'])) ? $instance['pinterest'] : '';
        $linkedin = (!empty($instance['linkedin'])) ? $instance['linkedin'] : '';
        $tumblr = (!empty($instance['tumblr'])) ? $instance['tumblr'] : '';
        $youtube = (!empty($instance['youtube'])) ? $instance['youtube'] : '';
        $vimeo = (!empty($instance['vimeo'])) ? $instance['vimeo'] : '';
        $rss = (!empty($instance['rss'])) ? $instance['rss'] : '';
        $colorfull = (!empty($instance['colorfull'])) ? $instance['colorfull'] : '';


        echo $before_widget;
        if(!$title == '' ){
            echo $before_title;
            echo $title;
            echo $after_title;
        }

        echo et_follow_shortcode(array(
            'size' => $size,
            'target' => $target,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'instagram' => $instagram,
            'google' => $google,
            'pinterest' => $pinterest,
            'linkedin' => $linkedin,
            'tumblr' => $tumblr,
            'youtube' => $youtube,
            'vimeo' => $vimeo,
            'rss' => $rss,
            'colorfull' => $colorfull,
        ));

        echo $after_widget;
        
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['size'] = strip_tags($new_instance['size']);
        $instance['target'] = strip_tags($new_instance['target']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['slider'] = (int) $new_instance['slider'];
        $instance['image'] = (int) $new_instance['image'];

        $instance['facebook'] = strip_tags($new_instance['facebook']);
        $instance['twitter'] = strip_tags($new_instance['twitter']);
        $instance['instagram'] = strip_tags($new_instance['instagram']);
        $instance['google'] = strip_tags($new_instance['google']);
        $instance['pinterest'] = strip_tags($new_instance['pinterest']);
        $instance['linkedin'] = strip_tags($new_instance['linkedin']);
        $instance['tumblr'] = strip_tags($new_instance['tumblr']);
        $instance['youtube'] = strip_tags($new_instance['youtube']);
        $instance['vimeo'] = strip_tags($new_instance['vimeo']);
        $instance['rss'] = strip_tags($new_instance['rss']);
        $instance['colorfull'] = (int) ($new_instance['colorfull']);



        return $instance;
    }

    function form( $instance ) {
        $title = @esc_attr($instance['title']);
        $size = @esc_attr($instance['size']);
        $target = @esc_attr($instance['target']);

        $facebook = @esc_attr($instance['facebook']);
        $twitter = @esc_attr($instance['twitter']);
        $instagram = @esc_attr($instance['instagram']);
        $google = @esc_attr($instance['google']);
        $pinterest = @esc_attr($instance['pinterest']);
        $linkedin = @esc_attr($instance['linkedin']);
        $tumblr = @esc_attr($instance['tumblr']);
        $youtube = @esc_attr($instance['youtube']);
        $vimeo = @esc_attr($instance['vimeo']);
        $rss = @esc_attr($instance['rss']);


        $slider = (int) @$instance['slider'];
        $image = (int) @$instance['image'];
        $colorfull = (int) @$instance['colorfull'];

        etheme_widget_input_text(__('Title', ET_DOMAIN), $this->get_field_id('title'),$this->get_field_name('title'), $title);
        etheme_widget_input_dropdown(__('Size', ET_DOMAIN), $this->get_field_id('size'),$this->get_field_name('size'), $size, array(
            'small' => 'Small',
            'normal' => 'Normal',
            'large' => 'Large',
        ));     

        etheme_widget_input_text(__('Facebook link', ET_DOMAIN), $this->get_field_id('facebook'),$this->get_field_name('facebook'), $facebook);
        etheme_widget_input_text(__('Twitter link', ET_DOMAIN), $this->get_field_id('twitter'),$this->get_field_name('twitter'), $twitter);
        etheme_widget_input_text(__('Instagram link', ET_DOMAIN), $this->get_field_id('instagram'),$this->get_field_name('instagram'), $instagram);
        etheme_widget_input_text(__('Google + link', ET_DOMAIN), $this->get_field_id('google'),$this->get_field_name('google'), $google);
        etheme_widget_input_text(__('Pinterest link', ET_DOMAIN), $this->get_field_id('pinterest'),$this->get_field_name('pinterest'), $pinterest);
        etheme_widget_input_text(__('LinkedIn link', ET_DOMAIN), $this->get_field_id('linkedin'),$this->get_field_name('linkedin'), $linkedin);
        etheme_widget_input_text(__('Tumblr link', ET_DOMAIN), $this->get_field_id('tumblr'),$this->get_field_name('tumblr'), $tumblr);
        etheme_widget_input_text(__('YouTube link', ET_DOMAIN), $this->get_field_id('youtube'),$this->get_field_name('youtube'), $youtube);
        etheme_widget_input_text(__('Vimeo link', ET_DOMAIN), $this->get_field_id('vimeo'),$this->get_field_name('vimeo'), $vimeo);
        etheme_widget_input_text(__('RSS link', ET_DOMAIN), $this->get_field_id('rss'),$this->get_field_name('rss'), $rss);
        etheme_widget_input_checkbox(__('Colorfull icons', ET_DOMAIN), $this->get_field_id('colorfull'),$this->get_field_name('colorfull'), checked( 1, $colorfull, false ), 1);

        etheme_widget_input_dropdown(__('Link Target', ET_DOMAIN), $this->get_field_id('target'),$this->get_field_name('target'), $target, array(
            '_self' => 'Current window',
            '_blank' => 'Blank',
        ));

    }
}

if(!function_exists('etheme_widget_input_dropdown')) {
    function etheme_widget_input_dropdown( $label, $id, $name, $value, $options ) {
        echo "\n\t\t\t<p>";
        etheme_widget_label( $label, $id );
        echo "<select id='{$id}' name='{$name}' class='widefat'>";
        echo '<option value=""></option>';
        foreach ($options as $key => $option) {
            echo '<option value="' . $key . '" ' . selected( strip_tags( $value ), $key ) . '>' . $option . '</option>';
        }
        echo "</select>";
        echo '</p>';
    }
}

