

<div id="touchcarousel-4" class="touchcarousel grey-blue tc-layout-4">
<div class="inner">
<ul class="touchcarousel-container">
	
<?php $rand_posts = get_posts('orderby=rand&numberposts=11'); foreach($rand_posts as $post): ?>	

 	<?php 
		$carousel_format = get_post_format(); if ( false === $carousel_format ) { 
		$carousel_post_format_image = '<div class="post_format"></div>'; 
		}
					
		if(has_post_format('video')) { 
		$carousel_post_format_image = '<div class="post_format_video"></div>';
		}
					
		if(has_post_format('image')) {
		$carousel_post_format_image = '<div class="post_format_image"></div>';
		}
		
		if(has_post_format('audio')) {
		$carousel_post_format_image = '<div class="post_format_audio"></div>';
		}
	?> 


<li class="touchcarousel-item">
<a class="tc-state" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

		<?php if(has_post_thumbnail()) { ?>
		<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>		
		
		<div class="post_img_box">
        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
		<?php $image = aq_resize( $thumbnailSrc, 230, 180, true); ?>
        <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
		</a>
		</div>	
		
		<div class="cats_and_formats_box">
        
		<?php $category = get_the_category();
        if ($category) {
        echo '<a class="custom_cat_class" href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "%s", "my-text-domain" ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ';
        }
        ?>
		
		<?php echo $carousel_post_format_image ?>
		</div>
		
        <div class="clear"></div>
        <?php } else {} ?>

	<div class="tc-block">
	<h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>	
	</div>
</a>
</li>
<?php endforeach; ?>

			
</ul>
</div>
</div>
<div class="clear"></div>


<?php
wp_enqueue_script('touchcarousel', BASE_URL . 'js/jquery.touchcarousel-1.0.min.js', false, '', true); 
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
carouselInstance = $("#touchcarousel-4").touchCarousel({
"snapToItems":true,
"pagingNavControls":false,
"itemsPerMove": 4,
"loopItems":true,
"directionNav":true,
"directionNavAutoHide":false,
"autoplay":true,
"autoplayDelay": 4000,
"autoplayStopAtAction":true,
"keyboardNav":false,
"dragUsingMouse":true,
"transitionSpeed":400,
"itemFallbackWidth": 100,
"scrollbar":false,
"scrollbarAutoHide":true,
"scrollbarTheme":"dark"
}).data('touchCarousel');
});
</script>