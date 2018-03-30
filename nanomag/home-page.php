<?php
/*
  Template Name: Home page
 */
?>
<?php get_header(); ?>
<?php 
$GLOBALS['sbg_sidebar'] = get_post_meta(get_the_ID(), 'sbg_selected_sidebar_replacement', true);  
?>
<?php get_template_part('slider'); ?>

<?php if(of_get_option('disable_home_carousel') !=1){
$jellywp_slider_type_c= get_post_custom_values('jellywp_slider_type', get_the_ID());
if($jellywp_slider_type_c[0]=='noslider'){}else{
?>
<div class="carousel_post_home_wrapper">
<div class="row carousel_post_home">
  <div class="twelve columns carousel_header_wrapper">
 <div class="widget-title"><h2><?php echo esc_attr(of_get_option('carousel_post_title'));?></h2></div>  
  
 <div class="owl_carousel carousel_header">
 
 
       <?php
  $category_carousel_post="";
  $number_of_carousel= of_get_option('number_carousel');
  $category_carousel= of_get_option('carousel_post');
  if (of_get_option('number_offset_carousel_post')){$number_offset_carousel_post = of_get_option('number_offset_carousel_post');}else{$number_offset_carousel_post = 0;}
  
  if(!empty($category_carousel)) {
    
  foreach($category_carousel as $key=>$value) { if($value == 1) { $category_carousel_post[] = $key; } } 
  }
  
  
  $post_array_carousel = array(
            'showposts' => $number_of_carousel,
            'category__in' => $category_carousel_post,
      'ignore_sticky_posts' => 1,
      'offset' => $number_offset_carousel_post
        );  
        $jellywp_widget_carousel = new WP_Query($post_array_carousel);
    $i=0;
     while ($jellywp_widget_carousel->have_posts()) {
            $jellywp_widget_carousel->the_post();
      $i++;
      $post_id = get_the_ID();
      //get all post categories
            $categories = get_the_category(get_the_ID());
      ?>         
 <div class="item carousel_header_medium <?php if(!of_get_option('disable_css_animation')==1){echo esc_attr("appear_animation");}?>">
  
  <div class="two-content-wrapper medium-two-columns <?php if(!of_get_option('disable_css_animation')==1){echo esc_attr("appear_animation");}?>">
                    
                <div class="image_post feature-item">
                   <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('medium-feature');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/medium-feature.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
</a>
<?php echo jelly_total_score_post_front_small_circle(get_the_ID());?>
                     </div>

<div class="wrap_box_style_main feature-custom-below main_post_2col_style">
 
 <h3 class="image-post-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
 <p class="car_header_desc"><?php echo jelly_post_excerpt(get_the_excerpt('')); ?> </p>
 <?php echo jelly_post_meta_footer(get_the_ID()); ?>
   </div>
    </div>

 </div>
 <?php }?>   

 
  </div>
  </div>
</div>
</div>
<?php }}?>


<!-- Start content -->
<div class="row main_content">
<?php 
if (have_posts()) {while (have_posts()) { the_post();
?>
<div class="content_wraper three_columns_container">
   <!-- Start content -->
     <div class="eight columns content_display_col1" id="content">
            
			  <?php the_content(); ?>
  </div>
  <!-- End content -->
    <!-- Start sidebar -->
<?php echo jelly_sidebar_homepage_show();?>
  <!-- End sidebar -->
  <div class="clearfix"></div>
  </div>
  <?php }}?>
  
  </div>

<?php get_footer(); ?>
