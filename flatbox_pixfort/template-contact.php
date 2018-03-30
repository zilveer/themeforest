<?php
/**
 *	Template Name: Contact Form
 *
 * The template for displaying contact form and Google Maps Image
 */

get_header();
the_post();
$subtitle = rwmb_meta("subtitle");
$header_image = rwmb_meta('header_image',array('type' => 'file' ));
$header_bg_color = rwmb_meta('header_bg_color');

?>
</section>
	<?php 
if ( $header_image && count($header_image)>0 ) :
				foreach ( $header_image as $himggg ) :
			  	if (empty($himggg)) break; 
			  	if ( $header_bg_color ) : ?>
					<div class="flat_pagetop" style="color:<?php echo $header_bg_color; ?> !important;background:url(<?php echo $himggg['url'];?>);">
				<?php else : ?>
					<div class="flat_pagetop" style="background:url(<?php echo $himggg['url']; ?>);">
				<?php endif; ?>
<?php break; endforeach;

else :
 ?>
	<div class="flat_pagetop">
<?php endif; ?>
		<section id="content" class="container">

		<div class="grid12 col">
<?php if (!empty($subtitle)) : ?>
			<h1 class="page-title left"><?php the_title(); ?></h1>
			<div class="subtitle">
				<p class="small gray"><?php echo $subtitle; ?></p>
			</div>
			<div class="clear"></div>
<?php else : ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
<?php endif; ?>
		</div>

</section>
	</div>
<?php if (!empty($smof_data['contact_gmap_embed'])) : ?>
	<div class="gmap-container"><div class="video-wrapper"><?php echo $smof_data['contact_gmap_embed']; ?></div></div>
<?php endif; ?>	
		<section id="content" class="container">
			
<!-- 			
<?php if (!empty($smof_data['contact_gmap_embed'])) : ?>
		<div class="grid12 col">
			<div class="gmap">


				
				<p></p>
			</div>
		</div>
<?php endif; ?>
  -->
  	<?php if (!empty($smof_data['contact_headline'])) : ?>
	</section>
			<div class="flatintro flatcontact">
				<section id="content" class="container">
					<p class="page-title-contact fadeitin"><?php echo $smof_data['contact_headline']; ?></p>
					<p></p>
					<p class="page-title2 contact_img fadeitin"><img src="<?php echo  get_template_directory_uri(); ?>/img/half2.png" alt="img02"></p>
				</section>
			</div>
	<section id="content" class="container contact_area">
	<?php endif; ?>		
		<p></p>
<?php if (!empty($smof_data['contact_email'])) : ?>
		<div class="grid8 col fadeitin">
			<!-- <p class="small_text">Perfection is achieved not when there is nothing more to add, but when there is nothing left to take Lorem ipsum dolor sit amet, consectetuer adipiscing elit.Perfection is achieved not when there is nothing more to add, but when there is nothing left to take Lorem ipsum dolor sit amet, consectetuer adipiscing elit.Perfection is achieved not when there is nothing more to add, but when there is nothing left to take Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p> -->
			<div class="message" style="display:none"><div id="contact_alert" class="call-to-action clearfix"></div></div>
			<h3 class="bold_title"><?php _e('Send a message', 'flatbox'); ?></h3>
			<p></p>
			<form id="contact_form" action="<?php echo get_template_directory_uri(); ?>/sendmail.php">
				<div class="grid4 col alpha">
					<label for="name"><?php _e('Name:', 'flatbox'); ?></label>
					<input type="text" name="name" id="name" class="full-width biginput" />
				</div>
				<div class="grid4 col omega">
					<label for="email"><?php _e('Email:', 'flatbox'); ?></label>
					<input type="email" name="email" id="email" class="full-width biginput" />
				</div>
				<label for="message"><?php _e('Message:', 'flatbox'); ?></label>
				<textarea name="message" id="message" cols="30" rows="10" class="full-width"></textarea>
				<input type="submit" value="<?php _e('Send it right away', 'flatbox'); ?>"<?php echo $smof_data['css3_animation_attribs']; ?> />
			</form>
		</div>
		<div class="grid4 col fadeitin">
			<div class="contaxt_box">
			<h3 class="bold_title"><?php _e('Additional Info', 'flatbox'); ?></h3>
			<p></p>
			<div class="small_text2">
			<?php if (!empty($smof_data['contact_home'])) : ?>
				<p class="contact_info"><span class="icon_home"></span><?php echo $smof_data['contact_home']; ?></p>
			<?php endif; ?>
			<?php if (!empty($smof_data['contact_location'])) : ?>
				<p class="contact_info"><span class="icon_location"></span><?php echo $smof_data['contact_location']; ?></p>
			<?php endif; ?>
			<?php if (!empty($smof_data['contact_info_email'])) : ?>
				<p class="contact_info"><span class="icon_email"></span><?php echo $smof_data['contact_info_email']; ?></p>
			<?php endif; ?>
			<?php if (!empty($smof_data['contact_mobile'])) : ?>
				<p class="contact_info"><span class="icon_phone"></span><?php echo $smof_data['contact_mobile']; ?></p>
			<?php endif; ?>
			<?php if (!empty($smof_data['contact_phone'])) : ?>
				<p class="contact_info"><span class="icon_telephone"></span><?php echo $smof_data['contact_phone']; ?></p>
			<?php endif; ?>
			<?php if (!empty($smof_data['contact_fax'])) : ?>
				<p class="contact_info"><span class="icon_document"></span><?php echo $smof_data['contact_fax']; ?></p>
			<?php endif; ?>
			
			<p class="small_text"><?php echo do_shortcode($smof_data['contact_additional_info']); ?></p>
			</div>
			
		<p></p>	
		<div class+"clearfix"></div>
		</div>
		</div>








<?php if (!empty($smof_data['contact_twitter'])) : ?>

		</section>
			<div class="flattwitter">

				<input type="hidden" id="max" value="500" />
				
				<img class="hval" id="firast" twitterids="<?php echo $smof_data['contact_twitter_id']; ?>" alt="tval" />
				

				<img class="back_quote_img fadeitin" src="<?php echo get_template_directory_uri(); ?>/images/people-80.png" alt="quote_back" />
				<section id="content" class="container">

					<div class="twittersign"><img src="<?php echo get_template_directory_uri(); ?>/images/twitters2.png" alt=""></div>
					<div id="ftwitter"></div>

					 <div class="clearfix"></div>

				</section>
			</div>
				<section id="content" class="container">


<?php endif; ?>








<?php else: ?>
		<div class="grid12 col">
			<p class="alert notice"><?php _e('Please set the email address in the Theme Options in order to make the contact form usable.', 'flatbox') ?></p>
		</div>
<?php endif; ?>

<?php get_footer(); ?>