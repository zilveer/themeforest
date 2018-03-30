<?php $canon_options_frame = get_option('canon_options_frame'); ?>

        	<div class="outter-wrapper post-footer feature">
                <div class="wrapper">
                    <div class="clearfix">

                        <div class="foot left"><?php echo $canon_options_frame['footer_text'] ?></div>  

            			<div class="foot right">

                            <?php 

                                if ($canon_options_frame['show_social_icons'] == "checked") {

                                    get_template_part('inc/templates/header/template_header_element_social'); 
                                    
                                }

                            ?>
                            
            			</div>

            		</div>
                </div>
        	</div>


