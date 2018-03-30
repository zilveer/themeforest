<?php 

	$canon_options_frame = get_option('canon_options_frame'); 

	$home_url = home_url();

?>

                                        <?php 
                                            if (!empty($canon_options_frame['logo_text'])) {
			                                    echo '<div class="logo logo-text">';
                                                echo "<a href='$home_url'>";
                                                echo wp_kses_post($canon_options_frame['logo_text']);
                                                echo '</a>';
                                                echo '</div>';
                                            } elseif (!empty($canon_options_frame['logo_url'])) {
			                                    echo '<div class="logo logo-img">';
                                                echo "<a href='$home_url'><img src='". $canon_options_frame["logo_url"] ."'' alt='Logo'></a>";
                                                echo '</div>';
                                            } else {
			                                    echo '<div class="logo logo-img logo-default">';
                                                echo "<a href='$home_url'><img src='". get_template_directory_uri() ."/img/logo-black.png' alt='Logo'></a>";
                                                echo '</div>';
                                            }
                                        ?>