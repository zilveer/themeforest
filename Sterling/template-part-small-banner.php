<?php
global $ttso, $post;

// Breadcrumbs.
$breadcrumbs            = esc_attr( $ttso->st_breadcrumbs );

// Searchbar.
$global_searchbar       = esc_attr( $ttso->st_global_searchbar );
$blog_searchbar         = esc_attr( $ttso->st_blog_searchbar );
$results_searchbar      = esc_attr( $ttso->st_results_searchbar );
$error_searchbar        = esc_attr( $ttso->st_error_searchbar );

// Banner title.
$blog_title             = esc_html( stripslashes( $ttso->st_blogtitle ) );
$results_title          = esc_html( stripslashes( $ttso->st_results_title ) );
$error_title            = esc_html( stripslashes( $ttso->st_404title ) );

// Banner description.
$blog_description       = esc_textarea( stripslashes( $ttso->st_blogdescription ) );
$results_description    = esc_textarea( stripslashes( $ttso->st_results_description ) );
$error_description      = esc_textarea( stripslashes( $ttso->st_404description ) );

// Per-page settings.
$banner_title           = get_post_meta( $post->ID, 'bannertitle', true );
$banner_search_bar      = get_post_meta( $post->ID, 'banner_search', true );
$banner_description     = get_post_meta( $post->ID, 'banner_description', true );

if ( is_home() || is_single() || is_archive() ) : // We are on an archive page. ?>
    <div class="center-wrap <?php if ( 'true' !== $breadcrumbs ) echo 'banner-no-crumbs'; ?>">
        <?php if(is_category()): ?>
            <p class="page-banner-heading"><?php single_cat_title(); ?></p>
        <?php else: ?>
            <p class="page-banner-heading"><?php echo esc_attr( $blog_title ); ?></p>
        <?php endif; ?>

        <?php if ( 'true' == $blog_searchbar ) { ?>
            <div id="banner-search">
                <?php get_search_form(); ?>
            </div><!-- end #banner-search -->
        <?php } else if ( '' != $blog_description ) {
            echo '<p class="page-banner-description">' . esc_attr( $blog_description ) . '</p>';
        } ?>

        <?php if ( 'true' == $breadcrumbs ) : ?>
            <div class="breadcrumbs"><?php $bc = new simple_breadcrumb; ?></div><!-- end .breadcrumbs -->
        <?php endif; ?>
    </div><!-- end .center-wrap -->
    <div class="shadow top"></div>
    <div class="shadow bottom"></div>
    <div class="tt-overlay"></div>
<?php elseif ( is_404() ) : // We are on a 404 error page. ?>
    <div class="center-wrap <?php if ( 'true' !== $breadcrumbs ) echo 'banner-no-crumbs'; ?>">
        <p class="page-banner-heading"><?php echo esc_attr( $error_title ); ?></p>

        <?php if ( 'true' == $error_searchbar ) { ?>
            <div id="banner-search">
                <?php get_search_form(); ?>
            </div><!-- end #banner-search -->
        <?php } ?>

        <?php if ( 'false' == $error_searchbar  && '' != $error_description ) : ?>
            <p class="page-banner-description" id="banner-description-<?php the_ID(); ?>"><?php echo esc_attr( $error_description ); ?></p>
        <?php endif; ?>

        <?php if ( 'true' == $breadcrumbs ) : ?>
            <div class="breadcrumbs"><?php $bc = new simple_breadcrumb; ?></div><!-- end .breadcrumbs -->
        <?php endif; ?>
    </div><!-- end .center-wrap -->
    <div class="shadow top"></div>
    <div class="shadow bottom"></div>
    <div class="tt-overlay"></div>
<?php elseif ( is_search() ) : // We are on a search page. ?>
    <div class="center-wrap <?php if ( 'true' !== $breadcrumbs ) echo 'banner-no-crumbs'; ?>">
        <p class="page-banner-heading"><?php printf( __( 'Search Results for "%s"', 'tt_theme_framework' ), get_search_query() ); ?></p>

        <?php if ( 'true' == $error_searchbar ) { ?>
            <div id="banner-search">
                <?php get_search_form(); ?>
            </div><!-- end #banner-search -->
        <?php } ?>

        <?php if ( 'false' == $results_searchbar && '' != $results_description ) : ?>
            <p class="page-banner-description" id="banner-description-<?php the_ID(); ?>"><?php echo esc_attr( $results_description ); ?></p>
        <?php endif; ?>

        <?php if ( 'true' == $breadcrumbs ) : ?>
            <div class="breadcrumbs"><?php $bc = new simple_breadcrumb; ?></div><!-- end .breadcrumbs -->
        <?php endif; ?>
    </div><!-- end .center-wrap -->
    <div class="shadow top"></div>
    <div class="shadow bottom"></div>
    <div class="tt-overlay"></div>
<?php else : ?>
    <div class="center-wrap <?php if ( 'true' !== $breadcrumbs ) echo 'banner-no-crumbs'; ?>">
        <?php if ( '' != $banner_title ) : ?>
            <p class="page-banner-heading"><?php echo esc_attr( $banner_title ); ?></p>
        <?php else : ?>
            <p class="page-banner-heading"><?php echo esc_html( $post->post_title ); ?></p>
        <?php endif; ?>

        <?php if ( 'yes' == $banner_search_bar && 'true' == $global_searchbar ) { ?>
            <div id="banner-search">
                <?php get_search_form(); ?>
            </div><!-- end #banner-search -->
        <?php } ?>

        <?php if ( 'no' == $banner_search_bar && '' != $banner_description ) : ?>
            <p class="page-banner-description" id="banner-description-<?php the_ID(); ?>"><?php echo esc_attr( $banner_description ); ?></p>
        <?php endif; ?>

        <?php if ( 'true' == $breadcrumbs ) : ?>
            <div class="breadcrumbs"><?php $bc = new simple_breadcrumb; ?></div><!-- end .breadcrumbs -->
        <?php endif; ?>
    </div><!-- end .center-wrap -->
    <div class="shadow top"></div>
    <div class="shadow bottom"></div>
    <div class="tt-overlay"></div>
<?php endif; ?>