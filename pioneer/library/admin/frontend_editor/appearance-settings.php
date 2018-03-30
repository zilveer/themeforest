<div id="appearanceselector">
	<form action="" method="post">
	
	<div class="one-half">
	<h5>Colors and backgrounds</h5>
	

					
			
			<?php
			
			
		
		$sections = array(
				
				array ("epic_page_background","#wrapper","backgroundColor","Page background"),
				array ("epic_footer_background","#footer","backgroundColor","Footer background"),
				array ("epic_link_color","#wrapper a","color","Link color"),
				array ("epic_link_color_hover","#wrapper a:hover","color","Link color on hover"),
				array ("epic_footer_link_color","#footer a","color","Link color in footer"),
				array ("epic_footer_link_color_hover","#footer a:hover","color","Link color in footer on hover"),
				array ("epic_twittermodule_background",".module-twitter > .module-content","backgroundColor","Twitter-module background"),
				
			);
			
			
			foreach ($sections as $section){
			
			
				$val = get_option($section[0]);
			
			?>
				<div class="colorselector">
				<div id="cs_<?php echo $section[0];?>" class="picker"><div></div></div>
				<input type="text" name="<?php echo $section[0];?>" id="<?php echo $section[0];?>" value="<?php echo $val ?>"/>
				<label><?php echo $section[3];?></label>
				</div>
				
				<script>
					jQuery('#cs_<?php echo $section[0];?> div').css('backgroundColor', '<?php echo $val;?>');
					jQuery('#cs_<?php echo $section[0];?> div').ColorPicker({
							color: '<?php echo $val;?>',
							onShow: function (colpkr) {
								jQuery(colpkr).fadeIn(500);
							return false;
						},
							onHide: function (colpkr) {
							jQuery(colpkr).fadeOut(500);
							return false;
						},
						onChange: function (hsb, hex, rgb) {
							jQuery('#cs_<?php echo $section[0];?> > div').css('backgroundColor', '#' + hex);
							jQuery('<?php echo $section[1];?>').css('<?php echo $section[2];?>', '#' + hex);
							jQuery('#<?php echo $section[0];?>').val('#' + hex);
						}
		
					});
			</script>
			
			
			<?php
			
			}
		
			?>
			
		<hr/>
		<h5>Site layout</h5>
		<?php $epic_site_layout = get_option('epic_site_layout');?>
		<p>
		<label><input type="radio" name="epic_site_layout" value="center" <?php if($epic_site_layout == 'center' || !$epic_site_layout){ echo 'checked="checked"';}?>> Centered</label>
		<label><input type="radio" name="epic_site_layout" value="left"   <?php if($epic_site_layout == 'left'){ echo 'checked="checked"';}?>> Left aligned</label>
		<label><input type="radio" name="epic_site_layout" value="right"  <?php if($epic_site_layout == 'right'){ echo 'checked="checked"';}?>> Right aligned</label>
		
		</p>
	
		
	</div>
	<div class="one-half last">
	<h5>Custom css</h5>
	<p><textarea name="epic_custom_css" style="min-height:140px;"><?php echo get_option('epic_custom_css');?></textarea></p>
	
	<h5>Background textures</h5>
	<p>Select the background texture you want to use on your page backgrounds. You can also upload new image for background in the theme options panel.</p>
	
	
	
<ul class="epic_admin_imagelist clearfix">

<?php 
$textures = get_backgroundtextures();

foreach ($textures as $texture) { 

	if($texture == get_option($value['epic_background_texture'])){
		$class = 'active';
	}
	else{
		$class = '';
	}


?>

<li><a href="#" title="<?php echo $texture;?>" class="<?php echo $class;?> " rel="epic_background_texture" style="background:url(<?php echo get_template_directory_uri().'/library/images/textures/'. $texture; ?>);"/></a></li>
<?php }?>
</ul>
<input type="hidden" id="epic_background_texture" name="epic_background_texture" value="<?php echo get_option('epic_background_texture'); ?>"/>
<a href="#" class="clearimage">Reset background</a>
	
	
	
	
	
	</div>
	<hr/>
		<input type="hidden" name="action" value="saved" />
	<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_appearance'); ?>
	<input type="submit" value="Save changes"/>
	<input type="reset" value="Cancel"/>

	</form>
	<script>

	// increase the default animation speed to exaggerate the effect

	jQuery(function($) {
	
	
		jQuery( "#appearanceselector" ).dialog({
			autoOpen: false,
			title:"Colors and appearance",
			show: "fade",
			hide: "fade",
			modal: false,
			width: 660,
			}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
			});
		jQuery( "#openAppearanceSelector" ).click(function() {
			jQuery( "#appearanceselector" ).dialog( "open" );
			return false;
		});
		
			});
	</script>

</div>		