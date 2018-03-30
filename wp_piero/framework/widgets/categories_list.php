<?php
add_action('widgets_init', 'cs_categories_content_load_widgets');

function cs_categories_content_load_widgets() {
    register_widget('Cs_Categories_Content_Widget');
}

class Cs_Categories_Content_Widget extends WP_Widget {

    function Cs_Categories_Content_Widget() {
        parent::__construct(
                'cs_categories_content', __('CS Categories Content', THEMENAME), array('description' => __('Popular post, recent post and comments.', THEMENAME),)
        );
    }

    function widget($args, $instance) {

        extract($args);

        $cats = $instance['widget_categories'];
        $number =(int)$instance['num_post'];
        $colunm =(int)$instance['layout_colunm'];
        $layout = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
        switch ($colunm){
        	case 1:
        		$layout = 'col-xs-12 col-sm-6 col-md-12 col-lg-12';
        		break;
        	case 2:
        		$layout = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
        		break;
        	case 3:
        		$layout = 'col-xs-12 col-sm-6 col-md-4 col-lg-4';
        		break;
        	case 4:
        		$layout = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
        		break;
        }

        echo $before_widget;
        ?>
        	<?php $wp_query = new WP_Query(array(
        		'category__in'=> $cats,
        		'posts_per_page' => $number,
        		'post_type' => 'post',
        		'post_status' => 'publish',
        		'orderby' => 'date',
        		'order' => 'DESC',
        		'paged' => 1
        	)); ?>
        	<?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
        	<article id="post-<?php the_ID(); ?>" class="<?php echo $layout; ?> categories_list_post post">
				<header class="cs-post-header">
					<div class="date-type table">
						<div class="date-box table-cell">
							<div class="date left">
			                    <span class="day"><?php echo get_the_date('j'); ?></span>
			                    <span class="month"><?php echo get_the_date('M'); ?></span>
							</div>
							<span class="icon-type-post right"><i class="<?php echo cshero_get_icon_post_type(); ?>"></i></span>
						</div>
						<?php the_title( sprintf( '<h3 class="cs-post-title table-cell"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
					</div>
					<?php if ( 'post' == get_post_type() ) : ?>
						<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
						<div class="cs-post-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div><!-- .entry-thumbnail -->
						<?php endif; ?>
					<?php endif; ?>
				</header><!-- .entry-header -->
			</article><!-- #post-## -->
        	<?php endwhile; ?>
        	<?php wp_reset_postdata(); ?>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['widget_categories'] = $new_instance['widget_categories'];
        $instance['num_post'] = $new_instance['num_post'];
        $instance['layout_colunm'] = $new_instance['layout_colunm'];

        return $instance;
    }

    function form($instance) {
		$defaults = array('widget_categories'=>null,'num_post' => 10,'layout_colunm'=> 2);
		$instance = wp_parse_args((array) $instance, $defaults);
		$walker = new Walker_Category_Checklist_Widget(
				$this->get_field_name('widget_categories'), $this->get_field_id('widget_categories')
		);
        ?>

        <?php
         	wp_category_checklist( 0, 0, $instance['widget_categories'], FALSE, $walker, FALSE);
        ?>
		<p>
            <label for="<?php echo $this->get_field_id('num_post'); ?>">Number posts:</label>
            <input class="widefat" style="width: 30px;" id="<?php echo esc_attr($this->get_field_id('num_post')); ?>" name="<?php echo esc_attr($this->get_field_name('num_post')); ?>" value="<?php echo esc_attr($instance['num_post']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('layout_colunm'); ?>">Number Colunm (1..4):</label>
            <input class="widefat" style="width: 30px;" id="<?php echo esc_attr($this->get_field_id('layout_colunm')); ?>" name="<?php echo esc_attr($this->get_field_name('layout_colunm')); ?>" value="<?php echo esc_attr($instance['layout_colunm']); ?>" />
        </p>
        <?php
    }

}
// This is required to be sure Walker_Category_Checklist class is available
require_once ABSPATH . 'wp-admin/includes/template.php';
/**
 * Custom walker to print category checkboxes for widget forms
 */
class Walker_Category_Checklist_Widget extends Walker_Category_Checklist {

	private $name;
	private $id;

	function __construct( $name = '', $id = '' ){
		$this->name = $name;
		$this->id = $id;
	}

	function start_el( &$output, $cat, $depth = 0, $args = array(), $id = 0 ) {
		extract($args);
		if ( empty($taxonomy) ) $taxonomy = 'category';
		$class = in_array( $cat->term_id, $popular_cats ) ? ' class="popular-category"' : '';
		$id = $this->id . '-' . $cat->term_id;
		$checked = checked( in_array( $cat->term_id, $selected_cats ), true, false );
		$output .= "\n<li id='{$taxonomy}-{$cat->term_id}'$class>"
		. '<label class="selectit"><input value="'
      . $cat->term_id . '" type="checkbox" name="' . $this->name
      . '[]" id="in-'. $id . '"' . $checked
      . disabled( empty( $args['disabled'] ), false, false ) . ' /> '
      . esc_html( apply_filters('the_category', $cat->name ))
      		. '</label>';
	}
	}
?>