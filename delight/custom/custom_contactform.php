<div class="my_meta_control meta_hidden" id="contactform_generator">

    <div class="block_separator multifields shortcode_selector">
    
            <?php $mb->the_field('contactformcode'); ?>
            <input type="hidden" name="<?php $mb->the_name(); ?>" value="" />
			<?php $mb->the_field('form'); ?>
            <label for="<?php $mb->the_name(); ?>">Select a form: <a href="javascript:;" class="info_icon" title="To create a form go to Delight -> Contacts">&nbsp;</a></label>
            	<select name="<?php $mb->the_name(); ?>" style="width:98%">
                	<?php 
						$i = 0;
						$pix_array_your_forms = get_pix_option('pix_array_your_forms_');
						while($i<count($pix_array_your_forms)){ ?>
                            <option value="<?php echo sanitize_title($pix_array_your_forms[$i]); ?>"><?php echo $pix_array_your_forms[$i]; ?></option>
							<?php $i++;
						} 
					?>

            </select>
    </div><!-- .block_separator -->    
    <input type="button" class="button-primary alignright" value="Insert shortcode" />

</div><!-- .my_meta_control -->
