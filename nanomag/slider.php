<?php 
if (have_posts()) {while (have_posts()) { the_post();
$jellywp_slider_type= get_post_custom_values('jellywp_slider_type', get_the_ID());
if($jellywp_slider_type[0]=='slider1'){
?>
<div class="slider_wrapper_main">
<div class="row header-slider-home header-slider-home-list-right">
  <div class="twelve columns feature-three"> 
  <div class="slide-large-wrapper header-slider2">
      <div class="owl_slider slider-large owl-carousel">
    <?php
  $cats="";
  $number_slider= of_get_option('slider_number');
  $category_slider= of_get_option('slider_category_select');
  $cats = '';
  if(!empty($category_slider)) {
  foreach($category_slider as $key=>$value) { if($value == 1) { $cats[] = $key; } } 
  }
  $post_array_slider = array(
            'showposts' => $number_slider,
            'category__in' => $cats,
      'ignore_sticky_posts' => 1
        );  
        $jellywp_widget_slider = new WP_Query($post_array_slider);
     $count = 1;
    $get_main_ft = TRUE;
     while ($jellywp_widget_slider->have_posts()) {
            $jellywp_widget_slider->the_post();
      $post_id = get_the_ID();
      //get all post categories
            $categories = get_the_category(get_the_ID());
      ?>        
<?php if($get_main_ft){?> 
<div class="item_slide">
<div class="main-post-image-slider image_post">
<a href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('slider-normal');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/slider-normal.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?> 
</a>
<?php echo jelly_total_score_post_front(get_the_ID());?>
<div class="item_slide_caption">
 <?php echo jelly_slider_post_meta(get_the_ID()); ?>
                                <h1><a class="heading" href="<?php the_permalink(); ?>"><?php the_title()?></a> </h1>                                              
            </div>
</div>
<?php 
$get_main_ft = FALSE;
}else{?>
<div class="sub-post-image-slider image_post">
<a href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('slider-small');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/slider-small.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
<?php echo jelly_total_score_post_front_small(get_the_ID());?>
</a>

<div class="item_slide_caption">
                                <h1><a href="<?php the_permalink(); ?>"><?php the_title()?></a> </h1>
                                                                                     
            </div>

</div>
<?php }?>
              
              <?php if($count%4==0){ 
                $get_main_ft = TRUE; ?>
               </div>  
               
    <?php
    }
    $count++;
  }?>
            
                   
              </div>
 </div>
  <div class="slider-right-list-post">
<h2 class="right-list-post-title"><?php echo esc_attr(of_get_option('right_slider_title'));?></h2>

                      <ul class="feature-post-list scroll_list_post">  
        <?php
  $cats_right="";
  $number_header_list= of_get_option('number_header_list');
  $category_slider_right= of_get_option('category_on_right_slider');
  if (of_get_option('number_offset_post_right')){$number_offset_post_right = of_get_option('number_offset_post_right');}else{$number_offset_post_right = 0;}
  
  $cats_right = '';
  if(!empty($category_slider_right)) {
    
  foreach($category_slider_right as $key=>$value) { if($value == 1) { $cats_right[] = $key; } } 
  }
  $post_array_right = array(
            'showposts' => $number_header_list,
            'category__in' => $cats_right,
      'ignore_sticky_posts' => 1,
      'offset' => $number_offset_post_right
        );  
        $jellywp_widget_right = new WP_Query($post_array_right);
     while ($jellywp_widget_right->have_posts()) {
            $jellywp_widget_right->the_post();
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

    <?php }?>   
        
      </ul>
            </div>  
    </div>
    </div>
  </div>

<?php }elseif($jellywp_slider_type[0]=='slider2'){?>
<div class="slider_wrapper_main slider_home_full">
  <div class="row header-slider-home header-slider-home-list-right">
  <div class="twelve columns feature-three"> 
  <div class="full-width-slider header-slider2">
      <div class="owl_slider slider-large full-width-slider owl-carousel">
    <?php
  $cats="";
  $number_slider= of_get_option('large_slider_number');
  $category_slider= of_get_option('slider_category_select');
  
  
  $cats = '';
  if(!empty($category_slider)) {
    
  foreach($category_slider as $key=>$value) { if($value == 1) { $cats[] = $key; } } 
  } 
  $post_array_slider = array(
            'showposts' => $number_slider,
            'category__in' => $cats,
      'ignore_sticky_posts' => 1
        );  
        $jellywp_widget_slider = new WP_Query($post_array_slider);
    $i=0;
     while ($jellywp_widget_slider->have_posts()) {
            $jellywp_widget_slider->the_post();
      $i++;
      $post_id = get_the_ID();
      //get all post categories
            $categories = get_the_category(get_the_ID());
      ?>
                <div class="item_slide home_large_img_slider image_post">
              <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('slider-large');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/slider-large.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
</a>
<?php echo jelly_total_score_post_front(get_the_ID());?> 
<div class="item_slide_caption builder_slider">
<?php echo jelly_slider_post_meta(get_the_ID()); ?>
                           <h1><a href="<?php the_permalink(); ?>"><?php the_title()?></a>  </h1>
                             <div class="clearfix"></div>  
            </div>

</div>
               
    <?php }?>        
              </div>
 </div>
</div>
</div>
   </div>

<?php }elseif($jellywp_slider_type[0]=='slider_full_width'){?>

<div class="slider_wrapper_main home_page_fullscreen_slider personal_slider_home <?php if(of_get_option('magazine_layout_design')=='magazine_personal'){echo'no_margin_slider';}?> <?php if(of_get_option('theme_header_style')=='theme_header_style_6'){echo'header_margin_slider';}?>">
  <div class="full-width-slider">
      <div class="owl_slider slider-large full-width-slider owl-carousel">
    <?php
  $cats="";
  $number_slider= of_get_option('large_slider_number');
  $category_slider= of_get_option('slider_category_select');
  
  
  $cats = '';
  if(!empty($category_slider)) {
    
  foreach($category_slider as $key=>$value) { if($value == 1) { $cats[] = $key; } } 
  } 
  $post_array_slider = array(
            'showposts' => $number_slider,
            'category__in' => $cats,
      'ignore_sticky_posts' => 1
        );  
        $jellywp_widget_slider = new WP_Query($post_array_slider);
    $i=0;
     while ($jellywp_widget_slider->have_posts()) {
            $jellywp_widget_slider->the_post();
      $i++;
      $post_id = get_the_ID();
      //get all post categories
            $categories = get_the_category(get_the_ID());
      ?>
                <div class="item_slide home_large_img_slider image_post">
              
<?php if ( has_post_thumbnail()) {
  $thumb_id = get_post_thumbnail_id();
  $category_image_header = wp_get_attachment_image_src( $thumb_id, 'slider-large', true ); ?>
 <div class="jelly_image_post_thumb" style="background-image: url('<?php echo $category_image_header[0]; ?>')">  
</div>
<div class="background_over_image"></div>
<?php }?>

<div class="item_slide_caption builder_slider">

                           <p class="personal_slider_meta_category">
                           <?php if(of_get_option('disable_post_category') !=1){ echo '<span class="meta-cat">'; echo the_category('<b></b>').'</span>';}?>
                           </p>
                           <h1><a href="<?php the_permalink(); ?>"><?php the_title()?></a>  </h1>
                           <p class="personal_slider_meta_footer">
                           <?php if(of_get_option('disable_post_author') !=1){echo '<span class="vcard post-author single_meta meta-user"><i class="fa fa-user"></i>'; echo the_author_posts_link().'</span>';}
                           if(of_get_option('disable_post_date') !=1){ echo '<span class="post-date updated"><i class="fa fa-clock-o"></i>'.get_the_date('M d, Y').'</span>';}?>
                           </p>
                             <div class="clearfix"></div>  
            </div>

</div>
               
    <?php }?>        
              </div>
 </div>

   </div>

<?php }elseif($jellywp_slider_type[0]=='slider_techno'){?>

<?php }elseif($jellywp_slider_type[0]=='slider_sport'){?>

   <?php }elseif($jellywp_slider_type[0]=='slider_personal'){?>
<div class="slider_wrapper_main slider_home_full personal_slider_home">
  <div class="row header-slider-home header-slider-home-list-right">
  <div class="twelve columns feature-three"> 
  <div class="full-width-slider header-slider2">
      <div class="owl_slider slider-large full-width-slider owl-carousel">
    <?php
  $cats="";
  $number_slider= of_get_option('large_slider_number');
  $category_slider= of_get_option('slider_category_select');
  
  
  $cats = '';
  if(!empty($category_slider)) {
    
  foreach($category_slider as $key=>$value) { if($value == 1) { $cats[] = $key; } } 
  } 
  $post_array_slider = array(
            'showposts' => $number_slider,
            'category__in' => $cats,
      'ignore_sticky_posts' => 1
        );  
        $jellywp_widget_slider = new WP_Query($post_array_slider);
    $i=0;
     while ($jellywp_widget_slider->have_posts()) {
            $jellywp_widget_slider->the_post();
      $i++;
      $post_id = get_the_ID();
      //get all post categories
            $categories = get_the_category(get_the_ID());
      ?>
                <div class="item_slide home_large_img_slider image_post">
              <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('slider-large');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/slider-large.jpg'.'">';} ?>
</a>
<div class="item_slide_caption builder_slider">

                           <p class="personal_slider_meta_category">
                           <?php if(of_get_option('disable_post_category') !=1){ echo '<span class="meta-cat">'; echo the_category(' / ').'</span>';}?>
                           </p>
                           <h1><a href="<?php the_permalink(); ?>"><?php the_title()?></a>  </h1>
                           <p class="personal_slider_meta_footer">
                           <?php if(of_get_option('disable_post_author') !=1){echo '<span class="vcard post-author single_meta meta-user"><i class="fa fa-user"></i>'; echo the_author_posts_link().'</span>';}
                           if(of_get_option('disable_post_date') !=1){ echo '<span class="post-date updated"><i class="fa fa-clock-o"></i>'.get_the_date('M d, Y').'</span>';}?>
                           </p>
                             <div class="clearfix"></div>  
            </div>

</div>
               
    <?php }?>        
              </div>
 </div>
</div>
</div>
   </div>



<?php }elseif($jellywp_slider_type[0]=='noslider'){?>   

<?php }else{?>
<div class="slider_wrapper_main">
<div class="row header-slider-home">
  <div class="twelve columns feature-three"> 
  <div class="grid_header_home">
    <?php
  $cats="";
  $category_slider= of_get_option('slider_category_select');
  $cats = '';
  if(!empty($category_slider)) {
  foreach($category_slider as $key=>$value) { if($value == 1) { $cats[] = $key; } } 
  }
  $post_array_slider = array(
            'showposts' => 7,
            'category__in' => $cats,
      'ignore_sticky_posts' => 1
        );  
        $jellywp_widget_slider = new WP_Query($post_array_slider);
     $count_slider = 0;
     while ($jellywp_widget_slider->have_posts()) {
            $jellywp_widget_slider->the_post();
      $post_id = get_the_ID();
      //get all post categories
            $categories = get_the_category(get_the_ID());
            $count_slider++;
      ?>        
<?php if($count_slider==1){?>
<div class="main-post-image-slider image_post">
<a href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('slider-normal');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/slider-normal.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
</a>
<?php echo jelly_total_score_post_front(get_the_ID());?> 
<div class="item_slide_caption">
<?php echo jelly_slider_post_meta(get_the_ID()); ?>
<h1><a class="heading" href="<?php the_permalink(); ?>"><?php the_title()?></a> </h1>                   
</div>
</div>
<?php }else{?>
<div class="sub-post-image-slider image_post">
<a href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('slider-small');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/slider-small.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
<?php echo jelly_total_score_post_front_small(get_the_ID());?>
</a>
<div class="item_slide_caption">
<h1><a href="<?php the_permalink(); ?>"><?php the_title()?></a> </h1>
</div>
</div>
<?php }}?>
</div>
</div>
</div>
</div>
<?php } }}?>