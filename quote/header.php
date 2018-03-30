<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package quote
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php $preloader = get_theme_mod('show_preloader', 1); if($preloader) { ?>
    <div id="preloader"></div>
    <?php } ?>

    <?php if(get_theme_mod('show_header_search')) { ?>
    <div id="search-wrapper">
        <div class="container">
            <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" role="form">
                <div class="input-group">
                    <input type="text" value="" name="s" id="s" class="form-control" placeholder="<?php _e('Search', DISTINCTIVETHEMESTEXTDOMAIN); ?>" />
                    <span class="input-group-btn">
                        <button class="btn btn-primary btn-outlined" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                    <span class="close-trigger"><i class="fa fa-angle-up"></i></span>
                </div>
            </form>
        </div>
    </div>
    <?php } ?>

    <?php 
    $menustyle = get_theme_mod('menu_style' , 'side');
    if(empty($menustyle)) { $menustyle = 'side'; }
    if ($menustyle == 'top') { 
        include('top-nav-bar.php');
    } elseif ($menustyle == 'side') {
        include('side-nav-bar.php');
    } ?>    

	<!-- MAIN IMAGE SECTION -->
	<div id="headerwrap" class="half">
   		<div class="container">
	    	<div class="gap"></div> 
                <?php if(is_archive()) { ?>
                <div id="bannertext" class="centered fade-down section-heading">
                    <h2 class="main-title">
                        <?php if ( is_category() ) : ?>
                            <?php echo single_cat_title( '', false ); ?>
                        <?php elseif ( is_author() ) : ?>
                            <?php printf( __( '%s', 'infinity' ), get_the_author_meta( 'display_name', get_query_var( 'author' ) ) ); ?>
                        <?php elseif ( is_tag() ) : ?>
                            <?php printf( __( 'Tag Archive for %s', 'infinity' ), single_tag_title( '', false ) ); ?>
                        <?php elseif ( is_day() ) : ?>
                            <?php printf( __( 'Daily Archives: %s', 'infinity' ), get_the_date() ); ?>
                        <?php elseif ( is_month() ) : ?>
                            <?php printf( __( 'Monthly Archives: %s', 'infinity' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'infinity' ) ) ); ?>
                        <?php elseif ( is_year() ) : ?>
                            <?php printf( __( 'Yearly Archives: %s', 'infinity' ), get_the_date( _x( 'Y', 'yearly archives date format', 'infinity' ) ) ); ?>
                        <?php elseif ( is_post_type_archive('dt_portfolio_cpt') ) : ?>
                            <?php _e( 'Our Works', 'infinity' ); ?>
                        <?php else : ?>
                            <?php _e( 'Blog', 'infinity' ); ?>
                        <?php endif; ?>
                    </h2><!-- .page-title -->
                    <hr>
                    <?php
                    $description = term_description();
                    if ( is_author() )
                        $description = get_the_author_meta( 'description' );

                    if ( $description )
                        printf( '<p class="archive-meta">%s</p>', $description );
                    ?>
                </div>
                <?php } elseif(is_single() || is_page()) { ?>
                <div id="bannertext" class="centered fade-down section-heading">
                    <h2 class="main-title"><?php the_title(); ?></h2>
                    <hr>
                </div> 
                <?php } elseif(is_search()) { ?>
               <div id="bannertext" class="centered fade-down section-heading">
                    <h2 class="main-title">
                    <?php global $wp_query;
                    $num = $wp_query->found_posts;
                    printf( '%1$s "%2$s"', $num . __( ' search results for', 'infinity'), get_search_query() ); ?></h2>
                </div> 
                <?php } elseif(is_404()) { ?>

                <?php } ?>
		</div><!-- /container -->
	</div><!-- /headerwrap -->

	<div id="content-wrapper">