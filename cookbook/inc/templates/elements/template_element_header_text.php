<?php
    
    // GET OPTIONS
    $canon_options_frame = get_option('canon_options_frame');

?>

                                    <div class="header_text">
                                        
                                        <?php echo wp_kses_post($canon_options_frame['header_text']); ?>

                                    </div>
