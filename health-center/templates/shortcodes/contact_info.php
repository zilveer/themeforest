
<div class="contact_info_wrap">
	<?php if(!empty($name)):?>
		<p><?php echo do_shortcode('[icon name="user" color="'.$color.'"]'.$name)?></p>
	<?php endif ?>
	
	<?php if(!empty($phone)):?>
		<p><?php echo do_shortcode('[icon name="theme-phone" color="'.$color.'"]'.$phone)?></p>
	<?php endif ?>
	
	<?php if(!empty($cellphone)):?>
		<p><?php echo do_shortcode('[icon name="theme-cellphone" color="'.$color.'"]'.$cellphone)?></p>
	<?php endif ?>
	
	<?php if(!empty($email)):?>
		<p><a href="mailto:<?php echo $email?>" ><?php echo do_shortcode('[icon name="theme-mail" color="'.$color.'"]'.$email)?></a></p>
	<?php endif ?>
	
	<?php if(!empty($address)):?>
		<p><span class="contact_address"><?php echo do_shortcode('[icon name="theme-map" color="'.$color.'"]'.$address)?></span></p>
	<?php endif ?>
	
</div>
