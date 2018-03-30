<?php
/*

Template Name: Contact

*/

get_header();

if (have_posts()) : while ( have_posts() ) : the_post();

$show_map = of_get_option("show_map");
$latitude = of_get_option("contact_map_lat");
$longitude = of_get_option("contact_map_lon");

$page_title = get_post_meta(get_the_ID(), 'si_page_title', true);
$page_icon = get_post_meta(get_the_ID(), 'si_page_icon', true);

?>

<div id="page_<?php echo $post->post_name; ?>" class="inner">
	
	<?php if ($page_title != "yes") : ?>
	
		<h1 id="page_title">
		
			<?php if ($page_icon != "") : ?><i class="page_icon <?php echo $page_icon; ?>"></i><?php endif; ?>
			
			<?php the_title(); ?>
		
		</h1>
	
	<?php endif; ?>
	
	<div<?php if ($show_map) { ?> class="one-half"<?php } ?>>
			
		<?php the_content(); ?>
		
		<!-- BEGIN #contact_form -->
		
		<form id="contact_form" onsubmit="return validate_form()" method="post">
		
			<p>
				<label><?php _e("Name", "shorti"); ?></label>
				<input onfocus="jQuery('#name_error').fadeOut('fast');" onclick="jQuery('#name_error').fadeOut('fast');" type ="text" name="name" id="name" />
			</p>
       
			
			<p>
				<label><?php _e("Email", "shorti"); ?></label>
				<input onfocus="jQuery('#email_error').fadeOut('fast');" onclick="jQuery('#email_error').fadeOut('fast');" type="text" name="email" id="email" />
			</p>
       
			<p>
				<label><?php _e("Message", "shorti"); ?></label>
				<textarea onfocus="jQuery('#message_error').fadeOut('fast');" onclick="jQuery('#message_error').fadeOut('fast');" id="message" rows="8" cols ="20"></textarea>
			</p>
	       
	       <button type="submit" name="submit" id="submit_button" class="btn"><?php _e("Send Message", "shorti"); ?><i class="icon-envelope-alt"></i></button>
		       
		</form>
		
		<?php shorti_ajax_contact(); ?>
		
		<!-- END #contact_form -->
	
	</div>
	
	<?php if ($show_map) { ?>
	<div id="map" class="one-half column-last">
	
		<div id="map-canvas" data-zoom="10" data-cord="<?php if ($latitude != "") { echo $latitude; } else { echo "40.690371"; } ?>;<?php if ($longitude != "") { echo $longitude; } else { echo "-74.044491"; } ?>"></div> <?php /* !!! THEME OPTIONS !!!*/?>
		
		<?php shorti_map_script(); ?>
		
	</div>
	<?php } ?>

<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>