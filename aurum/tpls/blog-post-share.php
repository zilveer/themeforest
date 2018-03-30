<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

?>
<?php if(get_data('blog_share_story')): ?>
<!-- share post -->
<div class="share-post">
	<h3><?php _e('Share This Story On', 'aurum'); ?>:</h3>

	<div class="share-post-links">

		<?php
		$share_story_networks = get_data('blog_share_story_networks');
		$as_icons = get_data( 'blog_share_post_icons' );
		
		if ( $as_icons ) {
			add_filter( 'aurum_shop_product_single_share', '__return_true', 100 );
		}

		foreach ( $share_story_networks['visible'] as $network_id => $network ) :

			if($network_id == 'placebo')
				continue;

			share_story_network_link($network_id, $id);

		endforeach;
		?>

	</div>

</div>
<!-- / share post end-->
<?php endif; ?>