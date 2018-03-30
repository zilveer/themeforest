<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Recent posts Widget
// **********************************************************************// 
class Etheme_Recent_Posts_Widget extends WP_Widget {

    function Etheme_Recent_Posts_Widget() {
        $widget_ops = array('classname' => 'etheme_widget_recent_entries', 'description' => __( "The most recent posts on your blog (Etheme Edit)", ET_DOMAIN) );
        parent::__construct('etheme-recent-posts', '8theme - '.__('Recent Posts', ET_DOMAIN), $widget_ops);
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
								<?php _e('by', ET_DOMAIN) ?> <strong><?php the_author(); ?></strong> <?php the_time(get_option('date_format')); ?>
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
        $title = @esc_attr($instance['title']);
        if ( !$number = (int) @$instance['number'] )
                $number = 5;

        $slider = (int) @$instance['slider'];
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', ET_DOMAIN); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', ET_DOMAIN); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
        <small><?php _e('(at most 15)', ET_DOMAIN); ?></small></p>

        <?php etheme_widget_input_checkbox(__('Enable slider', ET_DOMAIN), $this->get_field_id('slider'), $this->get_field_name('slider'),checked($slider, true, false), 1); ?>

<?php
    }
}