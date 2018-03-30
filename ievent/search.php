<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package iEVENT
 */

get_header(); ?>

	 <!-- BOF Main Content -->
    <div id="main" role="main" class="main">       
        
        <div id="primary" class="content-area">
                <div class="container with-sidebar">
                    <div class="sixteen columns jx-ievent-padding alpha">
                    
                        <?php if ( have_posts() ) : ?>
                        
                            <div class="jx-ievent-page-search wide bg-grey">
                                <form action="#" id="contactForm-1" method="post" class="jx-ievent-form-wrapper cf">
                                <div id="message-input-1" class="search-inline-block">
                                <input kl_virtual_keyboard_secure_input="on" id="first_name-1" name="first_name" placeholder="Search..." class="jx-ievent-form-name" type="text">
                                </div>
                                <div id="message-submit-1">
                                <button type="submit"><i class="fa fa-search"></i></button>
                                <!-- Submit Button -->	
                                </div>
                                </form>                        
                            </div>
    
                        
                            <header class="page-header">
                                <h1 class="page-title"><span><?php printf( esc_html__( 'Search Results for: %s', 'ievent' ), '<span>' . get_search_query() . '</span>' ); ?></span></h1>
                            </header><!-- .page-header -->
                            
                            
                            
                            
                            <?php /* Start the Loop */ ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php
                                /**
                                 * Run the loop for the search to output the results.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-search.php and that will be used instead.
                                 */
                                get_template_part( 'template-parts/content', 'search' );
                                ?>
                            <?php endwhile; ?>
                            <div class="jx-ievent-pagination">
                            <?php the_posts_pagination(); ?>
                            </div>
                        <?php else : ?>            
                            <?php get_template_part( 'template-parts/content', 'none' ); ?>
                        <?php endif; ?>
                        
                    </div>
                    <!-- EOF Body Content -->
                    
                    <div id="sidebar" class="four columns right jx-ievent-padding omega">
                        <?php dynamic_sidebar( 'general-sidebar' ); ?>
                    </div>
                    <!-- EOF sidebar-->
                </div>
                <!-- EOF container -->
        </div><!-- #primary -->    
    </div>

<?php get_footer(); ?>

