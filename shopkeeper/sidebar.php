<div class="row">
    <div class="large-11 large-push-1 columns">
    
        <div id="secondary" class="widget-area wpb_widgetised_column" role="complementary">
            <?php do_action( 'before_sidebar' ); ?>
            <?php if ( ! dynamic_sidebar( 'default-sidebar' ) ) : ?>
        
                <aside id="search" class="widget widget_search">
                    <?php get_search_form(); ?>
                </aside>
        
                <aside id="archives" class="widget">
                    <h1 class="widget-title"><?php _e( 'Archives', 'shopkeeper' ); ?></h1>
                    <ul>
                        <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                    </ul>
                </aside>
        
                <aside id="meta" class="widget">
                    <h1 class="widget-title"><?php _e( 'Meta', 'shopkeeper' ); ?></h1>
                    <ul>
                        <?php wp_register(); ?>
                        <li><?php wp_loginout(); ?></li>
                        <?php wp_meta(); ?>
                    </ul>
                </aside>
        
            <?php endif; // end sidebar widget area ?>
        </div><!-- #secondary -->
    
    </div>
</div>
