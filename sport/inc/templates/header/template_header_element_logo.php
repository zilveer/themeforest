<?php
    
    // GET OPTIONS
    $canon_options_frame = get_option('canon_options_frame');

?>

                                    <div id="header_logo">
                                        <?php 
                                            if (!empty($canon_options_frame['logo_text'])) {
                                                echo '<a href="'. home_url() .'" class="logo-text">';
                                                echo $canon_options_frame['logo_text'];
                                                echo '</a>';
                                            } elseif (!empty($canon_options_frame['logo_url'])) {
                                                echo '<a href="'. home_url() .'" class="logo"><img src="'. $canon_options_frame['logo_url'] .'" alt="Logo"></a>';
                                            } else {
                                                echo '<a href="'. home_url() .'" class="logo"><img src="'. get_template_directory_uri() .'/img/logo@2x.png" alt="Logo"></a>';
                                            }
                                        ?>
                                    </div>
