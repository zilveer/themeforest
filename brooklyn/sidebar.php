<?php

/**
 * Default Sidebar for Blog
 * by www.unitedthemes.com
 */

?>

<?php if( is_active_sidebar('blog-widget-area') ) : ?>
    
    <div id="secondary" class="widget-area grid-25 mobile-grid-100 tablet-grid-25" role="complementary">
        <ul class="sidebar">
            <?php dynamic_sidebar('blog-widget-area'); ?>
        </ul>
    </div>
    
<?php endif; ?>