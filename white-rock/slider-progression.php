<?php
/**
 * The template used for displaying featured slider called from the header.php
 *
 * @package progression
 * @since progression 1.0
 */
?>
<?php
$portfolio_type = get_the_term_list( $post->ID, 'portfolio_type' );
$portfolioloop = new WP_Query(array(
    'paged'          => get_query_var('paged'),
    'post_type'      => 'portfolio',
    'posts_per_page' => -1,
    'tax_query'      => array(
        // Note: tax_query expects an array of arrays!
        array(
            'taxonomy' => 'portfolio_type', // my guess
            'field'    => 'name',
            'terms'    => $portfolio_type
        ),
    ),
));
?>
<div id="homepage-slider-container">
<div id="page-title">
<div class="flexslider" id="homepage-slider">
	<ul class="slides">
		
	<?php while ( $portfolioloop->have_posts() ) : $portfolioloop->the_post(); ?>
		<li>
			<?php if(get_post_meta($post->ID, 'portfoliooptions_externallink', true)): ?><a href="<?php echo get_post_meta($post->ID, 'portfoliooptions_externallink', true) ?>"><?php endif; ?>
			<?php if(get_post_meta($post->ID, 'portfoliooptions_lightbox', true)): ?><a href="<?php echo get_post_meta($post->ID, 'portfoliooptions_lightbox', true) ?>" rel="prettyPhoto[slider-gallery]" ><!-- EXTERNAL LINK --><?php endif; ?>
			
				
			<?php if(has_post_thumbnail()): ?>
				<?php if(of_get_option('retina_slider_images', '1')): ?>
					<?php the_post_thumbnail('progression-slider-retina'); ?>
				<?php else: ?>
					<?php the_post_thumbnail('progression-slider'); ?>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if(get_post_meta($post->ID, 'portfoliooptions_videoembed', true)): ?>
			<!-- iFrame Video Here --><div class="video-container-slider"><?php echo get_post_meta($post->ID, 'portfoliooptions_videoembed', true) ?></div>
			<?php endif; ?>
			
			
			<?php $cc = get_the_content(); if($cc != '') { ?>
				<div class="caption-progression">
					<div class="width-container">
						<?php the_content(); ?>
					</div>
				</div>
			<?php } ?>
			
			<?php if(get_post_meta($post->ID, 'portfoliooptions_lightbox', true)): ?></a><!-- EXTERNAL LINK --><?php endif; ?>
			<?php if(get_post_meta($post->ID, 'portfoliooptions_externallink', true)): ?></a><?php endif; ?>
		</li>
	<?php endwhile; // end of the loop. ?>
	
	</ul>
</div><!-- close .flexslider -->
<div id="page-title-divider"></div>
</div><!-- #page-title -->
</div><!-- close #homepage-slider-container -->
<div class="clearfix"></div>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#homepage-slider').flexslider({
		animation: "<?php echo of_get_option('slider_animation', 'fade'); ?>",              //String: Select your animation type, "fade" or "slide"
		slideshow: <?php echo of_get_option('slider_autoplay_play', true); ?>,                //Boolean: Animate slider automatically
		slideshowSpeed: <?php echo of_get_option('slider_autoplay', 8000); ?>,           //Integer: Set the speed of the slideshow cycling, in milliseconds
		animationDuration: 500,         //Integer: Set the speed of animations, in milliseconds
		directionNav: <?php echo of_get_option('slider_navigation', true); ?>,             //Boolean: Create navigation for previous/next navigation? (true/false)
		controlNav: <?php echo of_get_option('slider_bullets', true); ?>,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
		mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
		prevText: "Previous",           //String: Set the text for the "previous" directionNav item
		nextText: "Next",               //String: Set the text for the "next" directionNav item
		pausePlay: false,               //Boolean: Create pause/play dynamic element
		pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
		playText: 'Play',               //String: Set the text for the "play" pausePlay item
		randomize: false,               //Boolean: Randomize slide order
		slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
		useCSS: true,
		animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
		pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
		pauseOnHover: false            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
    });
});
</script>