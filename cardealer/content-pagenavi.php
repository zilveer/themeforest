<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<!-- - - - - - - - - - - - Pagination - - - - - - - - - - - - - - -->
<?php 
global $wp_query;
global $show_total_items;

if ($wp_query->query_vars['posts_per_page'] < $wp_query->found_posts){
    
    ?>
    <div class="wp-pagenavi">

        <?php 

        TMM_Helper::pagenavi();
        
        if(isset($show_total_items) && $show_total_items == true){
            
            ?>

            <div class="total-items">
                    <?php echo (int) $wp_query->found_posts . ' ' .  __('items', 'cardealer'); ?>
            </div><!--/ .total-items-->
            <div class="clear"></div>
        
            <?php
        
        } 
        
        ?>

    </div><!--/ .wp-pagenavi -->
    <?php

} else {
	
	if(isset($show_total_items) && $show_total_items == true && $wp_query->found_posts > 0){

		?>
	    <div class="wp-pagenavi">
            <div class="total-items">
                    <?php echo (int) $wp_query->found_posts . ' ' . ( $wp_query->found_posts > 1 ? __('items', 'cardealer') : __('item', 'cardealer') ); ?>
            </div><!--/ .total-items-->
            <div class="clear"></div>
	    </div><!--/ .wp-pagenavi -->
	    <?php

	}

}

?>
<!-- - - - - - - - - - - end Pagination - - - - - - - - - - - - - -->
