<?php
	$headerAdsEnable = get_option(THEME_SLUG.'headerAdsEnable');
	$headerAdsType = get_option(THEME_SLUG.'headerAdsType');
	$headerAdsImg = get_option(THEME_SLUG.'headerAdsImg');
	$headerAdsUrl = get_option(THEME_SLUG.'headerAdsUrl');
	$headerAdsTitle = get_option(THEME_SLUG.'headerAdsTitle');
	$headerAdsCode = get_option(THEME_SLUG.'headerAdsCode');
	
	$promotion_button_uri = get_option(THEME_SLUG.'promotion_button_uri','http://wpdance.com');
?>
<script type="text/javascript">
//<![CDATA[
jQuery(function() {

	//enable &disable header ads button
	jQuery('#header-ads-btt').click(function(){
		jQuery('#header-ads-enable').val() == 'Enable' ? jQuery('#header-ads-enable').val('Disable') : jQuery('#header-ads-enable').val('Enable');
		jQuery('#header-ads-btt').attr('class',jQuery('#header-ads-enable').val()).val(jQuery('#header-ads-enable').val());
	});
	
	//enable &disable content ads button
	jQuery('#content-ads-btt').click(function(){
		jQuery('#content-ads-enable').val() == 'Enable' ? jQuery('#content-ads-enable').val('Disable') : jQuery('#content-ads-enable').val('Enable');
		jQuery('#content-ads-btt').attr('class',jQuery('#content-ads-enable').val()).val(jQuery('#content-ads-enable').val());
	});
	
	if(jQuery( "#ads-type" ).val() == 'banner'){
		jQuery('#code').hide();
		jQuery('#banner').show();
	}
	if(jQuery( "#ads-type" ).val() == 'code'){
		jQuery('#banner').hide();
		jQuery('#code').show();
	}
	jQuery( "#ads-type" ).change(function(){
		if(jQuery( "#ads-type" ).val() == 'banner'){
			jQuery('#code').hide();
			jQuery('#banner').show();
		}
		if(jQuery( "#ads-type" ).val() == 'code'){
			jQuery('#banner').hide();
			jQuery('#code').show();
		}
	
	});
	
	if(jQuery( "#ads-content-type" ).val() == 'banner'){
		jQuery('#content_code').hide();
		jQuery('#content_banner').show();
	}
	if(jQuery( "#ads-content-type" ).val() == 'code'){
		jQuery('#content_banner').hide();
		jQuery('#content_code').show();
	}
	jQuery( "#ads-content-type" ).change(function(){
		if(jQuery( "#ads-content-type" ).val() == 'banner'){
			jQuery('#content_code').hide();
			jQuery('#content_banner').show();
		}
		if(jQuery( "#ads-content-type" ).val() == 'code'){
			jQuery('#content_banner').hide();
			jQuery('#content_code').show();
		}
	
	});
});
//]]>
</script>
<div id="tab-advertisement" class="advertisement-tab">
    <div class="tab-title">
        <h2><span><?php _e('Advertisement','wpdance'); ?></span></h2>
    </div><!-- .tab-title -->
	<div class="tab-content">
		<form name="config-advertisement" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data" id="config-advertisement">
			<div class="enable-header-ads area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Enable Header Advertisement','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Enable Header Advertisement",'wpdance'),__("Enable or disable header advertisement",'wpdance')); ?>
						<div class="area-content">
							<div class="switch_container">
								<a href="javascript:void(0)" title="Enable" class="button1 enable <?php if($headerAdsEnable == 'Enable') echo ' active';?>"><span><span><?php _e('Enable','wpdance') ?></span></span></a>
								<a href="javascript:void(0)" title="Disable" class="button1 disable <?php if($headerAdsEnable == 'Disable') echo ' active';?>"><span><span><?php _e('Disable','wpdance') ?></span></span></a>
								<input type="hidden" name="header-ads-enable" value="<?php echo $headerAdsEnable ?>"/>
							</div><!-- .switch_container -->
						</div><!-- .area-content -->
					</div>	
				</div>	
			</div><!-- .enable-header-ads -->
			
			<div class="type-header-ads area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Advertisement Type','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Advertisement Type",'wpdance'),__("Select Advertisement Type",'wpdance')); ?>
						<div class="area-content">
							<span class="label"><?php _e('Ads Type','wpdance')?></span>
							<div class="bg-input select-box">
								<div class="bg-input-inner">
									<select name="ads-type" id="ads-type">
										<option value="banner" <?php echo strcmp('banner',$headerAdsType) == 0 ? "selected" : "" ?>>Using Banner</option>
										<option value="code" <?php echo strcmp('code',$headerAdsType) == 0 ? "selected" : "" ?>>Using html code</option>
									</select>
								</div>	
							</div>	
						</div><!-- .area-content -->
					</div>	
				</div>	
			</div><!-- .type-header-ads -->
			
			<div class="url-banner-header area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Url & Banner Title','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Url & Banner Title",'wpdance'),__("Config image url, banner url and banner title for header ads",'wpdance')); ?>
						<div class="area-content">
							<ul id="banner">
								<li class="first">
									<span class="label"><?php _e('Image Url','wpdance')?>:</span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="image_url" value="<?php echo esc_url($headerAdsImg) ?>"/></div></div>
								</li>
								<li>
									<span class="label"><?php _e('Banner Url','wpdance')?>:</span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="banner_url" value="<?php echo esc_url($headerAdsUrl) ?>"/></div></div>
								</li>
								<li class="last">
									<span class="label"><?php _e('Banner title','wpdance')?>:</span>
									<div class="bg-input"><div class="bg-input-inner"><input type="text" name="banner_title" value="<?php echo stripslashes(esc_attr($headerAdsTitle));?>"/></div></div>
								</li>
							</ul> 
							
							<ul id="code">	
								<li>
									<span class="label"><?php _e('Your code','wpdance')?>:</span>
									<textarea  class = "full-width" rows = "5" cols = "68" name="ads_code" id="ads_code"><?php echo stripslashes(htmlspecialchars_decode($headerAdsCode));?></textarea>
								</li>
							</ul>
						</div><!-- .area-content -->
					</div>	
				</div>	
			</div><!-- .url-banner-header -->		
					
			
			<div class="bottom-actions">
			   <div class="actions">
					<input type="hidden" name="action" value="custom_advertisement"/>
					<button type="submit" class="button btn-save"><span><span><?php _e('Save Changes','wpdance'); ?></span></span></button>
			   </div><!-- .actions -->
			</div><!-- .bottom-actions -->	
		</form>
	</div><!-- .tab-content -->
</div><!-- #tabs-9 -->	