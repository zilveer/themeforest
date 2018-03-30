<?php function ocmx_layout_options($input){
global $theme_options;
?>
		<ul class="layout-selector">
			<?php foreach($input["options"] as $layout_option => $option_list) : ?>
				<li <?php if(get_option($input["name"]) == $layout_option): ?>class="selected"<?php endif; ?>>
					<a href="#" id="ocmx_layout_<?php echo $layout_option; ?>">
						<img src=" <?php echo $option_list["image"]; ?>" />
						<h4><?php echo $option_list["label"]; ?></h4>
						<p><?php echo $option_list["description"]; ?></p>
					</a>
				</li>
				<?php if(get_option($input["name"]) == $layout_option):
					$use_layout_option = $layout_option."_home_options";
				endif; ?>
			<?php endforeach; ?>
			<input type="hidden" name="ocmx_home_page_layout" id="ocmx_home_page_layout" value="<?php echo get_option("ocmx_home_page_layout"); ?>" />
		</ul>

		<ul class="form-options contained-forms" id="layout_options">
			<?php layout_form($theme_options[$use_layout_option]); ?>
		</ul>
<?php
}
function layout_form($use_form){ ?>
	<?php foreach($use_form as $form_item) : ?>
		<li>
			<?php if(isset($form_item["main_section"])) : ?>
				<label class="parent-label"><?php $form_item["main_section"] ;?></label>
				<div class="form-wrap">
					<?php if(is_array($form_item["sub_elements"])) :
							foreach($form_item["sub_elements"] as $sub_input) : ?>
							 <?php if(isset($sub_input["show_if"]) && ( $sub_input["show_if"] && get_option($sub_input["show_if"]["id"]) !== $sub_input["show_if"]["value"]) ) : $class="no_display"; else : $class=""; endif; ?>
							<div id="<?php echo $sub_input["id"]; ?>_div" class="child-form <?php echo $class; ?>">
								<label class="child-label"><?php echo $sub_input["label"]; ?></label>

								<?php create_form($sub_input, count($form_item), ""); ?>

								<?php if($sub_input["description"] !== "") : ?>
									<span class="tooltip"><?php echo $sub_input["description"]; ?></span>
								<?php endif; ?>
							</div>
						<?php endforeach;
					endif;?>
					<?php if(isset($form_item["main_image"])) : ?>
						<div class="child-form">
							<label class="child-label"></label>
							<img src="<?php echo $form_item["main_image"]; ?>" />
						</div>
					<?php endif; ?>
				</div>
			<?php else : ?>
				<label class="parent-label"><?php $form_item["label"]; ?></label>
				<div class="form-wrap">
					<?php if(!isset($label_class))
							$label_class = "";
						create_form($form_item, count($form_item), $label_class); ?>
					<?php if(isset($form_item["description"]) && $form_item["description"] !== "") : ?>
						<span class="tooltip"><?php $form_item["description"]; ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
<?php }
add_action("ocmx_layout_options", "ocmx_layout_options");
add_action("ocmx_layout_form", "layout_form"); ?>