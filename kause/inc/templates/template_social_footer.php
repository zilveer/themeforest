<?php $canon_options = get_option('canon_options'); ?>

        	<footer class="outter-wrapper feature">
                <div class="wrapper">
                    <div class="clearfix">

                        <div class="foot left"><?php echo $canon_options['footer_text'] ?></div>  

            			<div class="foot right">

                            <?php 

                                if ($canon_options['show_social_icons'] == "checked") {
                                ?>
                                
                                    <ul class="social-link">

                                        <?php 

                                            for ($i = 0; $i < count($canon_options['social_links']); $i++) {  
                                            ?>
                                                <li><a target="_blank" href="<?php echo $canon_options['social_links'][$i][1]; ?>"><em class="fa <?php echo $canon_options['social_links'][$i][0]; ?>"></em></a></li>
                                            <?php
                                            }
                                        ?>

                                    </ul>


                                <?php     
                                }

                            ?>
                            
            			</div>

            		</div>
                </div>
        	</footer>


