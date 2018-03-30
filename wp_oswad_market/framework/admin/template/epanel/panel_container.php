<div class="ew-head">
	<img class="logo" src="<?php echo THEME_ADMIN_IMAGES;?>/logo.png"/>
</div>
<div class="bg-tabs">
	<div id="tabs">
		<?php $this->loadSidebarLeftPanel(); ?>
		<?php $this->loadContentPanel();?>
		<div class="loader" style="display:none">
			<img class="logo" src="<?php echo THEME_ADMIN_IMAGES;?>/ajax-loader.gif"/>
		</div><!-- .loader -->
		<div class="successful" style="display:none">
			<span class="message" ><?php _e('Config saved.','wpdance')?></span>
		</div><!-- .successful -->
	</div>
</div>
<script type="text/javascript">
//<![CDATA[
	jQuery('body').addClass('appearance_page_wp_admin');
	 jQuery(function() {
	jQuery( "#tabs" ).tabs({ fx: { opacity: 'toggle', duration:'slow'} }).addClass( "ui-tabs-vertical ui-helper-clearfix" );
	jQuery( "#tabs li.item-left" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
	 });
//]]>	 
</script>