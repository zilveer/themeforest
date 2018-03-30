<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 4/26/14
 * Time: 1:47 PM
 */


class AWECustomize extends AWEThemeSettings
{
    public $wp_customize; 
    public $default_config;
    public $name_option;

    public function __construct($default_config)
    {
        $this->default_config = $default_config;
        $this->name_option = ($this->default_config) ? $this->default_config['theme_options_name']: self::THEME_OPTIONS;
        $this->options = get_option($this->name_option);

        if(is_array($this->options))
            $this->options = array_merge($this->theme_options,$this->options);


        add_action( 'customize_preview_init' ,                      array( $this, 'awe_customize_live_preview' ) );
        add_action( 'customize_controls_enqueue_scripts',           array( $this, 'awe_customize_loading_script') );
        add_action( 'customize_controls_print_scripts',             array( $this, 'awe_customize_print_script') );
        add_action( 'customize_register',                           array( $this, 'awe_customize_customizer_register'));
        if(isset($this->options['extra']['style_color']) && $this->options['extra']['style_color']=='custom')
        {
            add_action('customize_save_after', array($this,'customize_generate_custom_color_file'));
        }
    }

    public function customize_generate_custom_color_file()
    {
        $this->options = get_option($this->name_option);
        $custom_color_config = $this->default_config['generate_custom_color'];
        $this->generate_custom_color_css($this->options['extra']['style_color_custom'],$custom_color_config);
    }
    public function awe_customize_live_preview()
    {
        if(AWE_DEBUG==true)
            $min=".min";
        else
            $min="";
        wp_enqueue_script('awe-customizer', AWE_JS_URL . 'livepreview'.$min.'.js', array(  'jquery', 'customize-preview' ),'',true );
    }
    public function awe_customize_loading_script()
    {
        if(AWE_DEBUG==true)
            $min=".min";
        else
            $min="";

        wp_enqueue_script( 'spectrum-color', AWE_JS_URL . 'spectrum'.$min.'.js', array( ),null,true );
        wp_enqueue_script( 'awe-customizer-js', AWE_JS_URL.'customizer'.$min.'.js', array(), null, true);
        wp_enqueue_style(  'awe-customizer-styles', AWE_CSS_URL. 'customizer4.x.css');
        wp_enqueue_style(  'spectrum-styles', AWE_CSS_URL. 'spectrum.css');
    }

    public function awe_customize_print_script()
    {
        print '<script>var name_option = "'.$this->name_option.'"</script>';
    }

    public function add_sub_title($section,$id,$label,$priority)
    {
        $this->wp_customize->add_setting($id);
        $this->wp_customize->add_control( new Custom_Sub_Title($this->wp_customize, $id, array(
            'label'    => $label,
            'section'  => $section,
            'settings' => $id,
            'priority' => $priority,
            'sanitize_callback' => array($this, 'awe_sanitize_callback')
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

    public function typography($section,$desc='',$name,$priority,$show_color=false)
    {


        $this->wp_customize->add_setting($this->name_option.'[typography]['.$name.'][enable]', array(
            'default'   =>  $this->options['typography'][$name]['enable'],
            'capability' => 'edit_theme_options',
            'type' => 'option',
            'sanitize_callback' => array($this, 'awe_sanitize_callback')
        ));

        $this->wp_customize->add_control(new Input_Enable_Font($this->wp_customize, $name.'-font-enable',array(
            'settings' => $this->name_option.'[typography]['.$name.'][enable]',
            'label' => 'Enable Custom '.ucwords($name).' Font',
            'section' => $section,
            'dataname' => $name,
            'priority'   => $priority++,
        )));
        $this->wp_customize->get_setting( $this->name_option.'[typography]['.$name.'][enable]' )->transport = 'postMessage';

        //font family
        $this->wp_customize->add_setting($this->name_option.'[typography]['.$name.'][font]', array(
            'default'           => $this->options['typography'][$name]['font'],
            'capability'        => 'edit_theme_options',
            'type'              => 'option',
            'sanitize_callback' => array($this, 'awe_sanitize_callback')
        ));

        $fonts = $this->get_fonts($this->options['font']);
        $this->wp_customize->add_control( new Choose_Font_Family($this->wp_customize, $name.'-font-family', array(
            'label'         => __('Font Family', self::LANG),
            'section'       => $section,
            'settings'      => $this->name_option.'[typography]['.$name.'][font]',
            'fonts'         => $fonts,
            'dataname'      => $name,
            'priority'      => $priority++,
        )));
        $this->wp_customize->get_setting( $this->name_option.'[typography]['.$name.'][font]' )->transport = 'postMessage';

        //weight
        $this->wp_customize->add_setting($this->name_option.'[typography]['.$name.'][weight]', array(
            'default'           => $this->options['typography'][$name]['weight'],
            'capability'        => 'edit_theme_options',
            'type'              => 'option',
            'sanitize_callback' => array($this, 'awe_sanitize_callback')
        ));
        $this->wp_customize->add_control( new Choose_Font_Style($this->wp_customize, $name.'-font-weight', array(
            'label'    => __('Font Weight', self::LANG),
            'section'  => $section,
            'settings' => $this->name_option.'[typography]['.$name.'][weight]',
            'styles'     => $fonts[$this->options['typography'][$name]['font']],
            'priority'      => $priority++,
        )));
        $this->wp_customize->get_setting( $this->name_option.'[typography]['.$name.'][weight]' )->transport = 'postMessage';

        //size
        $this->wp_customize->add_setting($this->name_option.'[typography]['.$name.'][size]', array(
            'default' => $this->options['typography'][$name]['size'],
            'capability' => 'edit_theme_options',
            'type' => 'option',
            'sanitize_callback' => array($this, 'awe_sanitize_callback')
        ));
        $this->wp_customize->add_control($name.'-font-size', array(
            'label' => __('Font Size', self::LANG),
            'section' => $section,
            'settings' => $this->name_option.'[typography]['.$name.'][size]',
            'priority'      => $priority++,
        ));
        $this->wp_customize->get_setting( $this->name_option.'[typography]['.$name.'][size]' )->transport = 'postMessage';

        //transform
        $this->wp_customize->add_setting($this->name_option.'[typography]['.$name.'][transform]', array(
            'default' => $this->options['typography'][$name]['transform'],
            'capability' => 'edit_theme_options',
            'type' => 'option',
            'sanitize_callback' => array($this, 'awe_sanitize_callback')
        ));
        $this->wp_customize->add_control($name.'-transform', array(
            'label' => __('Transform', self::LANG),
            'section' => $section,
            'settings' => $this->name_option.'[typography]['.$name.'][transform]',
            'priority'      => $priority++,
            'type' => 'select',
            'choices' => array(
                '' => 'None',
                'capitalize' => 'Capitalize',
                'uppercase' => 'UpperCase',
                'lowercase' => 'LowerCase',
            ),


        ));
        $this->wp_customize->get_setting( $this->name_option.'[typography]['.$name.'][transform]' )->transport = 'postMessage';

        //line-height
        $this->wp_customize->add_setting($this->name_option.'[typography]['.$name.'][lineheight]', array(
            'default' => $this->options['typography'][$name]['lineheight'],
            'capability' => 'edit_theme_options',
            'type' => 'option',
            'sanitize_callback' => array($this, 'awe_sanitize_callback')
        ));
        $choices['']="None";
        for($i=10;$i<=50;$i++){
            $choices[$i] = $i." px";
        }

        $this->wp_customize->add_control($name.'-lineheight', array(
            'label' => __('Line Height', self::LANG),
            'section' => $section,
            'settings' => $this->name_option.'[typography]['.$name.'][lineheight]',
            'priority'      => $priority++,
            'type' => 'select',
            'choices' => $choices,


        ));
        $this->wp_customize->get_setting( $this->name_option.'[typography]['.$name.'][lineheight]' )->transport = 'postMessage';


        if(isset($this->options['typography'][$name]['apply'])){
            $this->wp_customize->add_setting($this->name_option.'[typography]['.$name.'][apply][home]', array(
                'default'           => $this->options['typography'][$name]['apply']['home'],
                'capability'        => 'edit_theme_options',
                'type'              => 'option',
                'sanitize_callback' => array($this, 'awe_sanitize_callback')
            ));
            $this->wp_customize->add_control( $name.'-apply-home', array(
                'label'    => __('Homepage', LANGUAGE),
                'section'  => $section,
                'settings' => $this->name_option.'[typography]['.$name.'][apply][home]',
                'type'      => 'checkbox',
                'priority'   => $priority++,
            ));
            $this->wp_customize->get_setting( $this->name_option.'[typography]['.$name.'][apply][home]' )->transport = 'postMessage';

            $this->wp_customize->add_setting($this->name_option.'[typography]['.$name.'][apply][blog]', array(
                'default'           => $this->options['typography'][$name]['apply']['home'],
                'capability'        => 'edit_theme_options',
                'type'           => 'option',
                'sanitize_callback' => array($this, 'awe_sanitize_callback')
            ));

            $this->wp_customize->add_control( $name.'-apply-blog', array(
                'label'    => __('Blog', LANGUAGE),
                'section'  => $section,
                'settings' => $this->name_option.'[typography]['.$name.'][apply][blog]',
                'type'      => 'checkbox',
                'priority'   => $priority++,
            ));
            $this->wp_customize->get_setting( $this->name_option.'[typography]['.$name.'][apply][blog]' )->transport = 'postMessage';
        }


        //color
        if($show_color){
            $this->wp_customize->add_setting($this->name_option.'[typography]['.$name.'][color]', array(
                'default'           => $this->options['typography'][$name]['color'],
                'capability'        => 'edit_theme_options',
                'type'           => 'option',
                'sanitize_callback' => array($this, 'awe_sanitize_callback')
            ));
            $this->wp_customize->add_control( new WP_Customize_Color_Control($this->wp_customize, $name.'-font-color', array(
                'label'    => __('Color', self::LANG),
                'section'  => $section,
                'settings' => $this->name_option.'[typography]['.$name.'][color]',
                'priority'      => $priority++,
            )));
            $this->wp_customize->get_setting( $this->name_option.'[typography]['.$name.'][color]' )->transport = 'postMessage';
        }
    }

    public function awe_customize_customizer_register($wp_customize)
    {
        $this->wp_customize = $wp_customize;


        $wp_customize->add_section('awe_header', array(
            'title'    => __('Header Setting', self::LANG),
            'priority' => 4,
        ));

        //favicon

        //apple icon
        $logo_slogan = apply_filters('customize_logo_slogo_section',__('Logo & Slogan', self::LANG));
        $enable_logo = apply_filters('customize_enable_logo',true);
        $enable_slogan = apply_filters('customize_enable_slogan',true);
        $enable_logo_text = apply_filters('customize_enable_logo_text',true);
        $enable_logo_image_checkbox = apply_filters('customize_enable_image_checkbox',true);

        if($enable_slogan || $enable_logo)
        {
            $wp_customize->add_panel('logo_panel', array(
                'priority'       => 5,
                'capability'     => 'edit_theme_options',
                'theme_supports' => '',
                'title'          => __('Logo Settings',LANGUAGE),
                'description'    => 'Change Logo & Slogan Settings',
            ) );
            $wp_customize->add_section('awe_logo_image', array(
                'title'    => __('Logo Image',self::LANG),
                'priority' => 2,
                'panel'  => 'logo_panel',
            ));
            $wp_customize->add_section('awe_logo_sticky_image', array(
                'title'    => __('Logo Sticky Image',self::LANG),
                'priority' => 3,
                'panel'  => 'logo_panel',
            ));
        }

        if($enable_logo){
            $wp_customize->add_setting (
                $this->name_option.'[logo][image_height]',
                array(
                    'default' => $this->options['logo']['image_height'],
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => array($this, 'awe_sanitize_callback')
                )
            );
            $wp_customize->add_control (
                $this->name_option.'[logo][image_height]',
                array(
                    'label' => "Height",
                    'section' => 'awe_logo_image',
                    'type' => 'text',
                    'settings' => $this->name_option.'[logo][image_height]',
                    'priority' => 2
                )
            );
            $wp_customize->get_setting( $this->name_option.'[logo][image_height]' )->transport = 'postMessage';

            $wp_customize->add_setting (
                $this->name_option.'[logo][image_width]',
                array(
                    'default' => $this->options['logo']['image_width'],
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => array($this, 'awe_sanitize_callback')
                )
            );
            $wp_customize->add_control (
                $this->name_option.'[logo][image_width]',
                array(
                    'label' => "Width",
                    'section' => 'awe_logo_image',
                    'type' => 'text',
                    'settings' => $this->name_option.'[logo][image_width]',
                    'priority' => 3
                )
            );
            $wp_customize->get_setting( $this->name_option.'[logo][image_width]' )->transport = 'postMessage';

            // logo image
            $wp_customize->add_setting($this->name_option.'[logo][image]', array(
                'default'           => $this->options['logo']['image'],
                'capability'        => 'edit_theme_options',
                'type'              => 'option',
                'sanitize_callback' => array($this, 'awe_sanitize_callback')
            ));
            $wp_customize->add_control( new Choose_Single_Image_Control($wp_customize, $this->name_option.'[logo][image]', array(
                'label'    => __('Logo Image', LANGUAGE),
                'section'  => 'awe_logo_image',
                'settings' => $this->name_option.'[logo][image]',
                'priority'   => 4,
                'add_button_class'  => 'add-logo-image',
                'remove_button_class'   =>  'remove-logo-image',
            )));
            $wp_customize->get_setting( $this->name_option.'[logo][image]' )->transport = 'postMessage';
            ///////////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////////////////////////
            $wp_customize->add_setting (
                $this->name_option.'[logo_stickey][image_height]',
                array(
                    'default' => $this->options['logo_stickey']['image_height'],
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                )
            );
            $wp_customize->add_control (
                $this->name_option.'[logo_stickey][image_height]',
                array(
                    'label' => "Height",
                    'section' => 'awe_logo_sticky_image',
                    'type' => 'text',
                    'settings' => $this->name_option.'[logo_stickey][image_height]',
                    'priority' => 2
                )
            );
            $wp_customize->get_setting( $this->name_option.'[logo_stickey][image_height]' )->transport = 'postMessage';

            $wp_customize->add_setting (
                $this->name_option.'[logo_stickey][image_width]',
                array(
                    'default' => $this->options['logo_stickey']['image_width'],
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => array($this, 'awe_sanitize_callback')
                )
            );
            $wp_customize->add_control (
                $this->name_option.'[logo_stickey][image_width]',
                array(
                    'label' => "Width",
                    'section' => 'awe_logo_sticky_image',
                    'type' => 'text',
                    'settings' => $this->name_option.'[logo_stickey][image_width]',
                    'priority' => 3
                )
            );
            $wp_customize->get_setting( $this->name_option.'[logo_stickey][image_width]' )->transport = 'postMessage';

            // logo image
            $wp_customize->add_setting($this->name_option.'[logo_stickey][image]', array(
                'default'           => $this->options['logo_stickey']['image'],
                'capability'        => 'edit_theme_options',
                'type'              => 'option',
                'sanitize_callback' => array($this, 'awe_sanitize_callback')
            ));
            $wp_customize->add_control( new Choose_Single_Image_Control($wp_customize, $this->name_option.'[logo_stickey][image]', array(
                'label'    => __('Logo Image', LANGUAGE),
                'section'  => 'awe_logo_sticky_image',
                'settings' => $this->name_option.'[logo_stickey][image]',
                'priority'   => 4,
                'add_button_class'  => 'add-logo-image',
                'remove_button_class'   =>  'remove-logo-image',
            )));
            $wp_customize->get_setting( $this->name_option.'[logo_stickey][image]' )->transport = 'postMessage';


        }



        //custom script
        ########### TYPOGRAPHY ############
        $wp_customize->add_panel('typography_panel', array(
            'priority'       => 15,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __('Typography',LANGUAGE),
        ) );

        /* Logo */
        $display_logo_slogan = apply_filters("display_typography_logo_slogan",true);
        if($display_logo_slogan){
            $wp_customize->add_section('awe_typography_logo', array(
                'title'    => __('Logo & Slogan', self::LANG),
                'priority' => 1,
                'panel'  => 'typography_panel',
            ));

            $display_logo = apply_filters("display_typography_logo",true);
            if($display_logo) $this->typography('awe_typography_logo','','logo',1);
            $display_slogan = apply_filters("display_typography_slogan",true);
            if($display_slogan) $this->typography('awe_typography_logo','','slogan',15);
        }

        /* NavBar */
        $display_navbar = apply_filters("display_typography_navbar",true);
        if($display_navbar) {
            $wp_customize->add_section('awe_typography_nav', array(
                'title'    => __('NAVBAR', self::LANG),
                'priority' => 2,
                'panel'  => 'typography_panel',
            ));
            $this->typography('awe_typography_nav','','navbar',1);
        }



        /* Body And Content */
        $display_body_content = apply_filters("display_typography_body_content",true);
        if($display_body_content){
            $wp_customize->add_section('awe_typography_body_content', array(
                'title'    => __('Body And Content', self::LANG),
                'description'   =>  __('"Body Font Size (px)" will affect the sizing of all copy outisde of a post or page content area. "Content Font Size (px)" will affect the sizing of all copy inside a post or page content area. Headings are set with percentages and sized proportionally to these settings.',self::LANG),
                'priority' => 3,
                'panel'  => 'typography_panel',
            ));
            $display_logo_body = apply_filters("display_typography_body",true);
            if($display_logo_body) $this->typography('awe_typography_body_content','','body',1);

            $display_logo_content = apply_filters("display_typography_content",true);
            if($display_logo_content) $this->typography('awe_typography_body_content','','content',15);
        }

        /* Headline */
        $display_headline = apply_filters("display_typography_headline",true);
        if($display_headline) {
            $wp_customize->add_section('awe_typography_headline', array(
                'title'    => __('Headline', self::LANG),
                'priority' => 4,
                'panel'  => 'typography_panel',
            ));
            $headlines = array("h1","h2","h3","h4","h5","h6");
            $count = 10;
            foreach($headlines as $hl){

                $display_hl = apply_filters("display_typography_{$hl}",true);
                if($display_hl)
                    $this->typography('awe_typography_headline','',$hl,$count++);
                $count +=10;
            }
        }

        /* Site Links */
        $wp_customize->add_section('awe_typography_site_link', array(
            'title'    => __('Site Links', self::LANG),
            'priority' => 5,
            'panel'  => 'typography_panel',
        ));
        $this->add_description('awe_typography_site_link','site_links_desc',__('Site link colors are also used as accents for various elements throughout your site, so make sure to select something you really enjoy and keep an eye out for how it affects your design.',self::LANG),121);

        $wp_customize->add_setting($this->name_option.'[typography][site-link][color]', array(
            'default'           => $this->options['typography']['site-link']['color'],
            'capability'        => 'edit_theme_options',
            'type'           => 'option',
            'sanitize_callback' => array($this, 'awe_sanitize_callback')

        ));
        $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'site-links', array(
            'label'    => __('Site Links', self::LANG),
            'section'  => 'awe_typography_site_link',
            'settings' => $this->name_option.'[typography][site-link][color]',
            'priority'   => 1,
        )));
        $wp_customize->get_setting( $this->name_option.'[typography][site-link][color]' )->transport = 'postMessage';

        $wp_customize->add_setting($this->name_option.'[typography][site-link][color-hover]', array(
            'default'           => $this->options['typography']['site-link']['color-hover'],
            'capability'        => 'edit_theme_options',
            'type'           => 'option',
            'sanitize_callback' => array($this, 'awe_sanitize_callback')
        ));
        $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'site-links-hover', array(
            'label'    => __('Site Links Hover', self::LANG),
            'section'  => 'awe_typography_site_link',
            'settings' => $this->name_option.'[typography][site-link][color-hover]',
            'priority'   => 2,
        )));
        $wp_customize->get_setting( $this->name_option.'[typography][site-link][color-hover]' )->transport = 'postMessage';

        //input hidden theme name options
        $this->wp_customize->add_setting('awe-typography', array(
            'default'   =>  '',
            'capability' => 'edit_theme_options',
            'type' => 'option',
            'sanitize_callback' => array($this, 'awe_sanitize_callback')
        ));

        $this->wp_customize->add_control(new Input_hidden($this->wp_customize, '-awe-typography',array(
            'settings' => 'awe-typography',
            'label' => 'Option Theme Name',
            'section' => 'awe_typography_site_link',
            'priority'   => 3,
        )));
        $this->wp_customize->get_setting( 'awe-typography' )->transport = 'postMessage';

        ########### SOCIAL NETWORK ########
        $wp_customize->add_section('awe_social', array(
            'title'    => __('Social Network', self::LANG),
            'priority' => 16,
        ));
        $wp_customize->add_setting($this->name_option.'[social][enable]', array(
            'default'           => $this->options['social']['enable'],
            'capability'        => 'edit_theme_options',
            'type'           => 'option',
            'sanitize_callback' => array($this, 'awe_sanitize_callback')
        ));

        $wp_customize->add_control( $this->name_option.'[social][enable]', array(
            'label'    => __('Display Social?', LANGUAGE),
            'section'  => 'awe_social',
            'settings' => $this->name_option.'[social][enable]',
            'type'      => 'checkbox',
            'priority'   => 1,
        ));
        $wp_customize->get_setting( $this->name_option.'[social][enable]' )->transport = 'postMessage';

        $socials = array(
            'facebook'  =>  'fa fa-facebook',
            'google'    =>  'fa fa-google-plus',
            'twitter'   =>  'fa fa-twitter',
            'github'    =>  'fa fa-github',
            'instagram' =>  'fa fa-instagram',
            'pinterest' =>  'fa fa-pinterest',
            'linkedin'  =>  'fa fa-linkedin-square',
            'skype'     =>  'fa fa-skype',
            'tumblr'    =>  'fa fa-tumblr',
            'youtube'   =>  'fa fa-youtube',
            'vimeo'     =>  'fa fa-vimeo-square',
            'flickr'    =>  'fa fa-flickr',
            'dribbble'  =>  'fa fa-dribbble',
        );
        $count=2;

        foreach($socials as $k=>$v){
            $this->add_sub_title('awe_social',$k.'_subtitle',ucwords($k),$count++);
            $wp_customize->add_setting($this->name_option.'[social]['.$k.'][enable]', array(
                'default'           => $this->options['social'][$k]['enable'],
                'capability'        => 'edit_theme_options',
                'type'           => 'option',
                'sanitize_callback' => array($this, 'awe_sanitize_callback')
            ));

            $wp_customize->add_control( $this->name_option.'[social]['.$k.'][enable]', array(
                'label'    => __('Show', LANGUAGE),
                'section'  => 'awe_social',
                'settings' => $this->name_option.'[social]['.$k.'][enable]',
                'type'      => 'checkbox',
                'priority'   => $count++,
            ));
            $wp_customize->get_setting( $this->name_option.'[social]['.$k.'][enable]' )->transport = 'postMessage';

            $this->wp_customize->add_setting($this->name_option.'[social]['.$k.'][url]', array(
                'default'   =>  $this->options['social'][$k]['url'],
                'capability' => 'edit_theme_options',
                'type' => 'option',
                'sanitize_callback' => array($this, 'awe_sanitize_callback')
            ));

            $this->wp_customize->add_control(new Input_Social($this->wp_customize, $this->name_option.'[social]['.$k.']',array(
                'settings' => $this->name_option.'[social]['.$k.'][url]',
                'label' => 'Option Theme Name',
                'section' => 'awe_social',
                'icon'  => $v,
                'name'  => $k,
                'priority'   => $count++,
            )));
            $this->wp_customize->get_setting( $this->name_option.'[social]['.$k.'][url]')->transport = 'postMessage';
        }


        //input hidden theme name options
        $this->wp_customize->add_setting('awe-social', array(
            'default'   =>  '',
            'capability' => 'edit_theme_options',
            'type' => 'option',
            'sanitize_callback' => array($this, 'awe_sanitize_callback')
        ));

        $this->wp_customize->add_control(new Input_hidden($this->wp_customize, '-awe-social',array(
            'settings' => 'awe-social',
            'label' => 'Option Theme Name',
            'section' => 'awe_social',
            'priority'   => 1,
        )));
        $this->wp_customize->get_setting( 'awe-social' )->transport = 'postMessage';

        ########### FOOTER SETTING ########
        $wp_customize->add_section('awe_footer', array(
            'title'    => __('Footer Settings', self::LANG),
            'priority' => 17,
        ));

        //remove WP copyright
        $wp_customize->add_setting (
            $this->name_option."[footer][remove]",
            array(
                'default' => $this->options['footer']['remove'],
                'capability'     => 'edit_theme_options',
                'type'           => 'option',
                'sanitize_callback' => array($this, 'awe_sanitize_callback')
            )
        );

        $wp_customize->add_control (
            $this->name_option."[footer][remove]",
            array(
                'label' => __("Remove Default WP Copyright",self::LANG),
                'section' => 'awe_footer',
                'type' => 'checkbox',
                'settings' => $this->name_option."[footer][remove]",
                'priority'  =>  1,
            )
        );
        $wp_customize->get_setting( $this->name_option."[footer][remove]" )->transport = 'postMessage';

        //copyright
        $wp_customize->add_setting (
            $this->name_option."[footer][copyright]",
            array(
                'default'        => $this->options['footer']['copyright'],
                'capability'     => 'edit_theme_options',
                'type'           => 'option',
                'sanitize_callback' => array($this, 'awe_sanitize_callback')
            )
        );
        $wp_customize->add_control (
            new Custom_Textarea_Control($wp_customize,$this->name_option."[footer][copyright]",
                array(
                    'label' => __("Copyright",self::LANG),
                    'section' => 'awe_footer',

                    'settings' =>  $this->name_option."[footer][copyright]",
                    'priority'  =>  2,
                )
            ));
        $wp_customize->get_setting( $this->name_option."[footer][copyright]" )->transport = 'postMessage';
        //custom script
        $wp_customize->add_setting (
            $this->name_option."[footer][script]",
            array(
                'default'        => $this->options['footer']['script'],
                'capability'     => 'edit_theme_options',
                'type'           => 'option',
                'sanitize_callback' => array($this, 'awe_sanitize_callback')
            )
        );
        $wp_customize->add_control (
            new Custom_Textarea_Control($wp_customize,$this->name_option."[footer][script]",
                array(
                    'label' => __("Custom Footer Script",self::LANG),
                    'section' => 'awe_footer',

                    'settings' =>  $this->name_option."[footer][script]",
                    'priority'  =>  3,
                )
            ));
    }

    public function awe_sanitize_callback($value)
    {
        return $value;
    }

}
if (class_exists('WP_Customize_Control'))
{
    class Input_Social extends WP_Customize_Control {
        public $icon;
        public $name;
        public function render_content(){
            ?>
            <label class="label-social">
                <i class="<?php echo esc_attr($this->icon);?>"></i>
                <input type="text" class="input-social" data-name="<?php echo esc_attr($this->name);?>" <?php print $this->link(); ?> value="<?php print $this->value();?>">
            </label>
        <?php
        }
    }
    class Custom_Sub_Title extends WP_Customize_Control {
        public $type = 'sub-title';
        public function render_content() {
            ?>
            <h5 class="customize-sub-title"><?php echo esc_html( $this->label ); ?></h5>
        <?php
        }
    }




    class Custom_Description extends WP_Customize_Control {
        public $type = 'description';
        public function render_content() {
            ?>
            <p class="customize-description"><?php echo esc_html( $this->label ); ?></p>
        <?php
        }
    }

    class Input_Enable_Font extends WP_Customize_Control{
        public $type = 'enable_font';
        public $dataname;
        public function render_content() {
            ?>
            <label>
                <input type="checkbox" <?php checked($this->value(),1);?> <?php print $this->link(); ?> data-name="<?php echo esc_attr($this->dataname); ?>" value="1">
                <?php echo esc_html( $this->label ); ?>
            </label>
        <?php
        }
    }

    class Input_hidden extends WP_Customize_Control{
        public $name;
        public function render_content() {
            ?>
            <label>
                <input type="hidden" <?php $this->link(); ?> value="<?php print $this->value();?>">
            </label>
        <?php
        }
    }

    class Choose_Font_Family extends WP_Customize_Control{
        public $type = 'choose_font';
        public $fonts;
        public $dataname;
        public function render_content()
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select  <?php $this->link(); ?> data-name="<?php echo esc_attr($this->dataname); ?>">
                    <?php foreach($this->fonts as $k=>$v):?>
                        <option <?php selected($k,$this->value());?> data-style="<?php echo esc_attr($v);?>" value="<?php echo esc_attr($k);?>"><?php echo urldecode($k);?></option>
                    <?php endforeach;?>
                </select>
            </label>
        <?php
        }
    }
    class Custom_Textarea_Control extends WP_Customize_Control {
        public $type = 'textarea';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
        <?php
        }
    }

    class Choose_Font_Style extends WP_Customize_Control{
        public $type = 'choose_style';
        public $styles;
        public function name_style($fw)
        {
            $fontExpands = array(
                "n1" => "Thin",
                "i1" => "Thin Italic",
                "n2" => "Extra Light",
                "i2" => "Extra Light Italic",
                "n3" => "Light",
                "i3" => "Light Italic",
                "n4" => "Normal",
                "i4" => "Italic",
                "n5" => "Medium",
                "i5" => "Medium Italic",
                "n6" => "Semi Bold",
                "i6" => "Semi Bold Italic",
                "n7" => "Bold",
                "i7" => "Bold Italic",
                "n8" => "Extra Bold",
                "i8" => "Extra Bold Italic",
                "n9" => "Heavy",
                "i9" => "Heavy Italic",
                "100" => "Thin",
                "100italic" => "Thin Italic",
                "200" => "Extra Light",
                "200italic" => "Extra-Light Italic",
                "300" => "Light",
                "300italic" => "Light Italic",
                "400" => "Normal",
                "400italic" => "Italic",
                "500" => "Medium",
                "500italic" => "Medium Italic",
                "600" => "Semi Bold",
                "600italic" => "Semi-Bold Italic",
                "700" => "Bold",
                "700italic" => "Bold Italic",
                "800" => "Extra Bold",
                "800italic" => "Extra-Bold Italic",
                "900" => "Ultra Bold",
                "900italic" => "Ultra-Bold Italic",
                "" => ""
            );
            return isset($fontExpands[$fw])?$fontExpands[$fw]:"Normal";
        }
        public function render_content()
        {
            $styles = explode(",",$this->styles);
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select  <?php $this->link(); ?>>
                    <?php foreach($styles as $v):?>
                        <option <?php selected($v,$this->value());?> value="<?php echo esc_attr($v);?>"> <?php echo esc_attr($this->name_style($v));?></option>
                    <?php endforeach;?>
                </select>
            </label>
        <?php
        }
    }

    class Choose_Multi_Images_Control extends WP_Customize_Control
    {
        public $type = 'upload-multi-images';

        public function render_content()
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <p><?php _e("This setting is used for slider layout",LANGUAGE);?></p>
                <div class="img-preview">
                    <?php if($this->value()!=''):?>
                        <?php $value = json_decode($this->value());
                        if(is_array($value))
                            foreach($value as $i)
                            {
                                print "<img src=\"".esc_url($i)."\">";
                            }
                        ?>
                    <?php endif;?>
                </div>
                <input class="awe-multi-img" type="hidden" style="width:100%;" <?php $this->link(); ?> value="<?php print $this->value(); ?>">
                <input type="button" class="button button-primary upload-multi-img " value="Change">
                Choose_Single_Image_Control
            </label>
        <?php
        }
    }

    class Choose_Single_Image_Control extends WP_Customize_Control
    {
        public $type = 'upload-single-image';
        public $add_button_class;
        public $remove_button_class;
        public $desc;
        public function render_content()
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php if($this->desc!='' || !empty($this->desc)):?><p><?php print esc_attr($this->desc);?></p><?php endif;?>
                <div class="img-preview">
                    <?php if($this->value()!=''):;?>
                        <img src="<?php echo esc_url($this->value()); ?>">
                    <?php endif;?>
                </div>
                <input class="awe-img" type="hidden" style="width:100%;" <?php $this->link(); ?> value="<?php echo esc_url($this->value()); ?>">
                <input type="button" class="button button-primary input-upload <?php if($this->add_button_class) echo esc_attr($this->add_button_class); else echo "upload-img";?>" value="<?php if($this->value()!='') echo 'Change'; else echo 'Add'?>">
                <input type="button" class="button input-remove <?php if($this->remove_button_class) print $this->remove_button_class; else echo "remove-img";?>" value="remove"<?php if($this->value()==''):?> disabled<?php endif;?>>
            </label>
        <?php
        }
    }

    class Spectrum_Color_Control extends WP_Customize_Control
    {
        public $class;
        public function render_content()
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <input type="text" class="<?php if($this->class) echo esc_attr($this->class);else echo 'spectrum-color-picker';?>" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>">
            </label>
        <?php
        }
    }
}
