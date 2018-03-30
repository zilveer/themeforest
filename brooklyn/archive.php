<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package unitedthemes
 */
global $wp_query;

get_header(); 

$header_style = ot_get_option('ut_global_headline_style');

?>


<div class="grid-container">
<div id="primary" class="grid-parent grid-100 tablet-grid-100 mobile-grid-100">

				<?php if ( have_posts() ) : ?>
        			
                    <!-- page header -->
                    <div class="grid-70 prefix-15 mobile-grid-100 tablet-grid-100">
                    <header class="page-header <?php echo $header_style;?>">
                        <h1 class="page-title"><span>
                            <?php
                                if ( is_category() ) :
                                    single_cat_title();
        
                                elseif ( is_tag() ) :
                                    single_tag_title();
        
                                elseif ( is_author() ) :
                                    /* Queue the first post, that way we know
                                     * what author we're dealing with (if that is the case).
                                    */
                                    the_post();
                                    printf( __( 'Author: %s', 'unitedthemes' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
                                    /* Since we called the_post() above, we need to
                                     * rewind the loop back to the beginning that way
                                     * we can run the loop properly, in full.
                                     */
                                    rewind_posts();
        
                                elseif ( is_day() ) :
                                    printf( __( 'Day: %s', 'unitedthemes' ), '<span>' . get_the_date() . '</span>' );
        
                                elseif ( is_month() ) :
                                    printf( __( 'Month: %s', 'unitedthemes' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
        
                                elseif ( is_year() ) :
                                    printf( __( 'Year: %s', 'unitedthemes' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
        
                                elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
                                    _e( 'Asides', 'unitedthemes' );
        
                                elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
                                    _e( 'Images', 'unitedthemes');
        
                                elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
                                    _e( 'Videos', 'unitedthemes' );
        
                                elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
                                    _e( 'Quotes', 'unitedthemes' );
        
                                elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
                                    _e( 'Links', 'unitedthemes' );
        
                                else :
                                    _e( 'Archives', 'unitedthemes' );
        
                                endif;
                            ?>
                        </span>    
                        </h1>
                        <?php
                            // Show an optional term description.
                            $term_description = term_description();
                            if ( ! empty( $term_description ) ) :
                                printf( '<p class="lead">%s</p>', $term_description );
                            endif;
                        ?>
                    </header>
                    </div><!-- .page-header -->
                    
                    
					<?php /* Start the Loop */ ?>
                    
                    <?php while ( have_posts() ) : the_post(); ?>
        
                        <?php
                            /* Include the Post-Format-specific template for the content.
                             * If you want to overload this in a child theme then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'partials/content', get_post_format() );
                        ?>
        
                    <?php endwhile; ?>
                    
                    <?php /* end the Loop */ ?>                    
                            
                <?php else : ?>
        
                    <?php get_template_part( 'no-results', 'archive' ); ?>
        
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