<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
global $post;
if( !isset( $post->ID ) || (is_shop_installed() && is_woocommerce() ) )
    { return; }

$post_id = yit_post_id();

$show_title      = is_page() ? yit_get_post_meta( $post_id, '_show-title' ) : false;
$show_breadcrumb = is_page() ? yit_get_post_meta( $post_id, '_show-breadcrumb' ) : ( bool ) yit_get_option('breadcrumb');

if( $show_title || $show_breadcrumb ) :
    $tag_title      = apply_filters( 'yit_page_meta_title_tag', 'h1' );
?>
<!-- START PAGE META -->
<div id="page-meta" class="group margin-top" itemscope itemtype="http://schema.org/WebPage">
	<div class="container">
	<div class="row">
		<div class="span12">
    <?php if ( $show_title ) : ?>
        <!-- TITLE -->
        <div class="title">
        <?php
        if ( is_category() ) :
            if( yit_get_option( 'show-title-categories' ) ) : ?>
                <<?php echo $tag_title ?>><?php echo apply_filters( 'yit_archive_category_title', sprintf( yit_get_option( 'page-categories-title' ), single_cat_title( '', false ) ) ) ?></<?php echo $tag_title ?>>
            <?php endif;

        elseif( is_archive() ) :
            if( yit_get_option( 'show-title-archives' ) ) :
                if( is_tag() ) : ?>
                    <<?php echo $tag_title ?>><?php echo apply_filters( 'yit_archive_tag_title',      sprintf( yit_get_option( 'page-archives-title' ), single_tag_title( '', false ) ) ) ?></<?php echo $tag_title ?>>

                    <?php elseif( is_day() ) : ?>
                    <<?php echo $tag_title ?>><?php echo apply_filters( 'yit_archive_day_title',      sprintf( yit_get_option( 'page-archives-title' ), get_the_time( apply_filters( 'yit_daily_archive_date_format', __( 'F jS, Y', 'yit' ) ) ) ) ) ?></<?php echo $tag_title ?>>

                    <?php elseif( is_month() ) : ?>
                    <<?php echo $tag_title ?>><?php echo apply_filters( 'yit_archive_month_title',    sprintf( yit_get_option( 'page-archives-title' ), get_the_time( apply_filters( 'yit_montly_archive_date_format', __( 'F Y', 'yit' ) ) ) ) ) ?></<?php echo $tag_title ?>>

                    <?php elseif( is_year() ) : ?>
                    <<?php echo $tag_title ?>><?php echo apply_filters( 'yit_archive_year_title',     sprintf( yit_get_option( 'page-archives-title' ), get_the_time( apply_filters( 'yit_yearly_archive_date_format', __( 'Y', 'yit' ) ) ) ) ) ?></<?php echo $tag_title ?>>

                    <?php elseif( is_author() ) : ?>
                    <<?php echo $tag_title ?>><?php echo apply_filters( 'yit_archive_author_title', __( 'Author archive', 'yit' ) ) ?></<?php echo $tag_title ?>>
                <?php
                endif;
            endif;

        elseif( is_search() ) :
            if( yit_get_option( 'show-title-searches' ) ) : ?>
                <<?php echo $tag_title ?>><?php echo apply_filters( 'yit_archive_search_title',   sprintf( yit_get_option( 'page-searches-title' ), yit_string( '<span>', get_search_query() , '</span>', false ) ) ) ?></<?php echo $tag_title ?>>
            <?php endif;


        elseif( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) : ?>
            <<?php echo $tag_title ?>><?php echo apply_filters( 'yit_archive_blog_title', __( 'Blog Archive', 'yit' ) ) ?></<?php echo $tag_title ?>>

        <?php

        else : ?>
            <<?php echo $tag_title ?>><?php echo yit_decode_title(get_the_title()) ?></<?php echo $tag_title ?>>
        <?php endif ?>
        </div>
    <?php endif; ?>

    <?php if ( $show_breadcrumb ) : ?>
        <!-- BREDCRUMB -->
        <div class="breadcrumbs">
        <?php yit_breadcrumb( apply_filters( 'yit_breadcrumb_delimiter', '|' ) ); ?>
        </div>
    <?php endif; ?>
    </div></div></div>
</div>
<!-- END PAGE META -->
<?php endif ?>