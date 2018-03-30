<?php 
	$upload_dir = wp_upload_dir();
	global $wd_custom_size;
?>
    <div id="tab-general" class="general-tab">
		<form name="config-theme" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data" id="config-theme">
		<div class="tab-title">
			<h2><span><?php _e('General','wpdance'); ?></span></h2>
		</div>
        <div class="tab-content">
			
			<div class="images area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Images','wpdance'); ?></h3>
						<?php $this->showTooltip(__('Images','wpdance'),__('Upload logo, tagline and favor icon image for your site','wpdance')); ?>
						<div class="area-content">
							<ul style="">
							
								<li class="text-logo first"><span class="label"><?php _e('Text Logo','wpdance'); ?>:</span>
									<div class="bg-input">
										<div class="bg-input-inner">
											<input type="text" name="logo_text" value="<?php echo stripslashes(esc_attr(get_option('text_logo','')));?>"/>
										</div>
									</div>
								</li>
								
								<li>	
								
									<?php 
										$logo_src = get_option(THEME_SLUG.'logo','');
										if( strlen(trim($logo_src)) <= 0 ){
											$logo_src = get_template_directory_uri().'/images/no-logo.png';
											$value_logo_src = '';
										}else{
											$logo_src = esc_url($logo_src);
											$value_logo_src = $logo_src;
										}
									?>
									<span class="label"><?php _e('Logo image','wpdance')?></span>
									<div style="padding-left: 100px;width: 434px;">
										<input name="wd_custom_logo" type="hidden" class="custom_upload_image" value="<?php echo $value_logo_src; ?>" />
										<img style="padding-bottom:5px;" src="<?php echo $logo_src; ?>" class="custom_preview_image" /><br />
										<input class="custom_upload_image_button button" type="button" value="Choose Image" />
										<small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small>
										<br clear="all" />
									</div>									
								</li>
								
								
								<li class="last">
									<?php 
										$icon_src = (get_option(THEME_SLUG.'icon',''));
										if( strlen(trim($icon_src)) <= 0 ){
											$icon_src = get_template_directory_uri().'/images/no-logo.png';
											$value_icon_src = '';
										}else{
											$icon_src = esc_url($icon_src);
											$value_icon_src = $icon_src;
										}
									?>									
									<span class="label"><?php _e('Favor icon image','wpdance')?></span>
									<div style="padding-left: 100px;width: 434px;">
										<input name="wd_custom_iconlogo" type="hidden" class="custom_upload_image" value="<?php echo $value_icon_src; ?>" />
										<img style="padding-bottom:5px;" src="<?php echo $icon_src; ?>" class="custom_preview_image" /><br />
										<input class="custom_upload_image_button button" type="button" value="Choose Image" />
										<small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small>
										<br clear="all" />
										<span class="description">Accept ICO files</span>
									</div>					
								</li>
							</ul>
						</div><!-- .area-content -->
					</div>
				</div>
			</div><!-- .images -->
	
			<div class="images area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e("Custom Image Size",'wpdance'); ?></h3>
						<?php $this->showTooltip(__("Custom Image Size",'wpdance'),__('Change Your Custom Image Size.The Slider Item use this as params.After change image size,you have to regen thumbnail by going to "Tool => Regen. Thumbnails"','wpdance')); ?>
						<div class="area-content">
							<ul>
								<li class="custom-size">
									<p>Custom Size 1</p>
									<label>Width : </label>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="custom-width-1" value="<?php echo absint($wd_custom_size[0][0]);?>"/></div></div>
									<label>Height :</label>
									<div class="bg-input"><div class="bg-input-inner"> <input type="text" name="custom-height-1" value="<?php echo absint($wd_custom_size[0][1]);?>"/></div></div>
									</p>
								</li>
								<li class="custom-size">
									<p>Custom Size 2</p>
									<label>Width :</label><div class="bg-input"><div class="bg-input-inner"><input type="text" name="custom-width-2" value="<?php echo absint($wd_custom_size[1][0]);?>"/></div></div>
									<label>Height : </label>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="custom-height-2" value="<?php echo absint($wd_custom_size[1][1]);?>"/></div></div>
								</p>
								</li>
								<li class="custom-size">
									<p> Custom Size 3 </p>
									<label>Width : </label><div class="bg-input"><div class="bg-input-inner"><input type="text" name="custom-width-3" value="<?php echo absint($wd_custom_size[2][0]);?>"/></div></div>
									<label>Height : </label><div class="bg-input"><div class="bg-input-inner"><input type="text" name="custom-height-3" value="<?php echo absint($wd_custom_size[2][1]);?>"/></div></div>
								</p>
								</li>
							</ul>
						</div><!-- .area-content -->	
						</div><!-- .area-content -->
				</div>
			</div><!-- Sidebar Contact Content -->			
		
			<div class="social-embbed area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e("Sidebar Contact Content",'wpdance'); ?></h3>
						<?php $this->showTooltip(__("Sidebar Contact Content",'wpdance'),__('Sidebar Contact Content,parse your contact form 7 shortcode here.If you dont have one.Install pluggin Contact Form 7.Find Contact Menu on the left and create your own form','wpdance')); ?>
						<div class="area-content">
							<textarea id="_contact_content" name="contact_content" class="contact_content full-width"><?php echo stripslashes(esc_textarea(htmlspecialchars_decode(get_option(THEME_SLUG.'contact_content',''))));?></textarea>
						</div><!-- .area-content -->	
						</div><!-- .area-content -->
				</div>
			</div><!-- Sidebar Contact Content -->		
			
			
			<div class="social-embbed area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Social Links','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Social Links",'wpdance'),__('Config social links as facebook, twitter, vimeo, flickr','wpdance')); ?>
						<div class="area-content">
							<ul class="social-list">
								<li class="first">
									<span class="label"><?php _e('Facebook link','wpdance')?>:</span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="facebok_link" value="<?php echo get_option(THEME_SLUG.'facebok_link')?>"/></div></div>
								</li>
								<li>
									<span class="label"><?php _e('Twitter link','wpdance')?>:</span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="twitter_link" value="<?php echo get_option(THEME_SLUG.'twitter_link')?>"/></div></div>
								</li>
								<li>
									<span class="label"><?php _e('Rss link','wpdance')?>:</span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="rss_link" value="<?php echo get_option(THEME_SLUG.'rss_link')?>"/></div></div>
								</li>
								<li>
									<span class="label"><?php _e('Pinterest link','wpdance')?>:</span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="pinterest_link" value="<?php echo get_option(THEME_SLUG.'pinterest_link')?>"/></div></div>
								</li>
								<li>
									<span class="label"><?php _e('Google link','wpdance')?>:</span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="google_link" value="<?php echo get_option(THEME_SLUG.'google_link')?>"/></div></div>
								</li>
							</ul> 
						</div><!-- .area-content -->
					</div>	
				</div>	
			</div><!-- .social-embbed -->
			
			<div class="social-embbed area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Payment Links','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Payment Links",'wpdance'),__('Config Payment Link','wpdance')); ?>
						<div class="area-content">
							<ul class="social-list">
								<li class="first">
									<span class="label"><?php _e('Visa link','wpdance')?>:</span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="visa_link" value="<?php echo get_option(THEME_SLUG.'visa_link')?>"/></div></div>
								</li>
								<li>
									<span class="label"><?php _e('MasterCard link','wpdance')?>:</span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="mastercard_link" value="<?php echo get_option(THEME_SLUG.'mastercard_link')?>"/></div></div>
								</li>
								<li>
									<span class="label"><?php _e('AmericanExpress link','wpdance')?>:</span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="americanexpress_link" value="<?php echo get_option(THEME_SLUG.'americanexpress_link')?>"/></div></div>
								</li>
								<li>
									<span class="label"><?php _e('Paypal link','wpdance')?>:</span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="paypal_link" value="<?php echo get_option(THEME_SLUG.'paypal_link')?>"/></div></div>
								</li>
							</ul> 
						</div><!-- .area-content -->
					</div>	
				</div>	
			</div><!-- .social-embbed -->
			
			<div class="social-embbed area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e("Copyright text",'wpdance'); ?></h3>
						<?php $this->showTooltip(__("Copyright text",'wpdance'),__('Change Footer Copyright Text','wpdance')); ?>
						<div class="area-content">
							<ul class="social-list">
								<li class="last">
									<span class="label"><?php _e('Copyright text','wpdance')?>:</span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="copyright_text" value="<?php echo stripslashes(esc_textarea(get_option(THEME_SLUG.'copyright_text')));?>"/></div></div>
								</li>
							</ul>
						</div><!-- .area-content -->
					</div>
				</div>
			</div><!-- copy_right -->
		

			
       </div>
	   <div class="bottom-actions">
		   <div class="actions">
				<input type="hidden" name="edit-general" value="1"/>
				<input type="hidden" name="action" value="general_config"/>
				<button type="button" id="reset_general" class="button btn-reset"><span><span><?php _e('Default','wpdance'); ?></span></span></button>
				<button type="submit" class="button btn-save"><span><span><?php _e('Save Changes','wpdance'); ?></span></span></button>
		   </div>
		</div>
		 </form>
    </div>
	
