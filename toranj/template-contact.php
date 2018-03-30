<?php
/**
 *  Template Name: Contact Page
 * 
 * @package Toranj
 * @author owwwlab
 */

?>

<?php get_header(); ?>
<!-- Page main wrapper -->
<div id="main-content" class="abs dark-template">
	<div class="page-wrapper">
		
		<!-- Sidebar -->
		<div class="page-side">
			<div class="inner-wrapper vcenter-wrapper">
				<div class="side-content vcenter">
					<h1 class="title">
						<?php the_title(); ?>
					</h1>

					<div>
					<?php while( have_posts() ) : the_post(); ?>
						
						<?php the_content(); ?>
					
					<?php endwhile; ?>
					</div>
					

					<div class="contact-detail">
						<h5 class="bordered-fine"><?php _e('Location','toranj'); ?></h5>
						<?php echo ot_get_option('contact_location','input your contact location at admin > appearance > theme options'); ?>
					</div>
						
					<div class="contact-detail">
						<h5 class="bordered-fine"><?php _e('Contact','toranj'); ?></h5>
						<ul class="list-iconed">
							<?php
							$contacts = ot_get_option('contact_contact','');
							if (isset($contacts[0])){
								foreach (ot_get_option('contact_contact') as $contacts) {
									echo '<li><i class="fa '.$contacts['icon'].'"></i>'.$contacts['contact'].'</li>';
								}
							}
							?>
						</ul>
					</div>
					
					<?php 
					$socials = ot_get_option('social_icons');
					if (isset($socials[0])){
					?>
					<div class="contact-detail">
						<h5 class="bordered-fine"><?php _e('Socials','toranj'); ?></h5>
						<ul class="social-icons">
							<?php toranj_social_icons();?>
						</ul>
					</div>
					<?php
					}
					?>
					
				</div>
			</div>
		</div>
		<!-- Sidebar -->

		<!-- Main Content -->
		<div class="page-main">
			<div id="gmap" class="gmap-full" data-address="<?php echo ot_get_option('contact_address','Footscray VIC 3011 Australia') ?>"></div>
		</div>
		<!-- /Main Content -->

	</div>
</div>
<!-- /Page main wrapper -->

<?php get_footer(); ?>