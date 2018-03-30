<?php
/*
Template Name: Contact
*/
?>
<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/template-contact.php
 * @file	 	1.0
 */
?>
<?php get_header(); ?>
			
	<div id="contact_panel">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

				<header>
					
					<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
					<div class="clear"></div>
					<?php if(get_post_meta($post->ID,"page_subtitle",true)!="") { ?>
						<h4 class="subheader"><?php echo get_post_meta($post->ID,"page_subtitle",true); ?></h4>
					<?php } ?>
				
				</header> <!-- end article= header -->
				
				<section class="post_content clearfix">

					<div id="contactMap"></div>

				</section>	
												
				<footer>
					<div id="contactBox">
						<div class="icon-placeholder text-center"><em class="icon-mail"></em></div>
					
						<div class="row">
						
							<div id="contact_details" class="six columns">

								<?php global $data, $prefix; ?>
							
								<?php	
												
									$phone = $data[$prefix."contact_info_phone"];
									$email = $data[$prefix."contact_info_email"];
									$adress = $data[$prefix."contact_info_adress"];
									
									if($phone!="" || $email!="" || $adress!="") {
								?>
									<dl class="contact_info">
										<?php
											if($phone!="") {
												echo '<dt><em class="icon-phone"></em></dt>';
												echo '<dd>'.$phone.'</dd>';
											}
											
											if($email!="") {
												echo '<dt><em class="icon-mail"></em></dt>';
												echo '<dd>'.$email.'</dd>';
											}
											
											if($adress!="") {
												echo '<dt><em class="icon-home"></em></dt>';
												echo '<dd><adress>'.nl2br($adress).'</adress></dd>';
											}
										?>
									</dl>
								<?php
									}
								?>
								
							</div>
						
							<div class="contact_content six columns">
										
								<?php the_content(); ?>					
							
							</div>
							
						</div>
					
					</div>
				
				</footer> <!-- end article footer -->
			
			</article> <!-- end article -->
		
		<?php endwhile; ?>	
		
		<?php else : ?>
	
			<?php article_not_found(); ?>
		
		<?php endif; ?>
	
	</div> <!-- end #contact_panel -->

<?php get_footer(); ?>