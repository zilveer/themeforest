
<?php get_header(); ?>

<div id="main_content"> 

<?php if (get_option('op_crumbs_single') == 'on') { ?>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
<div class="inner">
<?php } ?>
<div id="content_bread_panel">	
<div class="inner">
<?php if (function_exists('wp_breadcrumbs')) wp_breadcrumbs(); ?>
</div>
</div>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
</div>
<?php } ?>
<?php } ?>

<?php
global $wp_query;
$postid = $wp_query->post->ID;
$post_thumb_var = get_post_meta($postid, 'r_post_thumb_var', true);
wp_reset_query();
?>
<?php if($post_thumb_var == 'Video Parallax') { ?>


<?php 
$thumb_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$image_full = aq_resize( $thumb_url, 1140, 'auto', false); ?>
<?php wp_enqueue_script('stellar', BASE_URL . 'js/jquery.stellar.js', false, '', true); ?>
<div class="single_photo" style=" background-image: url(<?php echo $image_full ?>);" data-stellar-background-ratio="0.5" >
<div class="photo_bg_shadow">

    <div class="featured_area_bg">
	<div class="inner">
	
	<?php 
    $youtube = get_post_meta($post->ID, 'r_youtube', true);
    $vimeo = get_post_meta($post->ID, 'r_vimeo', true);
    ?>

	<?php if($youtube) { ?>
		<div class="video-container">
		<iframe src="//www.youtube.com/embed/<?php echo $youtube; ?>" frameborder="0" allowfullscreen></iframe>
		</div>
	<?php } ?>
		
    <?php if($vimeo) { ?>
		<div class="video-container">
		<iframe src="//player.vimeo.com/video/<?php echo $vimeo; ?>" ></iframe>
		</div> 
	<?php } ?>
	
    </div>
</div>
	
</div>
</div>

<?php } ?>

<?php
global $wp_query;
$postid = $wp_query->post->ID;
$post_thumb_var = get_post_meta($postid, 'r_post_thumb_var', true);
wp_reset_query();
?>
<?php if($post_thumb_var == 'Full width Carousel') { ?>

<?php wp_enqueue_script('sliderPro', BASE_URL . 'js/jquery.sliderPro.min.js', false, '', true); ?>

<script type="text/javascript">
(function($){ 
$(window).load(function(){ 
	$( '#example2' ).sliderPro({
	width: '70%',
	height: 500,
	aspectRatio: 2,
	visibleSize: '100%',
	forceSize: 'fullWidth'
	});
})
})(jQuery);
</script>	


	<div id="example2" class="slider-pro">
		<div class="sp-slides">
		
		<?php 
        $slider_image_1 = get_post_meta($post->ID, 'r_slider_image_1', true);
		$slider_image_2 = get_post_meta($post->ID, 'r_slider_image_2', true);
		$slider_image_3 = get_post_meta($post->ID, 'r_slider_image_3', true);
		$slider_image_4 = get_post_meta($post->ID, 'r_slider_image_4', true);
		$slider_image_5 = get_post_meta($post->ID, 'r_slider_image_5', true);
		$slider_image_6 = get_post_meta($post->ID, 'r_slider_image_6', true);		
		$slider_image_7 = get_post_meta($post->ID, 'r_slider_image_7', true);
		$slider_image_8 = get_post_meta($post->ID, 'r_slider_image_8', true);
		$slider_image_9 = get_post_meta($post->ID, 'r_slider_image_9', true);
		$slider_image_10 = get_post_meta($post->ID, 'r_slider_image_10', true);		
        $slider_image_11 = get_post_meta($post->ID, 'r_slider_image_11', true);
		$slider_image_12 = get_post_meta($post->ID, 'r_slider_image_12', true);
		$slider_image_13 = get_post_meta($post->ID, 'r_slider_image_13', true);
		$slider_image_14 = get_post_meta($post->ID, 'r_slider_image_14', true);
		$slider_image_15 = get_post_meta($post->ID, 'r_slider_image_15', true);
		
		$title_slider_image_1 = get_post_meta($post->ID, 'r_title_slider_image_1', true);	
		$title_slider_image_2 = get_post_meta($post->ID, 'r_title_slider_image_2', true);
		$title_slider_image_3 = get_post_meta($post->ID, 'r_title_slider_image_3', true);
		$title_slider_image_4 = get_post_meta($post->ID, 'r_title_slider_image_4', true);
		$title_slider_image_5 = get_post_meta($post->ID, 'r_title_slider_image_5', true);
		$title_slider_image_6 = get_post_meta($post->ID, 'r_title_slider_image_6', true);
		$title_slider_image_7 = get_post_meta($post->ID, 'r_title_slider_image_7', true);
		$title_slider_image_8 = get_post_meta($post->ID, 'r_title_slider_image_8', true);
		$title_slider_image_9 = get_post_meta($post->ID, 'r_title_slider_image_9', true);
		$title_slider_image_10 = get_post_meta($post->ID, 'r_title_slider_image_10', true);
		$title_slider_image_11 = get_post_meta($post->ID, 'r_title_slider_image_11', true);	
		$title_slider_image_12 = get_post_meta($post->ID, 'r_title_slider_image_12', true);
		$title_slider_image_13 = get_post_meta($post->ID, 'r_title_slider_image_13', true);
		$title_slider_image_14 = get_post_meta($post->ID, 'r_title_slider_image_14', true);
		$title_slider_image_15 = get_post_meta($post->ID, 'r_title_slider_image_15', true);
        ?>
		
		<?php  if($slider_image_1 !== '') { ?>
		<?php $image = aq_resize( $slider_image_1, 1280, 700, true ); ?>
		
		<div class="sp-slide">
		<a href="<?php echo $image ?>" title="<?php echo $title_slider_image_1 ?>">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_1 ?>" title="<?php echo $title_slider_image_1 ?>"/>
        </a>
		<p class="sp-caption"><?php echo $title_slider_image_1 ?></p>
		</div>
        <?php } ?>

		<?php  if($slider_image_2 !== '') { ?>
		<?php $image = aq_resize( $slider_image_2, 1280, 700, true ); ?>
		
		<div class="sp-slide">
		<a href="<?php echo $image ?>" title="<?php echo $title_slider_image_2 ?>">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_2 ?>"  title="<?php echo $title_slider_image_2 ?>" />
        </a>
		<p class="sp-caption"><?php echo $title_slider_image_2 ?></p>
		</div>
        <?php } ?>

		<?php  if($slider_image_3 !== '') { ?>
		<?php $image = aq_resize( $slider_image_3, 1280, 700, true ); ?>
		
		<div class="sp-slide">
		<a href="<?php echo $image ?>" title="<?php echo $title_slider_image_3 ?>">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_3 ?>"  title="<?php echo $title_slider_image_3 ?>" />
        </a>
		<p class="sp-caption"><?php echo $title_slider_image_3 ?></p>
		</div>
        <?php } ?>

		<?php  if($slider_image_4 !== '') { ?>
		<?php $image = aq_resize( $slider_image_4, 1280, 700, true ); ?>
		
		<div class="sp-slide">
		<a href="<?php echo $image ?>" title="<?php echo $title_slider_image_4 ?>">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_4 ?>"  title="<?php echo $title_slider_image_4 ?>" />
        </a>
		<p class="sp-caption"><?php echo $title_slider_image_4 ?></p>
		</div>
        <?php } ?>		

		<?php  if($slider_image_5 !== '') { ?>
		<?php $image = aq_resize( $slider_image_5, 1280, 700, true ); ?>
		
		<div class="sp-slide">
		<a href="<?php echo $image ?>" title="<?php echo $title_slider_image_5 ?>">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_5 ?>"  title="<?php echo $title_slider_image_5 ?>" />
        </a>
		<p class="sp-caption"><?php echo $title_slider_image_5 ?></p>
		</div>
        <?php } ?>

		<?php  if($slider_image_6 !== '') { ?>
		<?php $image = aq_resize( $slider_image_6, 1280, 700, true ); ?>
		
		<div class="sp-slide">
		<a href="<?php echo $image ?>" title="<?php echo $title_slider_image_6 ?>">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_6 ?>"  title="<?php echo $title_slider_image_6 ?>" />
        </a>
		<p class="sp-caption"><?php echo $title_slider_image_6 ?></p>
		</div>
        <?php } ?>	
		
		<?php  if($slider_image_7 !== '') { ?>
		<?php $image = aq_resize( $slider_image_7, 1280, 700, true ); ?>
		<div class="sp-slide">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_7 ?>"  title="<?php echo $title_slider_image_7 ?>" />
		<p class="sp-caption"><?php echo $title_slider_image_7 ?></p>
		</div>
        <?php } ?>	
		
		<?php  if($slider_image_8 !== '') { ?>
		<?php $image = aq_resize( $slider_image_8, 1280, 700, true ); ?>
		<div class="sp-slide">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_8 ?>"  title="<?php echo $title_slider_image_8 ?>" />
		<p class="sp-caption"><?php echo $title_slider_image_8 ?></p>
		</div>
        <?php } ?>	

		<?php  if($slider_image_9 !== '') { ?>
		<?php $image = aq_resize( $slider_image_9, 1280, 700, true ); ?>
		<div class="sp-slide">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_9 ?>"  title="<?php echo $title_slider_image_9 ?>" />
		<p class="sp-caption"><?php echo $title_slider_image_9 ?></p>
		</div>
        <?php } ?>	

		<?php  if($slider_image_10 !== '') { ?>
		<?php $image = aq_resize( $slider_image_10, 1280, 700, true ); ?>
		<div class="sp-slide">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_10 ?>"  title="<?php echo $title_slider_image_10 ?>" />
		<p class="sp-caption"><?php echo $title_slider_image_10 ?></p>
		</div>
        <?php } ?>			

		<?php  if($slider_image_11 !== '') { ?>
		<?php $image = aq_resize( $slider_image_11, 1280, 700, true ); ?>
		<div class="sp-slide">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_11 ?>" title="<?php echo $title_slider_image_11 ?>"/>
		<p class="sp-caption"><?php echo $title_slider_image_11 ?></p>
		</div>
        <?php } ?>

		<?php  if($slider_image_12 !== '') { ?>
		<?php $image = aq_resize( $slider_image_12, 1280, 700, true ); ?>
		<div class="sp-slide">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_12 ?>"  title="<?php echo $title_slider_image_12 ?>" />
		<p class="sp-caption"><?php echo $title_slider_image_12 ?></p>
		</div>
        <?php } ?>

		<?php  if($slider_image_13 !== '') { ?>
		<?php $image = aq_resize( $slider_image_13, 1280, 700, true ); ?>
		<div class="sp-slide">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_13 ?>"  title="<?php echo $title_slider_image_13 ?>" />
		<p class="sp-caption"><?php echo $title_slider_image_13 ?></p>
		</div>
        <?php } ?>

		<?php  if($slider_image_14 !== '') { ?>
		<?php $image = aq_resize( $slider_image_14, 1280, 700, true ); ?>
		<div class="sp-slide">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_14 ?>"  title="<?php echo $title_slider_image_14 ?>" />
		<p class="sp-caption"><?php echo $title_slider_image_14 ?></p>
		</div>
        <?php } ?>		

		<?php  if($slider_image_15 !== '') { ?>
		<?php $image = aq_resize( $slider_image_15, 1280, 700, true ); ?>
		<div class="sp-slide">
        <img class="sp-image" data-src="<?php echo $image ?>" alt="<?php echo $title_slider_image_15 ?>"  title="<?php echo $title_slider_image_15 ?>" />
		<p class="sp-caption"><?php echo $title_slider_image_15 ?></p>
		</div>
        <?php } ?>
		
		
		
		
		</div>
    </div>
<?php } ?>




<?php
global $wp_query;
$postid = $wp_query->post->ID;
$post_thumb_var = get_post_meta($postid, 'r_post_thumb_var', true);
wp_reset_query();
?>
<?php if($post_thumb_var == 'Full width') { ?>

<?php
$thumb_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$image_full = aq_resize( $thumb_url, 1140, 'auto', false); ?>

<div class="big_image_cover">

<img src="<?php echo $image_full ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
<div class="photo_bg_shadow"></div>

<div class="photo_bg_inner">
<div class="inner">
<?php if (get_option('op_single_meta_line') == 'on') { ?>	
	<div class="post_meta_line">
		<div class="single_post_time"><?php the_time('j M, Y'); ?></div>  
		<div class="post_views"><?php setPostViews(get_the_ID()); echo getPostViews(get_the_ID()); ?></div>
		<div class="cat_author"><?php echo $op_signle_author ?> <?php global $post; $author_id=$post->post_author; ?>
<a href="<?php echo the_author_meta( 'user_url', $author_id ); ?>"><?php echo the_author_meta( 'user_nicename', $author_id ); ?></a></div> 
	</div> 
<?php } ?>
    <div class="clear"></div>
	<h1><?php the_title(); ?></h1> 
</div>
</div> 

</div>

<?php } ?>

<?php
global $wp_query;
$postid = $wp_query->post->ID;
$post_thumb_var = get_post_meta($postid, 'r_post_thumb_var', true);
wp_reset_query();
?>
<?php if($post_thumb_var == 'Full width - Parallax') { ?>

<?php 
$thumb_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$image_full = aq_resize( $thumb_url, 1140, 'auto', false); ?>

<?php wp_enqueue_script('dzsparallaxer', BASE_URL . 'js/dzsparallaxer.js', false, '', true); ?>

<div class="dzsparallaxer auto-init single_photo">

<div class="divimage dzsparallaxer--target " style="width: 100%; height: 900px; background-image: url(<?php echo $image_full ?>);">
</div>
<div class="center-it">

<div class="photo_bg_shadow">

    <div class="photo_bg_inner">
	<div class="inner">
 	<?php if (get_option('op_single_meta_line') == 'on') { ?>	
	<div class="post_meta_line">
		<div class="single_post_time"><?php the_time('j M, Y'); ?></div>  
		<div class="post_views"><?php setPostViews(get_the_ID()); echo getPostViews(get_the_ID()); ?></div>
		<div class="cat_author"><?php echo $op_signle_author ?> <?php global $post; $author_id=$post->post_author; ?>
<a href="<?php echo the_author_meta( 'user_url', $author_id ); ?>"><?php echo the_author_meta( 'user_nicename', $author_id ); ?></a></div> 
	</div> 
	<?php } ?>
    <div class="clear"></div>
	<h1><?php the_title(); ?></h1> 
    </div>
</div>
	
</div>
</div>
</div> 
<?php } ?>
	
	
	
	
	
<!---------------Single post content------------------->	
		
<div class="inner">
<div id="single_content" class="EqHeightDiv"> 	
	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
    <div class="single_post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php $post_thumb_var = get_post_meta($post->ID, "r_post_thumb_var", true); ?>
	<?php if($post_thumb_var == 'Standard') { ?>
	
	   <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	

	   <?php if(has_post_thumbnail()) { ?>

	    <?php $post_thumbnail = get_post_meta($post->ID, "r_post_thumbnail", $single = true);
	    if($post_thumbnail !== 'on') { ?>
		
	    <div class="single_thumbnail">
		<a href="<?php echo $thumbnailSrc ?>" title="<?php the_title(); ?>" rel="prettyphoto">
	    <?php $image = aq_resize( $thumbnailSrc, 830, 'auto', false); ?>
        <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
	    </a>
		</div>
	    <?php } ?>
	   
	    <?php } else {} ?>
		
	<?php } ?>
	
		<?php $post_video = get_post_meta($post->ID, "r_post_video", $single = true);
	   if($post_video !== '') { ?>
	
	<?php 
        $youtube = get_post_meta($post->ID, 'r_youtube', true);
        $vimeo = get_post_meta($post->ID, 'r_vimeo', true);
    ?>

		<?php if($youtube) { ?>
		<div class="video-container">
		    <iframe src="//www.youtube.com/embed/<?php echo $youtube; ?>" frameborder="0" allowfullscreen></iframe>
		</div>
		<?php } ?>
		
        <?php if($vimeo) { ?>
		<div class="video-container">
		    <iframe src="//player.vimeo.com/video/<?php echo $vimeo; ?>" ></iframe>
		</div> 
		<?php } ?>

	<div class="clear"></div>

	<?php } else { } ?>
	
	<?php $post_slider = get_post_meta($post->ID, "r_post_slider", $single = true);
	   if($post_slider !== '') { ?>

<?php wp_enqueue_script('flexslider', BASE_URL . 'js/jquery.flexslider-min.js', false, '', true); ?>

<script type="text/javascript">   
jQuery(document).ready(function($){  	
$('.slider_format').flexslider({
animation: "slide",
slideshow: true,
slideshowSpeed: 5000,         
animationDuration: 700,  
directionNav: true,
controlNav: false
});
});		
</script>	

	 <div class="slider_format">
	    <ul class="slides">
	    <?php 
        $slider_image_1 = get_post_meta($post->ID, 'r_slider_image_1', true);
		$slider_image_2 = get_post_meta($post->ID, 'r_slider_image_2', true);
		$slider_image_3 = get_post_meta($post->ID, 'r_slider_image_3', true);
		$slider_image_4 = get_post_meta($post->ID, 'r_slider_image_4', true);
		$slider_image_5 = get_post_meta($post->ID, 'r_slider_image_5', true);
		$slider_image_6 = get_post_meta($post->ID, 'r_slider_image_6', true);		
		$slider_image_7 = get_post_meta($post->ID, 'r_slider_image_7', true);
		$slider_image_8 = get_post_meta($post->ID, 'r_slider_image_8', true);
		$slider_image_9 = get_post_meta($post->ID, 'r_slider_image_9', true);
		$slider_image_10 = get_post_meta($post->ID, 'r_slider_image_10', true);	
        $slider_image_11 = get_post_meta($post->ID, 'r_slider_image_11', true);
		$slider_image_12 = get_post_meta($post->ID, 'r_slider_image_12', true);
		$slider_image_13 = get_post_meta($post->ID, 'r_slider_image_13', true);
		$slider_image_14 = get_post_meta($post->ID, 'r_slider_image_14', true);
		$slider_image_15 = get_post_meta($post->ID, 'r_slider_image_15', true);		
        ?>
		<?php  if($slider_image_1 !== '') { ?>
	    <li>
	    <?php $image = aq_resize( $slider_image_1, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>	
        <?php } ?>
	    <?php  if($slider_image_2 !== '') { ?>
		<li>
	    <?php $image = aq_resize( $slider_image_2, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>	
        <?php } ?>
	    <?php  if($slider_image_3 !== '') { ?>
		<li>
	    <?php $image = aq_resize( $slider_image_3, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>
        <?php } ?>
	    <?php  if($slider_image_4 !== '') { ?>
		<li>
	    <?php $image = aq_resize( $slider_image_4, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>
        <?php } ?>
		
	    <?php  if($slider_image_5 !== '') { ?>
		<li>
	    <?php $image = aq_resize( $slider_image_5, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>
        <?php } ?>	
		
	    <?php  if($slider_image_6 !== '') { ?>
		<li>
	    <?php $image = aq_resize( $slider_image_6, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>
        <?php } ?>	
		
		<?php  if($slider_image_7 !== '') { ?>
	    <li>
	    <?php $image = aq_resize( $slider_image_7, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>	
        <?php } ?>
	    <?php  if($slider_image_8 !== '') { ?>
		<li>
	    <?php $image = aq_resize( $slider_image_8, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>	
        <?php } ?>
	    <?php  if($slider_image_9 !== '') { ?>
		<li>
	    <?php $image = aq_resize( $slider_image_9, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>
        <?php } ?>
	    <?php  if($slider_image_10 !== '') { ?>
		<li>
	    <?php $image = aq_resize( $slider_image_10, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>
        <?php } ?>
		
	    <?php  if($slider_image_11 !== '') { ?>
		<li>
	    <?php $image = aq_resize( $slider_image_11, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>
        <?php } ?>	
		
	    <?php  if($slider_image_12 !== '') { ?>
		<li>
	    <?php $image = aq_resize( $slider_image_12, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>	
        <?php } ?>
	    <?php  if($slider_image_13 !== '') { ?>
		<li>
	    <?php $image = aq_resize( $slider_image_13, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>
        <?php } ?>
	    <?php  if($slider_image_14 !== '') { ?>
		<li>
	    <?php $image = aq_resize( $slider_image_14, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>
        <?php } ?>
		
	    <?php  if($slider_image_15 !== '') { ?>
		<li>
	    <?php $image = aq_resize( $slider_image_15, 830, 400, true ); ?>
        <img src="<?php echo $image ?>"/>
	    </li>
        <?php } ?>	

        </ul>
    </div>
	<div class="clear"></div>
	<?php } else { } ?>
	

	<?php $post_thumb_var = get_post_meta($post->ID, "r_post_thumb_var", true); ?>
	<?php if($post_thumb_var == 'Standard' || $post_thumb_var == 'Small' || $post_thumb_var == 'Full width Carousel' || $post_thumb_var == 'Video Parallax') { ?>
	
	<div class="single_title">	  
	   <h1><?php the_title(); ?></h1> 
    </div>
	
	<div class="clear"></div>

	<?php if (get_option('op_single_meta_line') == 'on') { ?>	
	<div class="post_meta_line">
		<div class="single_post_time"><?php the_time('j M, Y'); ?></div>  
		<div class="post_views"><?php setPostViews(get_the_ID()); echo getPostViews(get_the_ID()); ?></div>
		<div class="cat_author"><?php echo $op_signle_author ?> <?php the_author_link(); ?></div> 

	</div> 
	<?php } ?>
	
	<?php } ?>
	
    <div class="clear"></div>
	
    <div class="single_text">
	
	<?php $post_thumb_var = get_post_meta($post->ID, "r_post_thumb_var", true); ?>
	<?php if($post_thumb_var == 'Small') { ?>
	
	   <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	

	   <?php if(has_post_thumbnail()) { ?>

	    <?php $post_thumbnail = get_post_meta($post->ID, "r_post_thumbnail", $single = true);
	    if($post_thumbnail !== 'on') { ?>
		
	    <div class="single_thumbnail_small">
		<a href="<?php echo $thumbnailSrc ?>" title="<?php the_title(); ?>" rel="prettyphoto">
	    <?php $image = aq_resize( $thumbnailSrc, 300, 'auto', false); ?>
        <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
	    </a>

        <?php if (get_option('op_similar') == 'on') { ?>
 
	    <?php
        $tags = wp_get_post_tags($post->ID);
        if ($tags) {
        $tag_ids = array();
        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

        $args=array(
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'showposts'=>5,
        'caller_get_posts'=>1
        );
        $my_query = new wp_query($args);
        if( $my_query->have_posts() ) {
        echo '<ul>';
        while ($my_query->have_posts()) {
        $my_query->the_post();
        ?>
		
		<li>
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></h2>
	    </li>
		
        <?php } echo '</ul>'; } } ?>
        <?php wp_reset_query(); ?>
		 
	    <?php } ?>	

		</div>
	    <?php } ?>
	   
	    <?php } else {} ?>
		
	<?php } ?>
	
	<?php the_content(''); ?>
	<?php custom_wp_link_pages(); ?>	
    </div>
	<div class="clear"></div>
	
	<?php if (get_option('op_tags') == 'on') { ?>
	
	<?php if (get_option('op_tags_variant') == 'All tags') { ?>

	<ul id="post_tags">
    <?php
	$args = array (
		'echo' => 0,
		'show_count' => 1,
		'title_li' => '',
		'depth' => 1
	);
	$variable = wp_list_categories($args);
	$variable = str_replace ( "(" , "<span>", $variable );
	$variable = str_replace ( ")" , "</span>", $variable );
	echo $variable;
    ?>
    </ul>
	
    <script type="text/javascript">
	jQuery(document).ready(function($){  
	
	$("#post_tags")
	.find("span")
	.each(function(){
	$(this).animate({"width": "5px"});
	})
	.parent()
	.hover(
	function(){
	$(this).find("span").stop().animate({"width": "35px"});
	}, function() {
	$(this).find("span").stop().animate({"width": "5px"});
	});
	
	});
    </script>
	
	<?php } else { ?>
	<?php the_tags('<ul id="tags_simple"><li>','</li><li>','</li></ul>'); ?>
	<?php } ?>
	
    <?php } ?>
	
	<div class="clear"></div>
	
	
<?php if (get_option('op_banner_single') == 'on') { ?>
<div id="banner_single_728">
<?php $index_banner = get_option("op_banner_single_code"); ?>
<?php echo stripslashes($index_banner); ?>
</div>
<div class="clear"></div>
<?php } ?>	
	
	
<?php if (get_option('op_nav_variant') == 'Sticky') { ?>	
	
<div class="nav_svg">
	<svg width="64" height="64" viewBox="0 0 64 64">
		<path id="arrow-left-1" d="M46.077 55.738c0.858 0.867 0.858 2.266 0 3.133s-2.243 0.867-3.101 0l-25.056-25.302c-0.858-0.867-0.858-2.269 0-3.133l25.056-25.306c0.858-0.867 2.243-0.867 3.101 0s0.858 2.266 0 3.133l-22.848 23.738 22.848 23.738z" />
	</svg>
	
	<svg width="64" height="64" viewBox="0 0 64 64">
		<path id="arrow-right-1" d="M17.919 55.738c-0.858 0.867-0.858 2.266 0 3.133s2.243 0.867 3.101 0l25.056-25.302c0.858-0.867 0.858-2.269 0-3.133l-25.056-25.306c-0.858-0.867-2.243-0.867-3.101 0s-0.858 2.266 0 3.133l22.848 23.738-22.848 23.738z" />
	</svg>
</div>
	
<div class="nav-slide">
	<div class="sticky_post sticky_prev_post">
	<span class="icon-wrap"><svg class="icon" width="32" height="32" viewBox="0 0 64 64"><use xlink:href="#arrow-left-1"></svg></span>
	
	<div class="sticky_post_content">
		<h3><?php previous_post_link(); ?></h3>
		
		<?php
        $prev_post = get_previous_post();
        if (!empty( $prev_post )): ?>
        <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
	    <?php echo get_the_post_thumbnail($prev_post->ID, 'thumbnail', array(100,100)); ?>
	    </a>
        <?php endif; ?>
	</div>
	
	</div>
	
	<div class="sticky_post sticky_next_post">
	<span class="icon-wrap"><svg class="icon" width="32" height="32" viewBox="0 0 64 64"><use xlink:href="#arrow-right-1"></svg></span>
		
	<div class="sticky_post_content">
		<h3><?php next_post_link(); ?></h3>
		<?php
        $next_post = get_next_post();
        if (!empty( $next_post )): ?>
        <a href="<?php echo get_permalink( $next_post->ID ); ?>">
	    <?php echo get_the_post_thumbnail($next_post->ID, 'thumbnail', array(100,100)); ?>
	    </a>
        <?php endif; ?>
	</div>
	
	</div>
</div>
	
<?php } else { ?>	
	
	<div id="navigation_images">
	<div class="alignleft">
	<?php
    $prev_post = get_previous_post();
    if (!empty( $prev_post )): ?>
    <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
	<?php echo get_the_post_thumbnail($prev_post->ID, 'post-thumbnails', array(420,420)); ?>
	</a>
	
	<div class="prev_link_title">
	<span>- <?php echo (get_option('op_previous_article')) ?></span> </br>
    <?php previous_post_link(); ?>
    </div>
	<?php endif; ?>
	</div> 
	
	<div class="alignright">
	
	<?php
    $next_post = get_next_post();
    if (!empty( $next_post )): ?>
    <a href="<?php echo get_permalink( $next_post->ID ); ?>">
	<?php echo get_the_post_thumbnail($next_post->ID, 'post-thumbnails', array(420,420)); ?>
	</a>
   
	
	<div class="next_link_title">
	<span><?php echo (get_option('op_next_article')) ?> -</span></br>
	<?php next_post_link(); ?>
    </div>
	<?php endif; ?>
	</div>

	</div> 
	
	<div class="clear"></div>
<?php } ?>
	
	<?php if (get_option('op_rec_sim_style')!== 'Default') { ?>
    <?php $rec_sim_style = '' . get_option("op_rec_sim_style"); ?> 
    <?php } ?>
	
    <?php if (get_option('op_single_recent') == 'on') { ?>	
	<ul id="single_recent_posts" class="<?php echo $rec_sim_style ?> mosaicflow" data-item-selector=".single_recent_post" data-min-item-width="240">
	
	<div class="latest_title_box <?php echo $rec_sim_style ?>"><h3><?php echo $op_recent_posts ?></h3></div>	
	<div class="clear"></div>	
	<?php $archive_query = new WP_Query('showposts=6');  
        while ($archive_query->have_posts()) : $archive_query->the_post(); ?>  
		
        <li class="single_recent_post">  
		<?php if(has_post_thumbnail()) { ?>
		<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>		
		
		<?php echo $post_format_image ?> 
		
        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
		<?php $image = aq_resize( $thumbnailSrc, 250, 170, false); ?>
        <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
		</a>
		
        <?php } else {} ?>
		
		<?php
		$more_cat_posts = get_option('op_view_more_in_category');
		$categories_string = '';
			foreach((get_the_category()) as $category) {
           
			$categories_string .= '<a class="custom_cat_class_Kesha tip" href="'.get_category_link( $category->term_id ).' " title="' . esc_attr( sprintf( __( "$more_cat_posts %s" ), $category->name ) ) . '" " >'.$category->cat_name.'</a>';
	        } 
		$categories_string = trim($categories_string);
		?>
		<?php echo $categories_string; ?>
		
        <?php if (get_option('op_rec_sim_style')!== 'Default') { ?>
	    <div class="clear"></div> 
        <?php } ?>
		
        <a class="recent_posts_title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>  
	   
	   </li>  
    <?php endwhile; ?>  
    </ul>
    <?php } ?>
	
	
    <?php if (get_option('op_similar') == 'on') { ?>
	
	<?php if (get_option('op_rec_sim_style')!== 'Default') { ?>
    <?php $rec_sim_style = '' . get_option("op_rec_sim_style"); ?> 
    <?php } ?>
	
	<div id="similar-post" class="<?php echo $rec_sim_style ?>"> 
 
	    <?php
        $tags = wp_get_post_tags($post->ID);
        if ($tags) {
        $tag_ids = array();
        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

        $args=array(
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'showposts'=>6,
        'caller_get_posts'=>1
        );
        $my_query = new wp_query($args);
        if( $my_query->have_posts() ) {
        echo '<div class="sim_title_box '. $rec_sim_style .'"><h3>'. $op_more_news .' </h3></div><div class="clear"></div><ul class="mosaicflow" data-item-selector=".similar_posts" data-min-item-width="240">';
        while ($my_query->have_posts()) {
        $my_query->the_post();
        ?>
		
		<li class="similar_posts">
		
		<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	 
        <?php if(has_post_thumbnail()) { ?>	
			
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
		<?php $image = aq_resize( $thumbnailSrc, 250, 170, false); ?>
        <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>					
        </a>
			
        <?php } else { } ?>	
		
		<?php
		$more_cat_posts = get_option('op_view_more_in_category');
		$categories_string = '';
			foreach((get_the_category()) as $category) {
           
			$categories_string .= '<a class="custom_cat_class_Kesha tip" href="'.get_category_link( $category->term_id ).' " title="' . esc_attr( sprintf( __( "$more_cat_posts %s" ), $category->name ) ) . '" " >'.$category->cat_name.'</a>';
	        } 
		$categories_string = trim($categories_string);
		?>
		<?php echo $categories_string; ?>
		
        <?php if (get_option('op_rec_sim_style')!== 'Default') { ?>
	    <div class="clear"></div> 
        <?php } ?>
		
		<h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></h1>
	    </li>
		
        <?php } echo '</ul>'; } } ?>
        <?php wp_reset_query(); ?>
		
    </div>	 
	<?php } ?>	 
	
	<div class="clear"></div>

	<?php posts_nav_link(' &#183; ', 'previous page', 'next page'); ?>
	
	<?php if (get_option('op_single_comments') == 'on') { ?>
	
	<?php if (get_option('op_comments_variant') == 'Simple comments') { 
	comments_template('', true); } else { ?>
	
	<?php $discus = get_option('op_discus'); ?>
	
	<div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = '<?php echo $discus ?>'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = 'http://'+disqus_shortname+'.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	<?php } ?>
	
	<?php } ?>	
	
	<?php endwhile; ?>
	<?php else : ?>
	
	<?php endif; ?>	 

</div>

</div>	
	
<?php get_sidebar('right'); ?>	
	
</div>

<div class="clear"></div>
		
	
<?php get_footer(); ?>


	