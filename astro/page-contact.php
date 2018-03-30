<?php
/*
Template Name: Page - Contact
*/
?>
<?php 
    get_header();
    global $retina_device;
    $retina_flag = $retina_device === "prk_retina" ? true : false;
    $show_title=true;
    if (get_field('hide_title')=="1") {
        $show_title=false;
    }
    //OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
    if (INJECT_STYLE)
    {
        include_once(ABSPATH . 'wp-content/plugins/color-manager-astro/style_header.php');    
    }
?>
<div id="centered_block" class="<?php echo get_field('contact_layout'); ?>"> 
<div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
    <?php
        if (get_field('content_type')=='map')
        {
            if (get_field('marker_image')!="")
                $in_image=wp_get_attachment_image_src(get_field('marker_image'),'full');
            else
                $in_image[0]="";
            echo '<div id="google-maps-cover"><div id="google-maps" class="twelve '.get_field('contact_layout').'" data-style="'.get_field('map_style').'" data-zoom="'.get_field('zoom_level').'" data-lat="'.get_field('map_latitude').'" data-long="'.get_field('map_longitude').'" data-marker="'.$in_image[0].'" data-marker_image_lat="'.get_field('marker_image_lat').'" data-marker_image_long="'.get_field('marker_image_long').'" data-map_height="'.get_field('map_height').'">';
            echo '<div class="spinner"><div class="spinner-icon"></div></div>';
            echo '</div></div>';
        }
        else
        {
            if (get_field('map_image')!="") {
                $in_image=wp_get_attachment_image_src(get_field('map_image'),'full');
                $vt_image = vt_resize( '', $in_image[0] , 1920, 1200, false , $retina_flag );
                echo '<div id="contact-image-fth" class="twelve '.get_field('contact_layout').'">';
                echo '<img id="contact-image-cover" src="'.$vt_image['url'].'" data-or_w="'. $vt_image['width'] .'" data-or_h="'. $vt_image['height'] .'" alt="'.prk_get_img_alt($in_image[0]).'" />';
                echo '</div>';
            }
        }
        if (get_field('contact_layout')=="fullscreen")
        {
            if (get_field('slide_panel')=='1')
            {
                $extra_class=" auto_open";
            }
            else
            {
                $extra_class="";
            }
            ?>
                    <div id="contact_info" class="prk_noclose_class<?php echo $extra_class; ?>">
                        <div class="twelve">
                            <?php
                                if ($show_title==true)
                                {
                                    prk_output_title("advanced");
                                }
                            ?>
                            <div class="twelve columns">
                                <div class="twelve columns contact_content">
                                    <?php
                                        while (have_posts()) : the_post();
                                        if (get_the_content()!="")
                                        {
                                            the_content();
                                        }
                                        endwhile;
                                    ?>
                                    <div id="contact_address">
                                        <?php 
                                            if (get_field('show_contact_information')=="1")
                                            {
                                                ?>
                                                <h4 class="header_font bd_headings_text_shadow zero_color">
                                                    <?php echo get_field('contact-info_title'); ?>
                                                </h4>    
                                                <div class="contact_info">
                                                    <?php
                                                        if (get_field('contact-address')!="")
                                                        {
                                                            ?>
                                                            <div class="ctt_address">
                                                                <span>
                                                                    <?php echo get_field('contact-address'); ?>
                                                                </span>
                                                            </div>
                                                            <?php
                                                        }
                                                        if (get_field('contact-info_tel')!="")
                                                        {
                                                            ?>
                                                            <div class="six_margin_bt">
                                                                <h6 class="zero_color header_font big">
                                                                    <?php echo($prk_astro_options['contact-info_tel_h']); ?>
                                                                </h6>
                                                                <div class="block_description">
                                                                    <?php echo get_field('contact-info_tel'); ?>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        if (get_field('contact-info_fax')!="")
                                                        {
                                                            ?>
                                                            <div class="six_margin_bt">
                                                                <h6 class="zero_color header_font big">
                                                                    <?php echo($prk_astro_options['contact-info_fax_h']); ?>
                                                                </h6>
                                                                <div class="block_description">
                                                                    <?php echo get_field('contact-info_fax'); ?>
                                                                
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        if (get_field('contact-info_email')!="")
                                                        {
                                                            ?>
                                                            <div class="six_margin_bt">
                                                                <h6 class="zero_color header_font big">
                                                                    <?php echo($prk_astro_options['contact-info_email_h']); ?> 
                                                                </h6>
                                                                <div class="block_description">
                                                                    <a href="mailto:<?php echo antispambot($prk_astro_options['contact-info_email']); ?>" class="default_color">
                                                                    <?php echo antispambot(get_field('contact-info_email')); ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <?php 
                                        if (get_field('show_contact_form')=="1")
                                        {
                                            ?>
                                            <div id="contact_form">
                                                <h4 class="header_font bd_headings_text_shadow zero_color">
                                                    <?php echo get_field('info_title_form'); ?>
                                                </h4>
                                                <div class="clearfix"></div>
                                                <?php 
                                                    if (get_field('contact-shortcode')!="") 
                                                    {
                                                        echo do_shortcode(get_field('contact-shortcode'));
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                        <form action="#" id="contact-form" method="post" data-empty='<?php echo esc_attr($prk_translations['empty_text_error']); ?>' data-invalid='<?php echo esc_attr($prk_translations['invalid_email_error']); ?>' data-ok='<?php echo esc_attr($prk_translations['contact_ok_text']); ?>' data-name='<?php bloginfo('name'); ?>'>
                                                            <div class="row">
                                                                <div class="six columns">
                                                                    <input type="text" class="pirenko_highlighted" name="c_name" id="c_name" 
                                                                    placeholder="<?php echo esc_attr($prk_translations['comments_author_text']);echo esc_attr($prk_translations['required_text']); ?>"  data-original="<?php echo esc_attr($prk_astro_options['comments_author_text']);echo esc_attr($prk_translations['required_text']); ?>" />
                                                                </div>
                                                                <div class="six columns">
                                                                        <input type="text" class="pirenko_highlighted" name="c_email" id="c_email" size="28"                           placeholder="<?php echo esc_attr($prk_astro_options['comments_email_text']);echo esc_attr($prk_translations['required_text']); ?>"/>
                                                                </div>
                                                                <div class="twelve columns">
                                                                    <input type="text" class="pirenko_highlighted" name="c_subject" id="c_subject" size="28"
                                                                    placeholder="<?php echo esc_attr($prk_translations['contact_subject_text']); ?>" />
                                                                
                                                                    <textarea class="pirenko_highlighted" name="c_message" id="c_message" rows="8"
                                                                    placeholder="<?php echo esc_attr($prk_translations['contact_message_text']); ?>" data-original="<?php echo esc_attr($prk_astro_options['contact_message_text']); ?>" ></textarea>
                                                               
                                                                </div>
                                                            </div>
                                                            <?php
                                                                if (!isset($prk_translations['contact_submit']))
                                                                    $prk_translations['contact_submit']='Send Message';
                                                            ?>
                                                            <input type="hidden" id="full_subject" name="full_subject" value="" />
                                                            <input type="hidden" name="rec_email" value="<?php echo antispambot(get_field('prk_email_address')); ?>" />
                                                            <div id="contact_ok" class="zero_color header_font bd_headings_text_shadow"><?php echo($prk_translations['contact_wait_text']); ?></div>
                                                            <input type="hidden" name="c_submitted" id="c_submitted" value="true" />
                                                            <div class="clearfix"></div>
                                                            <div id="submit_message_div" class="header_font body_text_shadow default_color">
                                                                <a href="#">
                                                                    <div class="left_floated">
                                                                        <?php echo($prk_translations['contact_submit']); ?>
                                                                    </div>
                                                                    <div class="navicon-forward left_floated"></div>
                                                                </a>
                                                            </div>
                                                        </form>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
            <?php
        }
        else
        {
            if ($show_title==true)
            {
                prk_output_title("advanced");
            }
            ?>
            <div id="content">
                <div id="main" class="prk_inner_block columns centered main_no_sections">
                    <div class="twelve">
                        <?php
                            while (have_posts()) : the_post();
                                if (get_the_content()!="")
                                {
                                    ?>
                                    <div class="twelve columns contact_content">
                                        <?php the_content(); ?>
                                    </div>
                                    <?php
                                }
                            endwhile;
                        ?>
                        <div class="clearfix"></div>
                        <div id="contact_lower">
                            <div id="contact_side" class="columns">
                                <div id="contact_address">
                                    <?php 
                                        if (get_field('show_contact_information')=="1")
                                        {
                                            ?>
                                            <h4 class="header_font bd_headings_text_shadow zero_color">
                                                <?php echo get_field('contact-info_title'); ?>
                                            </h4> 
                                            <div class="contact_info">
                                                <?php
                                                    if (get_field('contact-address')!="")
                                                    {
                                                        ?>
                                                        <div class="ctt_address">
                                                            <span>
                                                                <?php echo get_field('contact-address'); ?>
                                                            </span>
                                                        </div>
                                                        <?php
                                                    }
                                                    if (get_field('contact-info_tel')!="")
                                                    {
                                                        ?>
                                                        <div class="six_margin_bt">
                                                            <h6 class="zero_color header_font big">
                                                                <?php echo($prk_astro_options['contact-info_tel_h']); ?>
                                                            </h6>
                                                            <div class="block_description">
                                                                <?php echo get_field('contact-info_tel'); ?>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    if (get_field('contact-info_fax')!="")
                                                    {
                                                        ?>
                                                        <div class="six_margin_bt">
                                                            <h6 class="zero_color header_font big">
                                                                <?php echo($prk_astro_options['contact-info_fax_h']); ?>
                                                            </h6>
                                                            <div class="block_description">
                                                                <?php echo get_field('contact-info_fax'); ?>
                                                            
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    if (get_field('contact-info_email')!="")
                                                    {
                                                        ?>
                                                        <div class="six_margin_bt">
                                                            <h6 class="zero_color header_font big">
                                                                <?php echo($prk_astro_options['contact-info_email_h']); ?> 
                                                            </h6>
                                                            <div class="block_description">
                                                                <a href="mailto:<?php echo antispambot($prk_astro_options['contact-info_email']); ?>" class="default_color">
                                                                <?php echo antispambot(get_field('contact-info_email')); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <div id="half_helper" class="clearfix"></div>
                            </div>
                            <div id="contact_description" class="twelve columns halfsized">
                                <div id="contact_form">
                                    <h4 class="header_font bd_headings_text_shadow zero_color">
                                        <?php echo get_field('info_title_form'); ?>
                                    </h4>
                                    <div class="clearfix"></div>
                                    <?php 
                                        if (get_field('contact-shortcode')!="") 
                                        {
                                            echo do_shortcode(get_field('contact-shortcode'));
                                        }
                                        else
                                        {
                                            ?>
                                            <form action="#" id="contact-form" method="post" data-empty='<?php echo esc_attr($prk_translations['empty_text_error']); ?>' data-invalid='<?php echo esc_attr($prk_translations['invalid_email_error']); ?>' data-ok='<?php echo esc_attr($prk_translations['contact_ok_text']); ?>' data-name='<?php bloginfo('name'); ?>'>
                                                <div class="row">
                                                    <div class="six columns">
                                                        <input type="text" class="pirenko_highlighted" name="c_name" id="c_name" 
                                                        placeholder="<?php echo esc_attr($prk_translations['comments_author_text']);echo esc_attr($prk_translations['required_text']); ?>"  data-original="<?php echo esc_attr($prk_translations['comments_author_text']);echo esc_attr($prk_translations['required_text']); ?>" />
                                                    </div>
                                                    <div class="six columns">
                                                            <input type="text" class="pirenko_highlighted" name="c_email" id="c_email" size="28" placeholder="<?php echo esc_attr($prk_translations['comments_email_text']);echo esc_attr($prk_translations['required_text']); ?>"/>
                                                    </div>
                                                    <div class="twelve columns">
                                                        <input type="text" class="pirenko_highlighted" name="c_subject" id="c_subject" size="28"
                                                        placeholder="<?php echo esc_attr($prk_translations['contact_subject_text']); ?>" />
                                                    
                                                        <textarea class="pirenko_highlighted" name="c_message" id="c_message" rows="8"
                                                        placeholder="<?php echo esc_attr($prk_translations['contact_message_text']); ?>" data-original="<?php echo esc_attr($prk_translations['contact_message_text']); ?>" ></textarea>
                                                   
                                                    </div>
                                                </div>
                                                <?php
                                                    if (!isset($prk_translations['contact_submit']))
                                                        $prk_translations['contact_submit']='Send Message';
                                                ?>
                                                <input type="hidden" id="full_subject" name="full_subject" value="" />
                                                <input type="hidden" name="rec_email" value="<?php echo antispambot(get_field('prk_email_address')); ?>" />
                                                <div id="contact_ok" class="zero_color header_font bd_headings_text_shadow"><?php echo($prk_translations['contact_wait_text']); ?></div>
                                                <input type="hidden" name="c_submitted" id="c_submitted" value="true" />
                                                <div class="clearfix"></div>
                                                <div id="submit_message_div" class="header_font body_text_shadow default_color">
                                                    <a href="#">
                                                        <div class="left_floated">
                                                            <?php echo($prk_translations['contact_submit']); ?>
                                                        </div>
                                                        <div class="navicon-forward left_floated"></div>
                                                    </a>
                                                </div>
                                            </form>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php
        }
    ?>      
        
</div>
</div>
<?php get_footer(); ?>