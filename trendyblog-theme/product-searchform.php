<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
	<div class="tb_widget_search">
		<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
			<div>
				<label class="screen-reader-text" for="s"><?php esc_attr_e( 'Search for:', THEME_NAME  ); ?></label>
				<input type="text" value="<?php echo esc_attr__(get_search_query()); ?>" name="s" placeholder="<?php esc_attr_e( 'Search for products', THEME_NAME ); ?>" />
				<input type="submit" id="searchsubmit" value="<?php echo esc_attr__( 'Search', THEME_NAME ); ?>" />
				<input type="hidden" name="post_type" value="product" />
			</div>
		</form>
	</div>
