<?php function ocmx_font_form($input){
	global $theme_options, $ocmx_fonts; ?>
	<li class="column">
		<ul class="element-selector">
			<?php $i=0; foreach($input as $font_option) : ?>
				<li><a id="element-selector-<?php echo $font_option["id"]; ?>" rel="<?php echo $font_option["id"]; ?>" <?php if($i == 0): ?>class="element-selected-tab"<?php endif;?> href="#"><?php echo $font_option["label"]; ?></a></li>
			<?php $i++; endforeach; ?>
		</ul>
	</li>
	<?php $i=0; foreach($input as $font_option) : ?>
		<li id="<?php echo $font_option["id"]; ?>_li" class="column <?php if($i == 0): ?>element-selected<?php else : ?>no_display<?php endif; ?>">
			<ul class="font-setting-container">
				<?php create_form($font_option, count($font_option)); ?>
			</ul>
			<ul class="font-list">
				<?php $fontstyle = $font_option["id"]."_style" ?>
				<?php foreach($ocmx_fonts as $font) :
					$font_css = "";
					$option = $font_option["name"];
					$size = $option."_size";
					$style =  $option."_style";
					if(get_option($fontstyle) == ""){$fontstyle .= "_default";}
					if(get_option($size) != "" && get_option($size) != "0") :
						$font_css .= "font-size: ".round(get_option($size), 0)."px !inherent; ";
					endif;

					//Set the selected font
					if(strpos($fontstyle, "_default") == false && get_option($fontstyle) == $font["css"]) :
						$selected_font = true;
					else :
						$selected_font = false;
					endif;

					// If we've selected a font, show it as the first option instead of the "theme default" tab
					if($font["label"] == "Theme Default" && strpos($fontstyle, "_default") == false) : ?>
						<li<?php if(get_option($fontstyle) == $font["css"]) : ?> class="select"<?php endif; ?>>
							<div class="font-item" rel="<?php echo $font_option["id"]; ?>_style">
								<div style="font-family: <?php echo get_option($fontstyle); ?>; <?php echo $font_css; ?>" class="type-display">
									AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVv
								</div>
								<span class="font-name"><?php _e("Current Font",'ocmx'); ?></span>
							</div>
							<input type="radio" class="no_display" name="<?php echo $font_option["id"]; ?>_style" value="<?php echo get_option($fontstyle); ?>" />
						</li>
					<?php else : ?>
						<li<?php if($selected_font == true) : ?> class="select"<?php endif; ?>>
							<div class="font-item" rel="<?php echo $font_option["id"]; ?>_style">
								<div style="font-family: <?php echo $font["css"]; ?>; <?php echo $font_css; ?>" class="type-display">
									AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVv
								</div>
								<span class="font-name"><?php echo $font["label"]; ?></span>
							</div>
							<input type="radio" class="no_display" name="<?php echo $font_option["id"]; ?>_style" value="<?php echo $font["css"]; ?>" <?php if($selected_font == true) : ?>checked="checked"<?php endif; ?> />
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</li>
	<?php $i++; endforeach; ?>
<?php
}
add_action("ocmx_font_form", "ocmx_font_form", 40);

function ocmx_font_overview($input){ ?>
<li class="clearfix">
	<div class="content">
		<p class="settings-message">
			<?php _e("Below is a general overview of the typography and color changes that you have made to your theme.
			The reason for this page is for you to get an idea of how your style selection looks in combination with eachother thereby allowing you to get the right balance between the elements.", 'ocmx') ?>
		</p>

		<div class="overview-container">
			<?php $i=0; foreach($input as $detail) :
					$option = $detail["name"];
					$size = $option."_size";
					$typo =  $option."_style";
					$font_css = "";
					if(get_option($typo) != "") :
						$font_css .= "font-family: ".get_option($typo)." !inherent; ";
					endif;
					if(get_option($size) != "" && get_option($size) != "0") :
						$font_css .= "font-size: ".round(get_option($size), 0)."px !inherent; ";
					endif; ?>
				<div class="section">
					<h3><?php echo $detail["label"]; ?></h3>
					<p id="<?php echo $detail["id"]; ?>_overview" style="<?php echo $font_css; ?>">This is an example of the <?php echo $detail["label"]; ?> styling of your theme.</p>
				</div>
			<?php $i++; endforeach; ?>
		</div>
	</div>
</li>
<?php }
add_action("ocmx_font_overview", "ocmx_font_overview");  ?>