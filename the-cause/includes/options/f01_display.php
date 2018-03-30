<?php
// display functions
function display($options) {
	
	?>
    
    <form method="post" action="">
    
    <?php
	foreach ($options as $option) {
		$optionType = $option['type'];
		$optionSubType = $option['subType'];
		$optionDir = $option['dir'];
		$optionValue = $option["value"];
		$optionName = $option['name'];
		$optionID = $option['id'];
		$optionStd = $option['std'];
		$optionDesc = $option['desc'];
		
		switch($optionType) {
			case "title":
			tbTitle($optionName);
			break;
			
			case "open":
			tbOpen();
			break;
			
			case "close":
			tbClose();
			break;
			
			case "close2":
			tbClose2();
			break;
			
			case "spacer":
			tbSpacer();
			break;
			
			case "spacer5":
			tbSpacer5();
			break;
			
			case "upload":
			tbUpload($optionID, $optionName, $optionStd, $optionDesc);
			break;
			
			case "text":
			tbText($optionID, $optionName, $optionStd, $optionDesc);
			break;
			
			case "textarea":
			tbTextArea($optionID, $optionName, $optionStd, $optionDesc);
			break;
			
			case "select":
			tbOptionSelect($optionID, $optionName, $optionDesc, $optionSubType, $optionDir, $optionValue, $optionStd);
			break;
			
			case "bckgSelect":
			tbBckgSelect($optionID, $optionName, $optionDesc, $optionStd);
			break;
			
			case "colorPicker":
			tbColorPicker($optionID, $optionName, $optionDesc, $optionStd);
			break;

			case "radio":
			tbRadio($optionID, $optionName, $optionDesc, $optionValue, $optionStd);
			break;
			
		}
	}
	
	saveButton();
}

// TITLE
function tbTitle($title) {
	echo "<h3 class='tb'>$title</h3>";
}

// OPEN
function tbOpen() {
	echo '<div class="tbOptionSection"><div>';
}

// CLOSE
function tbClose() {
	echo '</div></div>';
}

// CLOSE2
function tbClose2() {
	echo '</div></div><div class="tbOptionSection2"></div>';
}

// SPACER
function tbSpacer() {
	echo '<div class="tbSpacer20"></div>';
}

function tbSpacer5() {
	echo '<div class="tbSpacer5"></div>';
}

// UPLOAD
function tbUpload($optionID, $optionName, $optionStd, $optionDesc) {
	?>
    
    <table width="100%" border="0" cellpadding="4">
        <tr>
            <td width="200"><h4 class="tb"><?php echo $optionName; ?></h4></td>
            <td>
			
			<?php
				$value = get_option($optionID);
				if (!$value) {$value = $optionStd;}
			?>
			
			<?php if ($value) {	?>
			<div style="display: inline-block; float: right;"><img src="<?php echo $value; ?>" id="img_<?php echo $optionID; ?>"></div>
			<?php }?>
			
            <?php if ($optionDesc) { ?>
            <p><?php echo $optionDesc; ?></p>
            <?php } ?>

			<input id="<?php echo $optionID; ?>" type="text" size="36" name="<?php echo $optionID; ?>" value="<?php echo $value; ?>" />
			<input id="<?php echo $optionID; ?>_button" class type="submit" value="Upload" />
		
			<script type="text/javascript">
				jQuery(document).ready(function() {
				
				jQuery('#<?php echo $optionID; ?>_button').click(function() {
				 formfield = jQuery('#<?php echo $optionID; ?>').attr('name');
				 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				 return false;
				});
				
				window.send_to_editor = function(html) {
				 imgurl = jQuery('img',html).attr('src');
				 jQuery('#' + formfield).val(imgurl);
				 jQuery('#img_' + formfield).attr('src', imgurl);
				 tb_remove();
				}
				
				});
			</script>
            </td>
        </tr>
    </table>
    
    <?php
}

// TEXT
function tbText($optionID, $optionName, $optionStd, $optionDesc) {
	?>
    
    <table width="80%" border="0" cellpadding="4">
        <tr>
            <td width="200"><h4 class="tb"><?php echo $optionName; ?></h4></td>
            <td>
			<?php
                $value = stripslashes(get_option($optionID));
                
                if (!$value) {$value = $optionStd;}
            ?>
            
            <?php if ($optionDesc) { ?>
            <p><?php echo $optionDesc; ?></p>
            <?php } ?>
            
            <input type="text" id="<?php echo $optionID; ?>" name="<?php echo $optionID; ?>" value="<?php echo $value; ?>">
            </td>
        </tr>
    </table>
    
    <?php
}

// TEXT AREA
function tbTextArea($optionID, $optionName, $optionStd, $optionDesc) {
	?>
    
    <table width="80%" border="0" cellpadding="4">
        <tr>
            <td width="200"><h4 class="tb"><?php echo $optionName; ?></h4></td>
            <td>
			<?php
				$value = stripslashes(get_option($optionID));
				
				if (!$value) {$value = $optionStd;}
			?>
    
            <?php if ($optionDesc) { ?>
            <p><?php echo $optionDesc; ?></p>
            <?php } ?>
            
		    <textarea id="<?php echo $optionID; ?>" name="<?php echo $optionID; ?>"><?php echo $value; ?></textarea>
            </td>
        </tr>
    </table>
    
    <?php
}

// SELECT
function tbOptionSelect($optionID, $optionName, $optionDesc, $optionSubType, $optionDir = "", $optionValue, $optionStd) {
	?>
    
    <table width="80%" border="0" cellpadding="4">
        <tr>
            <td width="200"><h4 class="tb"><?php echo $optionName; ?></h4></td>
            <td>

            <?php if ($optionDesc) { ?>
            <p><?php echo $optionDesc; ?></p>
            <?php } ?>
            
    
			<?php $selected = get_option($optionID); if (!$selected) {$selected = $optionStd; } ?>
            
            <select name="<?php echo $optionID; ?>" id="<?php echo $optionID; ?>">
            
            <?php
            
            if ($optionSubType == 'page') {				
				if (empty($optionDir)) {		
					$tbPages = tb_get_pages();
					$type = 'page';
				} else {
					$tbPages = tb_get_pages($optionDir);
					$type = $optionDir;
				}
				
				?>
				
				<option value="0" <?php if ($selected == 0) { echo 'selected="selected"'; } ?>>Choose...</option>
				
				<?php

				foreach ($tbPages as $tbPage) {
					$tbPageID = $tbPage->ID;
					$tbPageTitle = $tbPage->post_title;
					?>
					
					<option value="<?php echo $tbPageID; ?>" <?php if ($selected == $tbPageID) { echo 'selected="selected"'; } ?>><?php echo $tbPageTitle; ?></option>
                    
                    <?php
				}
				
            } elseif($optionSubType == 'category') {				
				if (empty($optionDir)) {		
					$tbCats = tb_get_categories();
					$type = 'category';
				} else {
					$tbCats = tb_get_categories($optionDir);
					$type = $optionDir;
				}
				
				?>
				
				<option value="0" <?php if ($selected == 0) { echo 'selected="selected"'; } ?>>Choose...</option>
				
				<?php

				foreach ($tbCats as $tbCat) {
					$tbCatID = $tbCat->term_id;
					$tbCatTitle = $tbCat->name;
					?>
					
					<option value="<?php echo $tbCatID; ?>" <?php if ($selected == $tbCatID) { echo 'selected="selected"'; } ?>><?php echo $tbCatTitle; ?></option>
                    
                    <?php
				}
				
            } elseif ($optionSubType == 'style') {
				if (!$optionDir) {$optionDir = 'predefined';}
                if ($handle = opendir(TBS . $optionDir)) {
					
					$styles = array();
        
                    while (false !== ($file = readdir($handle))) {
                        if (strpos($file, 'css')) {
							$styles[] = $file;
                        }
                    }
                                
                    closedir($handle);
					
					sort($styles);
					foreach ($styles as $file) {
						$fileName = ucwords(str_replace("_", " ", substr($file, 0, strpos($file, ".css"))));
						?>
						<option value="<?php echo $file; ?>" <?php if ($selected == $file) { echo 'selected="selected"'; } ?>><?php echo $fileName; ?></option>
						<?php
					}
                }
                
                ?>
                
                <?php if ($optionDir != 'buttons') { ?>
                
                <option value="custom" <?php if ($selected == 'custom') { echo 'selected="selected"'; } ?>>Custom Skin</option>
                
                <?php }
        
            } elseif ($optionSubType == 'font') {
				if (!$optionDir) {$optionDir = 'fonts';}
                                
                ?>
                <option value="0" <?php if ($selected == 0) { echo 'selected="selected"'; } ?>>Default Font</option>
                <?php
        
                if ($handle = opendir(TBS . $optionDir)) {
        			
					$fonts = array();
                    while (false !== ($file = readdir($handle))) {
                        if (strpos($file, 'css') && ($file != 'default.css')) {
							$fonts[] = $file;
                        }
                    }
                    closedir($handle);
					
					sort($fonts);
					foreach ($fonts as $file) {
						$fileName = ucwords(str_replace("-", " ", substr($file, 0, strpos($file, ".css"))));
						if (strpos($fileName, '_')) {
							$fileName = substr($file, 0, strpos($file, "_"));
						}
						
						?>
						<option value="<?php echo $file; ?>" <?php if ($selected == $file) { echo 'selected="selected"'; } ?>><?php echo $fileName; ?></option>
						<?php
					}
                }
            } else {				
				foreach ($optionValue as $k => $v) {
					?>
                    <option value="<?php echo $k; ?>" <?php if ($selected == $k) { echo 'selected="selected"'; } ?>><?php echo $v; ?></option>
                    <?php
				}
            }
            
            ?>
            
            </select>
            </td>
        </tr>
    </table>
    
    <?php
}

// BCKG SELECT
function tbBckgSelect($optionID, $optionName, $optionDesc, $optionStd) {
	?>
    
    <table width="80%" border="0" cellpadding="4">
        <tr>
            <td width="200"><h4 class="tb"><?php echo $optionName; ?></h4></td>
            <td>

            <?php if ($optionDesc) { ?>
            <p><?php echo $optionDesc; ?></p>
            <?php } ?>
            
            <?php $selected = get_option($optionID); ?>
            
            <select name="<?php echo $optionID; ?>" id="<?php echo $optionID; ?>">
                
                <option value="0">Select custom background</option>
            
            <?php
            
			$bckgs = array();
            if ($handle = opendir(TBS . 'bckg')) {
                /* This is the correct way to loop over the directory. */
                while (false !== ($file = readdir($handle))) {
                    if (strpos($file, 'png')) {
						$bckgs[] = $file;
                    }
                }
                            
                closedir($handle);
            }
			
			sort($bckgs);
			foreach ($bckgs as $file) {
				$fileName = ucwords(str_replace("_", "", substr($file, 0, strpos($file, ".png"))));
				?>
				<option value="<?php echo $file; ?>" <?php if ($selected == $file) { echo 'selected="selected"'; } ?>><?php echo $fileName; ?></option>
				<?php				
			}
            
            ?>
                    
            </select>
            </td>
        </tr>
    </table>
    
    <?php
}

// COLOR PICKER
function tbColorPicker($optionID, $optionName, $optionDesc, $optionStd) {
	?>
    
    <table width="80%" border="0" cellpadding="4">
        <tr>
            <td width="200"><h4 class="tb"><?php echo $optionName; ?></h4></td>
            <td>

            <?php if ($optionDesc) { ?>
            <p><?php echo $optionDesc; ?></p>
            <?php } ?>
    
			<?php
        
            
            
            $value = get_option($optionID);
            if (!$value) {$value = $optionStd;}
            
            ?>
			
			<div id="<?php echo $optionID; ?>_cp" class="tbColorPicker"><div style="background-color: <?php echo $value; ?>"><input type="hidden" id="<?php echo $optionID; ?>" value="<?php echo $value; ?>" name="<?php echo $optionID; ?>"></div></div>

			<script type="text/javascript">
             
              jQuery(document).ready(function() {

				jQuery('#<?php echo $optionID; ?>_cp').ColorPicker({
					color: '<?php echo $value; ?>',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery('#<?php echo $optionID; ?>_cp div').css('backgroundColor', '#' + hex).children('input').attr('value', '#' + hex);
					}
				});

              });
             
            </script>
            </td>
        </tr>
    </table>
    
    <?php
    
}

// RADIO
function tbRadio($optionID, $optionName, $optionDesc, $optionValue, $optionStd) {
	?>
    
    <table width="80%" border="0" cellpadding="4">
        <tr>
            <td width="200"><h4 class="tb"><?php echo $optionName; ?></h4></td>
            <td>

            <?php if ($optionDesc) { ?>
            <p><?php echo $optionDesc; ?></p>
            <?php } ?>
    
			<?php
            
            $value = get_option($optionID);
            if (!$value) {$value = $optionStd;}
            
            ?>
            
            <p>
            <?php foreach ($optionValue as $k => $v) { ?>
                <label>
                <input type="radio" name="<?php echo $optionID; ?>" value="<?php echo $v; ?>" <?php if ($value == $v) echo 'checked="checked"'; ?>>
                <?php echo $k; ?></label>
                <br>
            <?php } ?>
            </p>

            </td>
        </tr>
    </table>
    
    <?php
    
}

// SAVE BUTTON
function saveButton() {
	?>
    <p class="submit">
        <input type="hidden" name="action" value="save">
        <input type="submit" name="save" value="Save Settings">
    </p>
    </form>
    <?php
}

?>