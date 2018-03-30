<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/product-searchform.php
 * @file	 	1.0
 */
?>
<div class="row">
  <div class="twelve columns">
    <div class="row collapse">
    	<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	      <div class="ten mobile-three columns">
	        <label class="screen-reader-text" for="s"><?php __( 'Search for:', 'woocommerce' );?></label>
				
	        <input type="text" id="s" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php __( 'Search for products', 'woocommerce' ) ?>" />
	      </div>
	      <div class="two mobile-one columns">
	        <button type="submit" id="searchsubmit" class="postfix button"><i class="icon-search"></i></button>
	        <input type="hidden" name="post_type" value="product" />
	      </div>
  		</form>
    </div>
  </div>
</div>
