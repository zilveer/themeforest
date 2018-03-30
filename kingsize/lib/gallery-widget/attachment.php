<?php
/**
 * @KingSize 2011 - This is the page.php
 *
 * @KingSize Template by Denoizzed and Our Web Media
 * Developed by: Our Web Media 2011
 * Developer URL: http://themeforest.net/user/OurWebMedia
 * Original design by: Denoizzed 2010
 * Author URL: http://themeforest.net/user/Denoizzed
 **/

get_header(); ?>

	<!-- Main wrap -->
		<div id="main_wrap">

		<!-- Main -->
   			<div id="main">

		<div id="content" class="content_full_width">		
	
		
			<?php
			/* Run the loop to output the attachment.
			 * If you want to overload this in a child theme then include a file
			 * called loop-attachment.php and that will be used instead.
			 */
			get_template_part( 'loop', 'attachment' );
			?>

	</div> 

<?php get_footer(); ?>
