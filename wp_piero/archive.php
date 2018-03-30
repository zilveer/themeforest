<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cshero
 */
get_header();
global $smof_data,$breadcrumb; $blog_layout = cshero_generetor_blog_layout();

$columns = $smof_data['archive_post'];
$span = 'col-lg-12 col-sm-6 col-md-6 col-xs-6';
    switch ($columns) {
        case '2':
            $span = 'col-lg-6 col-sm-6 col-md-6 col-xs-12';
            break;
        case '3':
            $span = 'col-lg-4 col-sm-4 col-md-4 col-xs-12';
            break;
        case '4':
            $span = 'col-lg-3 col-sm-3 col-md-3 col-xs-12';
            break;
        case '6':
            $span = 'col-lg-2 col-sm-2 col-md-2 col-xs-12';
            break;
        default:
            $span = 'col-lg-12 col-sm-12 col-md-12 col-xs-12';
            break;
    }
?>

	<section id="primary" class="content-area<?php if($breadcrumb == '0'){ echo ' no_breadcrumb'; }; ?><?php echo esc_attr($blog_layout->class); ?> blog-grid">
        <div class="container">
            <div class="row">
            	<?php if ($blog_layout->left_col): ?>
                	<div class="left-wrap <?php echo esc_attr($blog_layout->left_col); ?>">
                		<?php get_sidebar(); ?>
                	</div>
                <?php endif; ?>
                <div class="content-wrap <?php echo esc_attr($blog_layout->blog); ?>">

                    <main id="main" class="site-main" role="main">

                        <?php if ( have_posts() ) :?>
							<?php if($smof_data["archive_heading"]): ?>
                            <header class="page-header">
                                <h1 class="page-title">
                                    <?php
                                    if ( is_category() ) :
                                        single_cat_title();

                                    elseif ( is_tag() ) :
                                        single_tag_title();

                                    elseif ( is_author() ) :
                                        printf( __( 'Author: %s', THEMENAME ), '<span class="vcard">' . get_the_author() . '</span>' );

                                    elseif ( is_day() ) :
                                        printf( __( 'Day: %s', THEMENAME ), '<span>' . get_the_date() . '</span>' );

                                    elseif ( is_month() ) :
                                        printf( __( 'Month: %s', THEMENAME ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', THEMENAME ) ) . '</span>' );

                                    elseif ( is_year() ) :
                                        printf( __( 'Year: %s', THEMENAME ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', THEMENAME ) ) . '</span>' );

                                    elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
                                        _e( 'Asides', THEMENAME );

                                    elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
                                        _e( 'Galleries', THEMENAME);

                                    elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
                                        _e( 'Images', THEMENAME);

                                    elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
                                        _e( 'Videos', THEMENAME );

                                    elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
                                        _e( 'Quotes', THEMENAME );

                                    elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
                                        _e( 'Links', THEMENAME );

                                    elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
                                        _e( 'Statuses', THEMENAME );

                                    elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
                                        _e( 'Audios', THEMENAME );

                                    elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
                                        _e( 'Chats', THEMENAME );

                                    else :
                                        _e( 'Archives', THEMENAME );

                                    endif;
                                    ?>
                                </h1>
                                <?php
                                // Show an optional term description.
                                $term_description = term_description();
                                if ( ! empty( $term_description ) ) :
                                    printf( '<div class="taxonomy-description">%s</div>', $term_description );
                                endif;
                                ?>
                            </header><!-- .page-header -->
							<?php endif; ?>
                            <?php /* Start the Loop */ ?>
                            <?php
                            $index = 0;
                            ?>
                             <?php while ( have_posts() ) : the_post(); ?>
                            <?php
                            if($index%$columns==0){
                                ?><div class="cs-article row"><?php
                            }
                            ?>
                                <div class="<?php echo esc_attr($span);?>">

                                    <?php
                                    /* Include the Post-Format-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    if ( $columns == '1') {
                                         get_template_part( 'framework/templates/blog/vertical/blog',get_post_format());
                                    }
                                    else {
                                        get_template_part( 'framework/templates/blog/multiple-columns/blog',get_post_format());
                                    }
                                        
                                    ?>

                                </div>
                            <?php
                            $index++;
                            if($index%$columns==0){
                                ?></div><?php
                            }
                            ?>
                            <?php endwhile; ?>
                             
                            <?php cshero_paging_nav(); ?>

                        <?php else : ?>

                            <?php get_template_part( 'framework/templates/blog/blog', 'none' ); ?>

                        <?php endif; ?>

                    </main><!-- #main -->

                </div>
                <?php if ($blog_layout->right_col): ?>
                	<div class="right-wrap <?php echo esc_attr($blog_layout->right_col); ?>">
                		<?php get_sidebar(); ?>
                	</div>
                <?php endif; ?>
            </div>
        </div>

	</section><!-- #primary -->
<?php get_footer(); ?>
