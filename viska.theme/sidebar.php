<!-- Begin Sidebar -->
<aside class="<?php echo layout_class('right');?>">
    <div class="sidebar">
        <?php if ( is_active_sidebar( 'home-right' ) ) : ?>
            <?php dynamic_sidebar( 'home-right' ); ?>
        <?php else : ?>
            <div class="alert alert-message">
                <p><?php _e("Please activate some Widgets",LANGUAGE); ?>.</p>
            </div>
        <?php endif; ?>
    </div>
</aside>
<!-- End Sidebar -->