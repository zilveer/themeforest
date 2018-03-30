<?php
/**
 * GalleryWidget Class
 */
 
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

class GalleryWidgetObject extends WP_Widget {
    
    /** constructor */
    function GalleryWidgetObject() {
        // parent::WP_Widget(false, $name = 'GalleryWidget');
        $widget_ops = array('classname' => 'widget_search', 'description' => __( "A gallery of images that are attached to your posts", 'gallerywidget') );
		parent::__construct('GalleryWidget', __('KingSize Gallery Widget', 'gallerywidget'), $widget_ops);	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        global $galleryWidget;
	extract($args);
	$title = apply_filters('widget_title', $instance['title']);
        $max = esc_attr($instance['max']);
        $order = esc_attr($instance['order']);
        $category_option = esc_attr($instance['category_option']);
        $linktype = esc_attr($instance['linktype']);
        $singleimage = esc_attr($instance['singleimage']);
        $showon = esc_attr($instance['showon']);

        $titletype = esc_attr($instance['titletype']);
        $thumbsize = '';
		$categories = '';
		$linkclass = '';
		$linkrel = '';
		
		  if ((is_home() && $showon == 'home') || $showon == 'all') {

            echo $before_widget;
            if ( $title )
                echo $before_title . $title . $after_title;

            // main widget output
            if ($category_option == "include" || $category_option == "exclude") {
                echo $galleryWidget->getAttachedImagesByCategories($max, $order, $categories,
                    $category_option, $linktype,
                    $linkclass, $linkrel,
                    $singleimage,$titletype,$thumbsize);
            } else {
                echo $galleryWidget->getAttachedImages($max, $order, $linktype, $linkclass, $linkrel, $thumbsize);
            }
            
            echo $after_widget;
        }
        

    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
		$new_instance = (array) $new_instance;
		return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => 'GalleryWidget',
                                                             'max' => 3,
                                                             'order' => 'random',
                                                             'category_option' => 'exclude',
															 'categories' => 0,
															 'showon' => 'all',
                                                             'linktype' => 'just display',
                                                             'singleimage' => 'no',
                                                             'titletype' => 'default',
                                                             'thumbsize' => 'thumbnail'));
        $order_options = array("latest", "random");
        $category_option_options = array('all', 'include', 'exclude');
		//'direct',
        $linktype_options = array('just display','page',  'article');
        $singleimage_options = array('no', 'yes');
        $titletype_options = array('image', 'post');
        $thumbsize_options = get_intermediate_image_sizes();

        $title = esc_attr($instance['title']);
        $max = esc_attr($instance['max']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'gallerywidget'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

            <p><label for="<?php echo $this->get_field_id('max'); ?>"><?php _e('How many images:', 'gallerywidget'); ?> <input class="widefat" id="<?php echo $this->get_field_id('max'); ?>" name="<?php echo $this->get_field_name('max'); ?>" type="text" value="<?php echo $max; ?>" /></label></p>

            <p>
            <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order by:', 'gallerywidget'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
            <?php
            foreach ( $order_options as $value ) {
                echo '<option value="' . $value . '"'
                    . ( $value == $instance['order'] ? ' selected="selected"' : '' )
                    . '>' . $value . "</option>\n";
            }
            ?>
            </select></p>


            <p>
            <label for="<?php echo $this->get_field_id('linktype'); ?>"><?php _e('Image Link type*:', 'gallerywidget'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('linktype'); ?>" name="<?php echo $this->get_field_name('linktype'); ?>">
            <?php
            foreach ( $linktype_options as $value ) {
                echo '<option value="' . $value . '"'
                    . ( $value == $instance['linktype'] ? ' selected="selected"' : '' )
                    . '>' . $value . "</option>\n";
            }
            ?>
            </select></p>

            <p>
            <label for="<?php echo $this->get_field_id('titletype'); ?>"><?php _e('Image Hover Title*:', 'gallerywidget'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('titletype'); ?>" name="<?php echo $this->get_field_name('titletype'); ?>">
            <?php
            foreach ( $titletype_options as $value ) {
                echo '<option value="' . $value . '"'
                    . ( $value == $instance['titletype'] ? ' selected="selected"' : '' )
                    . '>' . $value . "</option>\n";
            }
            ?>
            </select></p>

            <p>
            <label for="<?php echo $this->get_field_id('singleimage'); ?>"><?php _e('Show only 1 image per post*:', 'gallerywidget'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('singleimage'); ?>" name="<?php echo $this->get_field_name('singleimage'); ?>">
            <?php
            foreach ( $singleimage_options as $value ) {
                echo '<option value="' . $value . '"'
                    . ( $value == $instance['singleimage'] ? ' selected="selected"' : '' )
                    . '>' . $value . "</option>\n";
            }
            ?>
            </select></p>

            <input name="<?php echo $this->get_field_name('showon'); ?>" type="hidden" value="all">
			
		    <input id="<?php echo $this->get_field_id('category_option'); ?>" name="<?php echo $this->get_field_name('category_option'); ?>" type="hidden" value="exclude">
           
        <?php
    }

} // class GalleryWidgetObject

add_action('widgets_init', create_function('', 'return register_widget("GalleryWidgetObject");'));
