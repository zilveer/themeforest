<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Brands Filter Widget
// **********************************************************************// 
class Etheme_Brands_Widget extends WP_Widget {

    function Etheme_Brands_Widget() {
        $widget_ops = array('classname' => 'etheme_widget_brands', 'description' => __( "Products Filter by brands", ET_DOMAIN) );
        parent::__construct('etheme-brands', '8theme - '.__('Brands Filter', ET_DOMAIN), $widget_ops);
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
				        		<a href="<?php echo get_term_link( $term ); ?>" title="<?php echo sprintf(__('View all products from %s', ET_DOMAIN), $term->name); ?>"><?php if($curr) echo '<strong>'; ?><?php echo $term->name; ?><?php if($curr) echo '</strong>'; ?></a>
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
        <?php etheme_widget_input_text(__('Title', ET_DOMAIN), $this->get_field_id('title'),$this->get_field_name('title'), $title); ?>

<?php
    }
}