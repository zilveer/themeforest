<?php
    
    // GET OPTIONS
    $canon_options_frame = get_option('canon_options_frame');

?>

									<ul class="social-link">

                                        <?php 

                                            for ($i = 0; $i < count($canon_options_frame['social_links']); $i++) {  
                                            ?>
                                                <li><a href="<?php echo $canon_options_frame['social_links'][$i][1]; ?>" <?php if ($canon_options_frame['social_in_new'] == 'checked') { echo "target='_blank'"; } ?>><em class="fa <?php echo $canon_options_frame['social_links'][$i][0]; ?>"></em></a></li>
                                            <?php
                                            }
                                        ?>

                                    </ul>
