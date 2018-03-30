<?php
if (!defined('ABSPATH')) {
    require_once('../../../../../wp-load.php');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php _e('Shortcode Generator', 'uxbarn'); ?></title>
	
	<script type="text/javascript" src="scripts/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-migrate-1.1.0_dev.js"></script>
	<script type="text/javascript" src="scripts/jquery-ui.js"></script>
	<script type="text/javascript" src="scripts/tiny_mce_popup.js?v=351"></script>
	<script type="text/javascript" src="scripts/jquery.ddslick.min.js"></script>
	<script type="text/javascript" src="../../js/iphone-style-checkboxes.js"></script>
	
	<link type="text/css" rel="stylesheet" href="css/base.css?ver=1" />
	<link type="text/css" rel="stylesheet" href="css/generator.css?ver=1" />
	<link type="text/css" rel="stylesheet" href="../../css/iphone-style-checkboxes.css" />
	<link type="text/css" rel="stylesheet" href="css/jquery-ui.css" />
	<!--<link href='http://fonts.googleapis.com/css?family=Lato|Lato:300' rel='stylesheet' type='text/css'>-->

	<script type="text/javascript">
		$(document).ready(function() {
			$('#insert').attr('class', 'hide-block');
			$('#close-window-container').attr('class', 'hide-block');
			
			var ddBasic = [
			    
                { text: "<?php _e('Drop Cap', 'uxbarn'); ?>", value: 'dropcap', },
                { text: "<?php _e('Highlight', 'uxbarn'); ?>", value: 'highlight', },
			];
			
			$('#selector').ddslick({
				data: ddBasic,
				selectText: '<?php _e('-- Select element to generate --', 'uxbarn'); ?>',
				//height: 350,
				onSelected: function(data){
					
					$('#insert').attr('class', 'button');
					$('#close-window-container').removeClass('hide-block');
					
					$('.switcher-content').css('display', 'none');
					
					var to = '#' + data.selectedData.value + '-content';
					$(to).css('display', 'block');
					
				}
			});
			
			$(':checkbox').not('.normal-checkbox').not('#close-window').not('.portfolio-checkbox, .staff-checkbox, .testimonial-checkbox, .checkbox-selectall, .checkbox-no-iphone').iphoneStyle({
				checkedLabel: '<?php _e('Yes', 'uxbarn'); ?>',
				uncheckedLabel: '<?php _e('No', 'uxbarn'); ?>'
			});
			
			$('.switcher-content').css('display', 'none');
			$('.show').css('display', 'block');
			
		});
		
		var ButtonDialog = {
			local_ed : 'ed',
			init : function(ed) {
				ButtonDialog.local_ed = ed;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert : function insertButton(ed) {
			 
				// Try and remove existing style / blockquote
				tinyMCEPopup.execCommand('mceRemoveNode', false, null);
				 
			    var shortcode = '';
			    
				// Retrieve the selected category
				var ddData = $('#selector').data('ddslick');
				switch(ddData.selectedData.value) {
				    
	                  case 'dropcap' : 
                            
                            var style = ' style="' + $('#dropcap-style').find(':selected').val() + '"';
                            var character = ' character="' + $('#dropcap-character').val() + '"';
                            
                            shortcode = '[uxb_dropcap' + style + character + ' /]';
                            
                            break;
                            
                      case 'highlight' : 
                            
                            var style = ' style="' + $('#highlight-style').find(':selected').val() + '"';
                            var text = $('#highlight-text').val();
                            
                            shortcode = '[uxb_highlight' + style + ']' + text + '[/uxb_highlight]';
                            
                            break;
                            
				}
				
				tinyMCEPopup.execCommand('mceReplaceContent', false, shortcode);
				
				if($('#close-window').is(':checked') == false) {
					tinyMCEPopup.close();
				}
			}
		};
		
		tinyMCEPopup.onInit.add(ButtonDialog.init, ButtonDialog);
		 
	</script>
	
</head>
<body>
	<div id="generator-header">
		<div id="selector-container">
			<select id="selector"></select>
		</div>
		<h4 id="title"><?php _e('Shortcode Generator', 'uxbarn'); ?></h4>
	</div>
	<div id="generator-container">
		
		<div id="switcher-panel"></div>
		
        <div id="dropcap-content" class="switcher-content">
            <div class="controls-container">
                <div class="description">
                    <?php _e('Select the style for this drop cap.', 'uxbarn'); ?>
                </div>
                <div class="controls">
                    <label for="dropcap-style"><?php _e('Style', 'uxbarn'); ?></label>
                    <select id="dropcap-style">
                        <option value="dark"><?php _e('Dark', 'uxbarn'); ?></option>
                        <option value="light"><?php _e('Light', 'uxbarn'); ?></option>
                        <option value="simple"><?php _e('Simple', 'uxbarn'); ?></option>
                    </select>
                </div>
            </div>
            <div class="controls-container">
                <div class="description">
                    <?php _e('Enter the character for this drop cap.', 'uxbarn'); ?>
                </div>
                <div class="controls">
                    <label for="dropcap-character"><?php _e('Character', 'uxbarn'); ?></label>
                    <input type="text" id="dropcap-character" value="" />
                </div>
            </div>
        </div>
        
        
        <div id="highlight-content" class="switcher-content">
            <div class="controls-container">
                <div class="description">
                    <?php _e('Select the style for this highlight.', 'uxbarn'); ?>
                </div>
                <div class="controls">
                    <label for="highlight-style"><?php _e('Style', 'uxbarn'); ?></label>
                    <select id="highlight-style">
                        <option value="dark"><?php _e('Dark', 'uxbarn'); ?></option>
                        <option value="light"><?php _e('Light', 'uxbarn'); ?></option>
                    </select>
                </div>
            </div>
            <div class="controls-container">
                <div class="description">
                    <?php _e('Enter the text for this highlight.', 'uxbarn'); ?>
                </div>
                <div class="controls">
                    <label for="highlight-text"><?php _e('Text', 'uxbarn'); ?></label>
                    <input type="text" id="highlight-text" value="" />
                </div>
            </div>
        </div>
		
		<div id="start-content" class="switcher-content show">
	    	<p>
	    		<?php _e('This generator consists of Drop Cap and Highlight only. In case you would like to create layouts with other elements, please use "Visual Composer". You can find its button just above the editor (see where it is located from the screenshot below).', 'uxbarn'); ?> 
	    	</p>
	    	<p>
	    		<img src="images/vc_button.jpg" alt="" style="border: 2px solid #666;" />
	    	</p>
	    </div>
		
	</div>
		
		<div id="generate-button">
			<div id="close-window-container">
				<input id="close-window" type="checkbox" />
				<label for="close-window"><?php _e('Leave this window opened?', 'uxbarn'); ?></label>
			</div>
			<a href="javascript:ButtonDialog.insert(ButtonDialog.local_ed)" class="button" id="insert"><?php _e('Generate Shortcode', 'uxbarn'); ?></a>
		</div>
	</div>
</body>
</html>