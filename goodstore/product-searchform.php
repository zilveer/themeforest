<?php
/**
 * Searchform
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */


ob_start();
?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="search-box">		
        <div class="search-input">
            <input type="text" value="<?php get_search_query(); ?>" name="s" id="s" placeholder="<?php _e('Search for products', 'jawtemplates'); ?>">
        </div>

        <div class="search-button">
            <button type="submit" id="searchsubmit" value="" class=""><span></span></button>
        </div>
    </div>
    <input type="hidden" name="post_type" value="product" />
</form>

<?php 
    $form = ob_get_clean();
    echo $form;