<?php
	//font lists
	global $selected_google_fonts, $all_google_fonts;
	$all = json_decode($all_google_fonts, true);
	$selected = array();
	foreach($selected_google_fonts as $sf)
	{
		$selected[] = $sf['name'];
	}
	
	//custom added fonts
	$extra_fonts = get_option('plsh_extra_google_fonts', array());
?>
<div class="section-item clearfix google-fonts">
	
	<div class="all-fonts">
		<h3><?php _e('All Google fonts', 'polaris'); ?></h3>
		
		<div class="font-list">
			<?php
				foreach($all as $font)
				{
					if(!in_array($font, $selected) && !in_array($font, $extra_fonts))
					{
						echo '<div class="font-item extra-font"><span>' . esc_html($font) . '</span><a href="#" class="move-font"><i class="fa fa-arrow-right"></i><i class="fa fa-times"></i></a></div>';
					}
				}
			?>
		</div>
	</div>
	
	<div class="active-fonts">
		<h3><?php _e('Selected', 'polaris'); ?></h3>
		<div class="font-list">
			<?php 
				if(!empty($extra_fonts))
				{
					foreach($extra_fonts as $ef)
					{
						echo '<div class="font-item extra-font"><span>' . esc_html($ef) . '</span><a href="#" class="move-font"><i class="fa fa-arrow-right"></i><i class="fa fa-times"></i></a></div>';
					}
				}
			?>
		</div>
	</div>
	
	<div class="default-fonts">
		<h3><?php _e('Default', 'polaris'); ?></h3>
		
		<div class="font-list">
			<?php 

				foreach($selected_google_fonts as $selected)
				{
					echo '<div class="font-item"">';
					echo '<span>' . esc_html($selected['name']) . '</span>';
					echo '</div>';
				}

			?>
		</div>
	</div>
	
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
		
		//remove
		jQuery('.font-item .move-font').click(function(){
			
			if(jQuery(this).parents('.all-fonts').length > 0)
			{
				
				jQuery(this).parents('.font-item').detach().prependTo('.active-fonts .font-list');
			}
			else
			{
				jQuery(this).parents('.font-item').detach().prependTo('.all-fonts .font-list');
			}
			
			var keys = '';
			jQuery('.active-fonts .font-list .font-item').each(function(){
                keys += ',' + jQuery(this).find('span').html();
            });
			keys = keys.substring(1);
			
			var result = 'fonts=' + keys;
            var admin_ajax = '<?php echo site_url() .'/wp-admin/admin-ajax.php'; ?>';
            var nonce = '<?php echo wp_create_nonce('plsh_extra_google_fonts') ?>';
            var data = { action: 'plsh_extra_google_fonts', _ajax_nonce: nonce, data: result};

            jQuery.post(admin_ajax,data,function(msg){				
			}, 'json');
			
			return false;
		});
		
	});
</script>