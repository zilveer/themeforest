<?php
add_action( 'widgets_init', 'recent_widgets' );

function recent_widgets() {
	register_widget( 'recent_widget' );
}

class recent_widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
			
	function __construct() {
    	$widget_ops = array(
			'classname'   => 'post_list_widget', 
			'description' => esc_attr__('Display a list of recent post.', 'nanomag')
		);
    	parent::__construct('rec-recent-posts', esc_attr__('jellywp: Recently Posts', 'nanomag'), $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/

	function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'Recently Articles' : $instance['title'], $instance, $this->id_base);
        if (!$number = absint($instance['number'])){$number = 6;}
        if (!$cats = $instance["cats"]){$cats = '';}
		if (isset($instance['number_offset'])==''){$number_offset = 0;}else{$number_offset = absint($instance['number_offset']);}


        $post_cat_args = array(
            'showposts' => $number,
            'category__in' => $cats,
			'ignore_sticky_posts' => 1,
			'offset' => $number_offset
        );

        $post_cat_widget = null;
        $post_cat_widget = new WP_Query($post_cat_args);


        echo $before_widget;

if($instance["title"]) {
        echo $before_title;
        echo $instance["title"];
        echo $after_title;
    }

        // Post list in widget
		echo '<div class="widget_container">';
        echo '<ul class="feature-post-list recent-post-widget">';

        while ($post_cat_widget->have_posts()) {
            $post_cat_widget->the_post();
			$post_id = get_the_ID();
            //get all post categories
            $categories = get_the_category(get_the_ID());
			 ?>
 
                          <li>
<a  href="<?php the_permalink(); ?>" class="feature-image-link image_post" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('small-feature');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/small-feature.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
</a>
 <div class="item-details">
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
<?php echo jelly_total_score_post_front_small_list(get_the_ID());?>
   <h3 class="feature-post-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
<?php echo jelly_post_meta(get_the_ID()); ?>
</div>
   <div class="clearfix"></div>
   </li>

 
            <?php
        }

        wp_reset_query();

        echo "</ul>\n";
		echo "</div>\n";
        echo $after_widget;
    }

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['cats'] = $new_instance['cats'];
		$instance['number'] = absint($new_instance['number']);
		$instance['number_offset'] = absint($new_instance['number_offset']);
		 
        return $instance;
	}


	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Recent Posts';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$number_offset = isset($instance['number_offset']) ? absint($instance['number_offset']) : 0;
		
?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'nanomag'); ?></label>
        <input width="100%" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
                        
        <p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_attr_e('Number of posts to show:', 'nanomag'); ?></label>
        <input width="100%" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
        
         <p><label for="<?php echo esc_attr($this->get_field_id('number_offset')); ?>"><?php esc_attr_e('Offset posts:', 'nanomag'); ?></label>
            <input width="100%" id="<?php echo esc_attr($this->get_field_id('number_offset')); ?>" name="<?php echo esc_attr($this->get_field_name('number_offset')); ?>" type="text" value="<?php echo esc_attr($number_offset); ?>" size="3" /></p> 
        
         <p>
            <label for="<?php echo esc_attr($this->get_field_id('cats')); ?>"><?php esc_attr_e('Choose your category:', 'nanomag');?> 
            
                <?php
                   $categories=  get_categories('hide_empty=0');
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
}
?>
