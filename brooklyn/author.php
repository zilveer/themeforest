<?php
/**
 * The template for displaying Author archive pages.
 *
 */
global $wp_query;

get_header(); 

$header_style = ot_get_option('ut_global_headline_style'); ?>

<div class="grid-container">
<div id="primary" class="grid-parent grid-100 tablet-grid-100 mobile-grid-100">

<?php if ( have_posts() ) : ?>
	<?php
        /* Queue the first post, that way we know
         * what author we're dealing with (if that is the case).
         *
         * We reset this later so we can run the loop
         * properly with a call to rewind_posts().
         */
        the_post();
    ?>
    
     <!-- page header -->
     <div class="grid-70 prefix-15 mobile-grid-100 tablet-grid-100">
     <header class="page-header <?php echo $header_style;?>">
     	<h1 class="page-title"><span><?php printf( esc_html__( 'All posts by %s', 'unitedthemes' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></span></h1>        
    </header>
    </div><!-- .page-header -->
    
    <?php
        /* Since we called the_post() above, we need to
         * rewind the loop back to the beginning that way
         * we can run the loop properly, in full.
         */
        rewind_posts();
    ?>
<?php endif; ?>
              
            
            <?php if ( have_posts() ) : ?>
            
                <?php /* The loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
                
                    <?php get_template_part('partials/content', get_post_format() ); ?>
                    
                <?php endwhile; ?>
    
            <?php else : ?>
                <?php get_template_part( 'content', 'none' ); ?>
            <?php endif; ?>
       
	</div><!-- .grid-parent grid-100 tablet-grid-100 mobile-grid-100 --> 
</div><!-- .grid-container --> 

<?php if( $wp_query->max_num_pages > 1 ) : ?>
<div id="ut-blog-navigation">
	<div class="grid-container">
		<div class="grid-100 tablet-grid-100 mobile-grid-100">	
		<?php if ( have_posts() ) : ?>
			<?php unitedthemes_content_nav( 'nav-below' ); ?>
		<?php endif; ?>	
		</div><!-- .grid-100 -->  
	</div><!-- .grid-container -->
</div><!-- #ut-blog-navigation -->
<?php endif; ?>

<?php get_footer(); ?>