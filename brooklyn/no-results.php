<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package unitedthemes
 */
 
$header_style = ot_get_option('ut_global_headline_style'); ?>

<div class="grid-70 prefix-15 mobile-grid-100 tablet-grid-100">
    
    <header class="page-header <?php echo $header_style;?>">
        <h1 class="page-title"><span><?php _e( 'Nothing Found', 'unitedthemes' ); ?></span></h1>                  
        
        <p class="lead">
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'unitedthemes' ), esc_url( admin_url( 'post-new.php' ) ) ); ?>

		<?php elseif ( is_search() ) : ?>

			<?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'unitedthemes' ); ?>

		<?php else : ?>

			<?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'unitedthemes' ); ?>

		<?php endif; ?>
        </p>
        
    </header><!-- .page-header --> 
    
    <?php get_search_form(); ?>
    
</div>
<div class="clear"></div>