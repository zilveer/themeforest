<?php get_header(); ?>

<!-- Homepage content -->
<div class="container homepage-content">
    <div class="main-content-column-1 full-width"
         
        <!-- Post -->
        <div <?php post_class('post-1'); ?>>
            <div class="post">
                <i class="fa fa-exclamation-triangle"></i> <?php _e('Page not found! Something has gone wrong. Sorry about that!', 'goliath'); ?>
            </div>
        </div>
        
    </div>
</div>
            
<?php get_footer(); ?>