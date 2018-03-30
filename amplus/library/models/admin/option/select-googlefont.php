<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/select.php');
class BFIAdminOptionSelectGoogleWebFont extends BFIAdminOptionSelect {
    
    public function display() {
        // Get the list of Google WebFonts
        $googleFonts = bfi_get_googlefonts();
		$googleFontLabels = array();
		$googleFontValues = array();
		$std = $this->getStd();
		
		// Form the option list and form the std as well since 
		// the std is only the name + style of the font
		foreach ($googleFonts as $key => $value) {
		    $googleFontLabels[] = $value['label'];
		    $googleFontValues[] = htmlentities(serialize(array('src' => $key, 'css' => $value['css'])));
		    
		    // it's okay to do include this in the loop since
		    // this won't match anything after serialization
		    if ($key == $std) {
		        $std = serialize(array('src' => $key, 'css' => $value['css']));
		    }
		}
        $this->properties["options"] = $googleFontLabels;
        $this->properties["values"] = $googleFontValues;
        
        /**
         * Get the current font (saved or default)
         */
		$currFont = $std;
		// We just saved
		if (isset($_REQUEST["action"]) 
		    && $_REQUEST['action'] == 'save') {
			$currFont = stripslashes($_REQUEST[$this->getID()]);
			$currFont = str_replace('"', '&quot;', $currFont);
		// we just loaded the page and we are using the default value
		} else if ($this->getValue() == $this->getStd()) {
		    $currFont = $std;
			$currFont = str_replace('"', '&quot;', $currFont);
		// For meta options, we just loaded the page
		// and there was something saved before.
		// meta returns an array, serialize it to match the value
	    } else if ($this->optionType == self::TYPE_META) {
		    $currFont = serialize($this->getValue());
			$currFont = str_replace('"', '&quot;', $currFont);
		// For panel options, we just loaded the page
		// and there was something saved before (option)
	    } else {
		    $currFont = $this->getValue();
		}


        // Display the drop down list for the font
        $this->echoOptionHeader();
        $values = $this->getValues();
        ?><select name="<?php echo $this->getID(); ?>" id="<?php echo $this->getID(); ?>"><?php 
        foreach ($this->getOptions() as $key => $option) {
            // this is if we have option groupings
            if (is_array($option)) {
                ?><optgroup label="<?php echo $key?>"><?php
                foreach ($option as $key2 => $subOption) {
                    printf("<option value=\"%s\" %s>%s</option>",
                        $values[$key][$key2],
                        $currFont == $values[$key][$key2] ? 'selected="selected"' : '',
                        $subOption
                        );
                }
                ?></optgroup><?php
                
            // this is for normal list of options
            } else {
                printf("<option value=\"%s\" %s>%s</option>",
                    $values[$key],
                    $currFont == $values[$key] ? 'selected="selected"' : '',
                    $option
                    );
            }
        } 
        ?></select><?php
        $this->echoOptionFooter();
        
        /**
         * Display the preview area
         */
        unset($this->properties['name']);
        $this->echoOptionHeader();
        ?>
        <div class='cufon'>
            <em class='cufonpreview title'><strong>Font preview:</strong> (This shows the current one selected above)</em>
			<div class='c'></div>
			<br>
			<em class='cufonpreviewlabel'>Preview Text:</em> <input type='text' class='preview' id='<?php echo $this->getID() ?>_preview_text' value='' placeholder='enter preview text'/>
			<button type='button' id='<?php echo $this->getID() ?>_preview_text_button' class='button-secondary' onclick='return false;'>Refresh preview</button>
			<script>
			jQuery('#<?php echo $this->getID() ?>_preview_text_button').click(function () {
				jQuery('#<?php echo $this->getID() ?>_iframe').attr('src', '<?php echo BFI_LIBRARYURL ?>includes/googlewebfont-preview.php?f='+jQuery('#<?php echo $this->getID() ?>').val()+'&t='+jQuery('#<?php echo $this->getID() ?>_preview_text').val());
			});
			</script>
			<div class='c'></div>
			<iframe src='<?php echo BFI_LIBRARYURL ?>includes/googlewebfont-preview.php?f=<?php echo $currFont ?>' id='<?php echo $this->getID() ?>_iframe' width='60%' height='120' style='border: 1px solid #CCC'></iframe>
			<script>
			jQuery('#<?php echo $this->getID() ?>').change(function() {
				jQuery('#<?php echo $this->getID() ?>_iframe').attr('src', '<?php echo BFI_LIBRARYURL ?>includes/googlewebfont-preview.php?f='+jQuery(this).val()+'&t='+jQuery('#<?php echo $this->getID() ?>_preview_text').val());
			});
			</script>
			<div class='c'></div>
			</div>
        <?php
        
        $this->echoOptionFooter();
    }
    
    
    public function resetAsOption() {
        $googleFonts = bfi_get_googlefonts();
		$googleFontLabels = array();
		$googleFontValues = array();
		$std = $this->getStd();
		
		foreach ($googleFonts as $key => $value) {
		    // it's okay to do include this in the loop since
		    // this won't match anything after serialization
		    if ($key == $std) {
		        $std = serialize(array('src' => $key, 'css' => $value['css']));
		    }
		}
		
		bfi_update_option($this->getID(), stripslashes($std));
    }
}
