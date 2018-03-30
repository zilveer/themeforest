<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Trizzy
 */

get_header();

?>

<!-- Titlebar
================================================== -->
<?php if(ot_get_option('pp_blog_parallax') == 'on') { ?>
<section class="parallax-titlebar fullwidth-element"  data-background="<?php echo ot_get_option('pp_blog_parallax_color','#000'); ?>" data-opacity="<?php echo ot_get_option('pp_blog_parallax_opacity','0.45'); ?>" data-height="160">
    <img src="<?php echo ot_get_option('pp_blog_parallax_bg'); ?>" alt="" />
    <div class="parallax-overlay"></div>
    <div class="parallax-content">
       <h2>
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'trizzy' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'trizzy' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'trizzy' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'trizzy' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'trizzy' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'trizzy' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'trizzy' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'trizzy');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'trizzy');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'trizzy' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'trizzy' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'trizzy' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'trizzy' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'trizzy' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'trizzy' );

						else :
							_e( 'Archives', 'trizzy' );

						endif;
					?>
				</h2>

        <nav id="breadcrumbs">
            <?php if(ot_get_option('pp_breadcrumbs','on') == 'on') echo dimox_breadcrumbs(); ?>
        </nav>
    </div>
</section>
<?php } else { ?>
<section class="titlebar">
    <div class="container">
    	<div class="sixteen columns">
    		<h1>
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'trizzy' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'trizzy' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'trizzy' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'trizzy' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'trizzy' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'trizzy' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'trizzy' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'trizzy');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'trizzy');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'trizzy' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'trizzy' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'trizzy' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'trizzy' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'trizzy' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'trizzy' );

						else :
							_e( 'Archives', 'trizzy' );

						endif;
					?>
				</h1>
					<nav id="breadcrumbs">
    			<?php if(ot_get_option('pp_breadcrumbs','on') == 'on') echo dimox_breadcrumbs(); ?>
    		</nav>
    	</div>
    </div>
</section>
<?php
}
$layout = ot_get_option('pp_blog_layout');
if($layout == 'masonry') {
    get_template_part( 'masonry','loop' ) ;
} else {
    get_template_part( 'standard','loop' ) ;
}
?>
 </div>
<?php get_footer(); ?>
