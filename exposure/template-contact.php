<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 * Template name: Contact
 */
/**
 * Send mail script
 */
thb_system_send_mail( thb_get_option('contact_email') );

get_header();

$thb_page_id = get_the_ID();
$email = thb_get_option("contact_email");
$latlong = thb_get_option('contact_lat_long');
$zoom = thb_get_option("contact_zoom"); 

?>
<div class="wrapper">
	<?php if( thb_get_post_meta($thb_page_id, 'pageheader_disable') == 0 ) : ?>
		<header class="pageheader">
			<h1><?php the_title(); ?></h1>
		</header><!-- /.pageheader -->
	<?php endif; ?>

	<?php thb_page_before(); ?>

		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<?php if( get_the_content() != '' ) : ?>
				<div class="thb-text">
					<?php the_content(); ?>
				</div>
			<?php endif; ?>
		<?php endwhile; endif; ?>

		<?php if( !empty($latlong) ) : ?>
			<div id="contact-map">
				<?php thb_contact_map(array(
					'height' => 300
				)); ?>
			</div>
		<?php endif; ?>

		<div id="contactform">
			<?php thb_contact_form(); ?>
		</div>

	<?php thb_page_after(); ?>
</div><!-- /.wrapper -->

<?php if( function_exists('dynamic_sidebar') && is_active_sidebar(thb_get_page_sidebar()) ) : ?>
	<div class="thb-main-sidebar">
		<div class="thb-main-sidebar-wrapper">
			<?php thb_page_sidebar(); ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>