<?php
class home_post_grid_small extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
		    'name' => esc_attr__('Grid post small', 'nanomag'),
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('home_post_grid_small', $block_options);
	}
	
	
	//create form
	function form($instance) {
        $titles = isset($instance['titles']) ? esc_attr($instance['titles']) : 'Home grid post small';
        $number_show = isset($instance['number_show']) ? absint($instance['number_show']) : 6;
		$number_offset = isset($instance['number_offset']) ? absint($instance['number_offset']) : 0;
        $show_style_1 = isset($instance['show_style_1']) ? (bool) $instance['show_style_1'] : false;
        $css_class_builder = isset($instance['css_class_builder']) ? esc_attr($instance['css_class_builder']) : 'color-9';
		?>
        <p><label for="<?php echo esc_attr($this->get_field_id('titles')); ?>"><?php esc_attr_e('Title:', 'nanomag'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('titles')); ?>" name="<?php echo esc_attr($this->get_field_name('titles')); ?>" type="text" value="<?php echo esc_attr($titles); ?>" /></p>

            <p><label for="<?php echo esc_attr($this->get_field_id('css_class_builder')); ?>"><?php esc_attr_e('CSS class','nanomag'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('css_class_builder')); ?>" name="<?php echo esc_attr($this->get_field_name('css_class_builder')); ?>" type="text" value="<?php echo esc_attr($css_class_builder); ?>" /></p>
        
        <p><label for="<?php echo esc_attr($this->get_field_id('number_show')); ?>"><?php esc_attr_e('Number of posts to show:', 'nanomag'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number_show')); ?>" name="<?php echo esc_attr($this->get_field_name('number_show')); ?>" type="text" value="<?php echo esc_attr(esc_attr($number_show)); ?>" size="3" /></p>
         <p><label for="<?php echo esc_attr($this->get_field_id('number_offset')); ?>"><?php esc_attr_e('Offset posts:', 'nanomag'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number_offset')); ?>" name="<?php echo esc_attr($this->get_field_name('number_offset')); ?>" type="text" value="<?php echo esc_attr($number_offset); ?>" size="3" /></p>        
            
 
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
		<?php
		
	}
		
	
	//create block
	function block($instance) {
		
		    extract($instance);

        $titles = apply_filters('widget_title', empty($instance['titles']) ? 'Recent Posts' : $instance['titles'], $instance, $this->id_base);
    
        $show_style_1 = isset($instance['show_style_1']) ? $instance['show_style_1'] : false;
      	if (isset($instance['number_offset'])==''){$number_offset = 0;}else{$number_offset = absint($instance['number_offset']);}
        if (!isset($instance["cats"])){$cats = '';}

        // array to call recent posts.

        $jellywp_args = array(
            'showposts' => $number_show,
            'category__in' => $cats,
			'ignore_sticky_posts' => 1,
			'offset' => $number_offset
        );
		


        $jellywp_widget = null;
        $jellywp_widget = new WP_Query($jellywp_args);

        ?>
        <div class="widget four-post-style <?php echo esc_attr($instance['css_class_builder']);?>">
        <?php if (!empty($instance['titles'])) {?><div class="widget-title"><h2><?php echo esc_attr($instance["titles"]);?></h2></div><?php }?>
		<div class="widget_container">
        
        <?php
		$row_count=0;
        while ($jellywp_widget->have_posts()) {
           $row_count++;
		   $post_id = get_the_ID();
		   $jellywp_widget->the_post();
           $categories = get_the_category(get_the_ID());
		          ?>   

    <div class="feature-four-column medium-four-columns <?php if(!of_get_option('disable_css_animation')==1){echo esc_attr("appear_animation");}?>">     
    <div class="image_post feature-item">
                   <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('small-grid');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/small-grid.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
</a>
<?php echo jelly_total_score_post_front_small_circle(get_the_ID());?>
                     </div>
<div class="meta_holder">
<?php  if(of_get_option('disable_post_category') !=1){
          if ($categories) {
            echo '<span class="meta-category-small">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
              $titleColor = jelly_categorys_title_color($tag->term_id, "category", false);
             echo '<a class="post-category-color-text" style="color:'.esc_attr($titleColor).'" href="'.esc_url($tag_link).'">'.$tag->name.'</a>';          
            }
            echo "</span>";
            }
       }?>
<?php echo jelly_post_like_meta(get_the_ID());?>

</div>
 <h3 class="image-post-title columns_post"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
<?php echo jelly_post_meta(get_the_ID()); ?>
 <p><?php echo jelly_post_excerpt(get_the_excerpt('')); ?> </p>
  <?php echo jelly_post_meta_footer(get_the_ID()); ?>
    </div>
         <?php if($row_count%3){}else{echo '<div class="clearfix"></div>';}?>
              
                <?php }?>
     
        </div>
        </div>
     
        <?php
        wp_reset_query();	
		
	}
	
	    function update($new_instance, $old_instance) {
        return $new_instance;
    }

	
}