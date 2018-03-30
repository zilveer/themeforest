<?php
/*
Template Name: Background Slideshow Homepage
*/
?>

<?php get_header(); ?>
<!-- Main Content Starts HERE -->
<div class="content-container">
<?php
global $smof_data;
$dreamer_parallax_homepage_layout = $smof_data['parallax_homepage_layout']['enabled'];
if ($dreamer_parallax_homepage_layout):
	foreach ($dreamer_parallax_homepage_layout as $key=>$value) {
		switch($key) {
			case 'block_parallax_1':
			?>
			<?php get_template_part( 'includes/parallax/parallax-one' ); ?>
			<?php
			break;
			case 'block_parallax_2':
			?>
			<?php get_template_part( 'includes/parallax/parallax-two' ); ?>
			<?php
			break;
			case 'block_parallax_3':
			?>
			<?php get_template_part( 'includes/parallax/parallax-three' ); ?>
			<?php
			break;
			case 'block_parallax_4':
			?>
			<?php get_template_part( 'includes/parallax/parallax-four' ); ?>
			<?php
			break;
			case 'block_parallax_5':
			?>
			<?php get_template_part( 'includes/parallax/parallax-five' ); ?>
			<?php
			break;
			case 'block_parallax_6':
			?>
			<?php get_template_part( 'includes/parallax/parallax-six' ); ?>
			<?php
			break;
			case 'block_parallax_7':
			?>
			<?php get_template_part( 'includes/parallax/parallax-seven' ); ?>
			<?php
			break;
			case 'block_parallax_8':
			?>
			<?php get_template_part( 'includes/parallax/parallax-eight' ); ?>
			<?php
			break;
			case 'block_parallax_9':
			?>
			<?php get_template_part( 'includes/parallax/parallax-nine' ); ?>
			<?php
			break;
			case 'block_parallax_10':
			?>
			<?php get_template_part( 'includes/parallax/parallax-ten' ); ?>
			<?php
			break;
			case 'block_team':
			?>
			<?php get_template_part( 'includes/pages/team' ); ?>
			<?php
			break;
			case 'block_about_us':
			?>
			<?php get_template_part( 'includes/pages/about-us' ); ?>
			<?php
			break;
			case 'block_testimonials':
			?>
			<?php get_template_part( 'includes/pages/testimonials' ); ?>
			<?php
			break;
			case 'block_skills_numbers':
			?>
			<?php get_template_part( 'includes/pages/skills-and-numbers' ); ?>
			<?php
			break;
			case 'block_services':
			?>
			<?php get_template_part( 'includes/pages/services' ); ?>
			<?php
			break;
			case 'block_news':
			?>
			<?php get_template_part( 'includes/pages/news' ); ?>
			<?php
			break;
			case 'block_twitter':
			?>
			<?php get_template_part( 'includes/pages/twitter-feed' ); ?>
			<?php
			break;
			case 'block_portfolio':
			?>
			<?php get_template_part( 'includes/pages/portfolio' ); ?>
			<?php
			break;
			case 'block_social_media':
			?>
			<?php get_template_part( 'includes/pages/social-media' ); ?>
			<?php
			break;
			case 'block_sharing_buttons_1':
			?>
			<?php get_template_part( 'includes/pages/sharing-buttons' ); ?>
			<?php
			break;
			case 'block_sharing_buttons_2':
			?>
			<?php get_template_part( 'includes/pages/sharing-buttons-two' ); ?>
			<?php
			break;
			case 'block_sharing_buttons_3':
			?>
			<?php get_template_part( 'includes/pages/sharing-buttons-three' ); ?>
			<?php
			break;
			case 'block_sharing_buttons_4':
			?>
			<?php get_template_part( 'includes/pages/sharing-buttons-four' ); ?>
			<?php
			break;
			case 'block_sharing_buttons_5':
			?>
			<?php get_template_part( 'includes/pages/sharing-buttons-five' ); ?>
			<?php
			break;
			case 'block_contact_page':
			?>
			<?php get_template_part( 'includes/pages/contact-us' ); ?>
			<?php
			break;
			case 'block_contact_map':
			?>
			<?php get_template_part( 'includes/pages/contact-map' ); ?>
			<?php
			break;
			case 'block_contact_details':
			?>
			<?php get_template_part( 'includes/pages/contact-details' ); ?>
			<?php
			break;
			case 'block_contact_form':
			?>
			<?php get_template_part( 'includes/pages/contact-form' ); ?>
			<?php
			break;
			case 'block_contact_details_form':
			?>
			<?php get_template_part( 'includes/pages/contact-details-form' ); ?>
			<?php
			break;
			case 'block_clean_page_1':
			?>
			<?php get_template_part( 'includes/clean-page-one' ); ?>
			<?php
			break;
			case 'block_clean_page_2':
			?>
			<?php get_template_part( 'includes/clean-page-two' ); ?>
			<?php
			break;
			case 'block_clean_page_3':
			?>
			<?php get_template_part( 'includes/clean-page-three' ); ?>
			<?php
			break;
			case 'block_clean_page_4':
			?>
			<?php get_template_part( 'includes/clean-page-four' ); ?>
			<?php
			break;
			case 'block_clean_page_5':
			?>
			<?php get_template_part( 'includes/clean-page-five' ); ?>
			<?php
			break;
		}
	}
endif; ?>

<?php get_footer(); ?>