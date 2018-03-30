<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 5/6/14
 * Time: 3:49 PM
 */

new wm_customize();
class wm_customize
{
    public $wp_customize;
    public function __construct()
    {
        add_action( 'customize_preview_init' , array( $this, 'live_preview' ) );
        add_action( 'customize_controls_enqueue_scripts',           array($this,'loading_script') );
        add_action( 'customize_register',                           array($this,'customizer_register'));

    }

    public function awe_sanitize_callback1($value)
    {
        return $value;
    }

    public function live_preview()
    {
        if(AWE_DEBUG==true)
            $min=".min";
        else
            $min="";
        wp_enqueue_script(
            'wm-customizer', get_template_directory_uri() . '/assets/customize/js/livepreview4.x'.$min.'.js', array(  'jquery', 'customize-preview' ),'',true );
        wp_enqueue_script('jquery-ui-resizable');
    }
    public function loading_script()
    {
        if(AWE_DEBUG==true)
            $min=".min";
        else
            $min="";
        wp_enqueue_script( 'wm-customizer-js', get_template_directory_uri().'/assets/customize/js/customizer4.x.js', array(), null, true);
        wp_dequeue_script( 'jquery-ui');
        wp_enqueue_style(  'wm-customizer-styles', get_template_directory_uri() . '/assets/customize/css/customizer4.x.css',100);
    }
    public function add_sub_title($section,$id,$label,$priority)
    {
        $this->wp_customize->add_setting($id);
        $this->wp_customize->add_control( new Custom_Sub_Title($this->wp_customize, $id, array(
            'label'    => $label,
            'section'  => $section,
            'settings' => $id,
            'priority' => $priority
        )));
    }



    public function add_description($section,$id,$label,$priority)
    {
        $this->wp_customize->add_setting($id);
        $this->wp_customize->add_control( new Custom_Description($this->wp_customize, $id, array(
            'label'    => $label,
            'section'  => $section,
            'settings' => $id,
            'priority'   => $priority
        )));
    }
    public function customizer_register($wp_customize)
    {
        $this->wp_customize = $wp_customize;
        $options = get_options();
        $name = apply_filters('awe_get_option_by_lang',THEME_OPTIONS_NAME);
        $name_option = $name."[extra]";

        ###### GENERAL OPTIONS SECTION ######
        $wp_customize->add_section('awe_theme_config_section', array(
            'title'    => __('Viska Setting', LANGUAGE),
            'priority' => 1,
        ));

        $this->add_sub_title('awe_theme_config_section','style_color_subtitle',__('Homepage Style',LANGUAGE),11);
        $this->add_description('awe_theme_config_section','awe_theme_section_desc',__('Choose your style color as you like, but we recommend you choose default style color to get the best experiment',LANGUAGE),12);

        /* Default Style Color */
        $wp_customize->add_setting($name_option.'[style_color]', array(
            'default'           => $options['style_color'],
            'capability'        => 'edit_theme_options',
            'type'           => 'option',
        ));
        $wp_customize->add_control( new AWE_Theme_Default_Style_Color_Control($wp_customize, 'style_color', array(
            'label'    => __('Default Style Color', LANGUAGE),
            'section'  => 'awe_theme_config_section',
            'settings' => $name_option.'[style_color]',
            'priority'   => 13,
        )));
        $wp_customize->get_setting( $name_option.'[style_color]' )->transport = 'postMessage';

        // /* Custom Style Color */
        $wp_customize->add_setting($name_option.'[style_color_custom]', array(
            'default'           => $options['style_color_custom'],
            'capability'        => 'edit_theme_options',
            'type'           => 'option',
        ));
        $wp_customize->add_control( new Custom_Color_Control( $wp_customize, 'style_color_custom', array(
            'label'        => __('Custom Style Color', LANGUAGE),
            'section'    => 'awe_theme_config_section',
            'settings'   => $name_option.'[style_color_custom]',
            'priority'   => 14,
        ) ) );
        $wp_customize->get_setting( $name_option.'[style_color_custom]' )->transport = 'postMessage';

        /* Chooose Profile */
        $this->add_sub_title('awe_theme_config_section','profile_subtitle',__('About Us',LANGUAGE),21);
        $this->add_description('awe_theme_config_section','profile_desc',__('Choose your about to display by select the below list and about, resume, skill section will followed to change content',LANGUAGE),22);
        $profiles = get_posts( array( 'post_type' => 'awe_aboutus' ) );
        $cats = array();
        if(is_array($profiles) && count($profiles)>0)
            foreach($profiles as $p)
            {
                $cats[$p->ID] = $p->post_title;
            }

        $wp_customize->add_setting($name_option.'[aboutus]', array(
            'default'        => $options['aboutus'],
            'capability'        => 'edit_theme_options',
            'type'          => 'option',
        ));
        $wp_customize->add_control($name_option.'[aboutus]', array(
            'settings' => $name_option.'[aboutus]',
            'label'   => 'Select Aboutus:',
            'section'  => 'awe_theme_config_section',
            'type'    => 'select',
            'priority'   => 23,
            'choices' => $cats,
        ));

        ######## INTRODUCTION SETTINGS #########
        $wp_customize->add_panel('intro_panel', array(
            'priority'       => 2,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __('Introduction Screen',LANGUAGE),
            'description'    => 'Change Introduction Settings',
        ) );

        $wp_customize->add_section('awe_theme_intro_screen', array(
            'title'    => __('Data Settings', LANGUAGE),
            'priority' => 1,
            'panel'  => 'intro_panel',
        ));

        $this->wp_customize->add_setting( $name_option.'[intro_data]', array(
            'default'   =>  $options['intro_data'],
            'capability' => 'edit_theme_options',
            'type' => 'option',
        ));

        $this->wp_customize->add_control(new Introduction_Info($this->wp_customize, $name_option.'[intro_data]',array(
            'settings' => $name_option.'[intro_data]',
            'label' => 'Introduction Info',
            'section' => 'awe_theme_intro_screen',
            'priority'   => 2,
        )));
        $this->wp_customize->get_setting( $name_option.'[intro_data]' )->transport = 'postMessage';



        /* Introduction Background settings */
        $wp_customize->add_section('awe_theme_intro_bg', array(
            'title'    => __('Background Settings', LANGUAGE),
            'priority' => 2,
            'panel'  => 'intro_panel',
        ));
        $this->wp_customize->add_setting( $name_option.'[intro_bg_data]', array(
            'default'   =>  $options['intro_bg_data'],
            'capability' => 'edit_theme_options',
            'type' => 'option',
            'sanitize_callback' => array($this, 'awe_sanitize_callback1')
        ));

        $this->wp_customize->add_control(new Introduction_Background($this->wp_customize, $name_option.'[intro_bg_data]',array(
            'settings' => $name_option.'[intro_bg_data]',
            'label' => 'Intro Background Settings',
            'section' => 'awe_theme_intro_bg',
            'priority'   => 1,
        )));
        $this->wp_customize->get_setting( $name_option.'[intro_bg_data]' )->transport = 'postMessage';

        ####### BLOG HEADER #########



        $wp_customize->add_panel('blog_panel', array(
            'priority'       => 3,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __('Introduction Blog Screen',LANGUAGE),
            'description'    => 'Change Introduction Blog Settings',
        ) );

        $wp_customize->add_section('awe_theme_blog_header', array(
            'title'    => __('Data Settings', LANGUAGE),
            'priority' => 1,
            'panel'  => 'blog_panel',
        ));

        $this->wp_customize->add_setting( $name_option.'[blog_data]', array(
            'default'   =>  $options['blog_data'],
            'capability' => 'edit_theme_options',
            'type' => 'option',
        ));

        $this->wp_customize->add_control(new Introduction_Info($this->wp_customize, $name_option.'[blog_data]',array(
            'settings' => $name_option.'[blog_data]',
            'label' => 'Introduction Info',
            'section' => 'awe_theme_blog_header',
            'priority'   => 2,
        )));
        $this->wp_customize->get_setting( $name_option.'[blog_data]' )->transport = 'postMessage';



        /* Introduction Background settings */
        $wp_customize->add_section('awe_theme_blog_bg', array(
            'title'    => __('Background Settings', LANGUAGE),
            'priority' => 2,
            'panel'  => 'blog_panel',
        ));
        $this->wp_customize->add_setting( $name_option.'[blog_bg]', array(
            'default'   =>  $options['blog_bg'],
            'capability' => 'edit_theme_options',
            'type' => 'option',
            'sanitize_callback' => array($this, 'awe_sanitize_callback1')
        ));

        $this->wp_customize->add_control(new Introduction_Background_Blog($this->wp_customize, $name_option.'[blog_bg]',array(
            'settings' => $name_option.'[blog_bg]',
            'label' => 'Intro Background Settings',
            'section' => 'awe_theme_blog_bg',
            'priority'   => 1,
        )));
        $this->wp_customize->get_setting( $name_option.'[blog_bg]' )->transport = 'postMessage';




        ###### SECTIONS SETTING ######
        // wp 4.1
        $wp_customize->add_panel('section_panel', array(
            'priority'       => 5,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __('Section Settings',LANGUAGE),
            'description'    => 'Change Order and Setting Sections',
        ) );

        $wp_customize->add_section (
            'awe_theme_section_sort',
            array(
                'title' => 'Section Order',
                'description'   => __('Change position display of each section as you want',LANGUAGE),
                'priority' => 1,
                'panel'  => 'section_panel',
            )
        );



        /* Section Order */
        $wp_customize->add_setting($name_option.'[sort_section]', array(
            'default'           => $options['sort_section'],
            'capability'        => 'edit_theme_options',
            'type'              => 'option',
            'sanitize_callback' => array($this, 'awe_sanitize_callback1')
        ));
        $wp_customize->add_control( new Sortable_Section_Control($wp_customize, 'sort_section', array(
            'label'    => __('Change order section', LANGUAGE),
            'section'  => 'awe_theme_section_sort',
            'settings' => $name_option.'[sort_section]',
            'priority'   => 2,
        )));
        $wp_customize->get_setting( $name_option.'[sort_section]' )->transport = 'postMessage';


        ###### HEADLINE & TEXT SECTION ######
        $headlines = array('about','skill','team','funfact','idea','portfolio','testimonial','pricing','twitter','service','subscribe','client','lastedpost','map','address','contact');

        $list_sections= $options['sort_section'];
        $list_sections = explode(",",$list_sections);
        if(is_array($list_sections) && count($list_sections>0))
            foreach($list_sections as $sectionname)
                if(!in_array($sectionname,$headlines))
                    array_push($headlines,$sectionname);
        $priority =2;
        foreach($headlines as $headline)
            if(isset($options[$headline])){
                if($headline == 'idea') {
                    $wp_customize->add_section (
                        'awe_theme_section_'.$headline,
                        array(
                            'title' => __('Proccess',LANGUAGE),
                            'priority' => $priority,
                            'panel'  => 'section_panel',
                        )
                    );
                }else
                {
                    $wp_customize->add_section (
                        'awe_theme_section_'.$headline,
                        array(
                            'title' => __(ucwords($headline),LANGUAGE),
                            'priority' => $priority,
                            'panel'  => 'section_panel',
                        )
                    );
                }
            /* Section */
                $count=1;
                /* Display or not*/
                if(isset($options["{$headline}"]["show"])){

                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][show]",
                        array(
                            'default' => $options["{$headline}"]["show"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                            'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][show]",
                        array(
                            'label' => "Display ".ucwords($headline)." Section",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'checkbox',
                            'settings' => "{$name_option}[{$headline}][show]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][show]" )->transport = 'postMessage';
                }
                if(isset($options["{$headline}"]["display"])){
                    $pricings = array();
                    $pricing_posts = get_posts( array( 'post_type' => 'awe_pricing_table' ) );
                    $pricings[''] = "None";
                    if(is_array($pricing_posts) && count($pricing_posts)>0)
                        foreach($pricing_posts as $f)
                        {
                            $pricings[$f->ID] = $f->post_title;
                        }
                    $wp_customize->add_setting("{$name_option}[{$headline}][display]", array(
                        'default'        => $options["{$headline}"]["display"],
                        'capability'        => 'edit_theme_options',
                        'type'          => 'option',
                        'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                    ));
                    $wp_customize->add_control("{$name_option}[{$headline}][display]", array(
                        'settings' => "{$name_option}[{$headline}][display]",
                        'label'   => 'Select Pricing:',
                        'section'  => 'awe_theme_section_'.$headline,
                        'type'    => 'select',
                        'priority'   => $count++,
                        'choices' => $pricings,
                    ));


                }

                if(isset($options["{$headline}"]["limit_display"])){
                        $choices=array();
                        for($i=1;$i<20;$i++)
                        {
                            $choices[$i] = $i;
                        }
                    $wp_customize->add_setting("{$name_option}[{$headline}][limit_display]", array(
                        'default'        => $options["{$headline}"]["limit_display"],
                        'capability'        => 'edit_theme_options',
                        'type'          => 'option',
                        'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                    ));

                    $wp_customize->add_control( "{$name_option}[{$headline}][limit_display]", array(
                        'settings' => "{$name_option}[{$headline}][limit_display]",
                        'label'   => 'Number Posts Display:',
                        'section'  => 'awe_theme_section_'.$headline,
                        'type'    => 'select',
                        'priority'   => $count++,
                        'choices' => $choices,
                    ));
                }

                if(isset($options["{$headline}"]["form"])){
                    $cf7s = array();
                    $wcf7s = get_posts( array( 'post_type' => 'wpcf7_contact_form' ) );
                    if(is_array($wcf7s) && count($wcf7s)>0)
                        foreach($wcf7s as $f)
                        {
                            $cf7s[$f->ID] = $f->post_title;
                        }
                    $wp_customize->add_setting("{$name_option}[{$headline}][form]", array(
                        'default'        => $options["{$headline}"]["form"],
                        'capability'        => 'edit_theme_options',
                        'type'          => 'option',
                        'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                    ));

                    $wp_customize->add_control( "{$name_option}[{$headline}][form]", array(
                        'settings' => "{$name_option}[{$headline}][form]",
                        'label'   => 'Contact Form',
                        'section'  => 'awe_theme_section_'.$headline,
                        'type'    => 'select',
                        'priority'   => $count++,
                        'choices' => $cf7s,
                    ));
                }
                if(isset($options["{$headline}"]["skin"]))
                {
                    $wp_customize->add_setting("{$name_option}[{$headline}][skin]", array(
                        'default'        => $options["{$headline}"]["skin"],
                        'capability'        => 'edit_theme_options',
                        'type'          => 'option',
                        'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                    ));
                    $wp_customize->add_control("{$name_option}[{$headline}][skin]", array(
                        'settings' => "{$name_option}[{$headline}][skin]",
                        'label'   => 'Select Skin:',
                        'section'  => 'awe_theme_section_'.$headline,
                        'type'    => 'select',
                        'priority'   => $count++,
                        'choices' => array('light'=>'Light','dark'=>'Dark'),
                    ));
                    $this->wp_customize->get_setting( "{$name_option}[{$headline}][skin]" )->transport = 'postMessage';
                }
                if(isset($options["{$headline}"]["header"]))
                    $this->add_sub_title('awe_theme_section_'.$headline,'header_'.$headline.'_subtitle',__('Header Settings',LANGUAGE),$count++);
                /* Header */
                if(isset($options["{$headline}"]["header"]["enable"])){

                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][header][enable]",
                        array(
                            'default' => $options["{$headline}"]["header"]["enable"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                            'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][header][enable]",
                        array(
                            'label' => "Enable ".ucwords($headline)." Header",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'checkbox',
                            'settings' => "{$name_option}[{$headline}][header][enable]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][header][enable]" )->transport = 'postMessage';
                }
                if(isset($options["{$headline}"]["header"]["style"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][header][style]",
                        array(
                            'default' => $options["{$headline}"]["header"]["style"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                            'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                        )
                    );
                    $header_options = array(
                        'normal'            =>  'Style 1',
                        'line-bottom'       =>  'Style 2',
                        'line-top'          =>  'Style 3',
                        'border-title'      =>  'Style 4',
                        'line-through'      =>  'Style 5',
                    );
                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][header][style]",
                        array(
                            'label' => "Header Style",
                            'section' => 'awe_theme_section_'.$headline,
                            'type'    => 'select',
                            'choices' => $header_options,
                            'settings' => "{$name_option}[{$headline}][header][style]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][header][style]" )->transport = 'postMessage';
                }

                /* Header Title */
                if(isset($options["{$headline}"]["header"]["title"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][header][title]",
                        array(
                            'default' => $options["{$headline}"]["header"]["title"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][header][title]",
                        array(
                            'label' =>"Title",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][header][title]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][header][title]" )->transport = 'postMessage';
                }
                /* Header Subtitle*/
                 if(isset($options["{$headline}"]["header"]["subtitle"]['enable']) && $headline != 'twitter'){

                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][header][subtitle][enable]",
                        array(
                            'default'        => $options["{$headline}"]["header"]["subtitle"]["enable"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );
                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][header][subtitle][enable]",
                        array(
                            'label' => "Enable Sub Title",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'checkbox',
                            'settings' => "{$name_option}[{$headline}][header][subtitle][enable]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][header][subtitle][enable]" )->transport = 'postMessage';
                }
                if(isset($options["{$headline}"]["header"]["subtitle"]['text']) && $headline != 'twitter'){

                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][header][subtitle][text]",
                        array(
                            'default'        => $options["{$headline}"]["header"]["subtitle"]["text"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );
                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][header][subtitle][text]",
                        array(
                            'label' => "Sub Title",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][header][subtitle][text]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][header][subtitle][text]" )->transport = 'postMessage';
                }

                if(isset($options["{$headline}"]["header"]["animation"]) && $headline != 'twitter'){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][header][animation]",
                        array(
                            'default'        => $options["{$headline}"]["header"]["animation"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );
                    $wp_customize->add_control( new Select_Animate_Style($wp_customize, "{$name_option}[{$headline}][header][animation]", array(
                        'label' => __('Animate Style', LANGUAGE),
                        'section' => 'awe_theme_section_'.$headline,
                        'settings' => "{$name_option}[{$headline}][header][animation]",
                        'priority' => $count++
                    )));
                    $wp_customize->get_setting( "{$name_option}[{$headline}][header][animation]" )->transport = 'postMessage';
                }
                // if(isset($options["{$headline}"]["header"]["animation"]) && $headline != 'twitter'){
                //     $wp_customize->add_setting (
                //         "{$name_option}[{$headline}][header][animation]",
                //         array(
                //             'default'        => $options["{$headline}"]["header"]["animation"],
                //             'capability'     => 'edit_theme_options',
                //             'type'           => 'option',
                //         )
                //     );
                //     $wp_customize->add_control( new Select_Animate_Style($wp_customize, "{$name_option}[{$headline}][header][animation]", array(
                //         'label' => __('Animate Style', LANGUAGE),
                //         'section' => 'awe_theme_section_'.$headline,
                //         'settings' => "{$name_option}[{$headline}][header][animation]",
                //         'priority' => $count++
                //     )));
                //     $wp_customize->get_setting( "{$name_option}[{$headline}][header][animation]" )->transport = 'postMessage';
                // }

                // customize content
                if(isset($options["{$headline}"]["content"]))
                    $this->add_sub_title('awe_theme_section_'.$headline,'content_'.$headline.'_subtitle',__('Content Settings',LANGUAGE),$count++);
                /* Content */
                /* for only map */
                if(isset($options["{$headline}"]["latitude"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][latitude]",
                        array(
                            'default' => $options["{$headline}"]["latitude"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][latitude]",
                        array(
                            'label' =>"Latitude",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][latitude]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][latitude]" )->transport = 'postMessage';
                }
                if(isset($options["{$headline}"]["longitude"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][longitude]",
                        array(
                            'default' => $options["{$headline}"]["longitude"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][longitude]",
                        array(
                            'label' =>"Longitude",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][longitude]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][longitude]" )->transport = 'postMessage';
                }

                if(isset($options["{$headline}"]["tooltip"]["heading"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][tooltip][heading]",
                        array(
                            'default' => $options["{$headline}"]["tooltip"]["heading"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][tooltip][heading]",
                        array(
                            'label' =>"Tooltip Heading",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][tooltip][heading]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][tooltip][heading]" )->transport = 'postMessage';
                }

                if(isset($options["{$headline}"]["tooltip"]["content"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][tooltip][content]",
                        array(
                            'default' => $options["{$headline}"]["tooltip"]["content"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][tooltip][content]",
                        array(
                            'label' =>"Tooltip Content",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][tooltip][content]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][tooltip][content]" )->transport = 'postMessage';
                }

                if(isset($options["{$headline}"]["marker"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][marker]",
                        array(
                            'default' => $options["{$headline}"]["marker"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );

                    $wp_customize->add_control( new Choose_Single_Image_Control($wp_customize,  "{$name_option}[{$headline}][marker]", array(
                        'label'    => __('Change Marker', LANGUAGE),
                        'section'  => 'awe_theme_section_'.$headline,
                        'settings' => "{$name_option}[{$headline}][marker]",
                        'priority' => $count++
                    )));

                    $wp_customize->get_setting( "{$name_option}[{$headline}][marker]" )->transport = 'postMessage';


                }
                /* For only address */
                if(isset($options["{$headline}"]["content"]['studio'])){
                    $wp_customize->add_setting("{$name_option}[{$headline}][content][studio]",
                        array(
                            'default' => $options["{$headline}"]["content"]["studio"],
                            'capability' => "edit_theme_options",
                            "type" => "option",
                    ));
                    $wp_customize->add_control("{$name_option}[{$headline}][content][studio]",
                        array(
                            'label' => 'Studio Name',
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][content][studio]",
                            'priority' => $count++,
                    ));
                    $wp_customize->get_setting( "{$name_option}[{$headline}][content][studio]" )->transport = 'postMessage';
                }

                if(isset($options["{$headline}"]["content"]["address"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][content][address]",
                        array(
                            'default' => $options["{$headline}"]["content"]["address"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][content][address]",
                        array(
                            'label' =>"Address",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][content][address]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][content][address]" )->transport = 'postMessage';
                }

                if(isset($options["{$headline}"]["content"]["email"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][content][email]",
                        array(
                            'default' => $options["{$headline}"]["content"]["email"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][content][email]",
                        array(
                            'label' =>"Address",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][content][email]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][content][email]" )->transport = 'postMessage';
                }
                if(isset($options["{$headline}"]["content"]["phone"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][content][phone]",
                        array(
                            'default' => $options["{$headline}"]["content"]["phone"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][content][phone]",
                        array(
                            'label' =>"Phone",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][content][phone]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][content][phone]" )->transport = 'postMessage';
                }
                /* end address */



                if(isset($options["{$headline}"]["content"]["style"]) && $headline != 'pricing' && $headline != 'portfolio'){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][content][style]",
                        array(
                            'default' => $options["{$headline}"]["content"]["style"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );
                    $content_options = $options["{$headline}"]["content"]["style_options"];
                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][content][style]",
                        array(
                            'label' => "Content Style",
                            'section' => 'awe_theme_section_'.$headline,
                            'type'    => 'select',
                            'choices' => $content_options,
                            'settings' => "{$name_option}[{$headline}][content][style]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][content][style]" )->transport = 'postMessage';
                }
                /* for only team join */
                if(isset($options["{$headline}"]["content"]["join"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][content][join]",
                        array(
                            'default'        => $options["{$headline}"]["content"]["join"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );
                    $wp_customize->add_control("{$name_option}[{$headline}][content][join]",array(
                            'label' => 'Display Join Team',
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'checkbox',
                            'settings' => "{$name_option}[{$headline}][content][join]",
                            'priority' => $count++,
                    ));
                    $wp_customize->get_setting( "{$name_option}[{$headline}][content][join]" )->transport = 'postMessage';
                }
                if(isset($options["{$headline}"]["content"]["join_image"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][content][join_image]",
                        array(
                            'default'        => $options["{$headline}"]["content"]["join_image"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );
                    
                    $wp_customize->add_control( new Choose_Single_Image_Control($wp_customize,"{$name_option}[{$headline}][content][join_image]" , array(
                        'label'    => __('Join Team Image', LANGUAGE),
                        'section' => 'awe_theme_section_'.$headline,
                        'settings' => "{$name_option}[{$headline}][content][join_image]",
                        'priority'   => $count++,
                        'add_button_class'  => 'add-join-team-image',
                        'remove_button_class'   =>  'remove-image',
                    )));
                    $wp_customize->get_setting( "{$name_option}[{$headline}][content][join_image]" )->transport = 'postMessage';
                }

                if(isset($options["{$headline}"]["content"]["join_text"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][content][join_text]",
                        array(
                            'default'        => $options["{$headline}"]["content"]["join_text"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );
                    $wp_customize->add_control("{$name_option}[{$headline}][content][join_text]",array(
                            'label' => 'Join Team Text',
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][content][join_text]",
                            'priority' => $count++,
                    ));
                    $wp_customize->get_setting( "{$name_option}[{$headline}][content][join_text]" )->transport = 'postMessage';
                }
                if(isset($options["{$headline}"]["content"]["join_link"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][content][join_link]",
                        array(
                            'default'        => $options["{$headline}"]["content"]["join_link"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );
                    $wp_customize->add_control("{$name_option}[{$headline}][content][join_link]",array(
                            'label' => 'Join Team link',
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][content][join_link]",
                            'priority' => $count++,
                    ));
                    $wp_customize->get_setting( "{$name_option}[{$headline}][content][join_link]" )->transport = 'postMessage';
                }
                /* Animation */
                if(isset($options["{$headline}"]["content"]["animation"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][content][animation]",
                        array(
                            'default'        => $options["{$headline}"]["content"]["animation"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );
                    $wp_customize->add_control( new Select_Animate_Style($wp_customize, "{$name_option}[{$headline}][content][animation]", array(
                        'label' => __('Animate Style', LANGUAGE),
                        'section' => 'awe_theme_section_'.$headline,
                        'settings' => "{$name_option}[{$headline}][content][animation]",
                        'priority' => $count++
                    )));
                    $wp_customize->get_setting( "{$name_option}[{$headline}][content][animation]" )->transport = 'postMessage';
                }

                /* Slider */

                if(isset($options["{$headline}"]["slider"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][slider]",
                        array(
                            'default'        => $options["{$headline}"]["slider"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );
                    $wp_customize->add_control( new List_Items_Slider($wp_customize, "{$name_option}[{$headline}][slider]", array(
                        'label' => __('Animate Style', LANGUAGE),
                        'section' => 'awe_theme_section_'.$headline,
                        'settings' => "{$name_option}[{$headline}][slider]",
                        'priority' => $count++
                    )));
                    $wp_customize->get_setting( "{$name_option}[{$headline}][slider]" )->transport = 'postMessage';
                }

                /* Button */
                if(isset($options["{$headline}"]['button']))
                {
                    if(isset($options["{$headline}"]['button']['label'])){
                        $this->add_sub_title('awe_theme_section_'.$headline,$headline.'_button',__('Button Settings',LANGUAGE),$count++);
                        $wp_customize->add_setting (
                            "{$name_option}[{$headline}][button][label]",
                            array(
                                'default'        => $options["{$headline}"]["button"]["label"],
                                'capability'     => 'edit_theme_options',
                                'type'           => 'option',
                            )
                        );
                        $wp_customize->add_control (
                            "{$name_option}[{$headline}][button][label]",
                            array(
                                'label' =>" Button Label",
                                'section' => 'awe_theme_section_'.$headline,
                                'type' => 'text',
                                'settings' => "{$name_option}[{$headline}][button][label]",
                                'priority' => $count++
                            )
                        );
                        $wp_customize->get_setting( "{$name_option}[{$headline}][button][label]" )->transport = 'postMessage';
                    }

                    if(isset($options["{$headline}"]['button']['url'])){
                        $wp_customize->add_setting (
                            "{$name_option}[{$headline}][button][url]",
                            array(
                                'default'        => $options["{$headline}"]["button"]["url"],
                                'capability'     => 'edit_theme_options',
                                'type'           => 'option',
                            )
                        );
                        $wp_customize->add_control (
                            "{$name_option}[{$headline}][button][url]",
                            array(
                                'label' =>" Button Url",
                                'section' => 'awe_theme_section_'.$headline,
                                'type' => 'text',
                                'settings' => "{$name_option}[{$headline}][button][url]",
                                'priority' => $count++
                            )
                        );
                        $wp_customize->get_setting( "{$name_option}[{$headline}][button][url]" )->transport = 'postMessage';
                    }
                }
                /* Content */

                /* for only map */
                if(isset($options["{$headline}"]["latitude"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][latitude]",
                        array(
                            'default' => $options["{$headline}"]["latitude"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                            'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][latitude]",
                        array(
                            'label' =>"Latitude",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][latitude]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][latitude]" )->transport = 'postMessage';
                }
                if(isset($options["{$headline}"]["longitude"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][longitude]",
                        array(
                            'default' => $options["{$headline}"]["longitude"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                            'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][longitude]",
                        array(
                            'label' =>"Longitude",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][longitude]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][longitude]" )->transport = 'postMessage';
                }

                if(isset($options["{$headline}"]["tooltip"]["heading"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][tooltip][heading]",
                        array(
                            'default' => $options["{$headline}"]["tooltip"]["heading"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                            'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][tooltip][heading]",
                        array(
                            'label' =>"Tooltip Heading",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][tooltip][heading]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][tooltip][heading]" )->transport = 'postMessage';
                }

                if(isset($options["{$headline}"]["tooltip"]["content"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][tooltip][content]",
                        array(
                            'default' => $options["{$headline}"]["tooltip"]["content"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                            'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][tooltip][content]",
                        array(
                            'label' =>"Tooltip Content",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][tooltip][content]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][tooltip][content]" )->transport = 'postMessage';
                }

                if(isset($options["{$headline}"]["marker"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][marker]",
                        array(
                            'default' => $options["{$headline}"]["marker"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                            'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                        )
                    );

                    $wp_customize->add_control( new Choose_Single_Image_Control($wp_customize,  "{$name_option}[{$headline}][marker]", array(
                        'label'    => __('Change Marker', LANGUAGE),
                        'section'  => 'awe_theme_section_'.$headline,
                        'settings' => "{$name_option}[{$headline}][marker]",
                        'priority' => $count++
                    )));

                    $wp_customize->get_setting( "{$name_option}[{$headline}][marker]" )->transport = 'postMessage';


                }
                /* For only address */
                if(isset($options["{$headline}"]["content"]["address"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][content][address]",
                        array(
                            'default' => $options["{$headline}"]["content"]["address"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                            'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][content][address]",
                        array(
                            'label' =>"Address",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][content][address]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][content][address]" )->transport = 'postMessage';
                }
                if(isset($options["{$headline}"]["content"]["email"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][content][email]",
                        array(
                            'default' => $options["{$headline}"]["content"]["email"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                            'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][content][email]",
                        array(
                            'label' =>"Address",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][content][email]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][content][email]" )->transport = 'postMessage';
                }
                if(isset($options["{$headline}"]["content"]["phone"])){
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][content][phone]",
                        array(
                            'default' => $options["{$headline}"]["content"]["phone"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                            'sanitize_callback' => array($this, 'awe_sanitize_callback1')
                        )
                    );

                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][content][phone]",
                        array(
                            'label' =>"Phone",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'text',
                            'settings' => "{$name_option}[{$headline}][content][phone]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][content][phone]" )->transport = 'postMessage';
                }
                /* end address */
                /* Footer */
                if(isset($options["{$headline}"]["footer"])) :

                    $this->add_sub_title('awe_theme_section_'.$headline,'footer_'.$headline.'_subtitle',__('Footer Settings',LANGUAGE),$count++);

                    $wp_customize->add_setting("{$name_option}[{$headline}][footer][enable]",array(
                        'default' => $options["{$headline}"]['footer']['enable'],
                        'capability' => 'edit_theme_options',
                        'type' => 'option'

                    ));
                    $wp_customize->add_control (
                        "{$name_option}[{$headline}][footer][enable]",
                        array(
                            'label' => "Enable Footer",
                            'section' => 'awe_theme_section_'.$headline,
                            'type' => 'checkbox',
                            'settings' => "{$name_option}[{$headline}][footer][enable]",
                            'priority' => $count++
                        )
                    );
                    $wp_customize->get_setting( "{$name_option}[{$headline}][footer][enable]" )->transport = 'postMessage';
                    //======== footer subtitle ===============//
                    if(isset($options["{$headline}"]['footer']['title']['enable'])) :
                        $wp_customize->add_setting("{$name_option}[{$headline}][footer][title][enable]",array(
                            'default' => $options[$headline]['footer']['title']['enable'],
                            'capability' => 'edit_theme_options',
                            'type' =>'option',

                        ));

                        $wp_customize->add_control("{$name_option}[{$headline}][footer][title][enable]",array(
                            'label' => 'Enable Title',
                            'section' => 'awe_theme_section_'.$headline,
                            'type' =>'checkbox',
                            'settings' => "{$name_option}[{$headline}][footer][title][enable]",
                            'priority' => $count++,
                        ));
                        $wp_customize->get_setting("{$name_option}[{$headline}][footer][title][enable]" )->transport = 'postMessage';
                    endif;// end subtitle enable

                    if(isset($options["{$headline}"]["footer"]["title"]["text"]))
                    {
                        $wp_customize->add_setting("{$name_option}[{$headline}][footer][title][text]",array(
                            'default' => $options[$headline]['footer']['title']['text'],
                            'capability' => 'edit_theme_options',
                            'type' =>'option',

                        ));
                        
                        $wp_customize->add_control("{$name_option}[{$headline}][footer][title][text]",array(
                            'label' => 'Title',
                            'section' => 'awe_theme_section_'.$headline,
                            'type' =>'text',
                            'settings' => "{$name_option}[{$headline}][footer][title][text]",
                            'priority' => $count++,
                        ));
                        $wp_customize->get_setting("{$name_option}[{$headline}][footer][title][text]" )->transport = 'postMessage';
                    
                    }
                    //======== footer subtitle ===============//
                    if(isset($options["{$headline}"]['footer']['subtitle']['enable'])) :
                        $wp_customize->add_setting("{$name_option}[{$headline}][footer][subtitle][enable]",array(
                            'default' => $options[$headline]['footer']['subtitle']['enable'],
                            'capability' => 'edit_theme_options',
                            'type' =>'option',

                        ));

                        $wp_customize->add_control("{$name_option}[{$headline}][footer][subtitle][enable]",array(
                            'label' => 'Enable Subtitle',
                            'section' => 'awe_theme_section_'.$headline,
                            'type' =>'checkbox',
                            'settings' => "{$name_option}[{$headline}][footer][subtitle][enable]",
                            'priority' => $count++,
                        ));
                        $wp_customize->get_setting("{$name_option}[{$headline}][footer][subtitle][enable]" )->transport = 'postMessage';
                    endif;// end subtitle enable

                    if(isset($options["{$headline}"]["footer"]["subtitle"]["text"])) :
                        $wp_customize->add_setting("{$name_option}[{$headline}][footer][subtitle][text]",array(
                            'default' => $options[$headline]['footer']['subtitle']['text'],
                            'capability' => 'edit_theme_options',
                            'type' =>'option',

                        ));

                        $wp_customize->add_control("{$name_option}[{$headline}][footer][subtitle][text]",array(
                            'label' => 'Subtitle',
                            'section' => 'awe_theme_section_'.$headline,
                            'type' =>'text',
                            'settings' => "{$name_option}[{$headline}][footer][subtitle][text]",
                            'priority' => $count++,
                        ));
                        $wp_customize->get_setting("{$name_option}[{$headline}][footer][subtitle][text]" )->transport = 'postMessage';
                    endif; /// end subtitle text

                    //========= footer description ============//
                    if(isset($options["{$headline}"]["footer"]["desc"]["enable"])) :
                        $wp_customize->add_setting("{$name_option}[{$headline}][footer][desc][enable]",array(
                            'default' => $options[$headline]['footer']['desc']['enable'],
                            'capability' => 'edit_theme_options',
                            'type' =>'option',

                        ));

                        $wp_customize->add_control("{$name_option}[{$headline}][footer][desc][enable]",array(
                            'label' => 'Enable Description',
                            'section' => 'awe_theme_section_'.$headline,
                            'type' =>'checkbox',
                            'settings' => "{$name_option}[{$headline}][footer][desc][enable]",
                            'priority' => $count++,
                        ));
                        $wp_customize->get_setting("{$name_option}[{$headline}][footer][desc][enable]" )->transport = 'postMessage';
                    endif; // end footer description 
                    if(isset($options["{$headline}"]["footer"]["desc"]["text"])) :
                        $wp_customize->add_setting("{$name_option}[{$headline}][footer][desc][text]",array(
                            'default' => $options["{$headline}"]['footer']['desc']['text'],
                            'capability' => 'edit_theme_options',
                            'type' =>'option',

                        ));

                        $wp_customize->add_control(new TextAreaControl($wp_customize, "{$name_option}[{$headline}][footer][desc][text]",array(
                            'label' => 'Description',
                            'section' => 'awe_theme_section_'.$headline,
                            'settings' => "{$name_option}[{$headline}][footer][desc][text]",
                            'priority' => $count++,
                        )));
                        $wp_customize->get_setting("{$name_option}[{$headline}][footer][desc][text]" )->transport = 'postMessage';
                    endif;
                    if(isset($options["{$headline}"]["footer"]["button"]["enable"])) :
                    //========= footer button ============//

                        $wp_customize->add_setting("{$name_option}[{$headline}][footer][button][enable]",array(
                            'default' => $options[$headline]['footer']['button']['enable'],
                            'capability' => 'edit_theme_options',
                            'type' =>'option',
                        ));

                        $wp_customize->add_control("{$name_option}[{$headline}][footer][button][enable]",array(
                            'label' => 'Enable Button',
                            'section' => 'awe_theme_section_'.$headline,
                            'type' =>'checkbox',
                            'settings' => "{$name_option}[{$headline}][footer][button][enable]",
                            'priority' => $count++,
                        ));
                        $wp_customize->get_setting("{$name_option}[{$headline}][footer][button][enable]" )->transport = 'postMessage';
                    endif;
                    if(isset($options["{$headline}"]["footer"]["button"]["text"])) :
                        $wp_customize->add_setting("{$name_option}[{$headline}][footer][button][text]",array(
                            'default' => $options[$headline]['footer']['button']['text'],
                            'capability' => 'edit_theme_options',
                            'type' =>'option',
                        ));

                        $wp_customize->add_control("{$name_option}[{$headline}][footer][button][text]",array(
                            'label' => 'Button Text',
                            'section' => 'awe_theme_section_'.$headline,
                            'type' =>'text',
                            'settings' => "{$name_option}[{$headline}][footer][button][text]",
                            'priority' => $count++,
                        ));
                        $wp_customize->get_setting("{$name_option}[{$headline}][footer][button][text]" )->transport = 'postMessage';
                    endif; 
                    if(isset($options["{$headline}"]["footer"]["button"]["link"])) :
                        $wp_customize->add_setting("{$name_option}[{$headline}][footer][button][link]",array(
                            'default' => $options[$headline]['footer']['button']['link'],
                            'capability' => 'edit_theme_options',
                            'type' =>'option',
                        ));

                        $wp_customize->add_control("{$name_option}[{$headline}][footer][button][link]",array(
                            'label' => 'Button Link',
                            'section' => 'awe_theme_section_'.$headline,
                            'type' =>'text',
                            'settings' => "{$name_option}[{$headline}][footer][button][link]",
                            'priority' => $count++,
                        ));
                        $wp_customize->get_setting("{$name_option}[{$headline}][footer][button][link]" )->transport = 'postMessage';
                    endif;
                    if(isset($options["{$headline}"]["footer"]["animation"])) :
                    $wp_customize->add_setting (
                        "{$name_option}[{$headline}][footer][animation]",
                        array(
                            'default'        => $options["{$headline}"]["footer"]["animation"],
                            'capability'     => 'edit_theme_options',
                            'type'           => 'option',
                        )
                    );
                    $wp_customize->add_control( new Select_Animate_Style($wp_customize, "{$name_option}[{$headline}][footer][animation]", array(
                        'label' => __('Animate Style', LANGUAGE),
                        'section' => 'awe_theme_section_'.$headline,
                        'settings' => "{$name_option}[{$headline}][footer][animation]",
                        'priority' => $count++
                    )));
                    $wp_customize->get_setting( "{$name_option}[{$headline}][footer][animation]" )->transport = 'postMessage';
                    endif;
                endif;
                /* Parallax */
                if(isset($options["{$headline}"]["parallax"])){
                    $this->add_sub_title('awe_theme_section_'.$headline,'parallax_'.$headline.'_subtitle',__('Parallax Settings',LANGUAGE),$count++);


                    $wp_customize->add_setting("{$name_option}[{$headline}][parallax]", array(
                        'default' => $options["{$headline}"]["parallax"],
                        'capability' => 'edit_theme_options',
                        'type' => 'option',
                    ));

                    $wp_customize->add_control( new Parallax_Settings($wp_customize, "{$name_option}[{$headline}][parallax]", array(
                        'label' => __('Color', LANGUAGE),
                        'section' => 'awe_theme_section_'.$headline,
                        'settings' => "{$name_option}[{$headline}][parallax]",
                        'priority' => $count++
                    )));
                    $wp_customize->get_setting( "{$name_option}[{$headline}][parallax]" )->transport = 'postMessage';



                }
                if(isset($options["{$headline}"]["overlay"])){
                   
                    $this->add_sub_title('awe_theme_section_'.$headline,'Overlay_'.$headline.'_subtitle',__('Overlay Settings',LANGUAGE),$count++);

                    $wp_customize->add_setting("{$name_option}[{$headline}][overlay]",array(
                        'default' => $options["{$headline}"]["overlay"],
                        'capability' => 'edit_theme_options',
                        'type' => 'option'
                    ));

                    $wp_customize->add_control(new overlayControl($wp_customize, "{$name_option}[{$headline}][overlay]",array(
                        'label' => __('Overlay Settings',LANGUAGE),
                        'section' =>'awe_theme_section_'.$headline,
                        'settings' => "{$name_option}[{$headline}][overlay]",
                        'priority' => $count++,
                    )));

                    $wp_customize->get_setting("{$name_option}[{$headline}][overlay]")->transport = 'postMessage';
                }


        }



    }

}

if (class_exists('WP_Customize_Control'))
{
    //Show Select to choose number item to display
    class List_Items_Slider extends  WP_Customize_Control{
        public $type = 'list-items-slider';
        public function render_content()
        {
            $values = json_decode($this->value(),true);
            ?>
            <label>
                <span class="customize-control-title">Display as slider</span>
                <input class="enable-slider" type="checkbox" <?php checked($values['enable'],'1');?> value="1"> Enable
                <br>
            </label>
            <label class="select-number-items-slider" <?php if($values['enable']==0):?> style="display: none"<?php endif;?>>
                <span class="customize-control-title">Number Items display</span>
                <select class="number-items-slider">
                    <?php for($i=1;$i<5;$i++):?>
                    <option <?php selected($values['num'],$i);?> value="<?php echo esc_attr($i);?>"><?php echo esc_attr($i);?></option>
                    <?php endfor;?>
                </select>
                <br>
            </label>
            <label>
                <input type="hidden" class="section-slider" <?php $this->link(); ?> value="<?php echo htmlentities($this->value());?>">
            </label>
            <?php
        }
    }

    class Parallax_Settings extends WP_Customize_Control{
        public $type = 'parallax-settings';
        public function render_content()
        {
            $values = json_decode($this->value(),true);
            ?>
            <label>
                <span class="customize-control-title">Active Parallax</span>
                <input class="enable-parallax" type="checkbox" <?php checked($values['enable'],'1');?> value="1"> Enable
                <br>
            </label>
            <div class="setting-bg">
                <span class="customize-control-title">Background Color</span>

                <div class="awe-style-color-custom">
                    <input type="text" class="parallax-color-picker" value="<?php echo $values['color'];?>">
                </div>
                <br>
            </div>
            <div class="setting-bg">
                <span class="customize-control-title"><?php _e('Background Image',LANGUAGE);?></span>
                <div class="img-preview">
                    <?php if($values['image']!=''):;?>
                        <img src="<?php echo $values['image']; ?>">
                    <?php endif;?>
                </div>
                <input type="button" class="button button-primary input-upload parallax-upload-img" value="<?php if($values['image']!='') echo 'Change'; else echo 'Add'?>">
                <input type="button" class="button input-remove parallax-remove-img" value="remove"<?php if($values['image']==''):?> disabled<?php endif;?>>
            </div>
            <div class="setting-bg">
                <span class="customize-control-title">Transparent</span>
                <div class="awe-style-color-custom">
                    <input type="text" class="parallax-transparent" value="<?php echo $values['transparent']; ?>">
                </div>
            </div>
            <div>
                <input type="hidden" class="section-parallax" <?php $this->link(); ?> value="<?php echo htmlentities($this->value());?>">
            </div>
            <?php
        }
    }

    class overlayControl extends WP_Customize_Control{
        private function checked_array($array,$check){
            if(in_array($check, $array)) echo "checked";
        }
        public function render_content(){
            $values = json_decode(urldecode($this->value()),true);
            ?>
            <li>
                <label><input type="checkbox" class="section-overlay-enable" <?php checked($values['enable'],"1"); ?> > <?php _e('Enable Background Overlay',LANGUAGE) ?></label>
                <div class="display-overlay" <?php if($values['enable'] != "1") echo 'style="display:none"'; ?> >
                    <label>
                        <input type="checkbox" class="section-overlay-color-enable" <?php $this->checked_array($values['type'],'color') ?> > Enable Overlay Color 
                    </label>
                    <input type="text" class="section-overlay-color-change" value="<?php echo $values['color'] ?>"><br>
                    <label><input type="checkbox" class="section-overlay-pattern" <?php $this->checked_array($values['type'],'pattern'); ?> ><?php _e('Enable Overlay Pattern',LANGUAGE) ?></label>
                    <div class="section-bg-overlay-image-upload">
                        <div class="img-preview">
                        <?php if($values['pattern']!=''):;?>
                            <img src="<?php echo $values['pattern']; ?>">
                        <?php endif;?>
                        </div>
                        <input class="awe-img overlay-section-pattern-url" type="hidden" style="width:100%;" value="<?php echo $values['pattern']; ?>">
                        <input type="button" class="button button-primary section-overlay-upload-img" value="<?php if($values['pattern']!='') echo 'Change'; else echo 'Add'?>">

                    </div>
                </div>
                <input class="section_overlay_save" type="hidden" <?php $this->link(); ?> value="<?php echo htmlentities( urldecode($this->value()) ); ?>" >
            </li>
            <?php 

        }
    }


    class Background_Settings extends WP_Customize_Control{
        public $type = 'background-settings';
        public $active_label;
        public function render_content()
        {
            $values = json_decode($this->value(),true);
            ?>
            <div class="background-settings">
                <label>
                    <span class="customize-control-title"><?php print ($this->active_label) ? $this->active_label : __("Enable Background",LANGUAGE);?></span>
                    <input class="enable-background" type="checkbox" <?php checked($values['enable'],'1');?> value="1"> Enable
                    <br>
                </label>
                <div class="setting-bg">
                    <span class="customize-control-title"><?php _e('Background Color',LANGUAGE);?></span>

                    <div class="awe-style-color-custom">
                        <input type="text" class="background-color-picker" value="<?php echo esc_attr($values['color']);?>">
                    </div>
                    <br>
                </div>
                <div class="setting-bg">
                    <span class="customize-control-title"><?php _e('Background Image',LANGUAGE);?></span>
                    <div class="img-preview">
                        <?php if($values['image']!=''):;?>
                            <img src="<?php echo esc_url($values['image']); ?>">
                        <?php endif;?>
                    </div>
                    <input type="button" class="button button-primary input-upload background-upload-img" value="<?php if($values['image']!='') echo 'Change'; else echo 'Add'?>">
                    <input type="button" class="button input-remove background-remove-img" value="remove" <?php if(empty($values['image'])):?>disabled<?php endif;?>>
                </div>
                <label>
                    <span class="customize-control-title"><?php _e("Enable Parallax",LANGUAGE);?></span>
                    <input class="enable-parallax" type="checkbox" <?php checked($values['enable_parallax'],'1');?> value="1"> <?php _e('Enable',LANGUAGE);?>
                    <br>
                </label>
                <div class="setting-bg">
                    <span class="customize-control-title"><?php _e('Transparent',LANGUAGE);?></span>
                    <div class="awe-style-color-custom">
                        <input type="text" class="background-transparent" value="<?php echo esc_attr($values['transparent']); ?>">
                    </div>
                </div>
                <div>
                    <input type="hidden" class="section-background" <?php $this->link(); ?> value="<?php echo htmlentities($this->value());?>">
                </div>
            </div>
            <?php
        }
    }
    class Parallax_Input_hidden extends WP_Customize_Control{
        public $type = 'background-input';
        public $name;

        public function render_content() {
            ?>
            <label class="<?php echo esc_attr($this->name);?>">
                <input type="hidden" <?php $this->link(); ?> value='<?php echo esc_attr($this->value());?>'>
            </label>
        <?php
        }
    }


    class Custom_Color_Control extends WP_Customize_Control
    {
        public $type = 'custom-color';
        public $class;
        public function render_content()
        {
            $options = get_options();
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

                <div class="awe-style-color-custom <?php if($options['style_color']=='custom'):?>choose<?php endif;?>">
                    <input type="text" class="<?php if($this->class) echo esc_attr($this->class);else echo 'style-color-custom-picker';?>" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>">
                </div>

            </label>

        <?php
        }
    }
    class AWE_Theme_Default_Style_Color_Control extends WP_Customize_Control
    {
        public $type = 'default-style-color';
        public function render_content()
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

                <div class="awe-style-color">
                    <ul class="color-switch">
                        <li class="color-cyan <?php if($this->value()=='color-cyan'):?>choose<?php endif;?>"><a  rel="color-cyan" href="#"></a></li>
                        <li class="color-blue <?php if($this->value()=='color-blue'):?>choose<?php endif;?>"><a  rel="color-blue" href="#"></a></li>
                        <li class="color-green <?php if($this->value()=='color-green'):?>choose<?php endif;?>"><a  rel="color-green" href="#"></a></li>
                        <li class="color-purple <?php if($this->value()=='color-purple'):?>choose<?php endif;?>"><a  rel="color-purple" href="#"></a></li>
                        <li class="color-red <?php if($this->value()=='color-red'):?>choose<?php endif;?>"><a  rel="color-red" href="#"></a></li>
                        <li class="color-yellow <?php if($this->value()=='color-yellow'):?>choose<?php endif;?>"><a  rel="color-yellow" href="#"></a></li>
                    </ul>
                </div>
                <input class="awe-style-color" type="hidden" style="width:100%;" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>">
            </label>
        <?php
        }
    }
    class Sortable_Section_Control extends WP_Customize_Control
    {
        public $type = 'sortable-section';

        public function render_content()
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <ul id="sortable">
                    <?php
                        $sections = array();
                        if($this->value()!='')
                            $sections = explode(',',$this->value());
                        if(count($sections)>0)
                            foreach($sections as $section):?>
                    <li class="ui-state-default" data-name="<?php echo esc_attr($section);?>"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo ucwords($section);?></li>
                                <?php endforeach;?>

                </ul>
                <a class="section-order-reset" href="#"><?php _e('Reset Order',LANGUAGE);?></a>
                <input type="hidden" class="section-order" style="width:100%;" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>">
            </label>

            <?php
        }
    }

    class Select_Animate_Style extends WP_Customize_Control
    {
        public function render_content()
        {
            $styles = array(
                'Attention Seekers'     =>  array(
                    'bounce','flash','pulse','rubberBand','shake','swing','tada','wobble'
                ),
                'Bouncing Entrances'    =>  array(
                    'bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp'
                ),

                'Fading Entrances'      =>  array(
                    'fadeIn','fadeInDown','fadeInDownBig','fadeInLeft','fadeInLeftBig','fadeInRight','fadeInRightBig','fadeInUp','fadeInUpBig','fadeInhalf-text','fadeInhalf-symbolBig'
                ),

                'Flippers'              =>  array(
                    'flip','flipInX','flipInY'
                ),
                'Lightspeed'            =>  array(
                    'lightSpeedIn'
                ),
                'Rotating Entrances'    =>  array(
                    'rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight'
                ),
                'Sliders'               =>  array(
                    'slideInDown','slideInLeft','slideInRight'
                ),
                'Specials'              =>  array(
                    'rollIn'
                ),
            );
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select <?php $this->link(); ?>>
                    <?php foreach($styles as $group=>$animates):?>
                        <optgroup label="<?php print $group;?>">
                          <?php foreach($animates as $animate):?>
                              <option <?php selected($animate,$this->value());?> value="<?php echo esc_attr($animate);?>"><?php print $animate;?></option>
                          <?php endforeach;?>
                        </optgroup>
                    <?php endforeach;?>
                </select>
            </label>
            <?php
        }
    }

    class TextAreaControl extends WP_Customize_Control{
        public function render_content(){
            $value = $this->value();
            ?>
            <textarea style="width:100%;height: 200px"  <?php $this->link(); ?> ><?php echo esc_textarea($value); ?></textarea>
            <?php
        }
    }

    class Introduction_Background extends WP_Customize_Control{

        public function render_content()
        {
            $values = json_decode(urldecode($this->value()),true); 
            //var_dump($values);
            ?>
            <li class="customize-control customize-control-radio">
                <span class="customize-control-title"><?php _e('Background Type',LANGUAGE);?></span>
                <select class="select-bg-type">
                    <option <?php selected($values['type'],'static',true); ?> value="static"><?php _e('Static Image',LANGUAGE); ?></option>
                    <option <?php selected($values['type'],'slider',true); ?> value="slider"><?php _e('Slider',LANGUAGE); ?></option>
                    <option <?php selected($values['type'],'color',true); ?> value="color"><?php _e('Color',LANGUAGE); ?></option>
                    <option <?php selected($values['type'],'video',true); ?> value="video"><?php _e('Video',LANGUAGE); ?></option>
                </select>
            </li>
            <?php// echo $values['type']; //=============== Video Bakground ==================// ?>
            <div>
            <li class="intro-bg-video customize-control customize-control-text" <?php if($values['type']!='video'):?>style="display: none" <?php endif;?>>
                <span class="customize-control-title"><?php _e('Youtube URL',LANGUAGE);?></span>
                <input type="text" class="intro-bg-video-url" value="<?php echo $values['video']['url'];?>">
                <br>
                <br>
                <span class="customize-control-title"><?php _e('Video Options',LANGUAGE);?></span>
                <?php _e('Hide Content?',LANGUAGE);?>
                <br>
                <input type="checkbox" class="intro-bg-video-autoplay" <?php checked($values['video']['autoplay'],'1');?> value="1">
                <?php _e('Auto Play?',LANGUAGE);?>
                <br>
                <div class="intro-bg-video-control-box" <?php if(!$values['video']['autoplay']):?> style="display: none"<?php endif;?>>
                    <input type="checkbox" class="intro-bg-video-control" <?php checked($values['video']['control'],'1');?> value="1">
                    <?php _e('Show Control Player?',LANGUAGE);?>
                    <br>
                </div>
                <input type="checkbox" class="intro-bg-video-mute" <?php checked($values['video']['mute'],'1');?> value="1">
                <?php _e('Mute?',LANGUAGE);?>
                <br>
                <input type="checkbox" class="intro-bg-video-loop" <?php checked($values['video']['loop'],'1');?> value="1">
                <?php _e('Loop?',LANGUAGE);?><br>
                <input type="checkbox" class="intro-bg-video-place-holder" <?php checked($values['video']['placeholder'],'1');?> value="1">
                <?php _e('Enable video place holder image?',LANGUAGE);?>
                <p class="customize-description">Display Image as background before play video</p>
                <div class="intro-bg-video-image-upload" <?php if($values['video']['placeholder'] != 1) echo 'style="display:none"'; ?>>
                    <div class="img-preview">
                    <?php if($values['video']['video_place_holder']!=''): ?>
                        <img src="<?php echo $values['video']['video_place_holder']; ?>">
                    <?php endif;?>
                    </div>
                    <input class="awe-img video_place_holder_url" type="hidden" style="width:100%;" value="<?php echo $values['video']['video_place_holder']; ?>">
                    <input type="button" class="button button-primary video-place-holder-upload-img" value="<?php if($values['video']['video_place_holder']!='') echo 'Change'; else echo 'Add'?>">
                </div>
            </li></div>

            <?php //======================= Static Image Background ===============================// ?>
            <div>
            <li class="intro-bg-static customize-control" <?php if($values['type']!='static'):?>style="display: none" <?php endif;?>>
                
                <span class="customize-control-title"><?php _e('Static Image',LANGUAGE);?></span>
                <div class="img-preview">
                    <?php if($values['static']['image']!=''):;?>
                        <img src="<?php echo $values['static']['image']; ?>">
                    <?php endif;?>
                </div>
                <input class="awe-img intro-bg-static-image-url" type="hidden" style="width:100%;" value="<?php echo $values['static']['image']; ?>">
                <input type="button" class="button button-primary intro-static-upload-img" value="<?php if($values['static']['image']!='') echo 'Change'; else echo 'Add'?>">
                <input type="button" class="button intro-static-remove-img" value="remove"<?php if($values['static']['image']==''):?> disabled<?php endif;?>>
            </li>
            </div>

            <?php //======================== Color Background =======================================// ?>
            <div>
            <li class="intro-bg-pattern customize-control" <?php if($values['type']!='color'):?>style="display: none" <?php endif;?>>
                <span class="customize-control-title"><?php _e('Background Color',LANGUAGE);?></span>
                <input class="intro-bg-color" value="<?php echo $values['color'] ?>" >
            </li>
            </div>

            <?php //======================== Slider Background =======================================// ?>
            <div>
            <li class="intro-bg-slider customize-control" <?php if($values['type']!='slider'):?>style="display: none" <?php endif;?>>
                <span class="customize-control-title"><?php _e('Transition',LANGUAGE);?></span>
                <select class="intro-bg-slider-transition-select">
                    <option <?php selected($values['slider']['transition'],'fade');?> value="fade">fade</option>
                    <option <?php selected($values['slider']['transition'],'slide');?> value="slide">slide</option>
                </select>
                <span class="customize-control-title"><?php _e('Speed',LANGUAGE);?></span>
                <select class="intro-bg-slider-speed-select">
                    <option <?php selected($values['slider']['speed'],'1000');?> value="1000">1000 mini seconds</option>
                    <option <?php selected($values['slider']['speed'],'2000');?> value="2000">2000 mini seconds</option>
                    <option <?php selected($values['slider']['speed'],'3000');?> value="3000">3000 mini seconds</option>
                    <option <?php selected($values['slider']['speed'],'4000');?> value="4000">4000 mini seconds</option>
                    <option <?php selected($values['slider']['speed'],'5000');?> value="5000">5000 mini seconds</option>
                    <option <?php selected($values['slider']['speed'],'6000');?> value="6000">6000 mini seconds</option>
                    <option <?php selected($values['slider']['speed'],'7000');?> value="7000">7000 mini seconds</option>
                    <option <?php selected($values['slider']['speed'],'8000');?> value="8000">8000 mini seconds</option>
                    <option <?php selected($values['slider']['speed'],'9000');?> value="9000">9000 mini seconds</option>
                    <option <?php selected($values['slider']['speed'],'10000');?> value="10000">10000 mini seconds</option>

                </select>
                <br>

                <span class="customize-control-title"><?php _e('Slider Multi Upload',LANGUAGE);?></span>
                <div class="intro-bg-slider-multi-upload">
                    <div class="img-previews multi-iamges-sort">
                        <?php if(is_array($values['slider']['images'])):?>
                            <?php
                            foreach($values['slider']['images'] as $i)
                                {
                                    echo "<div class=\"img-thumbail\"><img src=\"{$i}\"><span class=\"js-del fa fa-times\"></span></div>";
                                }
                            ?>
                        <?php endif;?>
                    </div>
                    <input class="awe-slider-img intro-bg-slider-images" type="hidden" style="width:100%;" value="<?php echo htmlentities(stripslashes(json_encode($values['slider']['images']))); ?>">
                    <input type="button" class="button button-primary intro-bg-slider-upload-multi-img" value="Add">
                </div>
            <li/>
            </div>
            <?php //====================== Overlay ==========================// ?>
            <li class="intro-bg-overlay customize-control">
                <label><input type="checkbox" class="introl-overlay-enable" <?php checked($values['overlay']['enable'],"1"); ?> > <?php _e('Enable Background Overlay',LANGUAGE) ?></label>
                <div class="display-overlay" <?php if($values['overlay']['enable'] != "1") echo 'style="display:none"'; ?> >
                    <label><input type="checkbox" class="intro-overlay-color" <?php $this->checked_array($values['overlay']['type'],'color') ?> > Enable Overlay Color </label>
                    <input type="text" class="intro-overlay-colors" value="<?php echo $values['overlay']['color'] ?>"><br>
                    <label><input type="checkbox" class="intro-overlay-pattern" <?php $this->checked_array($values['overlay']['type'],'pattern'); ?> ><?php _e('Enable Overlay Pattern',LANGUAGE) ?></label>
                    <div class="intro-bg-overlay-image-upload">
                        <div class="img-preview">
                        <?php if($values['overlay']['pattern']!=''):;?>
                            <img src="<?php echo $values['overlay']['pattern']; ?>">
                        <?php endif;?>
                        </div>
                        <input class="awe-img overlay-pattern-url" type="hidden" style="width:100%;" value="<?php echo $values['overlay']['pattern']; ?>">
                        <input type="button" class="button button-primary intro-overlay-upload-img" value="<?php if($values['overlay']['pattern']!='') echo 'Change'; else echo 'Add'?>">
                    </div>
                </div>
            </li>
            <label>
                <input class="intro-bg-data" type="hidden" <?php $this->link(); ?> value="<?php echo htmlentities(urldecode($this->value()));?>">
            </label>

            <?php

        }
        private function checked_array($array,$check){
            if(in_array($check, $array)) echo "checked";
        }
    }

    class Introduction_Background_Blog extends WP_Customize_Control{

        public function render_content()
        {
            $values = json_decode(urldecode($this->value()),true); 
            //var_dump($values);
            ?>
            <?php //======================= Static Image Background ===============================// ?>

            <li class="intro-bg-blog-static customize-control">
                
                <span class="customize-control-title"><?php _e('Background Blog header',LANGUAGE);?></span>
                <div class="img-preview">
                    <?php if($values['static']['image']!=''):;?>
                        <img src="<?php echo $values['static']['image']; ?>">
                    <?php endif;?>
                </div>
                <input class="awe-img blog-intro-bg-static-image-url" type="hidden" style="width:100%;" value="<?php echo $values['static']['image']; ?>">
                <input type="button" class="button button-primary blog-intro-static-upload-img" value="<?php if($values['static']['image']!='') echo 'Change'; else echo 'Add'?>">
                <input type="button" class="button blog-intro-static-remove-img" value="remove"<?php if($values['static']['image']==''):?> disabled<?php endif;?>>
            </li>
            <?php //====================== Overlay ==========================// ?>
            <li class="intro-bg-overlay customize-control">
                <label><input type="checkbox" class="blog-introl-overlay-enable" <?php checked($values['overlay']['enable'],"1"); ?> > <?php _e('Enable Background Overlay',LANGUAGE) ?></label>
                <div class="display-overlay" <?php if($values['overlay']['enable'] != "1") echo 'style="display:none"'; ?> >
                    <label><input type="checkbox" class="blog-intro-overlay-color" <?php $this->checked_array($values['overlay']['type'],'color') ?> > Enable Overlay Color </label>
                    <input type="text" class="blog-intro-overlay-colors" value="<?php echo $values['overlay']['color'] ?>"><br>
                    <label><input type="checkbox" class="blog-intro-overlay-pattern" <?php $this->checked_array($values['overlay']['type'],'pattern'); ?> ><?php _e('Enable Overlay Pattern',LANGUAGE) ?></label>
                    <div class="intro-bg-overlay-image-upload">
                        <div class="img-preview">
                        <?php if($values['overlay']['pattern']!=''):;?>
                            <img src="<?php echo $values['overlay']['pattern']; ?>">
                        <?php endif;?>
                        </div>
                        <input class="awe-img blog-overlay-pattern-url" type="hidden" style="width:100%;" value="<?php echo $values['overlay']['pattern']; ?>">
                        <input type="button" class="button button-primary blog-intro-overlay-upload-img" value="<?php if($values['overlay']['pattern']!='') echo 'Change'; else echo 'Add'?>">
                    </div>
                </div>
            </li>
            <label>
                <input class="intro-bg-data" type="hidden" <?php $this->link(); ?> value="<?php echo htmlentities(urldecode($this->value()));?>">
            </label>

            <?php

        }
        private function checked_array($array,$check){
            if(in_array($check, $array)) echo "checked";
        }
    }

    class Introduction_Info extends WP_Customize_Control{
        public function render_content() {

            $values = json_decode(urldecode($this->value()),true);

            ?>
            <?php if(array_key_exists('logo', $values)) : ?>
            <li class="customize-control customize-control-sub-title">
                <h5 class="customize-sub-title"><?php _e('Logo',LANGUAGE);?></h5>
            </li>
            
            <li class="intro-info-logo customize-control">
                <label>
                <input type="checkbox" class="intro-info-logo-show" <?php checked($values['logo']['enable'],'1');?> value="1">
                <?php _e('Display Logo?',LANGUAGE);?></label>
            </li>
        <?php endif; ?>
            <li class="customize-control customize-control-sub-title">
                <h5 class="customize-sub-title"><?php _e('Slogan',LANGUAGE);?></h5>
            </li>
            <li class="intro-info-slogan customize-control customize-control-select">
                <label>
                    <input type="checkbox" class="intro-info-slogan-show" <?php checked($values['slogan']['enable'],'1');?> value="1">
                    <?php _e('Display Slogan?',LANGUAGE);?>
                </label>
                <br>
                <span class="customize-control-title"><?php _e('Slogan Type',LANGUAGE);?></span>
                <select class="intro-info-slogan-type">
                    <option <?php selected($values['slogan']['type'],'static');?> value="static"><?php _e('Static',LANGUAGE);?></option>
                    <option <?php selected($values['slogan']['type'],'slider');?> value="slider"><?php _e('Slider',LANGUAGE);?></option>
                </select>
            </li>

            <li class="intro-info-slogan-static customize-control customize-control-text" <?php if($values['slogan']['type']!='static'):?>style="display: none" <?php endif;?>>
                <span class="customize-control-title"><?php _e('Slogan Static Text',LANGUAGE);?></span>
                <input type="text" class="intro-info-slogan-static-text" value="<?php echo htmlentities($values['slogan']['static_text']);?>">
                <br>
            </li>
            <li class="intro-info-slogan-slider customize-control customize-control-text" <?php if($values['slogan']['type']!='slider'):?>style="display: none" <?php endif;?>>
                <span class="customize-control-title"><?php _e('Slogan Slider Text',LANGUAGE);?></span>
                <?php if(is_array($values['slogan']['slider_text']))
                    foreach($values['slogan']['slider_text'] as $slider_text):?>
                <div class="slogan-item">
                    <input type="text" class="intro-info-slogan-slider-text" value="<?php echo htmlentities($slider_text);?>">
                    <a class="intro-info-slogan-item-remove" href="#">Delete</a>
                </div>
                <?php endforeach;?>

                <input type="button" value="Add More" class="button button-primary intro-info-slogan-slider-addmore">
                <br>
                <div class="intro-info-slogan-transition">
                    <span class="customize-control-title"><?php _e('Slogan Transition',LANGUAGE);?></span>
                    <select class="intro-info-slogan-transition-select">
                        <option <?php selected($values['slogan']['transition'],'fade');?> value="fade">fade</option>
                        <option <?php selected($values['slogan']['transition'],'fadeUp');?> value="fadeUp">fadeUp</option>
                        <option <?php selected($values['slogan']['transition'],'backSlide');?> value="backSlide">backSlide</option>
                        <option <?php selected($values['slogan']['transition'],'goDown');?> value="goDown">goDown</option>
                    </select><br>
                    <span class="customize-control-title"><?php _e('Slogan Speed',LANGUAGE);?></span>
                    <select class="intro-info-slogan-speed-select">
                        <option <?php selected($values['slogan']['speed'],'1000');?> value="1000">1000 mini seconds</option>
                        <option <?php selected($values['slogan']['speed'],'2000');?> value="2000">2000 mini seconds</option>
                        <option <?php selected($values['slogan']['speed'],'3000');?> value="3000">3000 mini seconds</option>
                        <option <?php selected($values['slogan']['speed'],'4000');?> value="4000">4000 mini seconds</option>
                        <option <?php selected($values['slogan']['speed'],'5000');?> value="5000">5000 mini seconds</option>
                        <option <?php selected($values['slogan']['speed'],'6000');?> value="6000">6000 mini seconds</option>
                        <option <?php selected($values['slogan']['speed'],'7000');?> value="7000">7000 mini seconds</option>
                        <option <?php selected($values['slogan']['speed'],'8000');?> value="8000">8000 mini seconds</option>
                        <option <?php selected($values['slogan']['speed'],'9000');?> value="9000">9000 mini seconds</option>
                        <option <?php selected($values['slogan']['speed'],'10000');?> value="10000">10000 mini seconds</option>
                    </select>

                    <br>
                </div>
                <br>
            </li>
            <li class="customize-control customize-control-sub-title">
                <h5 class="customize-sub-title"><?php _e('Title',LANGUAGE);?></h5>
            </li>
            <li class="intro-info-button">
                <label>
                <input type="checkbox" class="intro-info-button-show" <?php checked($values['button']['enable'],'1');?> value="1">
                <?php _e('Display Title?',LANGUAGE);?></label>
                <br>
            </li>
            <li class="intro-info-button-settings customize-control customize-control-text" <?php if(!$values['button']['enable']):?> style="display: none"<?php endif;?>>
                <span class="customize-control-title"><?php _e('Title Text',LANGUAGE);?></span>
                <input type="text" class="intro-info-button-text" value="<?php echo htmlentities($values['button']['text']);?>">
            </li>
            <label>

                <input type="hidden" class="info_data" <?php $this->link(); ?> value="<?php echo htmlentities($this->value());?>">
            </label>
        <?php
        }
    }
}