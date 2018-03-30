<?php
/**
 *
 */
class mysiteTooltip {
	
	private static $tip_id = 1;

	/**
	 *
	 */
	function _tip_id() {
	    return self::$tip_id++;
	}
	
	function tooltip( $atts = null, $content = null ) {
		
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Tooltip', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'tooltip',
				'options' => array(
					array(
						'name' => __( 'Tooltip Trigger Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the trigger text that will display with your toggle.<br /><br />The tooltip will be displayed when hovering over the trigger text.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'trigger',
						'type' => 'text',
					),
					array(
						'name' => __( 'Tooltip Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that you wish to have displayed inside the tooltip.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Width <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can manually specify the width of your tooltip here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'width',
						'type' => 'text',
					),
					array(
						'name' => __( 'Tooltip Position <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select where you would like your tooltip to appear relative to your trigger text.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'position',
						'options' => array(
							'top' => __( 'Top', MYSITE_ADMIN_TEXTDOMAIN ),
							'right' => __( 'Right', MYSITE_ADMIN_TEXTDOMAIN ),
							'bottom' => __( 'Bottom', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your tooltip.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Custom BG Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Or you can also choose your own color to use as the background for your tooltip.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'bgColor',
						'type' => 'color'
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears in your tooltip.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color'
					),
					array(
						'name' => __( 'Sticky <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'By default the tooltip will close when you move the cursor from it.  Making it sticky will have it stay open until you hover over it again.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'sticky',
						'options' => array( 'true' => __( 'Tootip stays open until you hovered over', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Close Icon <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Checking this will create an icon inside the tooltip when clicked on will close the tooltip.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'close',
						'options' => array( 'true' => __( 'Tooltip stays open until close icon is clicked', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Disable Arrow <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'By default there will be a small arrow on the tooltip for style purposes.  Check this if you wish to hide it.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'arrow',
						'options' => array( 'false' => __( 'Disable the tooltip arrow', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'ID <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If using HTML for your trigger make sure to specify an ID here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'custom_id',
						'type' => 'text',
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		global $mysite;
		
		extract(shortcode_atts(array(
			'trigger' 		=> '',
			'width' 		=> '',
			'position' 		=> '',
			'variation' 	=> '',
			'bgcolor'		=> '',
			'textcolor'		=> '',
			'sticky'		=> '',
			'close'			=> '',
			'arrow'			=> '',
			'custom_id'		=> '',
		), $atts));
		
		$mobile_disable_shortcodes = mysite_get_setting( 'mobile_disable_shortcodes' );
		if( isset( $mysite->mobile ) && is_array( $mobile_disable_shortcodes ) && in_array( 'tooltips', $mobile_disable_shortcodes ) )
			return;
		
		$out = '';
		$options = '';
		$style = '';
		$bgcolor[0] = ( !empty( $bgcolor[0] ) )? $bgcolor[0] : '';
		
		$tip_id = self::_tip_id();
		$tip_load = 'tooltip_load_' . $tip_id;
		$tip_trigger = 'tooltip_trigger_' . $tip_id;
		
		$width = trim(str_replace(' ', '', str_replace('px', '', $width ) ) );
		
		if( !empty( $width ) )
			$options .= "width: {$width},";
		else
			$options .= "width: 200,";
			
		if( trim( $position ) == 'top' )
			$options .= " positionBy: 'customTop',";
			
		elseif( trim( $position ) == 'right' )
			$options .= " positionBy: 'auto',";
			
		elseif( trim( $position ) == 'bottom' )
			$options .= " positionBy: 'customBottom',";
			
		if( trim( $arrow ) == 'false' )
			$options .= " arrows: false,";
		else
			$options .= " arrows: true,";
			
		if( trim( $sticky ) == 'true' || trim( $close ) == 'true' )
			$options .= " sticky: true,";
			
		if( ( trim( $sticky ) == 'true' ) && ( trim( $close ) != 'true' ) ) {
			$options .= " mouseOutClose: true,";
			$close = "jQuery('#cluetip-close').css('display','none');";
		}
		
		if( !empty( $variation ) )
			$style .= "jQuery('#cluetip').addClass('{$variation}');\rjQuery('#cluetip-arrows').addClass('{$variation}');";
		else
			$style .= "jQuery('#cluetip-arrows').removeClass().addClass('cluetip-arrows');";
			
		if( ( $bgcolor[0] == '#' ) && ( strlen( $bgcolor ) == 7 || strlen( $bgcolor ) == 4 ) )
			$style .= "jQuery('#cluetip').css('background-color','{$bgcolor}').css('border-color','{$bgcolor}');jQuery('#cluetip-arrows').css('border-color','{$bgcolor}');";
		else
			$style .= "jQuery('#cluetip').css('background-color','').css('border-color','');\rjQuery('#cluetip-arrows').css('border-color','');";
		
			
			
		// Check if user has set an ID
		if ($custom_id == '') { 
		
		// If not then we set trigger to a link
		
		$script = "<script type=\"text/javascript\">
		/* <![CDATA[ */
		jQuery(document).ready(function() {
			jQuery('a#{$tip_trigger}').cluetip({ local:true, {$options} hideLocal: false, cursor: 'pointer', showTitle: false, waitImage: false, clickThrough: false, dropShadow: false, waitImage :false, onShow: function(e) { {$style}{$close} Cufon.refresh(); }, fx: { open: 'fadeIn', openSpeed: 'fast' } });
		});
		
		/* ]]> */
		</script>";
		
		echo $script;
		echo '<div id="' . $tip_load . '" class="tooltip_load"' . ( !empty( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '' ) . '>' . $content . '</div>';
		
		$out .= '<a id="' . $tip_trigger . '" class="tooltip_trigger" href="#' . $tip_load . '" rel="#' . $tip_load . '">' . $trigger . '</a>'; 
				
		} else {
			
		// If ID is set then we echo out the custom trigger
			
			// echo trigger
			$out .= '<span id = "span'.$custom_id.'">'.$trigger.'</span>';
			
			// echo content
			echo '<div id = "custom_tooltip_content'.$custom_id.'" class="tooltip_load" style="display:none;">'.$content.'</div>';
			
			// script
			$script = "<script type=\"text/javascript\">
			/* <![CDATA[ */
			jQuery(document).ready(function() {
				jQuery('#span{$custom_id} > *').attr('id', '{$custom_id}');
				jQuery('#span{$custom_id} > *').attr('rel', '#custom_tooltip_content{$custom_id}');
				jQuery('#{$custom_id}').cluetip({ attribute: 'rel', local:true, {$options} hideLocal: false, cursor: 'pointer', showTitle: false, waitImage: false, clickThrough: false, dropShadow: false, waitImage :false, onShow: function(e) { {$style}{$close} Cufon.refresh(); }, fx: { open: 'fadeIn', openSpeed: 'fast' } });
			});
			
			/* ]]> */
			</script>";
			echo $script;
			
		}
		
		return $out;
	}
	
	/**
	 *
	 */
	function _options($class) {
		$shortcode = array();
		
		$class_methods = get_class_methods($class);
		
		foreach( $class_methods as $method ) {
			if($method[0] != '_')
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		
		$options = array(
			'name' => __( 'Tooltip', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'tooltip',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>