<?php
add_action('widgets_init', 'tab_register_widgets');

function tab_register_widgets() {
    register_widget('Tab_Posts_Widget');
}

class Tab_Posts_Widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

    function __construct() {
        $widget_ops = array(
            'classname' => 'tab_widget',
            'description' => esc_attr__('Tab widget: Popular, latest and comment.', 'nanomag')
        );
        parent::__construct('triple-posts', esc_attr__('jellywp: Tab widget', 'nanomag'), $widget_ops);
    }

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/

    function widget($args, $instance) {

        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        if (!$number = absint($instance['number'])){$number = 5;}
        $jellywp_args = array(
            'showposts' => $number,
            'orderby' => 'comment_count',
			'ignore_sticky_posts' => 1
        );
		$show_comment_tab = isset($instance['show_comment_tab']) ? $instance['show_comment_tab'] : false;
        $jellywp_args1 = array(
            'showposts' => $number,
            'orderby' => 'date',
			'ignore_sticky_posts' => 1
        );

        $jellywp_widget = null;
        $jellywp_widget = new WP_Query($jellywp_args);

        $jellywp_widget1 = null;
        $jellywp_widget1 = new WP_Query($jellywp_args1);

        echo $before_widget;

        if ($title != "") {
            echo $before_title;
            echo $title;
            echo $after_title;
        }
        ?>

        <div  id="tabs" class="widget_container">    

            <!--tabs-nav -->
            <ul class="tabs">
                <li class="active"><a class="title" href="#tab1"><?php esc_attr_e('Popular', 'nanomag'); ?></a></li>
                <li><a class="title" href="#tab2"><?php _e('Recent', 'nanomag'); ?></a></li>
               <?php if ($show_comment_tab == true) { ?> <li><a class="title" href="#tab3"><?php esc_attr_e('Comments', 'nanomag'); ?></a></li><?php }?>
            </ul>
            <!-- end tabs-nav -->

            <div class="tab-container">

                <!--tab1 -->
                <div id="tab1" class="tab-content">


                    <ul class="feature-post-list">
                     <?php
                        while ($jellywp_widget->have_posts()) {
                            $jellywp_widget->the_post();
							$post_id = get_the_ID();
                            //get all post categories
                            $categories = get_the_category(get_the_ID());
						    ?>
                         
                         <li class="tab-content-class <?php if(!of_get_option('disable_css_animation')==1){echo esc_attr("appear_animation");}?>">
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
                        ?>
                    </ul>

                </div>
                <!-- end tab1 -->

                <!--tab2 -->
                <div id="tab2" class="tab-content">

                     <ul class="feature-post-list">
                        <?php
                        while ($jellywp_widget1->have_posts()) {
                            $jellywp_widget1->the_post();
							$post_id = get_the_ID();
                            //get all post categories
                            $categories = get_the_category(get_the_ID());
							  ?>

                         <li class="tab-content-class">
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
             echo '<a class="post-category-color-text" style="color:'.$titleColor.'" href="'.$tag_link.'">'.$tag->name.'</a>';          
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
                        ?>
                    </ul>

                </div>
                <!-- end tab2 -->
   
                <?php if ($show_comment_tab == true) { ?>
                 <!--tab4 -->
                <div id="tab3" class="tab-content comment_tab">
                 
                 <ul class="feature-post-list">
            <?php 
                $args = array(
                       'status' => 'approve',
                        'number' => $number
					);	
				
				$postcount=0;
                $comments = get_comments($args);
				
                foreach($comments as $comment) :
						$postcount++;								
                        $commentcontent = strip_tags($comment->comment_content);			
                        if (strlen($commentcontent)> 50) {
                            $commentcontent = mb_substr($commentcontent, 0, 90) . "...";
                        }
                        $commentauthor = $comment->comment_author;
                        if (strlen($commentauthor)> 30) {
                            $commentauthor = mb_substr($commentauthor, 0, 29) . "...";			
                        }
                        $commentid = $comment->comment_ID;
                        $commenturl = get_comment_link($commentid); ?>
                      <li class="tab-content-class">
							<a  class="feature-image-link" href="<?php echo esc_url($commenturl); ?>"><?php echo get_avatar( $comment, '80' ); ?></a>
                             <div class="item-details">
									 <h3 class="feature-post-title"><a class="post-title" href="<?php echo esc_url($commenturl); ?>"><?php echo $commentauthor; ?></a></h3>
									<p class="post-meta meta-list-small">
                                    <span class="post-date"><?php echo esc_attr($commentcontent); ?></span>
                                        </p>
                                    </div>
						</li>
            <?php endforeach; ?>
        </ul>
                 
                </div>
                <!-- end tab4 -->
              <?php }?>

            </div>

 <div class="clearfix"></div>
        </div>
        <!-- end tabs-container -->
        <?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = absint($new_instance['number']);
		$instance['show_comment_tab'] = $new_instance['show_comment_tab'];
        return $instance;
    }


    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 4;
		
		$defaults = array( 			
			'show_comment_tab' => 'on'
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
       
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'nanomag'); ?></label>
            <input class="widefat" width="100%" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_attr_e('Number of posts to show:', 'nanomag'); ?></label>
        <input width="100%" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>

 <p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_comment_tab'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_comment_tab')); ?>" name="<?php echo esc_attr($this->get_field_name('show_comment_tab')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('show_comment_tab')); ?>"><?php esc_attr_e( 'Show comment tab', 'nanomag'); ?></label>
		</p>

        <?php
    }

}
?>