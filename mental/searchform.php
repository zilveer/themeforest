<?php
/**
 * Search form template part
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
		<input type="text" class="form-control" value="<?php echo get_search_query() ?>" placeholder="<?php echo __( 'Search', 'mental' ) ?>" name="s" id="srch-term">

		<div class="input-group-btn">
			<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		</div>
	</div>
</form>
<!-- /search -->
