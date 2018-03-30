<?php

/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'qrcode_vcard_load_widgets' );

/**
 * Register our widget.
 */
function qrcode_vcard_load_widgets() {
	register_widget('qrcode_vcard_widget');
}

/**
 * QRCode VCard Widget class.
 */
class qrcode_vcard_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function qrcode_vcard_widget() {
		/* Widget settings. */
		$widget_ops = array('classname' => 'widget_qrcode_vcard', 'description' => 'Generate QRCode for your VCard');

		/* Widget control settings. */
		$control_ops = array('width' => 200, 'height' => 250, 'id_base' => 'qrcode-vcard-widget');

		/* Create the widget. */
		parent::__construct('qrcode-vcard-widget', 'WP Space - QRCode VCard', $widget_ops, $control_ops);
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget($args, $instance) {
		wp_enqueue_style( 'widget-qrcode-vcard',  get_template_directory_uri() . '/widgets/qrcode/widget-qrcode-vcard.css' );
		wp_enqueue_script('qrcode', get_template_directory_uri().'/widgets/qrcode/jquery.qrcode-0.6.0.min.js', array('jquery'), '0.2', true);
		wp_enqueue_script('jquery_tools', get_template_directory_uri().'/js/jquery.tools.custom.js', array('jquery'), '1.2.6', true);

		extract($args);

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title']);
		$subtitle = apply_filters('widget_subtitle', $instance['subtitle']);
		$ulname = $instance['ulname'];
		$ufname = $instance['ufname'];
		$ucompany = $instance['ucompany'];
		$uphone = $instance['uphone'];
		//$ufax = $instance['ufax'];
		$uaddr = $instance['uaddr'];
		$ucity = $instance['ucity'];
		$upostcode = $instance['upostcode'];
		$ucountry = $instance['ucountry'];
		$uemail = $instance['uemail'];
		$usite = $instance['usite'];
		//$unote = $instance['unote'];
		//$ucats = $instance['ucats'];
		$urev = $instance['urev'];
		$uid = $instance['uid'];
		$show_personal = $instance['show_personal'];
		$width = $instance['width'];
		$color = $instance['color'];
		$image = $instance['image'];
		
		$output = '';
		
        if ($subtitle)	$output .= '<div class="widget_subtitle">'.$subtitle.'</div>';
		if ($title) 	$output .= $before_title . $title . $after_title;		
		
		$output .= '
				<div class="widget_inner' . ($show_personal ? ' with_personal_data' : '') . '">
					<div class="qrcode"><img src="' . $image . '" /></div>
					';
		if ($show_personal) 
			$output .= '
					<div class="personal_data">
						<p class="user_name odd first">' . $ufname . ' ' . $ulname . '</p>'
						. ($ucompany ? '<p class="user_company even">' . $ucompany . '</p>' : '')
						. ($uphone ? '<p class="user_phone odd">' . $uphone . '</p>' : '')
						. ($uemail ? '<p class="user_email even"><a href="mailto:' . $uemail . '">' . $uemail . '</a></p>' : '')
						. ($usite ? '<p class="user_site odd"><a href="' . $usite . '" target="_blank">' . $usite . '</a></p>' : '')
						. '
					</div>
					';
		$output .= '
				</div>';

		/* Before widget (defined by themes). */
		echo $before_widget;		
	
		echo $output;
			
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		/* Strip tags for title and comments count to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['subtitle'] = strip_tags($new_instance['subtitle']);

		$instance['ulname'] = strip_tags($new_instance['ulname']);
		$instance['ufname'] = strip_tags($new_instance['ufname']);
		$instance['utitle'] = strip_tags($new_instance['utitle']);
		$instance['ucompany'] = strip_tags($new_instance['ucompany']);
		$instance['uphone'] = strip_tags($new_instance['uphone']);
		//$instance['ufax'] = strip_tags($new_instance['ufax']);
		$instance['uaddr'] = strip_tags($new_instance['uaddr']);
		$instance['ucity'] = strip_tags($new_instance['ucity']);
		$instance['upostcode'] = strip_tags($new_instance['upostcode']);
		$instance['ucountry'] = strip_tags($new_instance['ucountry']);
		$instance['uemail'] = strip_tags($new_instance['uemail']);
		$instance['usite'] = strip_tags($new_instance['usite']);
		//$instance['unote'] = strip_tags($new_instance['unote']);
		//$instance['ucats'] = strip_tags($new_instance['ucats']);
		$instance['uid'] = strip_tags($new_instance['uid']);
		$instance['urev'] = date('Y-m-d');
		$instance['show_personal'] = isset($new_instance['show_personal']) ? 1 : 0;
		$instance['auto_draw'] = isset($new_instance['auto_draw']) ? 1 : 0;
		$instance['width'] = (int) $new_instance['width'];
		$instance['color'] = strip_tags($new_instance['color']);
		$instance['image'] = strip_tags($new_instance['image']);
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance) {
		
		/* Widget admin side css */
		wp_enqueue_style( 'widget-qrcode-vcard',  get_template_directory_uri() . '/widgets/qrcode/widget-qrcode-vcard-admin.css' );

		wp_enqueue_script('jquery_tools_min', get_template_directory_uri().'/js/jquery.tools.custom.js', array('jquery'), '1.2.6', false);
		wp_enqueue_script('qrcode', get_template_directory_uri().'/widgets/qrcode/jquery.qrcode-0.6.0.min.js', array('jquery'), '0.2', false);
		wp_enqueue_style('color-picker', get_template_directory_uri().'/js/colorpicker/colorpicker.css');
		wp_enqueue_script('color-picker', get_template_directory_uri().'/js/colorpicker/colorpicker.js', array('jquery'));

		/* Set up some default widget settings. */
		$address = explode(',', get_theme_option('user_address'));
		$defaults = array(
			'title' => '', 
			'subtitle' => '', 
			'description' => 'QR Code Generator (for your vcard)',
			'ulname' => get_theme_option('user_lastname'), 
			'ufname' => get_theme_option('user_firstname'), 
			'ucompany' => get_theme_option('user_last_company'), 
			'uaddr' => (isset($address[0]) ? $address[0] : '').(isset($address[1]) ? ','.$address[1] : ''), 
			'ucity' => isset($address[2]) ? $address[2] : '', 
			'upostcode' => isset($address[count($address)-2]) ? $address[count($address)-2] : '', 
			'ucountry' => isset($address[count($address)-1]) ? $address[count($address)-1] : '', 
			'uemail' => get_theme_option('user_email'), 
			'usite' => get_theme_option('user_website'), 
			'uphone' => get_theme_option('user_phone'), 
			//'ufax' => '', 
			//'unote' => '', 
			//'ucats' => '', 
			'uid' => md5(microtime()), 
			'urev' => date('Y-m-d'),
			'image' => '', 
			'show_personal' => 0,
			'auto_draw' => 0,
			'size' => 160,
			'color' => '#000000'
		);
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<div class="widget_qrcode">
        	<div class="qrcode_tabs">
                <ul class="tabs">
                    <li class="first"><a href="#tab_settings">Settings</a></li>
                    <li><a href="#tab_fields" onmousedown="initQRCode()">Personal Data</a></li>
                </ul>
                <div id="tab_settings" class="tab_content tab_settings">
                    <p>
                        <input class="fld_show_personal" onfocus="initQRCode()" id="<?php echo $this->get_field_id('show_personal'); ?>" name="<?php echo $this->get_field_name('show_personal'); ?>" value="1" type="checkbox" <?php echo $instance['show_personal']==1 ? 'checked="checked"' : ''; ?> />
                        <label for="<?php echo $this->get_field_id('show_personal'); ?>"> <?php echo 'Show personal data'; ?></label>
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
                        <input class="fld_title" onfocus="initQRCode()" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
                    </p>
            
                    <p>
                        <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php echo 'Subtitle:'; ?></label>
                        <input class="fld_subtitle" onfocus="initQRCode()" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" value="<?php echo $instance['subtitle']; ?>" style="width:100%;" />
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id('color'); ?>"><?php echo 'Color'; ?></label>
                        <input onmousedown="initQRCode()" onfocus="initQRCode()" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" value="<?php echo $instance['color']; ?>" style="width:100%; background-color:<?php echo $instance['color']; ?>" class="iColorPicker fld_color" />
                        <input class="fld_width" onfocus="initQRCode()" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo 160; //$instance['width']; ?>" type="hidden" />
                    </p>
                </div>
                <div id="tab_fields" class="tab_content tab_personal">
                    <p>
                        <label for="<?php echo $this->get_field_id('ulname'); ?>"><?php echo 'Last name:'; ?></label>
                        <input class="fld_ulname" id="<?php echo $this->get_field_id('ulname'); ?>" name="<?php echo $this->get_field_name('ulname'); ?>" value="<?php echo $instance['ulname']; ?>" style="width:100%;" />
                    </p>
                    
                    <p>
                        <label for="<?php echo $this->get_field_id('ufname'); ?>"><?php echo 'First name:'; ?></label>
                        <input class="fld_ufname" id="<?php echo $this->get_field_id('ufname'); ?>" name="<?php echo $this->get_field_name('ufname'); ?>" value="<?php echo $instance['ufname']; ?>" style="width:100%;" />
                    </p>
                    
                    <p>
                        <label for="<?php echo $this->get_field_id('ucompany'); ?>"><?php echo 'Company:'; ?></label>
                        <input class="fld_ucompany" id="<?php echo $this->get_field_id('ucompany'); ?>" name="<?php echo $this->get_field_name('ucompany'); ?>" value="<?php echo $instance['ucompany']; ?>" style="width:100%;" />
                    </p>
                    
                    <p>
                        <label for="<?php echo $this->get_field_id('uphone'); ?>"><?php echo 'Phone:'; ?></label>
                        <input class="fld_uphone" id="<?php echo $this->get_field_id('uphone'); ?>" name="<?php echo $this->get_field_name('uphone'); ?>" value="<?php echo $instance['uphone']; ?>" style="width:100%;" />
                    </p>
           
                    <p>
                        <label for="<?php echo $this->get_field_id('uaddr'); ?>"><?php echo 'Address:'; ?></label>
                        <input class="fld_uaddr" id="<?php echo $this->get_field_id('uaddr'); ?>" name="<?php echo $this->get_field_name('uaddr'); ?>" value="<?php echo $instance['uaddr']; ?>" style="width:100%;" />
                    </p>
                    
                    <p>
                        <label for="<?php echo $this->get_field_id('ucity'); ?>"><?php echo 'City:'; ?></label>
                        <input class="fld_ucity" id="<?php echo $this->get_field_id('ucity'); ?>" name="<?php echo $this->get_field_name('ucity'); ?>" value="<?php echo $instance['ucity']; ?>" style="width:100%;" />
                    </p>
                    
                    <p>
                        <label for="<?php echo $this->get_field_id('upostcode'); ?>"><?php echo 'Post code:'; ?></label>
                        <input class="fld_upostcode" id="<?php echo $this->get_field_id('upostcode'); ?>" name="<?php echo $this->get_field_name('upostcode'); ?>" value="<?php echo $instance['upostcode']; ?>" style="width:100%;" />
                    </p>
                    
                    <p>
                        <label for="<?php echo $this->get_field_id('ucountry'); ?>"><?php echo 'Country:'; ?></label>
                        <input class="fld_ucountry" id="<?php echo $this->get_field_id('ucountry'); ?>" name="<?php echo $this->get_field_name('ucountry'); ?>" value="<?php echo $instance['ucountry']; ?>" style="width:100%;" />
                    </p>
            
                    <p>
                        <label for="<?php echo $this->get_field_id('uemail'); ?>"><?php echo 'E-mail:'; ?></label>
                        <input class="fld_uemail" id="<?php echo $this->get_field_id('uemail'); ?>" name="<?php echo $this->get_field_name('uemail'); ?>" value="<?php echo $instance['uemail']; ?>" style="width:100%;" />
                    </p>
            
                    <p>
                        <label for="<?php echo $this->get_field_id('usite'); ?>"><?php echo 'Web Site URL:'; ?></label>
                        <input class="fld_usite" id="<?php echo $this->get_field_id('usite'); ?>" name="<?php echo $this->get_field_name('usite'); ?>" value="<?php echo $instance['usite']; ?>" style="width:100%;" />
                    </p>

				</div>
            </div>            
            <input class="fld_uid" id="<?php echo $this->get_field_id('uid'); ?>" name="<?php echo $this->get_field_name('uid'); ?>" value="<?php echo $instance['uid']; ?>" type="hidden" />
            <input class="fld_urev" id="<?php echo $this->get_field_id('urev'); ?>" name="<?php echo $this->get_field_name('urev'); ?>" value="<?php echo $instance['urev']; ?>" type="hidden" />
    
            <p>
                <input class="fld_button_draw" id="<?php echo $this->get_field_id('button_draw'); ?>" name="<?php echo $this->get_field_name('button_draw'); ?>" value="Update" type="button" />
                <input class="fld_auto_draw" id="<?php echo $this->get_field_id('auto_draw'); ?>" name="<?php echo $this->get_field_name('auto_draw'); ?>" value="1" type="checkbox" <?php echo $instance['auto_draw']==1 ? 'checked="checked"' : ''; ?> />
                <label for="<?php echo $this->get_field_id('auto_draw'); ?>"> <?php echo 'Auto'; ?></label>
            </p>
            <input class="fld_image" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" value="" type="hidden" />
            <div id="<?php echo $this->get_field_id('qrcode_image'); ?>" class="qrcode_image"><img src="<?php echo $instance['image']; ?>" /></div>
            <div id="<?php echo $this->get_field_id('qrcode_data'); ?>" class="qrcode_data">
<?php if ($instance['show_personal']==1) { ?>
                <ul>
                    <li class="user_name odd first"><?php echo $instance['ufname']; ?> <?php echo $instance['ulname']; ?></li>
                    <?php 
						echo  ($instance['ucompany'] ? '<li class="user_company even">' . $instance['ucompany'] . '</li>' : '')
							. ($instance['uphone'] ? '<li class="user_phone odd">' . $instance['uphone'] . '</li>' : '')
							. ($instance['uemail'] ? '<li class="user_email even"><a href="mailto:' . $instance['uemail'] . '">' . $instance['uemail'] . '</a></li>' : '')
							. ($instance['usite'] ? '<li class="user_site odd"><a href="' . $instance['usite'] . '" target="_blank">' . $instance['usite'] . '</a></li>' : '');
					?>
                </ul>
<?php } ?>
            </div>
		</div>

        <script type="text/javascript">
            jQuery(document).ready(function(){
				initQRCode();
            });
			function initQRCode() {
				var widget = null;
				jQuery('#widgets-right .widget_qrcode input.iColorPicker').each(function() {
					var obj = jQuery(this);
					if (!obj.hasClass('colored') && obj.attr('id').indexOf('__i__') < 0) {
						widget = obj.parents('.widget_qrcode');
						obj.addClass('colored');
						setColorPicker(jQuery(this).attr('id'));
						widget.find('div.qrcode_tabs').tabs('div.tab_content', {
							tabs: 'li > a'
						});
						widget.find('.fld_button_draw').click(function() {
							updateQRCode(widget);
						});
						widget.parents('form').find('.widget-control-save').click(function() {
							updateQRCode(widget);
						});
						widget.find('.tab_personal input,.fld_auto_draw,.iColorPicker').change(function () {
							if (widget.find('.fld_auto_draw').attr('checked')=='checked') {
								widget.find('.fld_button_draw').hide();
								updateQRCode(widget);
							} else 
								widget.find('.fld_button_draw').show();
						});
					}
				});
                if (widget && widget.find('.fld_auto_draw').attr('checked')=='checked')
					widget.find('.fld_button_draw').hide();
			}
            function updateQRCode(widget) {
				showQRCode(widget, {
                        ufname:		widget.find('.fld_ufname').val(),
                        ulname:		widget.find('.fld_ulname').val(),
                        ucompany:	widget.find('.fld_ucompany').val(),
                        usite:		widget.find('.fld_usite').val(),
                        uemail:		widget.find('.fld_uemail').val(),
                        uphone:		widget.find('.fld_uphone').val(),
                        //ufax:		widget.find('.fld_ufax').val(),
                        uaddr:		widget.find('.fld_uaddr').val(),
                        ucity:		widget.find('.fld_ucity').val(),
                        upostcode:	widget.find('.fld_upostcode').val(),
                        ucountry:	widget.find('.fld_ucountry').val(),
                        //unote:	widget.find('.fld_unote').val(),
                        //ucats:	widget.find('.fld_ucats').val(),
                        uid:		widget.find('.fld_uid').val(),
                        urev:		widget.find('.fld_urev').val()
                    }, 
                    {
                        qrcode: widget.find('.qrcode_image').eq(0),
                        personal: widget.find('.qrcode_data'),
                        show_personal: widget.find('.fld_show_personal').attr('checked')=='checked',
                        color: widget.find('.fld_color').val(),
                        width: widget.find('.fld_width').val()
                    }
                );
				widget.find('.fld_image').val(widget.find('.qrcode_image canvas').get(0).toDataURL('image/png'));
            }
			function showQRCode(widget, vc, opt) {
				var vcard = 'BEGIN:VCARD\n'
					+ 'VERSION:3.0\n'
					+ 'FN:' + vc.ufname + ' ' + vc.ulname + '\n'
					+ 'N:' + vc.ulname + ';' + vc.ufname + '\n'
					+ (vc.ucompany ? 'ORG:' + vc.ucompany + '\n' : '')
					+ (vc.uphone ? 'TEL;TYPE=cell, pref:' + vc.uphone + '\n' : '')
					+ (vc.ufax ? 'TEL;TYPE=fax, pref:' + vc.ufax + '\n' : '')
					+ (vc.uaddr || vc.ucity || vc.ucountry ? 'ADR;TYPE=dom, home, postal, parcel:;;' + vc.uaddr + ';' + vc.ucity + ';;' + vc.upostcode + ';' + vc.ucountry + '\n' : '')
					+ (vc.usite ? 'URL:' + vc.usite + '\n' : '')
					+ (vc.uemail ? 'EMAIL;TYPE=INTERNET:' + vc.uemail + '\n' : '')
					+ (vc.ucats ? 'CATEGORIES:' + vc.ucats + '\n' : '')
					+ (vc.unote ? 'NOTE:' + vc.unote + '\n' : '')
					+ (vc.urev ? 'NOTE:' + vc.urev + '\n' : '')
					+ (vc.uid ? 'UID:' + vc.uid + '\n' : '')
					+ 'END:VCARD';
				opt.qrcode
					.empty()
					.qrcode({
						'text': vcard,
						'color': opt.color ? opt.color : '#000000',
						'size': opt.width ? opt.width : 160,
						'height': opt.width ? opt.width : 220
					});
				if (opt.show_personal == 0)
					opt.personal.empty().hide(); 
				else
					opt.personal.html(
						'<ul>'
							+ '<li class="user_name odd first">' + vc.ufname + ' ' + vc.ulname + '</li>'
							+ (vc.ucompany ? '<li class="user_company even">' + vc.ucompany + '</li>' : '')
							+ (vc.uphone ? '<li class="user_phone odd">' + vc.uphone + '</li>' : '')
							+ (vc.uemail ? '<li class="user_email even"><a href="mailto:' + vc.uemail + '">' + vc.uemail + '</a></li>' : '')
							+ (vc.usite ? '<li class="user_site odd"><a href="' + vc.usite + '" target="_blank">' + vc.usite + '</a></li>' : '')
						+ '</ul>'
					).show();
			}
			
			if (!window.setColorPicker) {
				function setColorPicker(id_picker) {
					jQuery('#'+id_picker).ColorPicker({
						color: jQuery('#'+id_picker).val(),
						onShow: function (colpkr) {
							jQuery(colpkr).fadeIn(500);
							return false;
						},
						onHide: function (colpkr) {
							jQuery(colpkr).fadeOut(500);
							return false;
						},
						onChange: function (hsb, hex, rgb) {
							jQuery('#'+id_picker).css('backgroundColor', '#' + hex).val('#' + hex);
						}
					});
				}
			}
        </script>
	<?php
	}
}

?>