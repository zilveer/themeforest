<?php

/**
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
?>
<div class="blog-search">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
		<div class="input-group input-group-lg">
            <input type="text" class="form-control" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder','gather' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( '', 'label','gather' ) ?>"/>
            <span class="input-group-btn">
      			<button class="btn btn-primary" type="submit"><?php _e('<i class="glyphicon glyphicon-search glyphicon-lg"></i>','gather'); ?></button>
      		</span>
      	</div>
	</form>
</div>