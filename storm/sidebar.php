<?php global $bk_option;
if (isset($bk_option)):
    if ($bk_option['bk-sidebar-location'] != NULL): $sidebar_location = $bk_option['bk-sidebar-location']; endif;
    if ($bk_option['bk-sidebar-style'] != NULL): $sidebar_style = $bk_option['bk-sidebar-style']; endif;
endif;
?>
<!--<home sidebar widget>-->
    <?php  if ( (is_front_page() && is_active_sidebar( 'home_sidebar' ) && is_active_sidebar( 'content_section' )) || ( !is_front_page() && (is_active_sidebar( 'page_sidebar' ) || is_active_sidebar( 'home_sidebar' )))):?>
		<div class="sidebar <?php echo ($sidebar_location.' '.$sidebar_style)?>">
            <?php 
                if (is_front_page()) {
                        dynamic_sidebar('home_sidebar');
                } else {
                    if ( is_active_sidebar( 'page_sidebar' )) {
                        dynamic_sidebar('page_sidebar');
                    } else {
                            dynamic_sidebar('home_sidebar');
                    }
                }
            ?>  	
		</div>
    <?php endif; ?>
<!--</home sidebar widget>-->