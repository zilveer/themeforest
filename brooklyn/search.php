<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package unitedthemes
 */
global $wp_query;

get_header(); 

$header_style = ot_get_option('ut_global_headline_style'); ?>

<div class="grid-container">
<div id="primary" class="grid-parent grid-100 tablet-grid-100 mobile-grid-100">
                             
	<?php if ( have_posts() ) : ?>
        
    <div class="grid-70 prefix-15 mobile-grid-100 tablet-grid-100">
        <header class="page-header <?php echo $header_style;?>">
            <h1 class="page-title"><span><?php printf( esc_html__( 'Search Results for: %s', 'unitedthemes' ), '' . get_search_query() . '' ); ?></span></h1>                  
        </header>
    </div><!-- .page-header -->
        
    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>
    
        <?php get_template_part( 'partials/content', get_post_format() ); ?>
    
    <?php endwhile; ?>
    
    <?php else : ?>
    
    <?php get_template_part( 'no-results', 'search' ); ?>
    
    <?php endif; ?>

</div><!-- #primary -->
</div><!-- .grid-container -->
                                
<?php if( $wp_query->max_num_pages > 1 ) : ?>
<div id="ut-blog-navigation">
	<div class="grid-container">
		<div class="grid-100">	
		<?php if ( have_posts() ) : ?>
			<?php unitedthemes_content_nav( 'nav-below' ); ?>
		<?php endif; ?>	
		</div><!-- .grid-100 -->  
	</div><!-- .grid-container -->
</div><!-- #ut-blog-navigation -->
<?php endif; ?>

<?php get_footer(); ?>