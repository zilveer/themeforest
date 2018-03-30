<?php
add_action('widgets_init', 'tab_post_large_register_widgets');
function tab_post_large_register_widgets() {
        register_widget('tab_post_large_widget');
}
class tab_post_large_widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

    function __construct() {
        $widget_ops = array(
            'classname' => 'clearfix',
            'description' => esc_attr__('Display Hover large post in tab by select category work in menu and widget', 'nanomag')
        );
        parent::__construct('tab-post-large-widget', esc_attr__('jellywp: Hover tab post large Widget', 'nanomag'), $widget_ops);
    }

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/

    function widget($args, $instance) {

        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        if (!$number = absint($instance['number'])){$number = 5;}
        if (!$cats = $instance["cats"]){$cats = '';}
		if (isset($instance['number_offset'])==''){$number_offset = 0;}else{$number_offset = absint($instance['number_offset']);}
        echo $before_widget;

        if (!empty($title)) {
            echo $before_title;
            echo $instance["title"];
            echo $after_title;
        }
        ?>        
        <div  id="tabs" class="widget_container hover_tab_post_large_container">
		 <!--tabs-nav -->
            <ul class="hover_tab_post_large">

            <?php
            if (!empty($cats)) {

                foreach ($cats as $cat_id) {

                    echo '<li class=""><a class="title" href="'.get_category_link($cat_id).'" rel="#category_' . $cat_id . '">' . get_the_category_by_ID($cat_id) . '</a></li>';
                }
			}else {
                echo '<li class=""><a class="title" id="#">';
				esc_attr_e('No post' ,'nanomag');
				echo '</a></li>';
			}
            ?>

        </ul>
        <!-- end tabs-nav -->
         <div class="tab-container">

            <?php
            if (!empty($cats)) {
                foreach ($cats as $cat_id) {
                    $jellywp_args = array(
                        'showposts' => $number,
                        'ignore_sticky_posts' => 1,
						'category__in' => $cat_id,
						'offset' => $number_offset
                    );

                    $jellywp_widget = null;
                    $jellywp_widget = new WP_Query($jellywp_args);
                    ?>

                    <div id="category_<?php echo esc_attr($cat_id); ?>" class="tab-content">
                   
                   <ul class="feature-post-list">
                     <?php
                        while ($jellywp_widget->have_posts()) {
                            $jellywp_widget->the_post();
							$post_id = get_the_ID();
                            //get all post categories
                            $categories = get_the_category(get_the_ID());
					        ?>
                         
                         <li class="tab-content-class tab-large-page <?php if(!of_get_option('disable_css_animation')==1){echo esc_attr("appear_animation");}?>">
<div class="two-content-wrapper">
                    
                <div class="image_post feature-item menu_tab_post_large image_post">
                   <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('medium-feature');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/medium-feature.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
</a>
<?php echo jelly_total_score_post_front_small_circle(get_the_ID());?>
                     </div>

<div class="wrap_box_style_main image-post-title">
<div class="meta_holder">
<?php  if(of_get_option('disable_post_category') !=1){
          if ($categories) {
            echo '<span class="meta-category-small">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
              $titleColor = jelly_categorys_title_color($tag->term_id, "category", false);
             echo '<a class="post-category-color-text" style="color:'.esc_attr($titleColor).' !important;" href="'.esc_url($tag_link).'">'.$tag->name.'</a>';          
            }
            echo "</span>";
            }
       }?>
<?php echo jelly_post_like_meta(get_the_ID());?>

</div>    
<h3 class="image-post-title"><a class="image-post-title-link" href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
<?php echo jelly_post_meta(get_the_ID()); ?>
</div> 
    </div>
   <div class="clearfix"></div>
   </li>
                         
                            <?php
                        }
                        wp_reset_query();
                        ?>
                    </ul>
                    
                   </div> 
                    <?php
                    wp_reset_query();
                    }}
                	?>
                   

            </div>
            </div>

            <?php
            echo $after_widget;
        }

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['cats'] = $new_instance['cats'];
            $instance['number'] = absint($new_instance['number']);
			$instance['number_offset'] = absint($new_instance['number_offset']);
          
            return $instance;
        }

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/

        function form($instance) {
            $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
            $number = isset($instance['number']) ? absint($instance['number']) : 3;
			$number_offset = isset($instance['number_offset']) ? absint($instance['number_offset']) : 0;
            ?>
            <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:','nanomag'); ?></label>
                <input width="100%" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

            <p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_attr_e('Number of posts to show:', 'nanomag'); ?></label>
                <input width="100%" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
                 <p><label for="<?php echo esc_attr($this->get_field_id('number_offset')); ?>"><?php esc_attr_e('Offset posts:', 'nanomag'); ?></label>
            <input width="100%" id="<?php echo esc_attr($this->get_field_id('number_offset')); ?>" name="<?php echo esc_attr($this->get_field_name('number_offset')); ?>" type="text" value="<?php echo esc_attr($number_offset); ?>" size="3" /></p>  

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('cats')); ?>"><?php esc_attr_e('Select categories to include in the recent posts list:', 'nanomag'); ?> 

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

    }
?>
