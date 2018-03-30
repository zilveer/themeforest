<?php
/*
Template Name: Homepage :: jQuery 2
*/
?>
<?php get_header(); 

global $ttso;
$jquery2_slider_bg           = $ttso->ka_jquery2_slider_bg;
$jquery2_slider_bg_custom    = $ttso->ka_jquery2_slider_bg_custom;

//pre-define for backward-compatible
if ('' == $jquery2_slider_bg): '#E7E9E6' == $jquery2_slider_bg; endif;

?>

<div class="jquery2-slider-wrap flexslider">
	<div class="jquery2-slider-bg" style="background-color:<?php if('' == $jquery2_slider_bg_custom):echo $jquery2_slider_bg; else: echo $jquery2_slider_bg_custom; endif;?>">
		<ul class="slides">

<?php

//remove filter added by wploop_exclude() from framework/global/theme-functions.php
remove_filter('pre_get_posts','wploop_exclude');

//Get jQuery slider post category set by user in admin Site Options.
$jcycle_category = get_option('ka_jcycle_category');
$jcycle_category_id = get_cat_id($jcycle_category);

//start WordPress Loop to retrieve post from selected category,
//if no category is set, all posts will be returned.

$query_string ="posts_per_page=100&cat=$jcycle_category_id";
query_posts($query_string);

if (have_posts()) : while (have_posts()) : the_post();

//process all individual post meta.

//post meta - Link This Image 
$jcycle_url = get_post_meta($post->ID, '_jcycle_url_value', true);

//post meta - Feature Image (External Source)
$external_image_url = get_post_meta($post->ID,'truethemes_external_image_url',true);

//post meta - Featured Video
$jquery_video_url = get_post_meta($post->ID,'truethemes_video_url',true);

//post meta - Feature Image
$thumb = get_post_thumbnail_id();

//half width image details
$image_width = 436;
$image_height = 270;

//assign half image src, uses function from framework/global/basic.php
$image = truethemes_crop_image($thumb,$external_image_url,$image_width,$image_height);

//full width image details
$image_full_width = 840;
$image_full_height = 270;

//assign full image src, uses function from framework/global/basic.php
$image_full = truethemes_crop_image($thumb,$external_image_url,$image_full_width,$image_full_height);

?>
<li class="jqslider">

<?php 
//If there is post content, we show half image, half content.
if($post->post_content != "") : 
?>

  <div class="slider-content-main">
	<?php $home_title = the_title('','',false);if ($home_title != ""){echo '<h2>'.$home_title.'</h2>';} ?>
    <?php the_content(); ?>
  </div><!-- END slider-content-main -->
  

<?php if(!empty($jquery_video_url)): //if there is featured video ?>

  <div class="slider-content-video">
    
    <?php
    
    //Video will auto resize according to aspect ratio, and will not stay width 436 and height 270.
    //Do not remove height of video as the video will be missing in Internet Explorer.
     
    
    $embed_video = apply_filters('the_content', "[embed width=\"436\" height=\"270\"]".$jquery_video_url."[/embed]");
    $embed_video = str_replace("<embed","<embed wmode='transparent' ",$embed_video);    
    echo $embed_video; 
    
    ?>
   
  </div><!-- END slider-content-video -->    

    
<?php else: // no featured video, we show featured image ?>


  <div class="slider-content-sub">
   
    <?php if ($jcycle_url == ''){ ?>
    <img src="<?php echo $image; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php the_title(); ?>" />
    <?php }else{
    echo '<a href="'.$jcycle_url.'">'; ?>
	<img src="<?php echo $image; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php the_title(); ?>" />
    <?php echo '</a>'; }?>

  </div><!-- END slider-content-sub -->
  
  
<?php endif;//end if featured video check ?>    
  
  
  
</li>

<?php else : //we show full width image ?>

<div class="slider-content-sub-full-width">
<div class="slider-content-sub-content-full">
<?php 
if ($jcycle_url == ''){ ?>
<img src="<?php echo $image_full; ?>" width="<?php echo $image_full_width; ?>" height="<?php echo $image_full_height; ?>" alt="<?php the_title(); ?>" />
<?php }else{echo '<a href="'.$jcycle_url.'">'; ?>
<img src="<?php echo $image_full; ?>" width="<?php echo $image_full_width; ?>" height="<?php echo $image_full_height; ?>" alt="<?php the_title(); ?>" />
<?php echo '</a>';}?>
</div><!-- END slider-content-sub-content-full -->
</div><!-- END slider-content-sub-full-width -->
</li>
<?php endif;endwhile; endif;wp_reset_query(); ?>
</ul>
</div><!-- END jquery2-slider-bg -->
</div><!-- END jquery2-slider-wrap -->
  
  
  
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php truethemes_before_main_hook();// action hook ?>

<div id="main" class="tt-slider-karma-custom-jquery-2">  
<div class="main-area">
<div class="main-holder">
<main role="main" id="content" class="content_full_width">
<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
get_template_part('theme-template-part-inline-editing','childtheme');
comments_template('/page-comments.php', true); ?>
</main><!-- END main #content -->	
</div><!-- END main-holder -->
</div><!-- END main-area -->


<?php get_footer(); ?>