<?php
/*
Template Name: Contact
*/

get_header(); ?>
	<?php 
	$heading_text = (get_post_meta($post->ID, THEME_METABOX . "heading_text", true) == "") ? get_the_title() : get_post_meta($post->ID, THEME_METABOX . "heading_text", true);
	$heading_size = (get_post_meta($post->ID, THEME_METABOX . "heading_size", true) == "") ? "80" : get_post_meta($post->ID, THEME_METABOX . "heading_size", true);

	?>
	<!--start contentWrapper-->
	<div id="contentWrapper">
		<!--start content-->
		<div id="content">
			<!-- start Page -->
			<div id="page">
			
				<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
				<h1 class="pageHeading" style="font-size: <?php echo $heading_size; ?>px;"><?php echo $heading_text;?></h1>
				
				<?php echo the_content(); ?>

				<h2 id="sentConfirmTitle"> <?php echo of_get_option("form_title"); ?></h2>
		
				<p id="sentConfirmMessage" style="width:100%; margin:0 0 30px 0;">
					<?php echo of_get_option("form_message"); ?>
				</p>
				
				<a class="button small <?php echo of_get_option('blog_button_color'); ?>"  id="reload" href="#"><?php _e("Reload form", "alive"); ?></a>
				
				<!-- start contactForm -->
				<div id="contactForm" class="contactForm">
					<form name="themeContactForm" id="themeContactForm">
						<p class="form left" >
							<input class="field" type="text" name="name" id="name" value="<?php _e("Name", "alive"); ?>*" />
							<input class="field" type="text" name="email" id="email" value="<?php _e("Email", "alive"); ?>*" />
							<input class="field" type="text" name="subject" id="subject" value="<?php _e("Subject", "alive"); ?>" />
							
						</p>
						<p class="form" >
							<textarea  class="tarea" rows="8" name="message" id="message" cols="0"><?php _e("Message", "alive"); ?>*</textarea><br />
						</p>
						<p id="formProgress" class="formProgress alignLeft">*<?php _e("required", "alive"); ?></p>
						<input type="submit" value="<?php _e("SEND", "alive"); ?>" class="button medium <?php echo of_get_option('blog_button_color'); ?> alignRight" id="submit" />
					</form>  

				</div>             
				<!-- end contactForm -->
		
							
			<?php endwhile; endif;?>
			</div>
			<!-- end Page -->
		

	<?php get_sidebar(); ?> 
<?php get_footer(); ?>