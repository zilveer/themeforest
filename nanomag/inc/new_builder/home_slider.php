<?php
class home_post_slider extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => esc_attr__('Post slider', 'nanomag'),
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('home_post_slider', $block_options);
	}
	
	
	//create form
	function form($instance) {
        $titles = isset($instance['titles']) ? esc_attr($instance['titles']) : 'Home slider';
        $number_show = isset($instance['number_show']) ? absint($instance['number_show']) : 5;
		$number_offset = isset($instance['number_offset']) ? absint($instance['number_offset']) : 0;
		$css_class_builder = isset($instance['css_class_builder']) ? esc_attr($instance['css_class_builder']) : 'color-2';
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('titles')); ?>"><?php esc_attr_e('Title:', 'nanomag'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('titles')); ?>" name="<?php echo esc_attr($this->get_field_name('titles')); ?>" type="text" value="<?php echo esc_attr($titles); ?>" /></p>

            <p><label for="<?php echo esc_attr($this->get_field_id('css_class_builder')); ?>"><?php esc_attr_e('CSS class','nanomag'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('css_class_builder')); ?>" name="<?php echo esc_attr($this->get_field_name('css_class_builder')); ?>" type="text" value="<?php echo esc_attr($css_class_builder); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('number_show')); ?>"><?php esc_attr_e('Number of posts to show:', 'nanomag'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number_show')); ?>" name="<?php echo esc_attr($this->get_field_name('number_show')); ?>" type="text" value="<?php echo esc_attr(esc_attr($number_show)); ?>" size="3" /></p>
            
             <p><label for="<?php echo esc_attr($this->get_field_id('number_offset')); ?>"><?php esc_attr_e('Offset posts:', 'nanomag'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number_offset')); ?>" name="<?php echo esc_attr($this->get_field_name('number_offset')); ?>" type="text" value="<?php echo esc_attr($number_offset); ?>" size="3" /></p>    


        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cats')); ?>"><?php esc_attr_e('Choose your category:', 'nanomag'); ?> 

        <?php
        $categories = get_categories('hide_empty=0');
        echo "<br/>";
        foreach ($categories as $cat) {
            $option = '<input type="checkbox" id="' . $this->get_field_id('cats') . '[]" name="' . $this->get_field_name('cats') . '[]"';
            if (isset($instance['cats'])) {
                foreach ($instance['cats'] as $cats) {
                    if ($cats == $cat->term_id) {
                        $option = $option . ' checked="checked"';
                    }
                }
            }
            $option .= ' value="' . $cat->term_id . '" />';
            $option .= '&nbsp;';
            $option .= $cat->cat_name;
            $option .= '<br />';
            echo $option;
        }
        ?>
            </label>
        </p>
		<?php
		
	}
		
	
	//create block
	function block($instance) {
		
		    extract($instance);
        $titles = apply_filters('widget_title', empty($instance['titles']) ? ' ' : $instance['titles'], $instance, $this->id_base);
		
			if (!$number_show = absint( $instance['number_show'] )){$number_show = 5;}
			if (isset($instance['number_offset'])==''){$number_offset = 0;}else{$number_offset = absint($instance['number_offset']);}
			if (!isset($instance["cats"])){$cats = '';}
			$jellywp_args=array(						   
				'showposts' => $number_show,
				'category__in'=> $cats,
				'ignore_sticky_posts' => 1,
				'offset' => $number_offset
				);
			$jellywp_widget = null;
			$jellywp_widget = new WP_Query($jellywp_args);


        // Post list in widget>?>
        <div class="widget post_list_medium_widget <?php echo esc_attr($instance['css_class_builder']);?>">
        <?php if (!empty($instance['titles'])) {?><div class="widget-title"><h2><?php echo esc_attr($instance["titles"]);?></h2></div><?php }?>
		<div class="widget_container">
		  <div class="owl_slider slider-large content-sliders owl-carousel builder_slider">
		<?php
		$i=0;
        while ($jellywp_widget->have_posts()) {
			$i++;
			$post_id = get_the_ID();
            $jellywp_widget->the_post();
		    ?>
  	    	 <div class="item_slide image_post">
              <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('slider-feature');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/slider-feature.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
</a>
<?php echo jelly_total_score_post_front(get_the_ID());?>

<div class="caption_overlay_image main_caption">
 <h3 class="image-post-title columns_post"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
<?php echo jelly_post_meta(get_the_ID()); ?>
</div>

</div>
            <?php }?>
        </div>
 
        
        </div>
                
</div>
         <?php
        wp_reset_query();
    }
	
	    function update($new_instance, $old_instance) {
        return $new_instance;
    }

	
}
