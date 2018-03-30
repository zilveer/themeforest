<?php
/**
 * The Template for displaying search form
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call
?>
<!-- search -->
<form class="search-form" method="get" action="<?php echo home_url(); ?>" role="search">
	<div class="input-group">
		<input type="text" class="form-control" value="<?php echo get_search_query() ?>" placeholder="<?php echo __( 'Search for products', 'woocommerce' ) ?>" name="s" id="srch-term">

		<div class="input-group-btn">
			<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		</div>
		<input type="hidden" name="post_type" value="product" />
	</div>
</form>
<!-- /search -->