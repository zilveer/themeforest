<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<div class="pagination post-pagination clearfix">
		
	<?php
	$prev_post = get_previous_post();
	$next_post = get_next_post();
	?>
	
	<?php if (!empty( $prev_post )) : ?>
	<div class="older">
		<a class="animative-btn" href="<?php echo get_permalink( $prev_post->ID ); ?>">
			<?php _e("Previous Post", 'alison'); ?>
		</a>
	</div>
	<?php endif; ?>
	
	<?php if (!empty( $next_post )) : ?>
	<div class="newer">
		<a class="animative-btn" href="<?php echo get_permalink( $next_post->ID ); ?>">
			<?php _e("Next Post", 'alison'); ?>
		</a>
	</div>
	<?php endif; ?>
		
</div>