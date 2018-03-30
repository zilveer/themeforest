<?php

/* Royal Recent Category Slider Widget */

 
class Royal_Recent_Category_Slider_Widget extends WP_Widget {

    function Royal_Recent_Category_Slider_Widget() {
		global $themename;
		$widget_ops = array('classname' => 'custom-slider-posts-widget', 'description' => __( "Slider Posts widget", 'my-text-domain') );
		$control_ops = array('width' => 250, 'height' => 200);
		$this->WP_Widget('sliderposts', __('9) Royal Slider Posts', 'my-text-domain'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
		global $wpdb, $shortname;
        extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Slider Posts', 'my-text-domain') : $instance['title'], $instance, $this->id_base);
		
		if ( !$number = (int) $instance['number'] )
			$number = 5;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		
        $customcategory = $instance['customcategory'];
		$category_id = get_cat_ID( $customcategory );
		
        $disable_thumb = isset($_POST['value']) ? $_POST['value'] : ''; 

		$posts = get_posts("numberposts=$number&cat=$category_id&offset=0");

		echo $before_widget;
		echo $before_title . $title . $after_title;

		if($posts){ 
		
        define( 'BASE_URL', get_template_directory_uri() . '/' );
		wp_enqueue_script('carouFredSel', BASE_URL . 'js/jquery.carouFredSel.js', false, '', true);
		?>
		
<script type="text/javascript">
(function($){ 
$(window).load(function(){ 
   
var carousel = $("#home_car_short");

carousel.carouFredSel({
    width: "100%",
    height: "auto",
    responsive: true,
    auto: true,
	auto : {
		pauseDuration: 5000,
	},
	pagination	: "#home_car_pag",
    scroll: {
        items: 1,
        fx: 'scroll',							
	    pauseOnHover: true
    },
    duration: 1000,
    swipe: {
        onTouch: true,
        onMouse: true
    },
    items: {
        visible    : {
                min    : 1,
                max    : 1
            },
    },
    onCreate : function () {
        $(window).on('resize', function(){
            carousel.parent().add(carousel).css('height', carousel.children().first().height() + 'px');
        }).trigger('resize');
    }
});  

})
})(jQuery);
</script>

		<div class="image_carousel">
        <div class="pagination" id="home_car_pag"></div>
        <div id="home_car_short">
		
			<?php foreach($posts as $post){
					$post_title = stripslashes($post->post_title);
					$permalink = get_permalink($post->ID);
					$post_date = $post->post_date;
					$post_date = mysql2date('F j, Y', $post_date, true);
					$category = get_the_category($post->ID);
					$category_link = get_category_link($post->ID);
			?>

			<div class="image_carousel_post">
			
				<?php if(!$disable_thumb) { ?>
				<a href="<?php echo $permalink; ?>">
				<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	
				<?php $image = aq_resize( $thumbnailSrc, 360, 360, true ); ?>
                <img src="<?php echo $image ?>" alt="<?php echo $post_title; ?>" title="<?php echo $post_title; ?>" />
				</a>
				<?php } ?>
				
				<h1 class="car_image_caption">
				<a href="<?php echo $permalink; ?>" rel="bookmark">
	            <span class="slide_time"><?php echo $post_date; ?></span>
	            <span class="car_head"><?php echo $post_title; ?> &raquo;</span>
	            </a>
				</h1>

			<div class="clear"></div>
			</div>
			
		    <?php } ?>
		
		</div>
        </div>
		
			<?php }	
			
		echo $after_widget;
    }

	function update($new_instance, $old_instance) {
	return $new_instance;
	}


    function form($instance) {				
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$customcategory = esc_attr($instance['customcategory']);
		$disable_thumb = isset( $instance['disable_thumb'] ) ? (bool) $instance['disable_thumb'] : false;
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;	
        ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'my-text-domain'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('customcategory'); ?>"><?php _e('Blog Category:','mediapress'); ?></label>
            <?php
            //Access the WordPress Categories via an Array
			$dd_categories = array();
			$dd_categories_obj = get_categories('hide_empty=0');
			foreach ($dd_categories_obj as $dd_cat) {
    			$dd_categories[$dd_cat->cat_ID] = $dd_cat->cat_name;}
			$categories_tmp = array_unshift($dd_categories, "Select a category:");
            ?>
            <select id="<?php echo $this->get_field_id('customcategory'); ?>" name="<?php echo $this->get_field_name('customcategory'); ?>">
			<?php
			//DISPLAY SELECT OPTIONS
			foreach ($dd_categories as $dd_category) {
				if ($customcategory == $dd_category) {
					$selected_option = 'selected="selected"';
				} else {
					$selected_option = '';
				} ?>
				<option value="<?php echo $dd_category; ?>" <?php echo $selected_option; ?>><?php echo $dd_category; ?></option>
				<?php
			} ?>
			</select>
		</p>
		
		<p><label for="<?php echo $this->get_field_id('number'); ?>">Enter the number of recent posts you'd like to display:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('disable_thumb'); ?>" name="<?php echo $this->get_field_name('disable_thumb'); ?>"<?php checked( $disable_thumb ); ?> />
		<label for="<?php echo $this->get_field_id('disable_thumb'); ?>"><?php _e( 'Disable Post Thumbnail?', 'my-text-domain' ); ?></label></p>

        <?php 
    }

}

add_action('widgets_init', create_function('', 'return register_widget("Royal_Recent_Category_Slider_Widget");'));

?>
