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
        $dropdown = $instance['dropdown'];
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
			if($dropdown == 1) {
				?>
					<select id="dropdown_layered_brand">
						<option value="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>"><?php _e('Any Brand', ETHEME_DOMAIN); ?></option>
						<?php
						    foreach ($terms as $term) {
						        $i++;
						        $curr = false;
						        $thumbnail_id 	= absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) );
						        if(isset($current_term->term_id) && $current_term->term_id == $term->term_id) {
							        $curr = true;
						        }
						        ?>
						        	<option <?php if($curr) echo 'selected="selected"'; ?> value="<?php echo get_term_link( $term ); ?>">
						        		<?php echo $term->name; ?>
						        	</option>
								<?php
						    }
						?>
					</select>
				<?php
					wc_enqueue_js("

						jQuery('#dropdown_layered_brand').change(function(){
						
							location.href = jQuery('#dropdown_layered_brand').val();

						});

					");
			} else {
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
					        	<li <?php if($curr) echo 'class="active-brand"'; ?>>
					        		<a href="<?php echo get_term_link( $term ); ?>" title="<?php echo sprintf(__('View all products from %s', ETHEME_DOMAIN), $term->name); ?>"><?php echo $term->name; ?></a>
					        	</li>
							<?php
					    }
					?>
				</ul>
				<?php
			}
        }
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['dropdown'] = $new_instance['dropdown'];

        return $instance;
    }

    function form( $instance ) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $dropdown = isset($instance['dropdown']) ? $instance['dropdown'] : '';

?>
        <?php etheme_widget_input_text(__('Title', ETHEME_DOMAIN), $this->get_field_id('title'),$this->get_field_name('title'), $title); ?>
        <?php etheme_widget_input_checkbox(__('Show as a drop down', ETHEME_DOMAIN), $this->get_field_id('dropdown'), $this->get_field_name('dropdown'),checked($dropdown, true, false), 1); ?>

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
        $products = (bool) $instance['products'];
        $images = (bool) $instance['images'];
        $posts = (bool) $instance['posts'];
        $portfolio = (bool) $instance['portfolio'];
        $pages = (bool) $instance['pages'];
        echo $before_widget;
        echo etheme_search(array(
			'products' => $products,
			'posts' => $posts,
			'portfolio' => $portfolio,
			'pages' => $pages,
			'images' => $images,
			'count' => $count
        ));
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['count'] = (int) $new_instance['count'];
        $instance['products'] = (bool) $new_instance['products'];
        $instance['images'] = (bool) $new_instance['images'];
        $instance['posts'] = (bool) $new_instance['posts'];
        $instance['portfolio'] = (bool) $new_instance['portfolio'];
        $instance['pages'] = (bool) $new_instance['pages'];

        return $instance;
    }

    function form( $instance ) {
        $products = isset($instance['products']) ? (bool) $instance['products'] : false;
        $images = isset($instance['images']) ? (bool) $instance['images'] : false;
        $posts = isset($instance['posts']) ? (bool) $instance['posts'] : false;
        $portfolio = isset($instance['portfolio']) ? (bool) $instance['portfolio'] : false;
        $pages = isset($instance['pages']) ? (bool) $instance['pages'] : false;
        $count = isset($instance['count']) ? $instance['count'] : '';

?>

        <?php etheme_widget_input_checkbox(__('Search for products', ETHEME_DOMAIN), $this->get_field_id('products'), $this->get_field_name('products'),checked($products, true, false), 1); ?>
        <?php etheme_widget_input_checkbox(__('Display images for products', ETHEME_DOMAIN), $this->get_field_id('images'), $this->get_field_name('images'),checked($images, true, false), 1); ?>
        <?php etheme_widget_input_checkbox(__('Search for posts', ETHEME_DOMAIN), $this->get_field_id('posts'), $this->get_field_name('posts'),checked($posts, true, false), 1); ?>
        <?php etheme_widget_input_checkbox(__('Search in portfolio', ETHEME_DOMAIN), $this->get_field_id('portfolio'), $this->get_field_name('portfolio'),checked($portfolio, true, false), 1); ?>
        <?php etheme_widget_input_checkbox(__('Search for pages', ETHEME_DOMAIN), $this->get_field_id('pages'), $this->get_field_name('pages'),checked($pages, true, false), 1); ?>
        
        <?php etheme_widget_input_text(__('Number of items from each section', ETHEME_DOMAIN), $this->get_field_id('count'),$this->get_field_name('count'), $count); ?>

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

        if ( isset($cache[$args['widget_id']]) ) {
                echo $cache[$args['widget_id']];
                return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
        if ( !$number = (int) $instance['number'] )
                $number = 10;
        else if ( $number < 1 )
                $number = 1;
        else if ( $number > 15 )
                $number = 15;

        $r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
        if ($r->have_posts()) : ?>
        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
            <div>
                <?php  while ($r->have_posts()) : $r->the_post(); ?>
                    <div class="recent-post-mini">
                        <?php 
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), array(130,130));
                            $url = $thumb[0];
                            if($url && $url != ''):
                        ?>
                            <a class="postimg" href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><img src="<?php echo etheme_get_image(false,70,70); ?>" /></a>
                            
                        <?php endif; ?>
                        <?php
                            if ( get_the_title() ) $title = get_the_title(); else $title = get_the_ID();

                            $title = trunc($title, 10);
                        ?>
                        <a href="<?php the_permalink() ?>" <?php if(!$url || $url == '') echo 'style="width:100%;"' ?> title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                            <?php echo $title; ?> 
                        </a><br />
                        <?php _e('by', ETHEME_DOMAIN) ?> <strong><?php the_author(); ?></strong><br>
                        <?php the_time(get_option('date_format')); ?>
                        <div class="clear"></div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php echo $after_widget; ?>
<?php
                wp_reset_query();  // Restore global post data stomped by the_post().
        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_add('etheme_widget_recent_entries', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
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
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', ETHEME_DOMAIN); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', ETHEME_DOMAIN); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
        <small><?php _e('(at most 15)', ETHEME_DOMAIN); ?></small></p>
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
