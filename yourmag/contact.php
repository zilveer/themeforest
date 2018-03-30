<?php
/*
Template Name: Contact Page
*/
?>

<?php get_header(); ?>

<div id="main_content"> 

<?php if (get_option('op_crumbs') == 'on') { ?>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
<div class="inner">
<?php } ?>
<div id="content_bread_panel">	
<div class="inner">
<?php if (function_exists('wp_breadcrumbs')) wp_breadcrumbs(); ?>
</div>
</div>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
</div>
<?php } ?>
<?php } ?>

<div class="inner">
<div id="content">
		
<div class="single_post">
	
<script type="text/javascript">
		 jQuery(document).ready(function($){
			  $('#contact').ajaxForm(function(data) {
				 if (data==1){
					 $('#success').fadeIn("slow");
					 $('#bademail').fadeOut("slow");
					 $('#badserver').fadeOut("slow");
					 $('#contact').resetForm();
					 }
				 else if (data==2){
						 $('#badserver').fadeIn("slow");
					  }
				 else if (data==3)
					{
					 $('#bademail').fadeIn("slow");
					}
					});
				 });
</script>
			
			<div id="cf_map">
			<?php $cf_map = get_option("op_cf_map"); ?>
		    <?php echo stripslashes($cf_map); ?>
			</div>
			
			<div class="clear"></div>
			
			<div id="contact_box">
			<div id="contact_text"><?php echo (get_option('op_cf_text')) ?></div>
			
			<div class="clear"></div>

			<p id="success" class="successmsg" style="display:none;"><?php echo (get_option('op_successfully_sent')) ?></p>
			<p id="bademail" class="errormsg" style="display:none;"><?php echo (get_option('op_wrong_data')) ?></p>
			<p id="badserver" class="errormsg" style="display:none;">Your email failed. Try again later.</p>
			
			<div class="clear"></div>
			
			<form id="contact" action="<?php echo get_template_directory_uri() ?>/sendmail.php" method="post">
			<label for="name"><?php echo get_option('op_your_name'); ?></label>
			<input type="text" id="nameinput" name="name" value=""/>
			<label for="email"><?php echo get_option('op_your_email'); ?></label>

			<input type="text" id="emailinput" name="email" value=""/>
			<label for="comment"><?php echo get_option('op_your_message'); ?></label>
			<textarea cols="20" rows="7" id="commentinput" name="comment"></textarea><br />
			<input type="submit" id="submitinput" name="submit" class="submit" value="<?php echo get_option('op_contact_submit'); ?>"/>
			<input type="hidden" id="receiver" name="receiver" value="<?php echo get_option('op_contact_email')?>"/>
			</form>
			</div>	
			
</div>		 

</div>

<?php get_sidebar('right'); ?>

</div>
</div>

<div class="clear"></div>
	
<?php get_footer(); ?>
