<?php /* Template Name: Contact Form */ ?>
<?php get_header(); ?>
<?php 
    $alc_options = get_option('alc_general_settings'); 
    $options = array(
        	$alc_options['alc_contact_error_message'], 
		$alc_options['alc_contact_success_message'],
		$alc_options['alc_subject'],
		$alc_options['alc_email_address']
                );
    $custom =  get_post_custom($post->ID);
    $layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
    $breadcrumbs = $alc_options['alc_show_breadcrumbs'];
    $titles = $alc_options['alc_show_page_titles'];
?>
<?php  if ($breadcrumbs || $titles):?>
<div class="row">
    <div class="large-12 columns main-content-top">
        <div class="row">
            <div class="large-6 columns">
                <?php  if ($titles):?>
                    <h2>
                        <?php 
                            $headline = get_post_meta($post->ID, "_headline", $single = false);
                            if(!empty($headline[0]) ){echo $headline[0];}
                            else{echo get_the_title();} 
			?>
                    </h2>
		<?php endif?>
            </div>        
            <div class="large-6 columns">
                <?php  if ($breadcrumbs):?>
                    <?php if(class_exists('the_breadcrumb')){ $albc = new the_breadcrumb; } ?>
		<?php endif?>
            </div>
        </div>
    </div>
</div>
<?php endif?>
<div class="shadow"></div>
<?php if (!empty($alc_options['alc_contact_address'])):?>
<script type="text/javascript">   
  jQuery(function(){
	jQuery('#map_canvas').gmap3(
	  {
		action: 'addMarker',
		address: "<?php echo htmlspecialchars($alc_options['alc_contact_address'])?>",
		map:{
		  center: true,
		  zoom: 14
		}
		
	  },
	  {action: 'setOptions', args:[{scrollwheel:true}]}
	);
	  
  });
</script> 
<?php endif?> 
<div class="row main-content">
    <div class="large-12 columns"> 
		<?php if (!empty($alc_options['alc_contact_address'])):?>
			<div id="map_canvas" class="gmap3 map_location"></div>
		<?php endif?>			      
		<div class="large-6 columns">  
			<?php if (!empty($alc_options['alc_contact_top_info'])):?>
				<?php echo do_shortcode($alc_options['alc_contact_top_info'])?>
			<?php endif?>	
			<form method="POST" class="contactForm">
				<div id="status"></div>
				<div class="contact_form">
					<div class="row">
						<div class="small-4 columns">                   
							<input type="text" placeholder="<?php _e('Name', 'Evolution')?>" name="contactname" id="contactname" />
							<?php if(isset($nameError) && $nameError != ''): ?><span class="errorarr"><?php echo $nameError;?></span><?php endif;?>
						</div>
						<div class="small-4 columns">
							<input type="text" placeholder="<?php _e('E-mail', 'Evolution')?>" name="contactemail" id="contactemail" />
							<?php if(isset($emailError) && $emailError != ''): ?><span class="errorarr"><?php echo $emailError;?></span><?php endif;?>
						</div>
						<div class="small-4 columns">
							<input type="text" placeholder="<?php _e('Website', 'Evolution')?>" name="contactwebsite" id="contactwebsite" />
						</div>
						<div class="small-12 columns">
							<textarea cols="10" rows="15" name="contactmessage" id="contactmessage"  placeholder="<?php _e('Message', 'Evolution')?>" ></textarea>
							<?php if(isset($messageError) && $messageError != ''): ?><span class="errorarr"><?php echo $messageError;?></span><?php endif;?>
						</div>
						<div class="small-4 columns">
							<input type="submit" class="button right" value="<?php _e('Send message', 'Evolution')?>" name="send" id="send" />
							<input type="hidden" name = "options" value="<?php echo implode('|', $options) ?>" />
						</div> 
					</div>
				</div>
			</form>
		</div>
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="large-6 columns">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
    </div>
</div>
<script type="text/javascript">
<!-- Contact form validation
jQuery(document).ready(function(){

  jQuery(".contactForm").validate({
	submitHandler: function() {
	
		var postvalues =  jQuery(".contactForm").serialize();
		
		jQuery.ajax
		 ({
		   type: "POST",
		  url: "<?php echo get_template_directory_uri()  ?>/contact-form.php",
		   data: postvalues,
		   success: function(response)
		   {
		 	 jQuery("#status").html(response).show('normal');
		     jQuery('#contactmessage, #contactemail, #contactname, #contactwebsite').val("");
		   }
		 });
		return false;
		
    },
	focusInvalid: true,
	focusCleanup: false,
	//errorLabelContainer: jQuery("#registerErrors"),
  	rules: 
	{
		contactname: {required: true},
		contactemail: {required: true, minlength: 6,maxlength: 50, email:true},
		contactmessage: {required: true, minlength: 6}
	},
	
	messages: 
	{
		contactname: {required: "<?php _e( 'Name is required', 'Evolution' ); ?>"},
		contactemail: {required: "<?php _e( 'E-mail is required', 'Evolution' ); ?>", email: "<?php _e( 'Please provide a valid e-mail', 'Evolution' ); ?>", minlength:"<?php _e( 'E-mail address should contain at least 6 characters', 'Evolution' ); ?>"},
		contactmessage: {required: "<?php _e( 'Message is required', 'Evolution' ); ?>"}
	},
	
	errorPlacement: function(error, element) 
	{
		error.insertBefore(element);
		jQuery('<span class="errorarr"></span>').insertBefore(element);
	},
	invalidHandler: function()
	{
		//jQuery("body").animate({ scrollTop: 0 }, "slow");
	}
	
});
});
-->
</script>


<?php get_footer(); ?>