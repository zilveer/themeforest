<?php
add_action('widgets_init', 'recent1__widgets');

function recent1__widgets() {
    register_widget('recent1_widgets');
}

class recent1_widgets extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

    function __construct() {
        $widget_ops = array(
            'classname' => 'main_post_style clearfix',
            'description' => esc_attr__('Display main post with list of recent post.', 'nanomag')
        );
        parent::__construct('home-main-post-style', esc_attr__('jellywp: main post images black background', 'nanomag'), $widget_ops);
    }

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
    function widget($args, $instance) {

        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? 'Recent Posts' : $instance['title'], $instance, $this->id_base);
    
        if (!$number = absint($instance['number'])){$number = 4;}
        if (!$cats = $instance["cats"]){$cats = '';}
		if (isset($instance['number_offset'])==''){$number_offset = 0;}else{$number_offset = absint($instance['number_offset']);}

        // array to call recent posts.

        $jellywp_args = array(
            'showposts' => $number,
            'category__in' => $cats,
			'ignore_sticky_posts' => 1,
			'offset' => $number_offset
        );

        $jellywp_widget = null;
        $jellywp_widget = new WP_Query($jellywp_args);

        echo $before_widget;

        // Widget title
        if($instance["title"]) {
        echo $before_title;
        echo $instance["title"];
        echo $after_title;
        }


        // Post list in widget

        $i = 0;?>
		<div class="widget_container mainpost_widget">
        <?php
        while ($jellywp_widget->have_posts()) {
            $jellywp_widget->the_post();
			$post_id = get_the_ID();
            //get all post categories
            $categories = get_the_category(get_the_ID());
			 $i++;
            if ($i == 1) {
                ?>   

                    <div class="large_main_post_widget <?php if(!of_get_option('disable_css_animation')==1){echo esc_attr("appear_animation");}?>">
     <div class="image_post feature-item box-1">
                    <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('medium-feature');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/medium-feature.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
</a>
<?php echo jelly_total_score_post_front_small_circle(get_the_ID());?>
                   
                    <div class="caption_overlay_posts">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <h3><?php the_title(); ?></h3>
                    </a>
                    
                    <?php echo jelly_post_meta_main(get_the_ID()); ?>
                    </div>
                  
                </div>
     </div>
  <div class="wrap_box_style_ul"> 
 					  
                     <ul class="feature-post-list popular-post-widget">          
                
            <?php
			}else {?>
            
                          <li class="<?php if(!of_get_option('disable_css_animation')==1){echo esc_attr("appear_animation");}?>">
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
             echo '<a class="post-category-color-text" style="color:'.esc_attr($titleColor).' !important;" href="'.esc_url($tag_link).'">'.$tag->name.'</a>';          
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
            
                <?php }}?>
            
			

   </ul>
    </div>   
        
        </div>
      
        <?php
        wp_reset_query();


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


    function form($instance) {
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

}
?>
