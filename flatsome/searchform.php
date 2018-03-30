<?php
/**
 * The template for displaying search forms in flatsome
 *
 * @package flatsome
 */
?>
<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<div class="flex-row relative">
			<div class="flex-col flex-grow">
	   	   <input type="search" class="search-field mb-0" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo _e( 'Search', 'woocommerce' ); ?>&hellip;" />
			</div><!-- .flex-col -->
			<div class="flex-col">
				<button type="submit" class="ux-search-submit submit-button secondary button icon mb-0">
					<?php echo get_flatsome_icon('icon-search'); ?>
				</button>
			</div><!-- .flex-col -->
		</div><!-- .flex-row -->
    <div class="live-search-results text-left z-top"></div>
</form>
