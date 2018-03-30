<?php 
	/*
	Template Name: Coming Soon
	*/
	get_header('maintenance');
	the_post();
	
	/**
	 * Get post attachments
	 */
	$thumb_id = get_post_thumbnail_id( $post->ID );
	$args = array(
	    'post_type' => 'attachment',
	    'post_mime_type'  => 'image/jpeg',
	    'orderby' => 'menu_order',
	    'numberposts' => -1,
	    'order' => 'ASC',
	    'post_parent' => $post->ID,
	    'exclude' => $thumb_id // Exclude featured thumbnail
	);
	$attachments = get_posts($args);
		
	/**
	 * Finally, build an array of resized images.
	 */	
	foreach ( $attachments as $attachment ) :
		
		$background_images[] = $resized_image = aq_resize($attachment->guid, 272, 600, 1);
		
	endforeach;	
?>

<section id="content" class="clearfix">
	
	<article id="page-<?php the_ID(); ?>" <?php post_class('page-maintenance'); ?>>
		
		<a href="<?php echo home_url(); ?>">
			<?php if( get_option('custom_logo') ) : ?>
				<img src="<?php echo get_option('custom_logo'); ?>" alt="<?php echo get_option('custom_logo_alt_text'); ?>" class="retina" />
			<?php else : ?>
				<?php echo bloginfo('title'); ?>
			<?php endif; ?>
		</a>
		
		<?php echo '<br /><span>' . get_bloginfo('description') . '</span>'; ?>
		
		<div class="break-40"></div>
		
		<?php 
			the_content(); 
			
			if( get_the_content() )
				echo '<div class="break-30"></div>';
		?>
		
	</article>
		
		<div id="countdown">
		
			<div class="one_fourth">
				<img src="<?php echo $background_images[0]; ?>" alt="countdown" />
				<div class="clock">
					<span class="big-time"></span>
					<span class="small-time"><?php _e('Days','ebor_starter'); ?></span>
				</div>
			</div>
			<div class="one_fourth">
				<img src="<?php echo $background_images[1]; ?>" alt="countdown" />
				<div class="clock">
					<span class="big-time">%H</span>
					<span class="small-time"><?php _e('Hours','ebor_starter'); ?></span>
				</div>
			</div>
			<div class="one_fourth">
				<img src="<?php echo $background_images[2]; ?>" alt="countdown" />
				<div class="clock">
					<span class="big-time">%M</span>
					<span class="small-time"><?php _e('Minutes','ebor_starter'); ?></span>
				</div>
			</div>
			<div class="one_fourth last">
				<img src="<?php echo $background_images[3]; ?>" alt="countdown" />
				<div class="clock">
					<span class="big-time">%S</span>
					<span class="small-time"><?php _e('Seconds','ebor_starter'); ?></span>
				</div>
			</div>
			
		</div>
		
		<script type="text/javascript">
			jQuery(document).ready(function(){
			   jQuery('#countdown').countdown('<?php echo get_post_meta( $post->ID, '_ebor_soon_date', 1 ); ?>', function(event) {
			     jQuery(this).find('.big-time').eq(0).html(event.strftime('%D'));
			     jQuery(this).find('.big-time').eq(1).html(event.strftime('%H'));
			     jQuery(this).find('.big-time').eq(2).html(event.strftime('%M'));
			     jQuery(this).find('.big-time').eq(3).html(event.strftime('%S'));
			   });
			});
		</script>
	
</section>

<?php	
	get_footer();