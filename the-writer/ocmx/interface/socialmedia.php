<?php function ocmx_socials_options($input)
	{	
		global $counter, $label_class;
		
		if($input) : ?>
        	<li class="icon-block-item">
                <div class="admin-content">
         
					<ul class="icon-options">
						<?php foreach($input["sub_elements"] as $sub_input) : ?>
                       
                        	<?php create_form($sub_input, count($input), "child-form"); ?>         
                            
                        <?php endforeach; ?>
                    </ul>

                </div>
            </li>
		<?php endif;
	}
	
add_action("ocmx_socials_options", "ocmx_socials_options"); ?>