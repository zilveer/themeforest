<?php 

    $cmb_post_info_title = get_post_meta($post->ID, 'cmb_post_info_title', true);
    $cmb_post_show_info_meta = get_post_meta($post->ID, 'cmb_post_show_info_meta', true);
    $cmb_post_info_meta = get_post_meta($post->ID, 'cmb_post_info_meta', true);
    $cmb_post_show_info_ul = get_post_meta($post->ID, 'cmb_post_show_info_ul', true);
    $cmb_post_info_ul_title = get_post_meta($post->ID, 'cmb_post_info_ul_title', true);
    $cmb_post_info_ul= get_post_meta($post->ID, 'cmb_post_info_ul', true);
    $cmb_post_show_info_ol = get_post_meta($post->ID, 'cmb_post_show_info_ol', true);
    $cmb_post_info_ol_title = get_post_meta($post->ID, 'cmb_post_info_ol_title', true);
    $cmb_post_info_ol= get_post_meta($post->ID, 'cmb_post_info_ol', true);
    $cmb_post_info_extra_title = get_post_meta($post->ID, 'cmb_post_info_extra_title', true);
    $cmb_post_info_extra_text = get_post_meta($post->ID, 'cmb_post_info_extra_text', true);

 ?>

                    <div class="tc-info-box">

                        <div class="info-box-header">

                            <a href="#" onclick="window.print();return false;" class="tc-info-box-print"><i class="fa fa-print"></i></a>
                            
                            <h2><?php echo esc_attr($cmb_post_info_title); ?></h2>

                        </div>

                        <?php

                            // INFO BOX META
                            if ($cmb_post_show_info_meta == "checked") {
                                
                                echo '<div class="tc-info-box-meta">';
                                for ($i = 0; $i < count($cmb_post_info_meta); $i++) {  
                                    if (!empty($cmb_post_info_meta[$i]['label']) || !empty($cmb_post_info_meta[$i]['text'])) {
                                        printf('<h5>%s: <span>%s</span></h5>', esc_attr($cmb_post_info_meta[$i]['label']), esc_attr($cmb_post_info_meta[$i]['text']));
                                    }
                                }
                                echo '</div>';
                            }

                            // INFO BOX UNORDERED LIST
                            if ($cmb_post_show_info_ul == "checked") {

                                if (!empty($cmb_post_info_ul_title)) { printf('<h4>%s</h4>', esc_attr($cmb_post_info_ul_title)); }

                                echo '<ul class="tc-info-box-ul">';
                                for ($i = 0; $i < count($cmb_post_info_ul); $i++) {  
                                    printf('<li>%s</li>', esc_attr($cmb_post_info_ul[$i]['text']));
                                }
                                echo '</ul>';
                            }


                            // INFO BOX ORDERED LIST
                            if ($cmb_post_show_info_ol == "checked") {

                                if (!empty($cmb_post_info_ol_title)) { printf('<h4>%s</h4>', esc_attr($cmb_post_info_ol_title)); }

                                echo '<ol class="tc-info-box-ol">';
                                for ($i = 0; $i < count($cmb_post_info_ol); $i++) {  
                                    printf('<li>%s</li>', esc_attr($cmb_post_info_ol[$i]['text']));
                                }
                                echo '</ol>';
                            }


                            // INFO BOX EXTRA 
                            if (!empty($cmb_post_info_extra_title) || !empty($cmb_post_info_extra_text)) {

                                echo '<div class="tc-info-box-extra">';
                                if (!empty($cmb_post_info_extra_title)) { printf('<h4>%s</h4>', esc_attr($cmb_post_info_extra_title)); }
                                if (!empty($cmb_post_info_extra_text)) { printf('<div class="tc-info-box-extra-content">%s</div>', do_shortcode(wp_kses_post($cmb_post_info_extra_text))); }
                                echo '</div>';
                            }

                        ?>
                        
                    </div>



