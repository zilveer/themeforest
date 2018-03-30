<?php
/*
Template Name: Homepage :: jQuery
*/
?>
<?php get_header(); ?>
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php truethemes_before_main_hook();// action hook ?>

<div id="main" class="tt-slider-karma-custom-jquery-1">
	<div class="main-area">
		<main role="main" id="content" class="content_full_width">

<div class="jquery1-slider-wrap flexslider">
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
$image_width = 404;
$image_height = 256;

//assign half image src, uses function from framework/global/basic.php
$image = truethemes_crop_image($thumb,$external_image_url,$image_width,$image_height);


?>
<li class="jqslider">

<?php 
//If image is not empty, we show half image, half content.
if(!empty($image) || !empty($jquery_video_url)) : 
?>

  <div class="slider-content-main">
	<?php $home_title = the_title('','',false);if ($home_title != ""){echo '<h2>'.$home_title.'</h2>';} ?>
    <?php the_content(); ?>
  </div><!-- END slider-content-main -->
  

<?php if(!empty($jquery_video_url)): //show featured video if present ?>

  <div class="slider-content-video-alt">
    
    <?php
    
    //Video will auto resize according to aspect ratio, and will not stay width 436 and height 270.
    //Do not remove height of video as the video will be missing in Internet Explorer.     
    
    $embed_video = apply_filters('the_content', "[embed width=\"436\" height=\"270\"]".$jquery_video_url."[/embed]");
    $embed_video = str_replace("<embed","<embed wmode='transparent' ",$embed_video);      
    echo $embed_video; 
    
    ?>
   
  </div><!-- END slider-content-video-alt -->    

    
<?php else: // no featured video, we show featured image ?>

  <div class="slider-content-sub">
    <div class="slider-content-sub-content">
    <?php if ($jcycle_url == ''){ ?>
    <img src="<?php echo $image; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php the_title(); ?>" />
    <?php }else{
    echo '<a href="'.$jcycle_url.'">'; ?>
	<img src="<?php echo $image; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php the_title(); ?>" />
    <?php echo '</a>'; }?>
    <div class="home-banner-bottom">&nbsp;</div>
    </div><!-- END slider-content-sub-content -->
  </div><!-- END slider-content-sub --> 
  
<?php endif;//end if featured video check ?>
</li>

<?php else : //we show full width image ?>

<div class="slider-content-sub-full-width">
<?php the_content(); ?>
</div><!-- END slider-content-sub-full-width -->

</li>
<?php endif;endwhile; endif;wp_reset_query(); ?>
</ul>
</div><!-- END jquery1-slider-wrap -->


<div class="home-jquery-content">
<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif;
get_template_part('theme-template-part-inline-editing','childtheme');
comments_template('/page-comments.php', true);
?>
</div><!-- END home-jquery-content -->
</main><!-- END main #content -->
</div><!-- END main-area -->


<?php get_footer(); ?>