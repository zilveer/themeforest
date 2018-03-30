<?php
function fetch_options($input)
	{
		global $counter, $label_class;

		if($input) : ?>
				<li class="admin-block-item">
					<div class="admin-description">
						<?php if(isset($input["main_section"])) : ?>
							<h4><?php echo $input["main_section"];?></h4>
							<?php if($input["main_description"] !== "") : ?>
								<p><?php echo $input["main_description"];?></p>
							<?php endif; ?>
						<?php else : ?>
							<h4><?php echo $input["label"];?></h4>
							<?php if($input['description'] !== "") : ?>
								<p><?php echo $input["description"];?></p>
							<?php endif; ?>
						<?php endif; ?>
					</div>
					<div class="admin-content">
						<?php if(isset($input["main_section"])) : ?>
							<ul class="form-options contained-forms">
								<?php foreach($input["sub_elements"] as $sub_input) : ?>
									<li>
										<?php if($sub_input["input_type"] == "checkbox") : ?>
											<div class="form-wrap checkboxes">
												<?php create_form($sub_input, count($input), "child-form"); ?>
												<label class="child-label"><?php echo $sub_input["label"]; ?></label>
											</div>
										<?php else : ?>
											<h4><?php echo $sub_input["label"]; ?></h4>
											<div class="form-wrap">
												<?php create_form($sub_input, count($input), "child-form"); ?>
											</div>
										<?php endif; ?>
										<?php if(isset($sub_input["description"]) && $sub_input["description"] !== "") : ?>
											<span class="tooltip"><?php echo $sub_input["description"]; ?></span>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php else :
							create_form($input, count($input), $label_class);
						endif; ?>
					</div>
				</li>
		<?php endif;
	}
add_action("ocmx_fetch_options", "fetch_options"); ?>