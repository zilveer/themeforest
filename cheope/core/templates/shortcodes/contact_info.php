<div class="contact-info">
	<?php if ( isset ($title) && $title != '' ) : ?> <h3><?php echo strip_tags($title) ?></h3><?php endif; ?>
	<div class="sidebar-nav">
		<ul>
			<?php if ( isset ($address) && $address != '' ) : ?> 
				<li>
					<?php if ( isset ($address_icon) && $address_icon != '' ) : 
						$address_icon = str_replace('icon-', '', $address_icon); ?>
						<i class="icon-<?php echo $address_icon ?>" style="color:#979797;font-size:20px"></i>
					<?php endif; ?>
					<?php echo $address ?>					
				</li>
			
			<?php endif; ?>
			<?php if ( isset ($phone) && $phone != '' ) : ?> 
				<li>
					<?php if ( isset ($phone_icon) && $phone_icon != '' ) :  
						$phone_icon = str_replace('icon-', '', $phone_icon); ?>
						<i class="icon-<?php echo $phone_icon ?>" style="color:#979797;font-size:20px"></i>
					<?php endif; ?>
					<?php echo $phone ?>
				</li>				
			<?php endif; ?>
			<?php if ( isset ($mobile) && $mobile != '' ) : ?>
				<li>
					<?php if ( isset ($mobile_icon) && $mobile_icon != '' ) :  
						$mobile_icon = str_replace('icon-', '', $mobile_icon); ?>
						<i class="icon-<?php echo $mobile_icon ?>" style="color:#979797;font-size:20px"></i>
					<?php endif; ?>
					<?php echo $mobile ?>
				</li>					
			<?php endif; ?>
			<?php if ( isset ($fax) && $fax != '' ) : ?> 
				<li>
					<?php if ( isset ($fax_icon) && $fax_icon != '' ) :  
						$fax_icon = str_replace('icon-', '', $fax_icon); ?>
						<i class="icon-<?php echo $fax_icon ?>" style="color:#979797;font-size:20px"></i>
					<?php endif; ?>
					<?php echo $fax ?>
				</li>
			<?php endif; ?>
			<?php if ( isset ($email) && $email != '' ) : ?> 
				<li>
					<?php if ( isset ($email_icon) && $email_icon != '' ) :  
						$email_icon = str_replace('icon-', '', $email_icon); ?>
						<i class="icon-<?php echo $email_icon ?>" style="color:#979797;font-size:20px"></i>
					<?php endif; ?>
					<?php echo $email ?>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</div>