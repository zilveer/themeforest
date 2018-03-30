<?php
class home_post_three_columns extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
      'name' => esc_attr__('Post three columns', 'nanomag'),
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('home_post_three_columns', $block_options);
	}
	
	
	//create form
	function form($instance) {
        $titles = isset($instance['titles']) ? esc_attr($instance['titles']) : 'Home columns1';
        $title1 = isset($instance['title1']) ? esc_attr($instance['title1']) : 'Home columns2';
        $title2 = isset($instance['title2']) ? esc_attr($instance['title2']) : 'Home columns3';
        $css_class_builder = isset($instance['css_class_builder']) ? esc_attr($instance['css_class_builder']) : 'color-1';
        $css_class_builder1 = isset($instance['css_class_builder1']) ? esc_attr($instance['css_class_builder1']) : 'color-12';
        $css_class_builder2 = isset($instance['css_class_builder2']) ? esc_attr($instance['css_class_builder2']) : 'color-10';
        $number_show = isset($instance['number_show']) ? absint($instance['number_show']) : 5;
		$number_offset = isset($instance['number_offset']) ? absint($instance['number_offset']) : 0;
		$number_offset1 = isset($instance['number_offset1']) ? absint($instance['number_offset1']) : 0;
    $number_offset2 = isset($instance['number_offset2']) ? absint($instance['number_offset2']) : 0;
        ?>
        
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title col1:', 'nanomag'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('titles')); ?>" name="<?php echo esc_attr($this->get_field_name('titles')); ?>" type="text" value="<?php echo esc_attr($titles); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('title1')); ?>"><?php esc_attr_e('Title col2:','nanomag'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title1')); ?>" name="<?php echo esc_attr($this->get_field_name('title1')); ?>" type="text" value="<?php echo esc_attr($title1); ?>" /></p>

             <p><label for="<?php echo esc_attr($this->get_field_id('title2')); ?>"><?php esc_attr_e('Title col3:','nanomag'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title2')); ?>" name="<?php echo esc_attr($this->get_field_name('title2')); ?>" type="text" value="<?php echo esc_attr($title2); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('css_class_builder')); ?>"><?php esc_attr_e('CSS class columns1','nanomag'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('css_class_builder')); ?>" name="<?php echo esc_attr($this->get_field_name('css_class_builder')); ?>" type="text" value="<?php echo esc_attr($css_class_builder); ?>" /></p>

            <p><label for="<?php echo esc_attr($this->get_field_id('css_class_builder1')); ?>"><?php esc_attr_e('CSS class columns2','nanomag'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('css_class_builder1')); ?>" name="<?php echo esc_attr($this->get_field_name('css_class_builder1')); ?>" type="text" value="<?php echo esc_attr($css_class_builder1); ?>" /></p>

            <p><label for="<?php echo esc_attr($this->get_field_id('css_class_builder2')); ?>"><?php esc_attr_e('CSS class columns3','nanomag'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('css_class_builder2')); ?>" name="<?php echo esc_attr($this->get_field_name('css_class_builder2')); ?>" type="text" value="<?php echo esc_attr($css_class_builder2); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('number_show')); ?>"><?php esc_attr_e('Number of posts to show:', 'nanomag'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number_show')); ?>" name="<?php echo esc_attr($this->get_field_name('number_show')); ?>" type="text" value="<?php echo esc_attr($number_show); ?>" size="3" /></p>
            
         <p><label for="<?php echo esc_attr($this->get_field_id('number_offset')); ?>"><?php esc_attr_e('Offset col1 posts:', 'nanomag'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number_offset')); ?>" name="<?php echo esc_attr($this->get_field_name('number_offset')); ?>" type="text" value="<?php echo esc_attr($number_offset); ?>" size="3" /></p>  
            
            <p><label for="<?php echo esc_attr($this->get_field_id('number_offset1')); ?>"><?php esc_attr_e('Offset col2 posts:', 'nanomag'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number_offset1')); ?>" name="<?php echo esc_attr($this->get_field_name('number_offset1')); ?>" type="text" value="<?php echo esc_attr($number_offset1); ?>" size="3" /></p>

            <p><label for="<?php echo esc_attr($this->get_field_id('number_offset2')); ?>"><?php esc_attr_e('Offset col3 posts:', 'nanomag'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number_offset2')); ?>" name="<?php echo esc_attr($this->get_field_name('number_offset2')); ?>" type="text" value="<?php echo esc_attr($number_offset2); ?>" size="3" /></p>         

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cats')); ?>"><?php esc_attr_e('Choose your category col1:', 'nanomag'); ?> 

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

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cats1')); ?>"><?php esc_attr_e('Choose your category col2:', 'nanomag'); ?> 

                <?php
                $categories = get_categories('hide_empty=0');
                echo "<br/>";
                foreach ($categories as $cat) {
                    $option = '<input type="checkbox" id="' . $this->get_field_id('cats1') . '[]" name="' . $this->get_field_name('cats1') . '[]"';
                    if (isset($instance['cats1'])) {
                        foreach ($instance['cats1'] as $cats) {
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


        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cats2')); ?>"><?php esc_attr_e('Choose your category col3:', 'nanomag'); ?> 

                <?php
                $categories = get_categories('hide_empty=0');
                echo "<br/>";
                foreach ($categories as $cat) {
                    $option = '<input type="checkbox" id="' . $this->get_field_id('cats2') . '[]" name="' . $this->get_field_name('cats2') . '[]"';
                    if (isset($instance['cats2'])) {
                        foreach ($instance['cats2'] as $cats) {
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
        $titles = apply_filters('widget_title', empty($instance['titles']) ? 'Recent Posts' : $instance['titles'], $instance, $this->id_base);
        $title1 = apply_filters('widget_title', empty($instance['title1']) ? 'Recent Posts' : $instance['title1'], $instance, $this->id_base);
        $title2 = apply_filters('widget_title', empty($instance['title2']) ? 'Recent Posts' : $instance['title2'], $instance, $this->id_base);
        
        if (!$number_show = absint($instance['number_show'])){$number_show = 5;}
		if (isset($instance['number_offset'])==''){$number_offset = 0;}else{$number_offset = absint($instance['number_offset']);}
		if (isset($instance['number_offset1'])==''){$number_offset1 = 0;}else{$number_offset1 = absint($instance['number_offset1']);}
    if (isset($instance['number_offset2'])==''){$number_offset1 = 0;}else{$number_offset1 = absint($instance['number_offset2']);}
        if (!isset($instance["cats"])){$cats = '';}
		if (!isset($instance["cats1"])){$cats1 = '';}
    if (!isset($instance["cats2"])){$cats2 = '';}
     

        // array to call recent posts.

        $jellywp_args = array(
            'showposts' => $number_show,
            'category__in' => $cats,
			'ignore_sticky_posts' => 1,
			'offset' => $number_offset
        );

        $jellywp_args1 = array(
            'showposts' => $number_show,
            'category__in' => $cats1,
			'ignore_sticky_posts' => 1,
			'offset' => $number_offset1
			);

        $jellywp_args2 = array(
            'showposts' => $number_show,
            'category__in' => $cats2,
      'ignore_sticky_posts' => 1,
      'offset' => $number_offset2
      );

        $jellywp_widget = null;
        $jellywp_widget = new WP_Query($jellywp_args);



        echo '<div class="widget three_columns_post builder_two_cols">';

        $i = 0;
        while ($jellywp_widget->have_posts()) {
            $jellywp_widget->the_post();
            $i++;        
			$post_id = get_the_ID(); 
      //get all post categories
            $categories = get_the_category(get_the_ID());
		        if ($i == 1) {				
                ?>   

                <div class="feature-two-column list-col1-home left-post-display-content margin-left-post <?php echo esc_attr($instance['css_class_builder']);?>">
                   <?php if (!empty($instance['titles'])) {?><div class="widget-title"><h2><?php echo esc_attr($instance["titles"]);?></h2></div><?php }?>
                    <div class="two_col_builder two-content-wrapper medium-two-columns <?php if(!of_get_option('disable_css_animation')==1){echo esc_attr("appear_animation");}?>">
                    
                <div class="image_post feature-item">
                   <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('medium-feature');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/medium-feature.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
</a>
<?php echo jelly_total_score_post_front_small_circle(get_the_ID());?>
                     </div>

<div class="wrap_box_style_main feature-custom-below main_post_2col_style">
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
 <h3 class="image-post-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
  <?php echo jelly_post_meta(get_the_ID()); ?>	
 <p><?php echo jelly_post_excerpt(get_the_excerpt('')); ?> </p>
 <?php echo jelly_post_meta_footer(get_the_ID()); ?>
   </div>
    </div>
           
                                       
 <div class="wrap_box_style_ul"> 
    <?php echo '<ul class="feature-post-list">'; }else{?>
                 
               

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

    <?php }} echo " </ul>";?>
     </div>       
        </div>

        <?php
        wp_reset_query();

        // column right      

        $jellywp_widget1 = null;
        $jellywp_widget1 = new WP_Query($jellywp_args1);

        $i = 0;

        while ($jellywp_widget1->have_posts()) {
            $jellywp_widget1->the_post();
            $i++;
			$post_id = get_the_ID();
      //get all post categories
            $categories = get_the_category(get_the_ID());

		        if ($i == 1) {				
                ?>   

                <div class="feature-two-column right-post-display-content <?php echo esc_attr($instance['css_class_builder1']);?>">
                  <?php if (!empty($instance['title1'])) {?><div class="widget-title"><h2><?php echo esc_attr($instance["title1"]);?></h2></div><?php }?>
                     <div class="two_col_builder two-content-wrapper medium-two-columns <?php if(!of_get_option('disable_css_animation')==1){echo esc_attr("appear_animation");}?>">
                     
                    <div class="image_post feature-item">
                   <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('medium-feature');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/medium-feature.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
</a>
<?php echo jelly_total_score_post_front_small_circle(get_the_ID());?>
                     </div>

<div class="wrap_box_style_main feature-custom-below main_post_2col_style">
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
 <h3 class="image-post-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
  <?php echo jelly_post_meta(get_the_ID()); ?>	
 
 <p><?php echo jelly_post_excerpt(get_the_excerpt('')); ?> </p>
 <?php echo jelly_post_meta_footer(get_the_ID()); ?>
 </div>
 </div>
  <div class="wrap_box_style_ul"> 
                   <?php echo '<ul class="feature-post-list">'; }else{?>

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
    <?php }} echo " </ul>";?>
    </div>        
                    
            
        </div>



<?php
        wp_reset_query();

        // column right      

        $jellywp_widget2 = null;
        $jellywp_widget2 = new WP_Query($jellywp_args2);

        $i = 0;

        while ($jellywp_widget2->have_posts()) {
            $jellywp_widget2->the_post();
            $i++;
      $post_id = get_the_ID();
      //get all post categories
            $categories = get_the_category(get_the_ID());

            if ($i == 1) {        
                ?>   

                <div class="feature-two-column right-post-display-content <?php echo esc_attr($instance['css_class_builder2']);?>">
                  <?php if (!empty($instance['title2'])) {?><div class="widget-title"><h2><?php echo esc_attr($instance["title2"]);?></h2></div><?php }?>
                     <div class="two_col_builder two-content-wrapper medium-two-columns <?php if(!of_get_option('disable_css_animation')==1){echo esc_attr("appear_animation");}?>">
                     
                    <div class="image_post feature-item">
                   <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('medium-feature');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/medium-feature.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
</a>
<?php echo jelly_total_score_post_front_small_circle(get_the_ID());?>
                     </div>

<div class="wrap_box_style_main feature-custom-below main_post_2col_style">
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
 <h3 class="image-post-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
  <?php echo jelly_post_meta(get_the_ID()); ?>  
 
 <p><?php echo jelly_post_excerpt(get_the_excerpt('')); ?> </p>
 <?php echo jelly_post_meta_footer(get_the_ID()); ?>
 </div>
 </div>
  <div class="wrap_box_style_ul"> 
                   <?php echo '<ul class="feature-post-list">'; }else{?>

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
    <?php }} echo " </ul>";?>
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
