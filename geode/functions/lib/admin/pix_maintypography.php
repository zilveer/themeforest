<?php

function main_typography(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='main_typography') {
    
    $selected_font = get_option('pix_style_fonts_w_variants');
?>

        <section id="pix_content_loaded">
            <h3><?php _e('Typography','geode'); ?>: <small><?php _e('Main typography','geode'); ?></small></h3>

            <?php if (get_option('pix_content_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">
            <?php } ?>
                        

                <div class="pix_columns cf">

                    <h4 class="section_title active"><span>General font</span></h4>

                    <div class="admin-section-toggle visible">
                        <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                        <div class="pix_column alignleft">

                            <label for="pix_style_body_color"><?php _e('Text color','geode'); ?>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_body_color" type="text" value="<?php echo esc_attr(get_option('pix_style_body_color')); ?>" name="pix_style_body_color" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <div class="pix_group">
                                <label><?php _e('Preview','geode'); ?>:</label>
                                <input type="text" class="font_preview" disable="disable" value="abcdABCD0123456789">

                                <label for="pix_style_body_fontfamily" class="for_select for_font_family"><?php _e('Font family','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_body_fontfamily" name="pix_style_body_fontfamily">
                                            <option value="" <?php selected(get_option('pix_style_body_fontfamily'),''); ?> data-webfont=""><?php _e('Not a Google font', 'geode'); ?></option>
                                            <?php
                                                foreach ( $selected_font as $fontfamily => $value )
                                                { ?>
                                                <option value="<?php echo $fontfamily; ?>" data-webfont="<?php echo str_replace(' ','+',$fontfamily); ?>" <?php selected(get_option('pix_style_body_fontfamily'),$fontfamily); ?>><?php echo $fontfamily; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_body_fontvariant" class="for_select for_font_variant"><?php _e('Font variant','geode'); ?> <small><a href="#" data-dialog="<?php _e('Only to determine the font weight, the font style will be regular by default and editable through CSS or from the text editor.','geode'); ?>"><?php _e('more info','geode'); ?></a></small>:
                                    <span class="for_select">
                                        <select id="pix_style_body_fontvariant" name="pix_style_body_fontvariant">
                                            <?php
                                                foreach ( $selected_font[get_option('pix_style_body_fontfamily')]['variants'] as $fontvariant )
                                                { ?>
                                                <option value="<?php echo $fontvariant; ?>" <?php selected(get_option('pix_style_body_fontvariant'),$fontvariant); ?>><?php echo $fontvariant; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_body_fontsubset" class="for_select for_font_subset"><?php _e('Font subset','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_body_fontsubset" name="pix_style_body_fontsubset">
                                            <?php
                                                foreach ( $selected_font[get_option('pix_style_body_fontfamily')]['subsets'] as $fontsubset )
                                                { ?>
                                                <option value="<?php echo $fontsubset; ?>" <?php selected(get_option('pix_style_body_fontsubset'),$fontsubset); ?>><?php echo $fontsubset; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_body_fontsize"><?php _e('Font size (in pixels)', 'geode'); ?>:</label>
                                <div class="slider_div">
                                    <input id="pix_style_body_fontsize" name="pix_style_body_fontsize" type="text" value="<?php echo esc_attr(get_option('pix_style_body_fontsize')); ?>">
                                    <div class="slider_cursor"></div>
                                </div><!-- .slider_div -->

                            </div><!-- .pix_group -->

                        </div><!-- .pix_column.first -->
                        <div class="pix_column alignright">

                            <label><?php _e('Alternative font','geode'); ?>:</label>

                            <div class="pix_group">
                                <label><?php _e('Preview','geode'); ?>:</label>
                                <input type="text" class="font_preview" disable="disable" value="abcdABCD0123456789">

                                <label for="pix_style_alternative_fontfamily" class="for_select for_font_family"><?php _e('Font family','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_alternative_fontfamily" name="pix_style_alternative_fontfamily">
                                            <option value="" <?php selected(get_option('pix_style_alternative_fontfamily'),''); ?> data-webfont=""><?php _e('Not a Google font', 'geode'); ?></option>
                                            <?php
                                                foreach ( $selected_font as $fontfamily => $value )
                                                { ?>
                                                <option value="<?php echo $fontfamily; ?>" data-webfont="<?php echo str_replace(' ','+',$fontfamily); ?>" <?php selected(get_option('pix_style_alternative_fontfamily'),$fontfamily); ?>><?php echo $fontfamily; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_alternative_fontvariant" class="for_select for_font_variant"><?php _e('Font variant','geode'); ?> <small><a href="#" data-dialog="<?php _e('Only to determine the font weight, the font style will be regular by default and editable through CSS or from the text editor.','geode'); ?>"><?php _e('more info','geode'); ?></a></small>:
                                    <span class="for_select">
                                        <select id="pix_style_alternative_fontvariant" name="pix_style_alternative_fontvariant">
                                            <?php
                                                foreach ( $selected_font[get_option('pix_style_alternative_fontfamily')]['variants'] as $fontvariant )
                                                { ?>
                                                <option value="<?php echo $fontvariant; ?>" <?php selected(get_option('pix_style_alternative_fontvariant'),$fontvariant); ?>><?php echo $fontvariant; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_alternative_fontsubset" class="for_select for_font_subset"><?php _e('Font subset','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_alternative_fontsubset" name="pix_style_alternative_fontsubset">
                                            <?php
                                                foreach ( $selected_font[get_option('pix_style_alternative_fontfamily')]['subsets'] as $fontsubset )
                                                { ?>
                                                <option value="<?php echo $fontsubset; ?>" <?php selected(get_option('pix_style_alternative_fontsubset'),$fontsubset); ?>><?php echo $fontsubset; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_alternative_fontsize"><?php _e('Font size (in ems)', 'geode'); ?>:</label>
                                <div class="slider_div em">
                                    <input id="pix_style_alternative_fontsize" name="pix_style_alternative_fontsize" type="text" value="<?php echo esc_attr(get_option('pix_style_alternative_fontsize')); ?>">
                                    <div class="slider_cursor"></div>
                                </div><!-- .slider_div -->

                            </div><!-- .pix_group -->

                        </div><!-- .pix_column.second -->

                    </div><!-- .admin-section-toggle -->

                    <h4 class="section_title"><span>Single post</span></h4>

                    <div class="admin-section-toggle">
                        <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                        <div class="pix_column alignleft">

                            <label><?php _e('Single post font','geode'); ?>:</label>

                            <div class="pix_group">
                                <label><?php _e('Preview','geode'); ?>:</label>
                                <input type="text" class="font_preview" disable="disable" value="abcdABCD0123456789">

                                <label for="pix_style_single_fontfamily" class="for_select for_font_family"><?php _e('Font family','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_single_fontfamily" name="pix_style_single_fontfamily">
                                            <option value="" <?php selected(get_option('pix_style_single_fontfamily'),''); ?> data-webfont=""><?php _e('Not a Google font', 'geode'); ?></option>
                                            <?php
                                                foreach ( $selected_font as $fontfamily => $value )
                                                { ?>
                                                <option value="<?php echo $fontfamily; ?>" data-webfont="<?php echo str_replace(' ','+',$fontfamily); ?>" <?php selected(get_option('pix_style_single_fontfamily'),$fontfamily); ?>><?php echo $fontfamily; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_single_fontvariant" class="for_select for_font_variant"><?php _e('Font variant','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_single_fontvariant" name="pix_style_single_fontvariant">
                                            <?php
                                                foreach ( $selected_font[get_option('pix_style_single_fontfamily')]['variants'] as $fontvariant )
                                                { ?>
                                                <option value="<?php echo $fontvariant; ?>" <?php selected(get_option('pix_style_single_fontvariant'),$fontvariant); ?>><?php echo $fontvariant; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_single_fontsize"><?php _e('Font size (in ems)', 'geode'); ?>:</label>
                                <div class="slider_div em">
                                    <input id="pix_style_single_fontsize" name="pix_style_single_fontsize" type="text" value="<?php echo esc_attr(get_option('pix_style_single_fontsize')); ?>">
                                    <div class="slider_cursor"></div>
                                </div><!-- .slider_div -->
                                <br>

                            </div><!-- .pix_group -->

                        </div><!-- .pix_column.first -->
                        <div class="pix_column alignright">

                        </div><!-- .pix_column.second -->

                    </div><!-- .admin-section-toggle -->

                    <h4 class="section_title"><span>Heading 1</span></h4>

                    <div class="admin-section-toggle">
                        <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                        <div class="pix_column alignleft">

                            <label><?php _e('Heading 1 font','geode'); ?>:</label>

                            <div class="pix_group">
                                <label><?php _e('Preview','geode'); ?>:</label>
                                <input type="text" class="font_preview" disable="disable" value="abcdABCD0123456789">

                                <label for="pix_style_h1_fontfamily" class="for_select for_font_family"><?php _e('Font family','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_h1_fontfamily" name="pix_style_h1_fontfamily">
                                            <option value="" <?php selected(get_option('pix_style_h1_fontfamily'),''); ?> data-webfont=""><?php _e('Not a Google font', 'geode'); ?></option>
                                            <?php
                                                foreach ( $selected_font as $fontfamily => $value )
                                                { ?>
                                                <option value="<?php echo $fontfamily; ?>" data-webfont="<?php echo str_replace(' ','+',$fontfamily); ?>" <?php selected(get_option('pix_style_h1_fontfamily'),$fontfamily); ?>><?php echo $fontfamily; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_h1_fontvariant" class="for_select for_font_variant"><?php _e('Font variant','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_h1_fontvariant" name="pix_style_h1_fontvariant">
                                            <?php
                                                foreach ( $selected_font[get_option('pix_style_h1_fontfamily')]['variants'] as $fontvariant )
                                                { ?>
                                                <option value="<?php echo $fontvariant; ?>" <?php selected(get_option('pix_style_h1_fontvariant'),$fontvariant); ?>><?php echo $fontvariant; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_h1_fontsize"><?php _e('Font size (in ems)', 'geode'); ?>:</label>
                                <div class="slider_div em">
                                    <input id="pix_style_h1_fontsize" name="pix_style_h1_fontsize" type="text" value="<?php echo esc_attr(get_option('pix_style_h1_fontsize')); ?>">
                                    <div class="slider_cursor"></div>
                                </div><!-- .slider_div -->
                                <br>

                            </div><!-- .pix_group -->

                        </div><!-- .pix_column.first -->
                        <div class="pix_column alignright">

                            <label for="pix_style_h1_color"><?php _e('Text color','geode'); ?> <small><?php _e('(leave blank to inherit the general text color)','geode'); ?></small>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_h1_color" type="text" value="<?php echo esc_attr(get_option('pix_style_h1_color')); ?>" name="pix_style_h1_color" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_h1_css"><?php _e( 'Custom styles', 'shortcodelic' ); ?>:</label>
                            <textarea name="pix_style_h1_css" id="pix_style_h1_css" class="codemirror"><?php echo esc_attr(get_option('pix_style_h1_css')); ?></textarea>
                            <br>

                        </div><!-- .pix_column.second -->

                    </div><!-- .admin-section-toggle -->

                    <h4 class="section_title"><span>Heading 2</span></h4>

                    <div class="admin-section-toggle">
                        <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                        <div class="pix_column alignleft">

                            <label><?php _e('Heading 2 font','geode'); ?>:</label>

                            <div class="pix_group">
                                <label><?php _e('Preview','geode'); ?>:</label>
                                <input type="text" class="font_preview" disable="disable" value="abcdABCD0123456789">

                                <label for="pix_style_h2_fontfamily" class="for_select for_font_family"><?php _e('Font family','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_h2_fontfamily" name="pix_style_h2_fontfamily">
                                            <option value="" <?php selected(get_option('pix_style_h2_fontfamily'),''); ?> data-webfont=""><?php _e('Not a Google font', 'geode'); ?></option>
                                            <?php
                                                foreach ( $selected_font as $fontfamily => $value )
                                                { ?>
                                                <option value="<?php echo $fontfamily; ?>" data-webfont="<?php echo str_replace(' ','+',$fontfamily); ?>" <?php selected(get_option('pix_style_h2_fontfamily'),$fontfamily); ?>><?php echo $fontfamily; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_h2_fontvariant" class="for_select for_font_variant"><?php _e('Font variant','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_h2_fontvariant" name="pix_style_h2_fontvariant">
                                            <?php
                                                foreach ( $selected_font[get_option('pix_style_h2_fontfamily')]['variants'] as $fontvariant )
                                                { ?>
                                                <option value="<?php echo $fontvariant; ?>" <?php selected(get_option('pix_style_h2_fontvariant'),$fontvariant); ?>><?php echo $fontvariant; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_h2_fontsize"><?php _e('Font size (in ems)', 'geode'); ?>:</label>
                                <div class="slider_div em">
                                    <input id="pix_style_h2_fontsize" name="pix_style_h2_fontsize" type="text" value="<?php echo esc_attr(get_option('pix_style_h2_fontsize')); ?>">
                                    <div class="slider_cursor"></div>
                                </div><!-- .slider_div -->
                                <br>

                            </div><!-- .pix_group -->

                        </div><!-- .pix_column.first -->
                        <div class="pix_column alignright">

                            <label for="pix_style_h2_color"><?php _e('Text color','geode'); ?> <small><?php _e('(leave blank to inherit the general text color)','geode'); ?></small>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_h2_color" type="text" value="<?php echo esc_attr(get_option('pix_style_h2_color')); ?>" name="pix_style_h2_color" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_h2_css"><?php _e( 'Custom styles', 'shortcodelic' ); ?>:</label>
                            <textarea name="pix_style_h2_css" id="pix_style_h2_css" class="codemirror"><?php echo esc_attr(get_option('pix_style_h2_css')); ?></textarea>
                            <br>

                        </div><!-- .pix_column.second -->

                    </div><!-- .admin-section-toggle -->

                    <h4 class="section_title"><span>Heading 3</span></h4>

                    <div class="admin-section-toggle">
                        <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                        <div class="pix_column alignleft">

                            <label><?php _e('Heading 3 font','geode'); ?>:</label>

                            <div class="pix_group">
                                <label><?php _e('Preview','geode'); ?>:</label>
                                <input type="text" class="font_preview" disable="disable" value="abcdABCD0123456789">

                                <label for="pix_style_h3_fontfamily" class="for_select for_font_family"><?php _e('Font family','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_h3_fontfamily" name="pix_style_h3_fontfamily">
                                            <option value="" <?php selected(get_option('pix_style_h3_fontfamily'),''); ?> data-webfont=""><?php _e('Not a Google font', 'geode'); ?></option>
                                            <?php
                                                foreach ( $selected_font as $fontfamily => $value )
                                                { ?>
                                                <option value="<?php echo $fontfamily; ?>" data-webfont="<?php echo str_replace(' ','+',$fontfamily); ?>" <?php selected(get_option('pix_style_h3_fontfamily'),$fontfamily); ?>><?php echo $fontfamily; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_h3_fontvariant" class="for_select for_font_variant"><?php _e('Font variant','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_h3_fontvariant" name="pix_style_h3_fontvariant">
                                            <?php
                                                foreach ( $selected_font[get_option('pix_style_h3_fontfamily')]['variants'] as $fontvariant )
                                                { ?>
                                                <option value="<?php echo $fontvariant; ?>" <?php selected(get_option('pix_style_h3_fontvariant'),$fontvariant); ?>><?php echo $fontvariant; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_h3_fontsize"><?php _e('Font size (in ems)', 'geode'); ?>:</label>
                                <div class="slider_div em">
                                    <input id="pix_style_h3_fontsize" name="pix_style_h3_fontsize" type="text" value="<?php echo esc_attr(get_option('pix_style_h3_fontsize')); ?>">
                                    <div class="slider_cursor"></div>
                                </div><!-- .slider_div -->
                                <br>

                            </div><!-- .pix_group -->

                        </div><!-- .pix_column.first -->
                        <div class="pix_column alignright">

                            <label for="pix_style_h3_color"><?php _e('Text color','geode'); ?> <small><?php _e('(leave blank to inherit the general text color)','geode'); ?></small>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_h3_color" type="text" value="<?php echo esc_attr(get_option('pix_style_h3_color')); ?>" name="pix_style_h3_color" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_h3_css"><?php _e( 'Custom styles', 'shortcodelic' ); ?>:</label>
                            <textarea name="pix_style_h3_css" id="pix_style_h3_css" class="codemirror"><?php echo esc_attr(get_option('pix_style_h3_css')); ?></textarea>
                            <br>

                        </div><!-- .pix_column.second -->

                    </div><!-- .admin-section-toggle -->

                    <h4 class="section_title"><span>Heading 4</span></h4>

                    <div class="admin-section-toggle">
                        <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                        <div class="pix_column alignleft">

                            <label><?php _e('Heading 4 font','geode'); ?>:</label>

                            <div class="pix_group">
                                <label><?php _e('Preview','geode'); ?>:</label>
                                <input type="text" class="font_preview" disable="disable" value="abcdABCD0123456789">

                                <label for="pix_style_h4_fontfamily" class="for_select for_font_family"><?php _e('Font family','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_h4_fontfamily" name="pix_style_h4_fontfamily">
                                            <option value="" <?php selected(get_option('pix_style_h4_fontfamily'),''); ?> data-webfont=""><?php _e('Not a Google font', 'geode'); ?></option>
                                            <?php
                                                foreach ( $selected_font as $fontfamily => $value )
                                                { ?>
                                                <option value="<?php echo $fontfamily; ?>" data-webfont="<?php echo str_replace(' ','+',$fontfamily); ?>" <?php selected(get_option('pix_style_h4_fontfamily'),$fontfamily); ?>><?php echo $fontfamily; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_h4_fontvariant" class="for_select for_font_variant"><?php _e('Font variant','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_h4_fontvariant" name="pix_style_h4_fontvariant">
                                            <?php
                                                foreach ( $selected_font[get_option('pix_style_h4_fontfamily')]['variants'] as $fontvariant )
                                                { ?>
                                                <option value="<?php echo $fontvariant; ?>" <?php selected(get_option('pix_style_h4_fontvariant'),$fontvariant); ?>><?php echo $fontvariant; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_h4_fontsize"><?php _e('Font size (in ems)', 'geode'); ?>:</label>
                                <div class="slider_div em">
                                    <input id="pix_style_h4_fontsize" name="pix_style_h4_fontsize" type="text" value="<?php echo esc_attr(get_option('pix_style_h4_fontsize')); ?>">
                                    <div class="slider_cursor"></div>
                                </div><!-- .slider_div -->
                                <br>

                            </div><!-- .pix_group -->

                        </div><!-- .pix_column.first -->
                        <div class="pix_column alignright">

                            <label for="pix_style_h4_color"><?php _e('Text color','geode'); ?> <small><?php _e('(leave blank to inherit the general text color)','geode'); ?></small>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_h4_color" type="text" value="<?php echo esc_attr(get_option('pix_style_h4_color')); ?>" name="pix_style_h4_color" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_h4_css"><?php _e( 'Custom styles', 'shortcodelic' ); ?>:</label>
                            <textarea name="pix_style_h4_css" id="pix_style_h4_css" class="codemirror"><?php echo esc_attr(get_option('pix_style_h4_css')); ?></textarea>
                            <br>

                        </div><!-- .pix_column.second -->

                    </div><!-- .admin-section-toggle -->

                    <h4 class="section_title"><span>Heading 5</span></h4>

                    <div class="admin-section-toggle">
                        <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                        <div class="pix_column alignleft">

                            <label><?php _e('Heading 5 font','geode'); ?>:</label>

                            <div class="pix_group">
                                <label><?php _e('Preview','geode'); ?>:</label>
                                <input type="text" class="font_preview" disable="disable" value="abcdABCD0123456789">

                                <label for="pix_style_h5_fontfamily" class="for_select for_font_family"><?php _e('Font family','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_h5_fontfamily" name="pix_style_h5_fontfamily">
                                            <option value="" <?php selected(get_option('pix_style_h5_fontfamily'),''); ?> data-webfont=""><?php _e('Not a Google font', 'geode'); ?></option>
                                            <?php
                                                foreach ( $selected_font as $fontfamily => $value )
                                                { ?>
                                                <option value="<?php echo $fontfamily; ?>" data-webfont="<?php echo str_replace(' ','+',$fontfamily); ?>" <?php selected(get_option('pix_style_h5_fontfamily'),$fontfamily); ?>><?php echo $fontfamily; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_h5_fontvariant" class="for_select for_font_variant"><?php _e('Font variant','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_h5_fontvariant" name="pix_style_h5_fontvariant">
                                            <?php
                                                foreach ( $selected_font[get_option('pix_style_h5_fontfamily')]['variants'] as $fontvariant )
                                                { ?>
                                                <option value="<?php echo $fontvariant; ?>" <?php selected(get_option('pix_style_h5_fontvariant'),$fontvariant); ?>><?php echo $fontvariant; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_h5_fontsize"><?php _e('Font size (in ems)', 'geode'); ?>:</label>
                                <div class="slider_div em">
                                    <input id="pix_style_h5_fontsize" name="pix_style_h5_fontsize" type="text" value="<?php echo esc_attr(get_option('pix_style_h5_fontsize')); ?>">
                                    <div class="slider_cursor"></div>
                                </div><!-- .slider_div -->
                                <br>

                            </div><!-- .pix_group -->

                        </div><!-- .pix_column.first -->
                        <div class="pix_column alignright">

                            <label for="pix_style_h5_color"><?php _e('Text color','geode'); ?> <small><?php _e('(leave blank to inherit the general text color)','geode'); ?></small>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_h5_color" type="text" value="<?php echo esc_attr(get_option('pix_style_h5_color')); ?>" name="pix_style_h5_color" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_h5_css"><?php _e( 'Custom styles', 'shortcodelic' ); ?>:</label>
                            <textarea name="pix_style_h5_css" id="pix_style_h5_css" class="codemirror"><?php echo esc_attr(get_option('pix_style_h5_css')); ?></textarea>
                            <br>

                        </div><!-- .pix_column.second -->

                    </div><!-- .admin-section-toggle -->

                    <h4 class="section_title"><span>Heading 6</span></h4>

                    <div class="admin-section-toggle">
                        <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                        <div class="pix_column alignleft">

                            <label><?php _e('Heading 6 font','geode'); ?>:</label>

                            <div class="pix_group">
                                <label><?php _e('Preview','geode'); ?>:</label>
                                <input type="text" class="font_preview" disable="disable" value="abcdABCD0123456789">

                                <label for="pix_style_h6_fontfamily" class="for_select for_font_family"><?php _e('Font family','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_h6_fontfamily" name="pix_style_h6_fontfamily">
                                            <option value="" <?php selected(get_option('pix_style_h6_fontfamily'),''); ?> data-webfont=""><?php _e('Not a Google font', 'geode'); ?></option>
                                            <?php
                                                foreach ( $selected_font as $fontfamily => $value )
                                                { ?>
                                                <option value="<?php echo $fontfamily; ?>" data-webfont="<?php echo str_replace(' ','+',$fontfamily); ?>" <?php selected(get_option('pix_style_h6_fontfamily'),$fontfamily); ?>><?php echo $fontfamily; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_h6_fontvariant" class="for_select for_font_variant"><?php _e('Font variant','geode'); ?>:
                                    <span class="for_select">
                                        <select id="pix_style_h6_fontvariant" name="pix_style_h6_fontvariant">
                                            <?php
                                                foreach ( $selected_font[get_option('pix_style_h6_fontfamily')]['variants'] as $fontvariant )
                                                { ?>
                                                <option value="<?php echo $fontvariant; ?>" <?php selected(get_option('pix_style_h6_fontvariant'),$fontvariant); ?>><?php echo $fontvariant; ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </span>
                                </label>
                                <label for="pix_style_h6_fontsize"><?php _e('Font size (in ems)', 'geode'); ?>:</label>
                                <div class="slider_div em">
                                    <input id="pix_style_h6_fontsize" name="pix_style_h6_fontsize" type="text" value="<?php echo esc_attr(get_option('pix_style_h6_fontsize')); ?>">
                                    <div class="slider_cursor"></div>
                                </div><!-- .slider_div -->
                                <br>

                            </div><!-- .pix_group -->

                        </div><!-- .pix_column.first -->
                        <div class="pix_column alignright">

                            <label for="pix_style_h6_color"><?php _e('Text color','geode'); ?> <small><?php _e('(leave blank to inherit the general text color)','geode'); ?></small>:</label>
                            <div class="pix_color_picker">
                                <input id="pix_style_h6_color" type="text" value="<?php echo esc_attr(get_option('pix_style_h6_color')); ?>" name="pix_style_h6_color" >
                                <a class="pix_button" href="#"></a>
                                <div class="colorpicker"></div>
                                <i class="scicon-iconic-cancel"></i>
                            </div>
                            <br>

                            <label for="pix_style_h6_css"><?php _e( 'Custom styles', 'shortcodelic' ); ?>:</label>
                            <textarea name="pix_style_h6_css" id="pix_style_h6_css" class="codemirror"><?php echo esc_attr(get_option('pix_style_h6_css')); ?></textarea>
                            <br>

                        </div><!-- .pix_column.second -->

                    </div><!-- .admin-section-toggle -->

                </div><!-- .pix_columns -->

                <div class="clear"></div>

                <input type="hidden" name="action" value="data_save" />
                <input type="hidden" name="geode_security" value="<?php echo wp_create_nonce('geode_data'); ?>" />
                <button type="submit" class="pix-save-options pix_button fake_button alignright"><?php _e('Save options','geode'); ?><i class="scicon-awesome-ok"></i></button>
                <button type="submit" class="pix-save-options pix_button fake_button2 alignright"><?php _e('Save options','geode'); ?><i class="scicon-awesome-ok"></i></button>
                <button type="submit" class="pix-save-options pix_button alignright"><?php _e('Save options','geode'); ?><i class="scicon-awesome-ok"></i></button>
                <div id="gradient-save-button"></div>

            </form><!-- .dynamic_form -->

        </section><!-- #pix_content_loaded -->
</div>


<?php }
} ?>