<?php
// Template Name: Contact Page
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
<?php
//If the form is submitted
if(isset($_POST['submit'])) {
	
	$comments = $_POST['message'];

	//Check to make sure that the name field is not empty
	if(trim($_POST['contactname']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['contactname']);
	}


	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = get_post_meta($post->ID, 'contactpage_emailaddress', true); //Put your own email address here
		$body = "Name: $name \n\nEmail: $email \n\nComments:\n $comments";
		$headers = 'From: '.get_bloginfo('name').' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, get_bloginfo('name'), $body, $headers);
		$emailSent = true;
	}
}
?>

<?php while ( have_posts() ) : the_post(); ?>

		<?php
		global $wp_query;
		$thePostID = $wp_query->post->ID;
		?>
		<div id="page-title">
			<div class="width-container paged-title">
				<h1><?php the_title(); ?></h1>	
			</div>
		<div id="page-title-divider"></div>
		</div><!-- #page-title -->
		<div class="clearfix"></div>
		<?php if(has_post_thumbnail()): ?>
			<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-page-title'); ?>
			<script type='text/javascript'>
			jQuery(document).ready(function($) {  
			    $("#page-title").backstretch([
					"<?php echo $image[0]; ?>"
					<?php if( class_exists( 'kdMultipleFeaturedImages' ) ) {
						if( kd_mfi_get_featured_image_url( 'featured-image-2', 'page', 'progression-page-title', $thePostID ) != "" ) {
						    echo ',"', kd_mfi_get_featured_image_url( 'featured-image-2', 'page', 'progression-page-title', $thePostID ) , '"';
						}

						if( kd_mfi_get_featured_image_url( 'featured-image-3', 'page', 'progression-page-title', $thePostID ) != "" ) {
						    echo ',"', kd_mfi_get_featured_image_url( 'featured-image-3', 'page', 'progression-page-title', $thePostID ) , '"';
						}
					}
			 		?>
				],{
			            fade: 750,
			            duration: <?php echo of_get_option('slider_autoplay', 8000); ?>
			     });
			});
			</script>
		<?php endif; ?>
	

	<div id="main" class="site-main">
		<div class="width-container">
	
		
	<div class="grid2column">
			<?php if(get_post_meta($post->ID, 'contactpage_mapaddress', true)): ?>
				
				<script src="https://maps.google.com/maps/api/js<?php if (get_theme_mod( 'progression_studios_google_maps_api')) : ?>?key=<?php echo esc_attr(get_theme_mod('progression_studios_google_maps_api')); ?><?php endif ?>" type="text/javascript"></script>
				<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.gomap-1.3.2.min.js"></script>
				<div id="map-contact"></div>
				<script type="text/javascript"> 
				jQuery(document).ready(function($) {
				    $("#map-contact").goMap({ 
				        markers: [{  
				            address: '<?php echo get_post_meta($post->ID, 'contactpage_mapaddress', true); ?>', 
				            title: 'marker title 1' ,
							icon: '<?php echo get_template_directory_uri(); ?>/images/pin.png'
				        }],
						disableDoubleClickZoom: true,
						zoom: 12,
						maptype: 'ROADMAP'
				    }); 
				});
				</script>
			<?php endif; ?>

		<?php the_content(); ?>

	</div>

			
			
	<div class="grid2column lastcolumn">
		<?php if(get_post_meta($post->ID, 'contactpage_emailaddress', true)): ?>
			
			<h3 class="header-underline"><?php _e( 'Send us a message', 'progression' ); ?></h3>
			
		<div id="contact-wrapper">
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("#contactform").validate();
				});
			</script>
			<?php if(isset($hasError)) { //If errors are found ?>
				<p class="error"><?php _e('Please check if you have filled all the fields with valid information. Thank you.','progression'); ?></p>
			<?php } ?>

			<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
				<p class="success"><?php _e('Email Successfully Sent!','progression'); ?></p>
				<p class="success2"><?php _e('Thank you for using my contact form! I will be in touch with you soon.','progression'); ?></p>
			<?php } ?>
			<form method="post" action="<?php echo get_permalink(); ?>" id="contactform">
				<div class="contact-form-border-input">
				    <label for="name"><?php _e('Name','progression'); ?>:<span class="required">*</span></label>
					<input type="text" size="28" name="contactname" id="contactname" value="" class="required" />
				</div>
				<div class="contact-form-border-input">
					<label for="email"><?php _e('Email','progression'); ?>:<span class="required">*</span></label>
					<input type="text" size="28" name="email" id="email" value="" class="required email" />
				</div>
				<div class="contact-form-border">
					<label for="message"><?php _e('Message','progression'); ?>:</label>
					<textarea rows="10" cols="38" name="message" id="message"></textarea>
				</div>
			    <input type="submit" value="<?php _e('Send Message','progression'); ?>" name="submit" class="button" />
			</form>
		</div><!-- close #contact-wrapper -->
		<div class="clearfix"></div>
		<?php endif; ?>
		
	</div>
			
	<div class="clearfix"></div>	
	<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ), 'after' => '</div>' ) ); ?>
			

	<?php endwhile; // end of the loop. ?>
			

<?php if(of_get_option('page_comments_default', '0')): ?><?php comments_template( '', true ); ?><?php endif; ?>


<?php get_footer(); ?>